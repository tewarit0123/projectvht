<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\elder;

class elderlyController extends Controller
{
    public function index()
    {
        return view('elderly'); 
    }

    public function dashboard(Request $request)
    {
        $elder = Elder::where('e_id', $request->session()->get('elder_id'))
            ->first();
            
        return view('elder.dashboard', compact('elder'));
    }
}