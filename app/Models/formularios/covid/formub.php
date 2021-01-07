<?php

namespace App\Models\formularios\covid;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class formub extends Model
{
    use HasFactory;
    protected $fillable = ['id','idformua','idformuc','si','no'];
}