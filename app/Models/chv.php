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

    // เพิ่ม relationship กับตาราง village ผ่าน chvin_v
    public function village()
    {
        return $this->belongsToMany(Village::class, 'chvin_v', 'id_card', 'v_id')
                    ->select(['village.*']);
    }

    // แก้ไข accessor สำหรับดึงชื่อหมู่บ้าน
    public function getVillageNameAttribute()
    {
        return $this->leftJoin('chvin_v', 'chv.id_card', '=', 'chvin_v.idchv')
                    ->leftJoin('village', 'chvin_v.v_id', '=', 'village.v_id')
                    ->where('chv.id_card', $this->id_card)
                    ->value('village.v_name');
    }
}
