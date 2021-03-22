@extends('plantilla')
@section('pagina')
<div class='container-fluid'>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-primary">Configuración de departamentos
        </h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Nuevo departamento</h6>
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
            <form method="POST" action="{{route('svdepartamento.store')}}">
                @csrf
                <div class="form-group">
                    <label>Pais <span class="text-danger">*</span></label>
                    <select class="form-control" name="idpais">
                        <option value="0">Seleccione</option>
                        @foreach($pais as $item)
                        <option @if(old('idpais')==$item->id) {{'selected'}} @endif value="{{$item->id}}">{{$item->pais}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Codigo <span class="text-danger">*</span></label>
                    <input type="text" name="codigo" value="{{old('codigo')}}" class="form-control" autocomplete="off"/>
                </div>
                <div class="form-group">
                    <label>Departamento <span class="text-danger">*</span></label>
                    <input type="text" name="departamento" value="{{old('departamento')}}" class="form-control" autocomplete="off"/>
                </div>
                <div class="form-group">
                    <a href="{{route('svdepartamento.index')}}"><div class="btn btn-sm btn-secondary"><i class="fas fa-times"></i> Cancelar</div></a>
                    <button class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop