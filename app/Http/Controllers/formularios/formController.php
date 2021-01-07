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
		return view('form.vehiculo',compact('disabled','equipohistorial'));
    }
    public function vehiculoupdate(Request $request)
    {
        
    }
    public function covid($idempleado)
    {
        $empleado = empleados::find($idempleado);
        $dui = empleadoDocumento::where('idempleado',$idempleado)->where('idtipodocumento',1)->first();
        $genero = genero::all();
        $sintomas = formuc::all();
        return view('form.covid',compact('empleado','dui','genero','sintomas'));
    }
    public function formcovid()
    {
        $idusuario = session('user_id');
        $empleado = empleadoUser::where('idusuario',$idusuario)->first();
        $idempleado = 0;
        if($empleado){
            $idempleado = $empleado->idempleado;
        }
        $url = route('api.form.covid',$idempleado);
        return view('form.cargar',compact('url'));
    }
    public function guardarcovid(Request $request)
    {
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
            
            $sintomas = formuc::all();
            foreach($sintomas as $item)
            {
                $a = 'c'.$item->id;
                $valor = $request->$a;
                $si = NULL;
                $no = NULL;
                if($valor=="SI")
                {
                    $si = "SI";
                }else{
                    $no = "NO";
                }
                formub::create([
                    'idformua' =>$idformua,
                    'idformuc' =>$item->id,
                    'si' =>$si,
                    'no' =>$no,
                ]);
            }
            echo "1";
        }else{
            echo "0";
        }        
    }
}
