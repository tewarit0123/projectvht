<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class elder extends Model
{
    use HasFactory;
    
    protected $table = 'elder';
    protected $primaryKey = 'e_id';

    protected $fillable = [
        'titlename',
        'fullname',
        'phone',
        'weight',
        'height',
        'birth_date',
        'id_card',
        'address',
        'village',
        'gender',
        'volunteer',
        'doctor',
        'phonevolunteer',
        'phonedoctor',
    ];
}
