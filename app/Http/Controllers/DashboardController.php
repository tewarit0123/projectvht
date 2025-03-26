<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Logic to fetch data for the dashboard
        return view('dashboard'); // Return the dashboard view
    }
}