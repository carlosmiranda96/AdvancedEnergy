<?php

namespace App\Models\rutas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rutas extends Model
{
    use HasFactory;
    protected $fillable = ['metodo','ruta','funcion','nombre'];
}
