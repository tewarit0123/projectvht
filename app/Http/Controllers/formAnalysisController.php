<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormAnalysisController extends Controller
{
    public function index()
    {
        return view('formanalysis', ['slot' => '']);
    }

    public function store()
    {

    }
}
