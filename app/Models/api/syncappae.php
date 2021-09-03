<?php

namespace App\Models\api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class syncappae extends Model
{
    use HasFactory;
    protected $fillable = ['key','dispositivo','fecha','hora','descripcion','latitud','longitud'];
}
