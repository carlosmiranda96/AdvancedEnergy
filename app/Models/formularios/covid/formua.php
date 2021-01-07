<?php

namespace App\Models\formularios\covid;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class formua extends Model
{
    use HasFactory;
    protected $fillable = ['id','fecha','nombrecompleto','dui','genero','empresa','otraempresa','proyecto','temperatura','comentarios'];
}
