<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class marcacionesempleados extends Model
{
    use HasFactory;
    protected $fillable = [
        'idempleado',
        'idusuario',
        'tipo',
        'fecha',
        'instante',
        'observaciones',
        'idubicacion',
        'latitud',
        'longitud'
    ];
}
