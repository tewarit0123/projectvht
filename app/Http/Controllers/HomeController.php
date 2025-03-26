<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function showForm()
    {
        return view('home'); // ส่งข้อมูลไปที่ view ที่ชื่อว่า home
    }
}


