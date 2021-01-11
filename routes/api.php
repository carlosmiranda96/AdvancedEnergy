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

Route::get('qr/obtenerubicacion',[PageController::class,'obtenerubicacion'])->name('api.getUbicacion');//Obtener ubicacion segun coordenadas
Route::get('asistencia',[PageController::class,'asistencia'])->name('asistencia');//Abre la aplicacion
Route::get('qr',[PageController::class,'lectorqr'])->name('lectorqr');//Abre el lector qr

Route::get('escaner',[PageController::class,'escaner'])->name('api.escanear');//Metodo para escanear, QR Empleado, QR Vehiculo, QR Ubicacion


//FORMULARIO --COVID
Route::get('form/covid/{toquen}',[formController::class,'covid'])->name('api.form.covid');//Abre formulario covid
Route::get('form/covidenviar',[formController::class,'guardarcovid'])->name('api.form.covid.enviar');//Envia formulario covid
//FORMULARIO --VEHICULO
Route::get('form/vehiculo',[formController::class,'vehiculo'])->name('api.form.vehiculo');//Abre formulario vehiculo
Route::put('form/vehiculo/update/{id}',[EquiposhistorialController::class,'update'])->name('api.form.vehiculo.update');//Actualiza formulario vehiculo









