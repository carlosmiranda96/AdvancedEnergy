<?php

use App\Http\Controllers\api\ApiController;
use App\Http\Controllers\EquiposhistorialController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('userlogin/{email}/{password}', [PageController::class, 'user'])->name('userlogin');
Route::get('ubicaciones', [ApiController::class, 'ubicaciones'])->name('apiubicaciones');
Route::get('empleados', [ApiController::class, 'empleados'])->name('apiempleados');
Route::get('vehiculos', [ApiController::class, 'vehiculos'])->name('apivehiculos');












