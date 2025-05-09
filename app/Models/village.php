<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    use HasFactory;

    protected $table = 'village';
    protected $primaryKey = 'v_id';

    protected $fillable = [
        'v_name',
    ];
}
