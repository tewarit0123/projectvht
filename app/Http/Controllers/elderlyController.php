<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class elderlyController extends Controller
{
    public function index()
    {
        return view('elderly'); 
        
    }
}