<?php

namespace App\Models\config;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class configapp extends Model
{
    use HasFactory;
    protected $fillable = ['version'];
}
