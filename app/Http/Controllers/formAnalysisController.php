<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Elder;

class FormAnalysisController extends Controller
{
    public function index($e_id = null)
    {
        $elder = null;
        if ($e_id) {
            $elder = Elder::find($e_id);
        }
        return view('formanalysis', compact('elder'));
    }

    public function store()
    {

    }
}
