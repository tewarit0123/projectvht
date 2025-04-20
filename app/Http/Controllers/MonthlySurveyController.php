<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MonthlySurvey;
use Carbon\Carbon;

class MonthlySurveyController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'e_id' => 'required|exists:elder,e_id',
            'walk_6m' => 'required|in:1,2',
            'fall_6mo' => 'required|in:1,2',
            'weight_loss' => 'required|in:1,2',
            'appetite_loss' => 'required|in:1,2',
            'vision_problem' => 'required|in:1,2',
            'hearing_status' => 'required|in:1,2,3,4',
            'sadness' => 'required|in:1,2',
            'no_pleasure' => 'required|in:1,2',
            'daily_living' => 'required|in:1,2',
            'chewing_problem' => 'required|in:1,2',
            'oral_pain' => 'required|in:1,2',
            'details' => 'required|string',
        ]);

        // เพิ่มวันที่ประเมิน
        $validated['survey_date'] = Carbon::now();

        // สร้างข้อมูลใหม่
        MonthlySurvey::create($validated);

        return redirect()->back()->with('success', 'บันทึกข้อมูลการประเมินเรียบร้อยแล้ว');
    }
} 