<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlySurvey extends Model
{
    use HasFactory;

    // กำหนดชื่อของตารางที่ใช้
    protected $table = 'monthly_surveys';

    // กำหนดฟิลด์ที่สามารถกรอกข้อมูลได้ (mass assignment)
    protected $fillable = [
        'e_id',        // FK ไปยังตาราง elderly
        'survey_date',       // วันที่ประเมิน (เก็บเฉพาะเดือนก็ได้)
        'walk_6m',          // การเดิน 6 เมตร
        'fall_6mo',         // การล้มใน 6 เดือน
        'weight_loss',      // การลดน้ำหนัก
        'appetite_loss',     // การสูญเสียความอยากอาหาร
        'vision_problem',    // ปัญหาการมองเห็น
        'hearing_status',    // สถานะการได้ยิน
        'sadness',           // ความเศร้า
        'no_pleasure',       // ไม่มีความสุข
        'daily_living',      // การใช้ชีวิตประจำวัน
        'chewing_problem',    // ปัญหาการเคี้ยว
        'oral_pain',         // อาการปวดในช่องปาก
        'details',              // ความคิดเห็น
    ];

    // กำหนดความสัมพันธ์กับ Volunteer
    public function volunteer()
    {
        return $this->belongsTo(Volunteer::class);
    }
}

