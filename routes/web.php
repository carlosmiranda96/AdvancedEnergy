<?php

use App\Http\Controllers\AutorizacionController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\DiasController;
use App\Http\Controllers\DiasferiadosController;
use App\Http\Controllers\EmpleadodocumentoController;
use App\Http\Controllers\EmpleadoempresaController;
use App\Http\Controllers\EmpleadoreferenciaController;
use App\Http\Controllers\EmpleadosController;
use App\Http\Controllers\EmpleadouserController;
use App\Http\Controllers\EquipomantenimientoController;
use App\Http\Controllers\EquipostrabajoController;
use App\Http\Controllers\EquiposhistorialController;
use App\Http\Controllers\MarcacionesempleadosController;
use App\Http\Controllers\EstadocivilController;
use App\Http\Controllers\GeneroController;
use App\Http\Controllers\GrupohorariosController;
use App\Http\Controllers\GrupohorariosdController;
use App\Http\Controllers\IngenieriaController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PageAjustesController;
use App\Http\Controllers\modulosController;
use App\Http\Controllers\PaisController;
use App\Http\Controllers\PermisosController;
use App\Http\Controllers\reportes\AsistenciaRPTController;
use App\Http\Controllers\reportes\EmpleadosRPTController;
use App\Http\Controllers\ReportesController;
use App\Http\Controllers\UbicacionesController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\SvdepartamentoController;
use App\Http\Controllers\SvmunicipioController;
use App\Http\Controllers\TipodocumentoController;
use Illuminate\Support\Facades\Route;

use Maatwebsite\Excel\Facades\Excel;

//RUTAS QUE NO NECESITAN ESTAR LOGEADO
Route::get('/',[PageController::class,'login'])->name('login');
Route::get('recuperacion',[PageController::class,'recordar'])->name('recordar');
Route::get('registrarse',[PageController::class,'registrarse'])->name('registrarse');
Route::post('iniciarsesion', [PageController::class, 'iniciarsesion'])->name('iniciarsesion');
Route::get('validaruser/{email}/{password}', [PageController::class, 'validarUser'])->name('validaruser');
Route::get('validarsesion', [PageController::class, 'validarsesion'])->name('validarsesion');

//RUTAS QUE NECESITAN QUE EL USUARIO ESTE LOGEADO
Route::group(['middleware' => 'sesion'], function() {
    Route::get('api/qr',[PageController::class,'lectorqr'])->name('lectorqr');//Abre el lector qr

    Route::get('cerrarsesion',[PageController::class,'cerrar'])->name('cerrarsesion');
    Route::get('inicio', [PageController::class, 'inicio'])->name('inicio');
    Route::get('rrhh',[PageController::class,'rrhh'])->name('rrhh');

    Route::get('aplicacion',[PageController::class,'loadaplicacion'])->name('load.aplicacion');

    Route::get('QR/marcaciones',[PageController::class,'marcaciones'])->name('marcacion');
    Route::get('QR/equipos',[PageController::class,'equipos'])->name('historialequipos');
    Route::get('QR/escaner',[PageController::class,'escaner'])->name('escanear');
    Route::get('QR/obtenerubicacion',[PageController::class,'obtenerubicacion'])->name('getUbicacion');
    Route::get('QR/obtenerEmpleado',[PageController::class,'obtenerEmpleado'])->name('getEmpleado');

    Route::get('general',[PageController::class,'general'])->name('general');

    Route::resource('equiposhistorial',EquiposhistorialController::class);
    Route::get('equipohistorial/mostrar/{id}',[EquiposhistorialController::class,'mostrar'])->name('equiposhistorial.mostrar');
    Route::resource('marcacionesempleados',MarcacionesempleadosController::class);

    Route::get('ajustes/perfil',[PageAjustesController::class,'perfil'])->name('aj_perfil');
    Route::put('ajustes/perfil/update/{id}',[UsuariosController::class,'update'])->name('perfil.update');

    Route::get('ingenieria',[IngenieriaController::class,'index'])->name('ingenieria.index');
    Route::get('ingenieria/formulario',[IngenieriaController::class,'formulario'])->name('ingenieria.formulario');

    Route::resource('equipos',EquipostrabajoController::class);
    Route::resource('equipomantenimiento',EquipomantenimientoController::class);
    Route::get('mantenimiento/programacion',[EquipomantenimientoController::class,'programacion'])->name('equipomantenimiento.programacion');
    Route::get('session/guardarmenu',[PageController::class,'sessionmenu'])->name('session.guardarmenu');

    //Rutas de formularios
    Route::get('formulario/covid',[Reporte::class,'parametros'])->name('formulario.covid');

    //REPORTES
    Route::get('reporte/{id}',[ReportesController::class,'reportes'])->name('reportes');//Cargar el reporte por su id

    Route::get('reportes/parametros',[ReportesController::class,'parametros'])->name('reportes.parametros');
    Route::get('reportes/pdf',[ReportesController::class,'generarPDF'])->name('reportes.pdf');

    //empleados
    Route::get('reportes/empleado/parametros/{id}',[EmpleadosRPTController::class,'parametros'])->name('reportes.empleados.parametros');//obtener parametros a imprimir
    Route::get('reportes/empleado/pdf',[EmpleadosRPTController::class,'generarPDF'])->name('reportes.empleados.pdf');//GENERA REPORTE PDF
    //asistencia
    Route::get('reportes/asistencia/parametros/{id}',[AsistenciaRPTController::class,'parametros'])->name('reportes.asistencia.parametros');//obtener parametros a imprimir
    Route::get('reportes/asistencia/pdf',[AsistenciaRPTController::class,'generarPDF'])->name('reportes.asistencia.pdf');//GENERA REPORTE PDF

    Route::get('marcaciones',[PageController::class,'marcaciones'])->name('marcaciones');

    Route::get('exportar',[PageController::class,'export'])->name('exportar');
});

