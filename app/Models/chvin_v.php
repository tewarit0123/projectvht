<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chvin_v extends Model
{
    use HasFactory;

    protected $table = 'chvin_v'; // ระบุชื่อตาราง
    protected $primaryKey = 'idchv'; // กำหนด Primary Key (ถ้าใช้ชื่ออื่น)

    protected $fillable = [
        'idchv', // ตัวอย่างคอลัมน์ที่ต้องการบันทึก
        'v_id',   // เพิ่มคอลัมน์อื่นที่เกี่ยวข้อง
        'status',   // เพิ่มคอลัมน์อื่นที่เกี่ยวข้อง
    ];
}
