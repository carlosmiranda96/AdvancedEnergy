<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class empleadoDocumento extends Model
{
    use HasFactory;
    protected $fillable = [
        'idempleado',
        'idtipodocumento',
        'numerodocumento',
        'fechaexpedicion',
        'fechavencimiento',
        'foto'
    ];
}
