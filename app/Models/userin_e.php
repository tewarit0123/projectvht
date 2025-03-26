<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userin_e extends Model
{
    use HasFactory;
    protected $table = 'userin_e';
    protected $primaryKey = 'u_id';

    protected $fillable = [
        'fullname', 
        'id_card',   
        'username', 
        'password', 
    ];
}
