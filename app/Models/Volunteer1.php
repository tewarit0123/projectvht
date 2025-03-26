<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    use HasFactory;

    // กำหนดชื่อของตารางในฐานข้อมูล (ถ้าชื่อตารางไม่เป็นไปตามกฎของ Laravel)
    protected $table = 'volunteers';

    protected $fillable = [
        'national_id',
         'first_name',
          'last_name',
           'address',
            'phone',
        'birth_date',
         'age', 
         'height',
          'weight',
           'gender'
    ];
}
