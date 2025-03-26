<?php

namespace App\Http\Controllers;

use App\Models\Village;
use Illuminate\Http\Request;

class FormVillageController extends Controller
{
    // ฟังก์ชันแสดงฟอร์มเพิ่มข้อมูลหมู่บ้าน
    public function create()
    {
        return view('formvillage');
    }

    // ฟังก์ชันแสดงข้อมูลหมู่บ้านทั้งหมด
    public function index(Request $request)
    {
        // ดึงข้อมูลหมู่บ้านทั้งหมดจากฐานข้อมูล พร้อมการแบ่งหน้า
        $perPage = 10; // จำนวนข้อมูลต่อหน้า
        $currentPage = $request->input('page', 1); // หน้าเริ่มต้น

        // เพิ่มการค้นหาตามชื่อหมู่บ้าน
        $search = $request->input('search');
        $villages = Village::when($search, function($query) use ($search) {
            return $query->where('v_name', 'like', "%{$search}%");
        })->paginate($perPage);

        // ส่งข้อมูลหมู่บ้านไปยัง view
        return view('formvillageindex', compact('villages', 'search'));
    }

    // ฟังก์ชันบันทึกข้อมูลหมู่บ้าน
    public function store(Request $request)
    {
        // Validate ข้อมูลจากฟอร์ม
        $request->validate([
            'name' => 'required|string',
        ]);

        // ตรวจสอบว่ามีชื่อหมู่บ้านนี้อยู่ในระบบแล้วหรือไม่
        if (Village::where('v_name', $request->name)->exists()) {
            return redirect()->back()->withErrors(['name' => 'มีชื่อนี้อยู่ในระบบแล้ว'])->withInput();
        }

        // บันทึกข้อมูลหมู่บ้าน
        Village::create([
            'v_name' => $request->name,  // ใช้ชื่อคอลัมน์ที่ถูกต้อง
        ]);

        // หลังจากบันทึกแล้ว redirect กลับไปที่หน้า index พร้อมข้อความ success
        return redirect()->route('formvillageindex')->with('success', 'หมู่บ้านถูกเพิ่มเรียบร้อย');
    }

    // ฟังก์ชันแสดงฟอร์มแก้ไขข้อมูลหมู่บ้าน
    public function edit($v_id)
    {
        // ค้นหาข้อมูลหมู่บ้านตาม ID
        $village = Village::findOrFail($v_id);
    
        // ส่งข้อมูลหมู่บ้านไปยัง View สำหรับการแก้ไข
        return view('formvillageedit', compact('village'));
    }
    
    // ฟังก์ชันอัพเดทข้อมูลหมู่บ้าน
    public function update(Request $request, $v_id)
    {
        // ค้นหาข้อมูลหมู่บ้านตาม ID
        $village = Village::findOrFail($v_id);
    
        // อัปเดตข้อมูลหมู่บ้าน
        $village->update([
            'v_name' => $request->name,
        ]);
    
        // ส่งผู้ใช้กลับไปยังหน้า index พร้อมข้อความ success
        return redirect()->route('formvillageindex')->with('success', 'อัพเดทข้อมูลหมู่บ้านเรียบร้อย');
    }
    
    // ฟังก์ชันลบข้อมูลหมู่บ้าน
    public function destroy($v_id)
    {
        // ค้นหาข้อมูลหมู่บ้านที่ต้องการลบ
        $village = Village::findOrFail($v_id);
        $village->delete();

        return redirect()->route('formvillageindex')->with('success', 'ลบข้อมูลหมู่บ้านเรียบร้อย');
    }
}
