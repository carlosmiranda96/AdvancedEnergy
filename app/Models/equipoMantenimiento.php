<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class equipoMantenimiento extends Model
{
    use HasFactory;
    protected $fillable = ['idequipo','fecha','kilometraje','pkMantenimiento','pfMantenimiento','descripcion','monto','tipomantenimiento'];
}
