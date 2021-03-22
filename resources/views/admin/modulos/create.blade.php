@extends('plantilla')
@section('pagina')
<div class='container-fluid'>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-primary">Configuración de modulos
        </h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Nuevo modulo</h6>
        </div>
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="m-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <form method="POST" class="row" action="{{route('modulos.store')}}">
                @csrf
                <div class="form-group col-lg-12">
                    <label>Nombre de modulo <span class="text-danger">*</span></label>
                    <input type="text" name="modulo" value="{{old('modulo')}}" class="form-control" autocomplete="off"/>
                </div>
                <div class="form-group col-lg-12">
                    <label>Ruta</label>
                    <input type="text" name="ruta" value="{{old('ruta')}}" class="form-control" autocomplete="off"/>
                </div>
                <div class="form-group col-lg-12">
                    <label>Icono</label>
                    <input type="text" name="icono" value="{{old('icono')}}" class="form-control" autocomplete="off"/>
                </div>
                <div class="form-group col-lg-4">
                    <label>Nivel</label>
                    <input type="text" name="nivel" value="@if(old('nivel')) {{old('nivel')}} @else {{$request->nivel}} @endif" class="form-control" autocomplete="off"/>
                </div>
                <div class="form-group col-lg-4">
                    <label>Dependencia</label>
                    <input type="text" name="dependencia" value="@if(old('dependencia')) {{old('dependencia')}} @else {{$request->id}} @endif" class="form-control" autocomplete="off"/>
                </div>
                <div class="form-group col-lg-4">
                    <label>Orden</label>
                    <input type="text" name="orden" value="@if(old('orden')) {{old('orden')}} @else {{$request->orden}} @endif" class="form-control" autocomplete="off"/>
                </div>
                <div class="form-group col-lg-12">
                    <a href="{{route('modulos.index')}}"><div class="btn btn-sm btn-secondary"><i class="fas fa-times"></i> Cancelar</div></a>
                    <button class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop