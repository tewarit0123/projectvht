<?php

namespace App\Http\Controllers;

use App\Models\Elder;
use App\Models\Village; // Import the Village model
use Illuminate\Http\Request;

class formelderlyController extends Controller
{
    public function edit($e_id)
    {
        // ค้นหาข้อมูลผู้สูงอายุที่ต้องการแก้ไข
        $elder = Elder::findOrFail($e_id);
        $villages = Village::all(); // Fetch all villages
        return view('formelderlyedit', compact('elder', 'villages')); // Pass villages to the view
    }

    public function store(Request $request)
    {
        // Validate ข้อมูลจากฟอร์ม
        $request->validate([
            'titlename' => 'required|string',
            'fullname' => 'required|string',
            'phone' => 'required|string',
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'birth_date' => 'required|date',
            'id_card' => 'required|string',
            'address' => 'required|string',
            'village' => 'required|string',
            'gender' => 'required|string',
            'volunteer' => 'required|string',
            'doctor' => 'required|string',
            'phonevolunteer' => 'required|string',
            'phonedoctor' => 'required|string',
        ]);

        // บันทึกข้อมูลลงในตาราง elder
        Elder::create([
            'titlename' => $request->titlename,
            'fullname' => $request->fullname,
            'phone' => $request->phone,
            'weight' => $request->weight,
            'height' => $request->height,
            'birth_date' => $request->birth_date,
            'id_card' => $request->id_card,
            'address' => $request->address,
            'village' => $request->village,
            'gender' => $request->gender,
            'volunteer' => $request->volunteer,
            'doctor' => $request->doctor,
            'phonevolunteer' => $request->phonevolunteer,
            'phonedoctor' => $request->phonedoctor,
        ]);

        // ส่งผลลัพธ์กลับไปที่หน้าฟอร์ม
        return redirect()->route('formelderly')->with('success', 'บันทึกข้อมูลสำเร็จ');
    }

    public function update(Request $request, $e_id)
    {
        // ค้นหาข้อมูลผู้สูงอายุที่ต้องการอัพเดท
        $elder = Elder::findOrFail($e_id);
        
        // อัพเดทข้อมูล
        $elder->update([
            'titlename' => $request->titlename,
            'fullname' => $request->fullname,
            'phone' => $request->phone,
            'weight' => $request->weight,
            'height' => $request->height,
            'birth_date' => $request->birth_date,
            'id_card' => $request->id_card,
            'address' => $request->address,
            'village' => $request->village,
            'volunteer' => $request->volunteer,
            'doctor' => $request->doctor,
            'phonevolunteer' => $request->phonevolunteer,
            'phonedoctor' => $request->phonedoctor,
        ]);

        $elder->save();

        // ส่งผลลัพธ์กลับไปที่หน้าฟอร์ม
        return redirect()->route('formelderly')->with('success', 'อัพเดทข้อมูลสำเร็จ');
    }

    public function index(Request $request)
    {
        $perPage = 10;
        $search = $request->input('search');
        
        $elders = Elder::when($search, function ($query) use ($search) {
            return $query->where('fullname', 'LIKE', "%{$search}%")
                         ->orWhere('id_card', 'LIKE', "%{$search}%");
        })
        ->paginate($perPage)
        ->withQueryString(); // เพิ่ม withQueryString() เพื่อรักษาพารามิเตอร์การค้นหาในการแบ่งหน้า
        
        $villages = Village::all();
        
        return view('formelderlyindex', compact('elders', 'villages', 'search'));
    }

    // ฟังก์ชันลบข้อมูลผู้สูงอายุ
    public function destroy($e_id)
    {
        // ค้นหาข้อมูลผู้สูงอายุที่ต้องการลบ
        $elder = Elder::findOrFail($e_id);
        $elder->delete();

        return redirect()->route('formelderlyindex')->with('success', 'ลบข้อมูลผู้สูงอายุเรียบร้อย');
    }
}
