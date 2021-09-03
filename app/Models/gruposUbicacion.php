<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gruposUbicacion extends Model
{
    use HasFactory;
    protected $fillable = [
        'idUbicacion',
        'idGrupo'
    ];
}
