<?php

namespace App\Http\Controllers\cloud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class cloudController extends Controller
{
    public function index(){
        return view('cloud.cloud');
    }
}
