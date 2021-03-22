<?php

namespace App\Http\Controllers\SSL;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class validar extends Controller
{
    function validar($txt)
    {
        return Storage::get($txt);
    }
}
