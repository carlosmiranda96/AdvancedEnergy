<?php

use App\Http\Controllers\AutorizacionGrupoController;
use App\Http\Controllers\AutorizacionUserController;
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
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\GrupohorariosController;
use App\Http\Controllers\GrupohorariosdController;
use App\Http\Controllers\IngenieriaController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PageAjustesController;
use App\Http\Controllers\modulosController;
use App\Http\Controllers\PaisController;
use App\Http\Controllers\PermisosController;
use App\Http\Controllers\reportes\AsistenciaRPTController;
use App\Http\Controllers\reportes\Covid19RPTController;

use App\Http\Controllers\reportes\EmpleadosRPTController;
use App\Http\Controllers\ReportesController;
use App\Http\Controllers\SSL\validar;
use App\Http\Controllers\UbicacionesController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\SvdepartamentoController;
use App\Http\Controllers\SvmunicipioController;
use App\Http\Controllers\TipodocumentoController;
use App\Http\Controllers\userAccesoController;
use App\Models\rutas\rutas;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\formularios\formController;
use App\Http\Controllers\formularios\solicitudempleoController;
use App\Http\Controllers\reportes\SolicitudEmpleoRPTController;
use App\Http\Controllers\rrhh\carnetController;
use App\Http\Controllers\vehiculos\EquiposaccesoriosController;
use Maatwebsite\Excel\Facades\Excel;

//RUTAS QUE NO NECESITAN ESTAR LOGEADO
Route::get('/',[PageController::class,'login'])->name('login');
Route::get('recuperacion',[PageController::class,'recordar'])->name('recordar');
Route::get('registrarse',[PageController::class,'registrarse'])->name('registrarse');
Route::post('iniciarsesion', [PageController::class, 'iniciarsesion'])->name('iniciarsesion');

Route::get('politica',[PageController::class,'politica'])->name('politica');

Route::get("pruebaperimetro",[PageController::class,'pruebaPerimetro']);

Route::get('apiiniciarsesion', [PageController::class, 'iniciarsesion'])->name('apiiniciarsesion');

Route::get('validaruser/{email}/{password}', [PageController::class, 'validarUser'])->name('validaruser');
Route::get('validarsesion', [PageController::class, 'validarsesion'])->name('validarsesion');
Route::get('validate',[PageController::class,'validar'])->name('validate');//Valida registro de usuario Restablecer Clave
Route::post('validate/password/update',[UsuariosController::class,'updateclave2'])->name('usuarios.updateclave2');
Route::POST('usuario/restablecer2',[UsuariosController::class,'restablecer2'])->name('usuario.restablecer2');

Route::get('ldap',[PageController::class,'ldap'])->name('ldap');

//ESPAÑOL DATATABLES

Route::get('datatable-es',function(){
    $data = array();
    $data["processing"] = "Cargando..";
    $data["search"] = "Buscar:&nbsp;";
    $data["lengthMenu"] = "Mostrando _MENU_ &nbsp;registros";
    $data["info"] = "Mostrando del _START_ al _END_ de _TOTAL_ registros";
    $data["infoEmpty"] = "Mostrando 0 registros";
    $data["infoFiltered"] = "(Filtrado de _MAX_ registros)";
    $data["infoPostFix"] = "";
    $data["loadingRecords"] = "Cargando...";
    $data["zeroRecords"] = "Busqueda no encontrada";
    $data["emptyTable"] = "No hay información";
    $data["paginate"] = array("first"=>"Primero",
                        "previous"=>"Anterior",
                        "next"=>"Siguiente",
                        "last"=>"Ultimo");
    $data["aria"] = array("sortAscending"=>": activer pour trier la colonne par ordre croissant",
                        "sortDescending"=>": activer pour trier la colonne par ordre décroissant");
    echo json_encode($data);
})->name('datatable-es');

