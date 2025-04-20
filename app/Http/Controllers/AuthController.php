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
            return redirect()->route('elderly');
        }

        // ถ้ายังไม่ล็อกอิน ให้แสดงหน้า login
        return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     */
    public function login(Request $request)
    {
        // Validate based on user type
        if ($request->user_type === 'elderly') {
            $request->validate([
                'id_card' => 'required|string|size:13',
            ]);

            // ค้นหาผู้สูงอายุจากเลขบัตรประชาชน
            $elder = Elder::where('id_card', $request->id_card)->first();

            if ($elder) {
                // Store elder data in session
                $request->session()->put('elder_id', $elder->e_id);
                $request->session()->put('user_type', 'elderly');
                
                return redirect()->route('elder.dashboard');
            }

            return back()->withErrors(['login_error' => 'เลขบัตรประชาชนไม่ถูกต้อง']);
        }

        // ... existing code for CHV login ...
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = chv::leftJoin('chvin_v', 'chv.id_card', '=', 'chvin_v.idchv')
            ->leftJoin('village', 'chvin_v.v_id', '=', 'village.v_id')
            ->select('chv.*', 'village.v_name as village_name')
            ->where('chv.username', $request->username)
            ->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::guard('chv')->login($user);
            $request->session()->regenerate();
            $request->session()->put('username', $request->username);
            $request->session()->put('user_type', 'chv');

            return redirect()->route('elderly');
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

    public function showElderly()
    {
        // Get the currently logged in CHV's ID
        $chvId = Auth::guard('chv')->user()->idchv;
        
        // Fetch elders assigned to this CHV through the chv_elder relationship table
        $elders = Elder::join('chv_elder', 'elder.e_id', '=', 'chv_elder.e_id')
            ->where('chv_elder.idchv', $chvId)
            ->select('elder.*')
            ->get();

        return view('elderly', compact('elders'));
    }
}
