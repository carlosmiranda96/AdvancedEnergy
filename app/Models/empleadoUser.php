<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class empleadoUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'idusuario',
        'idempleado'
    ];
}
