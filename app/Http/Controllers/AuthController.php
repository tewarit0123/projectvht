<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\chv;
use App\Models\village;
use App\Models\elder;

class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        // ตรวจสอบว่าผู้ใช้ล็อกอินอยู่หรือไม่
        if (Auth::check()) {
            // ถ้าล็อกอินอยู่แล้ว เปลี่ยนเส้นทางไปยังหน้า dashboard
            return redirect()->route('dashboard');
        }

        // ถ้ายังไม่ล็อกอิน ให้แสดงหน้า login
        return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $villages = Village::all(); // Fetch all villages
        
        // ค้นหาผู้ใช้จากตาราง chv พร้อม join ข้อมูลหมู่บ้าน
        $user = chv::leftJoin('chvin_v', 'chv.id_card', '=', 'chvin_v.idchv')
            ->leftJoin('village', 'chvin_v.v_id', '=', 'village.v_id')
            ->select('chv.*', 'village.v_name as village_name')
            ->where('chv.username', $request->username)
            ->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::guard('chv')->login($user); // ใช้ Guard ที่กำหนด

            $request->session()->regenerate();
            $request->session()->put('username', $request->username);

            return redirect()->route('dashboard');
        }

        return back()->withErrors(['login_error' => 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง']);
    }


    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        Auth::guard('chv')->logout();

        Session::flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
