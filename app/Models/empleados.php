<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class empleados extends Model
{
    use HasFactory;
    protected $fillable = [
        'fechaingreso',
        'codigo',
        'nombre1',
        'nombre2',
        'apellido1',
        'apellido2',
        'apellido3',
        'nombrecompleto',
        'foto',
        'direccion',
        'correo',
        'telefono',
        'celular',
        'fechanacimiento',
        'idgenero',
        'idestadocivil',
        'idmunicipio',
        'estado',
        'toquen'
    ];
}
