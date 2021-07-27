<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class empleadoEmpresa extends Model
{
    use HasFactory;
    protected $fillable = [
        'idempleado',
        'idcargo',
        'idubicacion',
        'idempresa',
        'idgrupohorario',
        'salario',
        'horasextras'
    ];
}
