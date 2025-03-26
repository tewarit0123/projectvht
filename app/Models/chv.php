<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // ใช้ Authenticatable
use Illuminate\Notifications\Notifiable;

class chv extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'chv';  // กำหนดชื่อของตารางให้เป็น chv
    protected $primaryKey = 'idchv';

    public $timestamps = false;
    
    protected $fillable = [
        'titlename',
        'fullname',
        'phone',
        'birth_date',
        'id_card',
        'address',
        'village',
        'username',
        'password',
        'gender',
    ];

    protected $hidden = [
        'password', // ซ่อนรหัสผ่านเมื่อแสดงข้อมูล
        'remember_token',
    ];
}
