<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chv_elder extends Model
{
    use HasFactory;

    protected $table = 'chv_elder';  // กำหนดชื่อของตารางให้เป็น chv
    protected $primaryKey = 'e_id';

    protected $fillable = [
        'e_id',
        'idchv',  
    ];

    public function chv()
    {
        return $this->belongsTo(Chv::class, 'idchv'); // Adjust 'chv_id' to the actual foreign key if different
    }

    public function elder()
    {
        return $this->belongsTo(elder::class, 'e_id'); // เพิ่มความสัมพันธ์กับโมเดล elder
    }
}
