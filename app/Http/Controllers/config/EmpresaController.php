<?php

namespace App\Http\Controllers\config;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\config\empresa;
use Illuminate\Support\Facades\Storage;

class EmpresaController extends Controller
{
    public function index()
    {
        $empresa = empresa::all();
        return view('admin.empresa.lista',compact('empresa'));
    }
    public function create(){
        return view('admin.empresa.create');
    }
    public function store(Request $request){
        $request->validate([
            'nombreEmpresa' => 'required',
            'color1' => 'required',
            'color2' => 'required',
            'color3' => 'required'
        ]);
        if(isset($request->foto)){
            $foto = $request->file('foto')->store('fotoempresa');
        }else{
            $foto = "fotoempresa/logo.png";
        }

        $empresa = new empresa;
        $empresa->nombreEmpresa = $request->nombreEmpresa;
        $empresa->logo = $foto;
        $empresa->color1 = $request->color1;
        $empresa->color2 = $request->color2;
        $empresa->color3 = $request->color3;
        $empresa->save();

        return redirect()->route('empresa.index')->with('mensaje','Datos guardados correctamente');
    }
    public function edit($id){
        $empresa = empresa::find($id);
        return view('admin.empresa.edit',compact('empresa'));
    }
    public function update(Request $request,$id){
        $request->validate([
            'nombreEmpresa' => 'required',
            'color1' => 'required',
            'color2' => 'required',
            'color3' => 'required'
        ]);
        $empresa = empresa::find($id);
        if(isset($request->foto))
        {
            if($empresa->logo!="fotoempresa/logo.png"){
                Storage::delete($empresa->logo);//Elimino foto anterior
            }
            $foto = $request->file('foto')->store('fotoempresa');
        }else{
            $foto = $empresa->logo;
        }
        $empresa->nombreEmpresa = $request->nombreEmpresa;
        $empresa->logo = $foto;
        $empresa->color1 = $request->color1;
        $empresa->color2 = $request->color2;
        $empresa->color3 = $request->color3;
        $empresa->save();
        return redirect()->route('empresa.edit',$id)->with('mensaje','Datos guardados correctamente');
    }
    public function destroy($id){
        $empresa = empresa::find($id);

        if($empresa->logo!="fotoempresa/logo.png"){
            Storage::delete($empresa->logo);//Elimino foto anterior
        }
        $empresa->delete();
        return redirect()->route('empresa.index')->with('mensaje','Dato eliminado correctamente');
    }
}
