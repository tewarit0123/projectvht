<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    protected $fillable = [
        'national_id',
        'titlename',
        'fullname',
        'address',
        'phone',
        'birth_date',
        'height',
        'weight',
        'gender',
        'status',
        // เพิ่ม fields อื่นๆ ตามที่ต้องการ
    ];
    
    protected $attributes = [
        'status' => 0, // ตั้งค่าเริ่มต้นเป็น 0
    ];
    // หรือใช้ guarded แทน fillable
    // protected $guarded = [];
}

