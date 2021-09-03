<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usuariosGrupo extends Model
{
    use HasFactory;
    protected $fillable = [
        'idGrupo',
        'idUsuario'
    ];
}
