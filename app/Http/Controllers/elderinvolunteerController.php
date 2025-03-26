<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Elder;
use App\Models\chv;
use App\Models\Village;
use App\Models\chvin_v; // นำเข้า Model ที่ใช้บันทึกข้อมูล
use App\Models\chv_elder; // นำเข้า Model ที่ใช้บันทึกข้อมูล

class elderinvolunteerController extends Controller
{
    public function index(Request $request)
    {
        $villages = Village::all(); // Fetch all villages
        $chv_elder = chv_elder::all();

        // Check if a village is selected
        $selectedVillage = $request->input('villageInput');

        $elders = Elder::leftJoin('village', 'elder.village', '=', 'village.v_name')
        ->leftJoin('chv_elder', 'chv_elder.e_id', '=', 'elder.e_id')
        ->leftJoin('chv', 'chv_elder.idchv', '=', 'chv.idchv')
        ->select(
            'elder.*', 
            'village.v_id', 
            'village.v_name', 
            'chv.fullname as chvfullname',
            'chv.titlename as chvtitlename',
            'chv.idchv'

        )
        ->when($selectedVillage, function ($query, $selectedVillage) {
            return $query->where('village.v_name', $selectedVillage);
        })
        ->paginate(10);
    
    
        
        $volunteers = chv::join('chvin_v', 'chv.id_card', '=', 'chvin_v.idchv')
            ->whereNull('chvin_v.idchv')
            ->select('chv.*')
            ->get(); // Fetch volunteers not associated with chvin_v
        
        $chvs = chvin_v::join('chv', 'chvin_v.idchv', '=', 'chv.id_card')
            ->select('chv.titlename', 'chv.fullname', 'chv.village', 'chvin_v.v_id', 'chvin_v.idchv')
            ->when($selectedVillage, function ($query) use ($selectedVillage) {
                return $query->where('chvin_v.v_id', '=', $selectedVillage); // Filter by selected village
            })
            ->get(); // ดึงข้อมูลอสม. จาก chvin_v

        return view('elderinvolunteer', compact('elders', 'villages', 'chvs', 'volunteers')); // ส่งข้อมูลอสม. ไปยัง view
    }

    public function chvine($v_id){

        $chvs = chv::join('chvin_v', 'chv.id_card', '=', 'chvin_v.idchv')
            ->select('chv.titlename', 'chv.fullname','chv.idchv' )
            ->where('chvin_v.v_id', $v_id)
            ->get(); 

        return response()->json($chvs); // Return the results as JSON
    }

    public function storeChvElder(Request $request)
    {
        $validated = $request->validate([
            'chv' => 'required|string',
            'elder_id' => 'required|string',    
        ]);

        // Update the existing entry in the chv_elder table
        chv_elder::updateOrCreate(
            ['e_id' => $validated['elder_id']], // Find by elder_id
            ['idchv' => $validated['chv']] // Update or create with chv
        );

        return response()->json(['success' => 'บันทึกข้อมูลสำเร็จ']);
    }

    public function editChvElder($id)
    {
        $chvElder = chv_elder::with('elder') // Assuming you have a relationship defined
            ->where('e_id', $id)
            ->first();

        return response()->json($chvElder); // Return the selected chv_elder as JSON
    }
}