//RUTAS DE API
Route::get('api/qr/obtenerubicacion',[PageController::class,'obtenerubicacion'])->name('api.getUbicacion');//Obtener ubicacion segun coordenadas
Route::get('api/asistencia',[PageController::class,'asistencia'])->name('asistencia');//Abre la aplicacion

Route::get('api/escaner',[PageController::class,'escaner'])->name('api.escanear');//Metodo para escanear, QR Empleado, QR Vehiculo, QR Ubicacion


//FORMULARIO --COVID
Route::get('api/form/covid/{toquen}',[formController::class,'covid'])->name('api.form.covid');//Abre formulario covid

Route::get('api/form/covidenviar',[formController::class,'guardarcovid'])->name('api.form.covid.enviar');//Envia formulario covid
//FORMULARIO --VEHICULO
Route::get('api/form/vehiculo',[formController::class,'vehiculo'])->name('api.form.vehiculo');//Abre formulario vehiculo
Route::put('api/form/vehiculo/update/{id}',[EquiposhistorialController::class,'update'])->name('api.form.vehiculo.update');//Actualiza formulario vehiculo

//FORMULARIO SOLICITUD EMPLEO
Route::get("solicitud-empleo",[solicitudempleoController::class,'solicitud'])->name("form.solicitudempleo");
Route::post("solicitud-empleo/guardar",[solicitudempleoController::class,'guardar'])->name("form.solicitudempleo.guardar");
Route::get("solicitudes-empleo",[solicitudempleoController::class,'index'])->name('solicitudempleo.index');


//VALIDAR CERTIFICADO SSL
Route::get('.well-known/pki-validation/{txt}',[validar::class,'validar'])->name('ssl');

//RUTAS QUE NECESITAN QUE EL USUARIO ESTE LOGEADO
Route::group(['middleware' => 'sesion'], function() {

    Route::get('api/qr',[PageController::class,'lectorqr'])->name('lectorqr');//Abre el lector qr
    Route::get('cerrarsesion',[PageController::class,'cerrar'])->name('cerrarsesion');

    /*$rutas = rutas::all();
    foreach($rutas as $item){
        //$funcion = [PageController::class, 'inicio'];
        $funcion = "";
        $funcion = "[PageController::class, 'inicio']";
        eval("\$funcion = \"$funcion\";");
        echo $funcion;
        //Route::get($item->ruta,$funcion)->name($item->nombre);
    }*/
    Route::get('inicio', [PageController::class, 'inicio'])->name('inicio');


    Route::get('rrhh',[PageController::class,'rrhh'])->name('rrhh');

    Route::get('aplicacion',[PageController::class,'loadaplicacion'])->name('load.aplicacion');

    Route::get('QR/marcaciones',[PageController::class,'marcaciones'])->name('marcacion');
    Route::get('QR/equipos',[PageController::class,'equipos'])->name('historialequipos');
    Route::get('QR/escaner',[PageController::class,'escaner'])->name('escanear');
    Route::get('QR/escanerCarnet',[PageController::class,'escanerCarnet'])->name('escanearCarnet');//Escanea el carnet para relacionar user con empleado
    Route::get('QR/obtenerubicacion',[PageController::class,'obtenerubicacion'])->name('getUbicacion');
    Route::get('QR/obtenerEmpleado',[PageController::class,'obtenerEmpleado'])->name('getEmpleado');

    //Route::get('general',[PageController::class,'general'])->name('general');

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
    
    Route::get('reportes/asistencia/excel',[AsistenciaRPTController::class,'generarExcel'])->name('AsistenciaRPTController.excel');
    Route::get('reportes/covid19/excel',[Covid19RPTController::class,'generarExcel'])->name('Covid19RPTController.excel');
    Route::get('reportes/solicitudempleo/excel',[SolicitudEmpleoRPTController::class,'generarExcel'])->name('SolicitudEmpleoRPTController.excel');

    //empleados
    Route::get('reportes/empleado/parametros/{id}',[EmpleadosRPTController::class,'parametros'])->name('reportes.empleados.parametros');//obtener parametros a imprimir
    Route::get('reportes/empleado/pdf',[EmpleadosRPTController::class,'generarPDF'])->name('reportes.empleados.pdf');//GENERA REPORTE PDF
    //asistencia
    Route::get('reportes/asistencia/parametros/{id}',[AsistenciaRPTController::class,'parametros'])->name('reportes.asistencia.parametros');//obtener parametros a imprimir
    Route::get('reportes/asistencia/pdf',[AsistenciaRPTController::class,'generarPDF'])->name('reportes.asistencia.pdf');//GENERA REPORTE PDF

    Route::get('marcaciones',[PageController::class,'marcaciones'])->name('marcaciones');

    Route::get('exportar',[PageController::class,'export'])->name('exportar');

    Route::get('mail',[PageController::class,'pruebaemail']);
    //Accesos
    Route::resource('userAcceso',userAccesoController::class);

    Route::resource('carnet',carnetController::class);


    //CONTROL DE VEHICULOS
    Route::get('controlvehiculos',[EquiposhistorialController::class,'index'])->name('controlvehiculos');

    Route::get("accesoriosvehiculos/add",[EquiposaccesoriosController::class,'add'])->name('addAccesorio');
    Route::get("accesoriosvehiculos/get",[EquiposaccesoriosController::class,'get'])->name('getAccesorio');
    Route::get("accesoriosvehiculos/delete",[EquiposaccesoriosController::class,'delete'])->name('deletedAccesorio');


    Route::POST('usuario/restablecer',[UsuariosController::class,'restablecer'])->name('usuario.restablecer');
    Route::get('usuarios/password/{id}',[UsuariosController::class,'cambiarclave'])->name('usuarios.clave');
    Route::put('usuarios/password/update/{id}',[UsuariosController::class,'updateclave'])->name('usuarios.updateclave');

});

