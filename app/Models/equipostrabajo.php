<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class equipostrabajo extends Model
{
    use HasFactory;
    protected $fillable = ['codigo','placa','marca','modelo','año','descripcion'];
}
