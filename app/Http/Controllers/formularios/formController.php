<?php

namespace App\Http\Controllers\formularios;

use App\Http\Controllers\Controller;
use App\Models\empleadoDocumento;
use App\Models\empleadoUser;
use App\Models\empleados;
use App\Models\equiposhistorial;
use App\Models\formularios\covid\formua;
use App\Models\formularios\covid\formub;
use App\Models\genero;
use App\Models\formularios\covid\formuc;
use Illuminate\Http\Request;


class formController extends Controller
{
    public function vehiculo(Request $request)
    {
        $disabled = "";
        $equipohistorial = equiposhistorial::find($request->id);
        if(isset($equipohistorial->kilometraje)){
            $disabled = "disabled";
        }
		return view('form.vehiculo',compact('disabled','equipohistorial'));
    }
    public function formcovid()
    {
        $idusuario = session('user_id');
        $empleado = empleadoUser::where('idusuario',$idusuario)->first();
        $idempleado = 0;
        $toquen=0;
        
        $url = route('api.form.covid',$toquen);
        return view('form.cargar',compact('url'));
    }
    public function covid($toquen,Request $request)
    {
        $empleado = empleados::where('toquen',$toquen)->first();
        $dui = "";
        $temp = $request->temp;
        if($empleado){
            $dui = empleadoDocumento::where('idempleado',$empleado->id)->where('idtipodocumento',1)->first();
        }
        $genero = genero::all();
        $sintomas = formuc::orderby("requerido","desc")->get();
        if(!isset($temp)){
            $temp = "";     
        }else{
            $temp = number_format($temp,2);
        }
        return view('form.covid',compact('empleado','dui','genero','sintomas','temp'));
    }
    public function guardarcovid(Request $request)
    {
        date_default_timezone_set('America/El_Salvador');
        if(isset($request->fecha)&&isset($request->nombrecompleto))
        {
            $formulario = formua::create([
                'fecha' => $request->fecha,
                'nombrecompleto' => $request->nombrecompleto,
                'dui'=>$request->dui,
                'idgenero'=>$request->idgenero,
                'empresa'=>$request->empresa,
                'otraempresa'=>$request->otraempresa,
                'proyecto'=>$request->proyecto,
                'temperatura'=>$request->temperatura,
                'comentarios'=>$request->comentarios,
            ]);
            $idformua = $formulario->id;
            
            $sintomas = formuc::orderby("requerido","desc")->get();
            foreach($sintomas as $item)
            {
                $a = 'c'.$item->id;
                $valor = $request->$a;
                $si = NULL;
                $no = NULL;
                if(isset($valor) && $valor=="SI")
                {
                    $respuesta = "SI";
                }else{
                    $respuesta = "NO";
                }
                formub::create([
                    'idformua' =>$idformua,
                    'idformuc' =>$item->id,
                    'respuesta' =>$respuesta
                ]);
            }
            echo "1";
        }else{
            echo "0";
        }        
    }
}
