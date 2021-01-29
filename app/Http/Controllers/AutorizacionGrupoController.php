<?php

namespace App\Http\Controllers;

use App\Models\autorizaciongrupo;
use App\Models\grupo;
use App\Models\modulos;
use Illuminate\Http\Request;

class AutorizacionGrupoController extends Controller
{
    public function index(Request $request)
    {
        $grupo = grupo::get();
        $idgrupo = 0;
        if(isset($request->id)){
            $idgrupo = $request->id;
        }
        return view('admin.autorizacion.grupo.lista',compact('grupo','idgrupo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'idgrupo' => 'required|integer|min:1|unique:autorizaciongrupo',
            'permiso' => 'required',
        ]);
        foreach($request->permiso as $item){
            autorizaciongrupo::create([
                'idgrupo' => $request->idgrupo,
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
        $idgrupo = $request->idgrupo;
        $permiso = $request->opcion;
        if(isset($idpermiso))
        {
            $opcion = 0;
            if(isset($request->autorizacion) && $request->autorizacion=="true")
            {
                $opcion = 1;
            }
            $autorizacion = autorizaciongrupo::where('idgrupo',$idgrupo)->where('idpermiso',$idpermiso)->first();
            if(!isset($autorizacion)){
                //AGREGAR PERMISO
                $autorizacion = new autorizaciongrupo;
                $autorizacion->idgrupo = $idgrupo;
                $autorizacion->idpermiso = $idpermiso;
                $autorizacion->ver = 0;
                $autorizacion->crear = 0;
                $autorizacion->editar = 0;
                $autorizacion->eliminar = 0;
                $autorizacion->excel = 0;
                $autorizacion->pdf = 0;
                $this->addOpcion($autorizacion,$permiso,$opcion)->save();
                $this->agregarDependencia($idgrupo,$idpermiso);
                echo "1";
            }else{
                //ACTUALIZAR PERMISO OPCION
                $guardado = $this->addOpcion($autorizacion,$permiso,$opcion);
                $autorizacion = $guardado;
                $autorizacion->save();
                if($guardado->ver==0 && $guardado->crear==0 && $guardado->editar==0 && $guardado->eliminar==0 && $guardado->excel==0 && $guardado->pdf==0){
                    //ELIMINAR PERMISO
                    $borrar = autorizaciongrupo::where('idgrupo',$idgrupo)->where('idpermiso',$idpermiso)->first();
                    if(isset($borrar)){
                        $borrar->delete();
                        $this->eliminarDependencia($idgrupo,$idpermiso);
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
    private function addOpcion(autorizaciongrupo $objeto,$permiso,$opcion)
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
    public function destroy($idgrupo)
    {
        $autorizaciongrupo = autorizaciongrupo::where('idgrupo',$idgrupo);
        $autorizaciongrupo->delete();
        return redirect()->route('autorizacion.index')->with('mensaje','Dato eliminado correctamente');
    }
    public function agregarDependencia($idgrupo,$idpermiso)
    {
        $permiso = modulos::find($idpermiso);
        $dependencia = $permiso->dependencia;
        if($dependencia>0)
        {
            $autorizacion = autorizaciongrupo::where('idgrupo',$idgrupo)->where('idpermiso',$dependencia)->first();
            if(!isset($autorizacion)){
                //AGREGAR PERMISO
                autorizaciongrupo::create([
                    'idgrupo' => $idgrupo,
                    'idpermiso' => $dependencia,
                    'ver' => 0,
                    'crear' => 0,
                    'editar' => 0,
                    'eliminar' => 0,
                    'excel' => 0,
                    'pdf' => 0
                ]);
                $this->agregarDependencia($idgrupo,$dependencia);
            }
        }
    }
    public function eliminarDependencia($idgrupo,$idpermiso)
    {
        $permiso = modulos::find($idpermiso);
        $dependencia = $permiso->dependencia;
        if($dependencia>0)
        {
            $auto = autorizaciongrupo::join('modulos','idpermiso','modulos.id')->select('modulos.*')->where('idgrupo',$idgrupo)->where('dependencia',$dependencia)->first();
            if(!isset($auto)){
                $borrar = autorizaciongrupo::where('idgrupo',$idgrupo)->where('idpermiso',$dependencia)->first();
                if(isset($borrar)){
                    $borrar->delete();
                    $this->eliminarDependencia($idgrupo,$dependencia);
                }
            }
        }
    }
}
