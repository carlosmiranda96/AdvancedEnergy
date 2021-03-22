<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class autorizaciongrupo extends Model
{
    use HasFactory;
    protected $fillable = ['idgrupo','idpermiso','ver','crear','editar','eliminar','excel','pdf'];
}