//RUTAS DE ADMINISTRADOR
Route::group(['middleware' => 'admin'], function() {
    Route::resource('cargos',CargoController::class);
    Route::resource('ubicacion',UbicacionesController::class);
    Route::resource('dias',DiasController::class);
    Route::resource('diasFeriados',DiasferiadosController::class);
    Route::resource('grupohorario',GrupohorariosController::class);
    Route::resource('empleados',EmpleadosController::class);

    Route::resource('empleadodocumento',EmpleadodocumentoController::class);
    Route::post('empleadodocumentos/subiradjunto',[EmpleadodocumentoController::class,'subiradjunto'])->name('empleadodocumento.subiradjunto');
    Route::get('empleadodocumentos/listaadjunto',[EmpleadodocumentoController::class,'listaadjunto'])->name('empleadodocumento.listaadjunto');
    Route::get('empleadodocumentos/borraradjunto',[EmpleadodocumentoController::class,'borraradjunto'])->name('empleadodocumento.borraradjunto');

    Route::resource('empleadoempresa',EmpleadoempresaController::class);
    Route::resource('empleadoreferencia',EmpleadoreferenciaController::class);
    Route::resource('empleadouser',EmpleadouserController::class);

    Route::resource('departamento',DepartamentoController::class);
    Route::resource('grupohorariosd',GrupohorariosdController::class);
    Route::resource('usuarios',UsuariosController::class);
    Route::get('usuarios/password/{id}',[UsuariosController::class,'cambiarclave'])->name('usuarios.clave');
    Route::put('usuarios/password/update/{id}',[UsuariosController::class,'updateclave'])->name('usuarios.updateclave');
    Route::resource('modulos',modulosController::class);

    Route::get('menu/crear',[modulosController::class,'crear'])->name('modulos.crear');

    Route::resource('permisos',PermisosController::class);
    
    Route::resource('autorizacion',AutorizacionController::class);
    Route::get('autorizacions/usuario',[AutorizacionController::class,'usuario'])->name('autorizacion.usuario');
    Route::get('autorizacions/update',[AutorizacionController::class,'update'])->name('autorizacion.update');
    Route::get('autorizacions/grupo',[AutorizacionController::class,'grupo'])->name('autorizacion.grupo');

    Route::resource('pais',PaisController::class);
    Route::get('svpais/departamento',[PaisController::class,'getDepartamento'])->name('pais.departamento');

    Route::resource('svdepartamento',SvdepartamentoController::class);
    Route::resource('svmunicipio',SvmunicipioController::class);
    Route::get('municipio/departamento',[SvmunicipioController::class,'getDepartamento'])->name('svmunicipio.departamento');
    Route::resource('tipodocumento',TipodocumentoController::class);
    Route::resource('estadocivil',EstadocivilController::class);
    Route::resource('genero',GeneroController::class);
});

