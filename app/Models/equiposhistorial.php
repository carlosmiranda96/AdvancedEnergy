<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class equiposhistorial extends Model
{
    use HasFactory;
    protected $fillable = [
        'instante',
        'idequipotrabajo',
        'idempleado',
        'kilometraje',
        'combustible',
        'extinguidor',
        'botiquin',
        'equiposeguridad',
        'observaciones',
        'idusuario',
        'latitud',
        'longitud',
        'uso'
    ];
}
