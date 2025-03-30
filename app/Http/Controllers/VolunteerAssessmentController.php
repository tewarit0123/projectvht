<?php

namespace App\Http\Controllers;

use App\Models\elder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VolunteerAssessmentController extends Controller
{
    public function index()
    {
        $chvId = Auth::guard('chv')->user()->idchv;
        
        $elders = elder::join('chv_elder', 'elder.e_id', '=', 'chv_elder.e_id')
            ->where('chv_elder.idchv', $chvId)
            ->select('elder.*')
            ->get();

        return view('volunteerss', compact('elders'));
    }

    public function getElderDetails(Request $request)
    {
        $elder = elder::where('fullname', $request->fullname)->first();
        return response()->json($elder);
    }

    public function store(Request $request)
    {
        if($request->isMethod('post')) {
            $chvId = Auth::guard('chv')->user()->idchv;
            
            return redirect()->back()->with('success', 'บันทึกข้อมูลสำเร็จ');
        }

        $chvId = Auth::guard('chv')->user()->idchv;
        $elders = elder::join('chv_elder', 'elder.e_id', '=', 'chv_elder.e_id')
            ->where('chv_elder.idchv', $chvId)
            ->select('elder.*')
            ->get();

        return view('volunteerss', compact('elders'));
    }
} 