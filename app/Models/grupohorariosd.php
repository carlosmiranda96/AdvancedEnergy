<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class grupohorariosd extends Model
{
    use HasFactory;
    protected $fillable = ['idgrupohorario','iddia','horainicio','horafin'];
}
