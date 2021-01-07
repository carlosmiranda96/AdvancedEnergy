<?php

use App\Http\Controllers\EquiposhistorialController;
use App\Http\Controllers\formularios\formController;
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

Route::get('asistencia',[PageController::class,'asistencia'])->name('asistencia');
Route::get('ubicacion',[PageController::class,'ubicacion'])->name('ubicacion');

Route::post('qr/vehiculo',[PageController::class,'vehiculo'])->name('api.vehiculo');
Route::post('qr/escaner',[PageController::class,'abrirescaner'])->name('api.cargarescaner');

Route::get('form/vehiculo',[formController::class,'vehiculo'])->name('api.form.vehiculo');
Route::put('form/vehiculo/update/{id}',[EquiposhistorialController::class,'update'])->name('api.form.vehiculo.update');//actualiza formulario
Route::get('form/covid/{idempleado}',[formController::class,'covid'])->name('api.form.covid');
Route::post('form/covidenviar',[formController::class,'guardarcovid'])->name('api.form.covid.enviar');

Route::get('qr/obtenerubicacion',[PageController::class,'obtenerubicacion'])->name('api.getUbicacion');//Obtener ubicacion

Route::get('qr/escaner',[PageController::class,'escaner'])->name('api.escanear');//GUardar información
