<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Volunteer;
use Carbon\Carbon;

class VolunteerController extends Controller
{
    // แสดงรายชื่อผู้สูงอายุ
    public function index()
    {
        $volunteers = Volunteer::all(); // ดึงข้อมูลทั้งหมดของผู้สูงอายุ
        $volunteers = Volunteer::where('status', 0)->get(); // ดึงข้อมูลเฉพาะที่สถานะยัง active

        // คำนวณอายุจาก birth_date
        foreach ($volunteers as $volunteer) {
            $volunteer->calculated_age = Carbon::parse($volunteer->birth_date)->age;
        }

        return view('volunteers.index', compact('volunteers')); // ส่งข้อมูลไปยัง view
    }

    // แสดงฟอร์มสำหรับเพิ่มข้อมูล
    public function create()
    {
        return view('volunteers.create'); // ส่งไปยังฟอร์มสร้างใหม่
    }

    // บันทึกข้อมูลใหม่
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'national_id' => 'required|string',
            'titlename' => 'required|string',
            'fullname' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            'birth_date' => 'required|date',
            'height' => 'required|integer',
            'weight' => 'required|integer',
            'gender' => 'required|string',
        ]);


        // Create a new Volunteer record
        $volunteer = new Volunteer($validated);
        $volunteer->save();

        $this->sendLineNotify('มีการบันทึกข้อมูลผู้สูงอายุใหม่: ' . $request->first_name . ' ' . $request->last_name);

        return redirect()->route('volunteerss')->with('success', 'ข้อมูลถูกบันทึกเรียบร้อยแล้ว');
    }

    // แสดงฟอร์มสำหรับแก้ไขข้อมูล
    public function edit($id)
    {
        $volunteer = Volunteer::findOrFail($id); // ดึงข้อมูลของ volunteer ที่ต้องการแก้ไข
        return view('volunteers.edit', compact('volunteer')); // ส่งข้อมูลไปยัง view
    }

    public function update(Request $request, $id)
    {
        // ค้นหาข้อมูลที่ต้องการอัปเดต
        $volunteer = Volunteer::findOrFail($id);
    
        // รับค่า birth_date จากฟอร์ม
        $birthDate = $request->input('birth_date');
    
        // อัปเดตข้อมูลของ volunteer ด้วยข้อมูลที่ส่งมา
        $volunteer->national_id = $request->input('national_id');
        $volunteer->titlename = $request->input('titlename');
        $volunteer->fullname = $request->input('fullname');
        $volunteer->address = $request->input('address');
        $volunteer->phone = $request->input('phone');
        $volunteer->birth_date = $birthDate;
        $volunteer->height = $request->input('height');
        $volunteer->weight = $request->input('weight');
        $volunteer->gender = $request->input('gender');
    
        // บันทึกการเปลี่ยนแปลง
        $volunteer->save();
    
        // เปลี่ยนเส้นทางและแสดงข้อความสำเร็จ
        return redirect()->route('volunteers.index')->with('success', 'ข้อมูลถูกอัปเดตเรียบร้อยแล้ว');
    }

    // ลบข้อมูล
    public function destroy($id)
    {
        $volunteer = Volunteer::findOrFail($id);
        $volunteer->status = 1; // เปลี่ยนสถานะเป็น 1 เพื่อแสดงว่าถูกลบ
        $volunteer->save();

        return redirect()->route('volunteers.index')->with('success', 'ข้อมูลถูกลบเรียบร้อยแล้ว');
    }

    public function updateStatus(Request $request, $id)
{
    $volunteer = Volunteer::findOrFail($id);
    $volunteer->status = $request->input('status'); // รับค่าจาก AJAX
    $volunteer->save();

    return response()->json(['success' => true]);
}

public function sendLineNotify($message)
{
    $token = 'lId42Rc8JaYfrq2lRhM8ywK0r0fURDRXMBnwNsmtyiF'; // แทนที่ด้วย Token ที่สร้างขึ้น
    $url = 'https://notify-api.line.me/api/notify';

    $data = [
        'message' => $message,
    ];

    $headers = [
        'Content-Type: application/x-www-form-urlencoded',
        'Authorization: Bearer ' . $token,
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    curl_close($ch);
}
}
