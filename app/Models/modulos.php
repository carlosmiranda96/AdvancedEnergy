<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class modulos extends Model
{
    use HasFactory;
    protected $fillable = ['modulo','ruta','icono','nivel','dependencia','orden'];
}
