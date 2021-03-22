<?php
namespace App\Http\Controllers\reportes;
use App\Http\Controllers\Controller;
use App\Models\empleados;
use Illuminate\Http\Request;

class EmpleadosRPTController extends Controller
{
    public function parametros($idpermiso)
    {
        $empleados = empleados::where('estado',1)->orderby('nombre1')->get();
        echo    '<div class="form-group">
                    <label>Seleccione empleado</label>
                    <select class="form-control" name="idempleado" required>
                        <option value="0">Todos</option>';
                        foreach($empleados as $item){
                        echo '<option value="'.$item->id.'">'.$item->nombre1.' '.$item->apellido1.' '.$item->codigo.'</option>';
                        }
        echo    '   </select>
                </div>';
    }
    public function generarPDF(Request $request)
    {
        $idreporte = $request->idreporte;
        $idempleado = $request->idempleado;
        if($idempleado==0)
        {
            $empleados = empleados::where('estado',1)->get();
        }else{
            $empleados = empleados::where('estado',1)->get();
        }
        return view('reportes.empleadosRPT',compact('empleados'));
    }
}