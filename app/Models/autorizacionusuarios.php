<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class autorizacionusuarios extends Model
{
    use HasFactory;
    protected $fillable = ['idusuario','idpermiso'];
}
