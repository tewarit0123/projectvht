<?php

namespace App\Http\Controllers;

use App\Models\chv;
use App\Models\Village;
use App\Models\chv_elder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon; // ใช้สำหรับคำนวณอายุ
use Barryvdh\DomPDF\Facade\Pdf;


class FormVolunteerController extends Controller
{
    public function index(Request $request)
    {
        $villages = Village::all(); // Fetch all villages
        $perPage = $request->input('perPage', 10);
        $search = $request->input('search');
        
        $query = chv::leftJoin('chvin_v', 'chv.id_card', '=', 'chvin_v.idchv')
            ->leftJoin('village', 'chvin_v.v_id', '=', 'village.v_id')
            ->select('chv.*', 'village.v_name as village_name');
    
        // ถ้ามีการค้นหา
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('chv.fullname', 'LIKE', "%{$search}%")
                  ->orWhere('chv.id_card', 'LIKE', "%{$search}%")
                  ->orWhere('village.v_name', 'LIKE', "%{$search}%");
            });
        }
    
        $volunteers = $query->paginate($perPage);

        // เพิ่มข้อมูลจำนวนผู้สูงอายุที่ดูแล
        $volunteers->getCollection()->transform(function($volunteer) {
            $volunteer->elder_count = chv_elder::where('idchv', $volunteer->idchv)->count(); // ดึงจำนวนผู้สูงอายุที่ดูแล
            return $volunteer;
        });
    
        if ($request->ajax()) {
            return response()->json([
                'volunteers' => $volunteers,
                'pagination' => [
                    'total' => $volunteers->total(),
                    'per_page' => $volunteers->perPage(),
                    'current_page' => $volunteers->currentPage(),
                    'last_page' => $volunteers->lastPage(),
                ]
            ]);
        }
    
        return view('formvolunteerindex', compact('volunteers', 'villages'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titlename' => 'required|string',
            'fullname' => 'required|string',
            'birth_date' => 'required|date',
            'phone' => 'required|string',
            'id_card' => 'required|string|max:13',
            'address' => 'required|string',
            'village' => 'nullable|string',
            'gender' => 'required|string',
            'username' => 'required|string|unique:chv',
            'password' => 'nullable|string|min:6',
        ]);

        // Check if the id_card already exists in the system
        if (chv::where('id_card', $validated['id_card'])->exists()) {
            return redirect()->back()->withErrors(['id_card' => 'เลขบัตรประชาชนนี้มีอยู่ในระบบแล้ว'])->withInput();
        }

        $birthDate = Carbon::parse($validated['birth_date']);
        $age = $birthDate->age;

        if ($age < 18) {
            return redirect()->back()->withErrors(['birth_date' => 'ผู้สมัครต้องมีอายุอย่างน้อย 18 ปี'])->withInput();
        }

        $password = $validated['password'] ? bcrypt($validated['password']) : null;

        chv::create([

            'titlename' => $validated['titlename'],
            'fullname' => $validated['fullname'],
            'phone' => $validated['phone'],
            'birth_date' => $validated['birth_date'],
            'id_card' => $validated['id_card'],
            'address' => $validated['address'],
            'village' => $validated['village'],
            'gender' => $validated['gender'],
            'username' => $validated['username'],
            'password' => $password,
        ]);

        return redirect()->route('formvolunteerindex')->with('success', 'บันทึกข้อมูลสำเร็จ');
    }

    public function edit($idchv)
    {
        $volunteer = chv::findOrFail($idchv);
        $villages = Village::all();
        return view('formvolunteeredit', compact('volunteer', 'villages'));
    }

    public function update(Request $request, $idchv)
    {
        $validated = chv::findOrFail($idchv);

        $validated->update([
            'titlename' => $request->titlename,
            'fullname' => $request->fullname,
            'phone' => $request->phone,
            'address' => $request->address,
            'village' => $request->village,
            'username' => $request->username,
        ]);

        if ($request->filled('password')) {
            $validated->password = bcrypt($request->password); // Corrected to use $request->password
        }

        $validated->save();

        return redirect()->route('formvolunteerindex')->with('success', 'อัพเดทข้อมูลสำเร็จ');
    }

    public function destroy($idchv)
    {
        $volunteer = chv::findOrFail($idchv);
        $volunteer->delete();

        return Redirect::route('formvolunteerindex')->with('success', 'ลบข้อมูลสำเร็จ');
    }

    public function elderReport(Request $request)
    {
        $volunteerId = $request->input('volunteer_id'); 
        $elders = chv_elder::with(['chv', 'elder'])
            ->where('idchv', $volunteerId) 
            ->get(); 

        // เพิ่มการ join เพื่อดึงชื่อผู้สูงอายุและชื่อ อสม.
        $elders = chv_elder::leftJoin('elder', 'chv_elder.e_id', '=', 'elder.e_id')
            ->leftJoin('chv', 'chv_elder.idchv', '=', 'chv.idchv') // Join to get volunteer name
            ->select('elder.*', 'elder.titlename as elder_title','elder.fullname as elder_name', 'chv.fullname as volunteer_name', 'chv.id_card', 'elder.id_card as elder_id_card') // Select elder and volunteer names
            ->where('chv_elder.idchv', $volunteerId)
            ->get(); 

        // เพิ่มการตรวจสอบเพื่อให้มีชื่อ อสม. แม้ไม่มีข้อมูล
        if ($elders->isEmpty()) {
            $elders[] = (object) [
                'volunteer_name' => 'ไม่พบข้อมูล',
                'fullname' => 'ไม่พบข้อมูล',
                'elder_id_card' => 'ไม่พบข้อมูล', 
                'address' => 'ไม่พบข้อมูล', 
                'weight' => 0.0, 
                'height' => 0.0, 
                'birth_date' => null, 
                'phone' => 'ไม่พบข้อมูล', 
            ]; // สร้างอ็อบเจ็กต์ใหม่ถ้าไม่มีข้อมูล
        }

        $chvselect = chv::leftJoin('chvin_v', 'chv.id_card', '=', 'chvin_v.idchv')
            ->leftJoin('village', 'chvin_v.v_id', '=', 'village.v_id')
            ->select('chv.fullname', 'village.v_name as village_name')
            ->where('chv.idchv', $volunteerId)
            ->get(); 

        return view('elder_report', compact('elders','chvselect'));
    }

    public function exportPDF($volunteerId)
    {
        // Get the same data as the elder_report view
        $elders = chv_elder::leftJoin('elder', 'chv_elder.e_id', '=', 'elder.e_id')
            ->leftJoin('chv', 'chv_elder.idchv', '=', 'chv.idchv')
            ->select('elder.*', 'elder.titlename as elder_title', 'elder.fullname as elder_name', 'chv.fullname as volunteer_name', 'chv.id_card' , 'elder.id_card as elder_id_card')
            ->where('chv_elder.idchv', $volunteerId)
            ->get();

        if ($elders->isEmpty()) {
            $elders[] = (object) [
                'volunteer_name' => 'ไม่พบข้อมูล',
                'fullname' => 'ไม่พบข้อมูล',
                'elder_id_card' => 'ไม่พบข้อมูล', 
                'address' => 'ไม่พบข้อมูล', 
                'weight' => 0.0, 
                'height' => 0.0, 
                'birth_date' => null, 
                'phone' => 'ไม่พบข้อมูล', 
            ]; // สร้างอ็อบเจ็กต์ใหม่ถ้าไม่มีข้อมูล
        }

        $chvselect = chv::leftJoin('chvin_v', 'chv.id_card', '=', 'chvin_v.idchv')
            ->leftJoin('village', 'chvin_v.v_id', '=', 'village.v_id')
            ->select('chv.fullname', 'village.v_name as village_name')
            ->where('chv.idchv', $volunteerId)
            ->get();

        $pdf = PDF::loadView('pdf.elder_report', compact('elders', 'chvselect'));
        
        // Set Thai font
        $pdf->setOption('defaultFont', 'THSarabunNew');
        
        // Download PDF with a specific filename
        return $pdf->download('รายงานผู้สูงอายุ_' . date('Y-m-d') . '.pdf');
    }
}