<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\userin_e;

class userinelderController extends Controller
{
    public function index(Request $request)
    {
        // Fetch all users from the userin_e model
        $users = userin_e::paginate(10); // Use pagination instead of all()
        $currentPage = $request->input('page', 1); // หน้าเริ่มต้น

        // Pass the users data to the view
        return view('userinelder', compact('users'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'fullname' => 'required|string|max:255',
            'id_card' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        // Create a new userin_e record
        userin_e::create($validatedData);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'บันทึกข้อมูลสำเร็จ');
    }

    public function update(Request $request, $u_id)
    {
        $user = userin_e::findOrFail($u_id);

        $user->update([
            'fullname' => $request->fullname,
            'id_card' => $request->id_card,
            'username' => $request->username,
        ]);

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->back()->with('success', 'อัพเดทข้อมูลสำเร็จ');
    }

    public function destroy($u_id)
    {
        try {
            // Find the user by ID and delete
            $user = userin_e::findOrFail($u_id);
            $user->delete();

            // Redirect back with a success message
            return redirect()->back()->with('success', 'ลบข้อมูลสำเร็จ');
        } catch (\Exception $e) {
            // Redirect back with an error message
            return redirect()->back()->with('error', 'เกิดข้อผิดพลาด: ' . $e->getMessage());
        }
    }
}
