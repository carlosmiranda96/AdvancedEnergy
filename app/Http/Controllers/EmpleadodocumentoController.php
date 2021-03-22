<?php

namespace App\Http\Controllers;

use App\Models\empleadoDocumento;
use App\Models\empleadoDocumentosFotos;
use App\Models\empleados;
use App\Models\tipodocumento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class EmpleadodocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }
    public function subiradjunto(Request $request)
    {
        $image = $request->file('file');
        $imageName = time().'.'.$image->extension();
        $image->move(public_path('documentos'),$imageName);
        empleadoDocumentosFotos::create([
            'idempleadodocumento' => $request->empleadodocumentoid,
            'foto' => $imageName
        ]);
        return response()->json(['success' => $imageName]);
    }
    public function listaadjunto(Request $request)
    {
        $fotos = empleadoDocumentosFotos::where('idempleadodocumento',$request->idempleadodocumento)->get();
        $output = '<div class="row">';
        foreach($fotos as $item){
            $foto = $item->foto;
            $extencion = explode('.',$foto)[1];
            if(strtolower($extencion)=='pdf'){
                $output .= '<div class="col-md-2 text-center">
                    <img src="'.asset('public/documentos/pdf.png').'" class="img-thumbnail" width="150" height="150"/>
                    '.$item->foto.'
                    <button type="button" class="btn btn-danger btn-sm remove_image" id="'.$item->id.'">Eliminar</button>
                </div>';
            }else{
                $output .= '<div class="col-md-2 text-center">
                    <img src="'.asset('public/documentos/'.$item->foto).'" class="img-thumbnail" width="150" height="150"/>
                    '.$item->foto.'
                    <button type="button" class="btn btn-danger btn-sm remove_image" id="'.$item->id.'">Eliminar</button>
                </div>';
            }
        }
        $output .= '</div>';
        echo $output;
    }
    public function borraradjunto(Request $request)
    {
        if(isset($request->id))
        {
            $empleadodocumentofoto = empleadoDocumentosFotos::find($request->id);
            $foto = $empleadodocumentofoto->foto;
            $file_path = public_path('documentos/'.$foto);
            File::delete($file_path);
            $empleadodocumentofoto->delete();
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $empleados = empleados::find($request->id);
        $tipodocumento = tipodocumento::orderby('tipodocumento')->get();
        return view('rrhh.empleados.documentos.create',compact('empleados','tipodocumento'));
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
            'idtipodocumento' => 'required|integer|min:1',
            'numerodocumento' => 'required'
        ]);
        empleadoDocumento::create($request->all());
        return redirect()->route('empleadodocumento.show',$request->idempleado)->with('mensaje','Datos guardados correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\empleadoDocumento  $empleadoDocumento
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empleados = empleados::find($id);
        $empleadodocumento = empleadoDocumento::join('tipodocumentos','idtipodocumento','tipodocumentos.id')->select('empleado_documentos.*','tipodocumentos.tipodocumento')->where('idempleado',$id)->paginate();
        return view('rrhh.empleados.documentos.show',compact('empleados','empleadodocumento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\empleadoDocumento  $empleadoDocumento
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empleadodocumento = empleadoDocumento::find($id);
        $empleados = empleados::find($empleadodocumento->idempleado);
        $tipodocumento = tipodocumento::orderby('tipodocumento')->get();
        return view('rrhh.empleados.documentos.edit',compact('empleados','tipodocumento','empleadodocumento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\empleadoDocumento  $empleadoDocumento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $empleadodocumento = empleadoDocumento::find($id);
        $empleadodocumento->update($request->all());
        return redirect()->route('empleadodocumento.show',$request->idempleado)->with('mensaje','Datos guardados correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\empleadoDocumento  $empleadoDocumento
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empleadodocumento = empleadoDocumento::find($id);
        $idempleado = $empleadodocumento->idempleado;
        $empleadodocumento->delete();
        return redirect()->route('empleadodocumento.show',$idempleado)->with('mensaje','Dato eliminado correctamente');
    }
}
