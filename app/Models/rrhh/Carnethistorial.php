<?php

namespace App\Models\rrhh;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carnethistorial extends Model
{
    use HasFactory;
    protected $fillable = ['id','fecha','hora','idcarnet','idempleado','idusuario'];
}
