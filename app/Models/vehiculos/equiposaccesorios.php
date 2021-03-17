<?php

namespace App\Models\vehiculos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class equiposaccesorios extends Model
{
    use HasFactory;
    protected $fillable = ['descripcion','idvehiculo'];
}