//RUTAS DE ADMINISTRADOR
Route::group(['middleware' => 'admin'], function()
{
    Route::resource('cargos',CargoController::class);
    Route::resource('ubicacion',UbicacionesController::class);
    Route::resource('dias',DiasController::class);
    Route::resource('diasFeriados',DiasferiadosController::class);
    Route::resource('grupohorario',GrupohorariosController::class);
    Route::resource('empleados',EmpleadosController::class);
    Route::post('empleado/grupo',[EmpleadosController::class,'updateGrupo'])->name('empleado.updategrupo');

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
    
    

    Route::resource('grupo',GrupoController::class);

    Route::resource('modulos',modulosController::class);

    Route::get('menu/crear',[modulosController::class,'crear'])->name('modulos.crear');


    Route::resource('permisos',PermisosController::class);
    
    Route::resource('autorizacion',AutorizacionUserController::class);
    Route::get('autorizacions/usuario',[AutorizacionUserController::class,'index'])->name('autorizacion.usuario');//Por usuario
    Route::get('autorizacions/usuario/update',[AutorizacionUserController::class,'update'])->name('autorizacion.usuario.update');

    Route::get('autorizacions/grupo',[AutorizacionGrupoController::class,'index'])->name('autorizacion.grupo');//Por grupo
    Route::get('autorizacions/grupo/update',[AutorizacionGrupoController::class,'update'])->name('autorizacion.grupo.update');//Por grupo

    Route::resource('pais',PaisController::class);
    Route::get('svpais/departamento',[PaisController::class,'getDepartamento'])->name('pais.departamento');

    Route::resource('svdepartamento',SvdepartamentoController::class);
    Route::resource('svmunicipio',SvmunicipioController::class);
    Route::get('municipio/departamento',[SvmunicipioController::class,'getDepartamento'])->name('svmunicipio.departamento');
    Route::resource('tipodocumento',TipodocumentoController::class);
    Route::resource('estadocivil',EstadocivilController::class);
    Route::resource('genero',GeneroController::class);
});

