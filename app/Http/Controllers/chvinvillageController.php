<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Village; // Assuming you have a Village model
use App\Models\chv; // Added import for chv model
use App\Models\chvin_v;


class chvinvillageController extends Controller
{
    public function index(Request $request)
    {
        $villages = Village::all(); // Fetch all villages from the database
        // Fetch volunteers not associated with chvin_v
        $volunteers = chv::leftJoin('chvin_v', 'chv.id_card', '=', 'chvin_v.idchv')
            ->whereNull('chvin_v.idchv')
            ->select('chv.*')
            ->get(); // เปลี่ยนจาก Volunteer เป็น chv
       
        return view('chvinvillage', compact('villages', 'volunteers'));
    }

    public function chvjoin(Request $request){
        try{
            $chv_select = chv::join('chvin_v', 'chv.id_card', '=', 'chvin_v.idchv')
            ->select('chv.titlename', 'chv.fullname', 'chvin_v.v_id', 'chvin_v.status', 'chv.id_card', 'chv.phone', 'chv.village') // Added phone to the selection
            ->having('chvin_v.v_id', '=', $request->v_id)
            ->get();
            return response()->json([$chv_select]);
        }catch(\Exception $e){
            return response()->json(['message' => 'error: ' . $e->getMessage()],500);
        }
    }

    public function store(Request $request)
    {
 
        try {
            chvin_v::create([
                'idchv' => $request->input('id_card'), // ใช้ idchv จากตาราง chv
                'v_id' => $request->input('v_id') // ใช้ v_id จากตาราง village
            ]);
    
            return response()->json(['message' => 'บันทึกข้อมูลสำเร็จ'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'เกิดข้อผิดพลาด: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            // ตรวจสอบว่ามีข้อมูลที่ตรงกับ ID หรือไม่
            $volunteer = chvin_v::findOrFail($id); // เปลี่ยนจาก chv เป็น chvin_v
            if (!$volunteer) {
                return response()->json(['message' => 'เกิดข้อผิดพลาด: ID ไม่ถูกต้อง'], 404);
            }

            $volunteer->delete(); // ลบข้อมูลจาก chvin_v

            return response()->json(['message' => 'สำเร็จ'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'เกิดข้อผิดพลาด: ' . $e->getMessage()], 500);
        }
    }

    public function upstatus($id , $status)
    {
        try {
            chvin_v::where('idchv', $id)->update(['status' => $status]);
            return response()->json(['message' => 'สถานะถูกอัปเดตสำเร็จ'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'เกิดข้อผิดพลาด: ' . $e->getMessage()], 500);
        }
    }


}
