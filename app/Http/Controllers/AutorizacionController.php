<?php

namespace App\Http\Controllers;

use App\Models\autorizacionusuarios;
use App\Models\permisos;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\modulos;

class AutorizacionController extends Controller
{
    public function index()
    {
        $autorizacionusuarios = autorizacionusuarios::leftJoin('users','idusuario','users.id')->select('users.id','name as usuario')->groupby('users.id','name')->paginate(5);
        return view('admin.autorizacion.lista',compact('autorizacionusuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usuarios = User::get();
        return view('admin.autorizacion.create',compact('usuarios'));
    }
    public function usuario(Request $request)
    {
        $usuarios = User::get();
        $idusuario = 0;
        if(isset($request->id)){
            $idusuario = $request->id;
        }
        return view('admin.autorizacion.lista',compact('usuarios','idusuario'));
    }
    public function grupo()
    {
        $autorizacionusuarios = autorizacionusuarios::leftJoin('users','idusuario','users.id')->select('users.id','name as usuario')->groupby('users.id','name')->paginate(5);
        return view('admin.autorizacion.lista',compact('autorizacionusuarios'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'idusuario' => 'required|integer|min:1|unique:autorizacionusuarios',
            'permiso' => 'required',
        ]);
        foreach($request->permiso as $item){
            autorizacionusuarios::create([
                'idusuario' => $request->idusuario,
                'idpermiso' => $item
            ]);
        }
        return redirect()->route('autorizacion.index')->with('mensaje','Datos guardados correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        echo "hola";
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        echo "hola";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $idpermiso = $request->idpermiso;//Menu
        $idusuario = $request->idusuario;
        $permiso = $request->opcion;
        if(isset($idpermiso))
        {
            $opcion = 0;
            if(isset($request->autorizacion) && $request->autorizacion=="true")
            {
                $opcion = 1;
            }
            $autorizacion = autorizacionusuarios::where('idusuario',$idusuario)->where('idpermiso',$idpermiso)->first();
            if(!isset($autorizacion)){
                //AGREGAR PERMISO
                $autorizacion = new autorizacionusuarios;
                $autorizacion->idusuario = $idusuario;
                $autorizacion->idpermiso = $idpermiso;
                $autorizacion->ver = 0;
                $autorizacion->crear = 0;
                $autorizacion->editar = 0;
                $autorizacion->eliminar = 0;
                $autorizacion->excel = 0;
                $autorizacion->pdf = 0;
                $this->addOpcion($autorizacion,$permiso,$opcion)->save();
                $this->agregarDependencia($idusuario,$idpermiso);
                echo "1";
            }else{
                //ACTUALIZAR PERMISO OPCION
                $guardado = $this->addOpcion($autorizacion,$permiso,$opcion);
                $autorizacion = $guardado;
                $autorizacion->save();
                if($guardado->ver==0 && $guardado->crear==0 && $guardado->editar==0 && $guardado->eliminar==0 && $guardado->excel==0 && $guardado->pdf==0){
                    //ELIMINAR PERMISO
                    $borrar = autorizacionusuarios::where('idusuario',$idusuario)->where('idpermiso',$idpermiso)->first();
                    if(isset($borrar)){
                        $borrar->delete();
                        $this->eliminarDependencia($idusuario,$idpermiso);
                        echo "1";
                    }else{
                        echo "0";
                    }
                }else{
                    echo "1";
                }                
            }
        }else{
            echo "0";
        }
    }
    private function addOpcion(autorizacionusuarios $objeto,$permiso,$opcion)
    {
        switch($permiso)
        {
            case 1:
                $objeto->ver = $opcion;
                break;
            case 2:
                $objeto->crear = $opcion;
                break;
            case 3:
                $objeto->editar = $opcion;
                break;
            case 4:
                $objeto->eliminar = $opcion;
                break;
            case 5:
                $objeto->excel = $opcion;
                break;
            case 6:
                $objeto->pdf = $opcion;
                break;
        }
        return $objeto;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cargos  $cargos
     * @return \Illuminate\Http\Response
     */
    public function destroy($idusuario)
    {
        $autorizacionusuarios = autorizacionusuarios::where('idusuario',$idusuario);
        $autorizacionusuarios->delete();
        return redirect()->route('autorizacion.index')->with('mensaje','Dato eliminado correctamente');
    }
    public function agregarDependencia($idusuario,$idpermiso)
    {
        $permiso = modulos::find($idpermiso);
        $dependencia = $permiso->dependencia;
        if($dependencia>0)
        {
            $autorizacion = autorizacionusuarios::where('idusuario',$idusuario)->where('idpermiso',$dependencia)->first();
            if(!isset($autorizacion)){
                //AGREGAR PERMISO
                autorizacionusuarios::create([
                    'idusuario' => $idusuario,
                    'idpermiso' => $dependencia,
                    'ver' => 0,
                    'crear' => 0,
                    'editar' => 0,
                    'eliminar' => 0,
                    'excel' => 0,
                    'pdf' => 0
                ]);
                $this->agregarDependencia($idusuario,$dependencia);
            }
        }
    }
    public function eliminarDependencia($idusuario,$idpermiso)
    {
        $permiso = modulos::find($idpermiso);
        $dependencia = $permiso->dependencia;
        if($dependencia>0)
        {
            $auto = autorizacionusuarios::join('modulos','idpermiso','modulos.id')->select('modulos.*')->where('idusuario',$idusuario)->where('dependencia',$dependencia)->first();
            if(!isset($auto)){
                $borrar = autorizacionusuarios::where('idusuario',$idusuario)->where('idpermiso',$dependencia)->first();
                if(isset($borrar)){
                    $borrar->delete();
                    $this->eliminarDependencia($idusuario,$dependencia);
                }
            }
        }
    }
}
