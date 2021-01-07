<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class empleadoDocumentosFotos extends Model
{
    use HasFactory;
    protected $fillable = [
        'idempleadodocumento',
        'foto'
    ];
}
