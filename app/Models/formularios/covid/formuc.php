<?php

namespace App\Models\formularios\covid;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class formuc extends Model
{
    use HasFactory;
    protected $fillable = ['id','sintoma','puntos'];
}
