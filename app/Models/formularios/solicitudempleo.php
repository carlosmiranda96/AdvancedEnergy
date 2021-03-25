<?php

namespace App\Models\formularios;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class solicitudempleo extends Model
{
    use HasFactory;
    protected $fillable = ['nombre','apellido','dui','fechanacimiento','direccionactual','telefono',
    'celular','email','aspiracionsalarial','educacion','puesto','Eempresa','Ecargo','Efechainicio','Esalario','Eresponsabilidades','Etrabajoactual'];
}
