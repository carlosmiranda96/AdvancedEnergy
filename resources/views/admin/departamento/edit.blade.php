@extends('plantilla')
@section('pagina')
<div class='container-fluid'>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-primary">Configuración de departamentos</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Actualizar ubicación</h6>
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
            <form method="POST" action="{{route('departamento.update',$departamento->id)}}">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label>Departamento</label>
                    <input type="text" name="departamento" value="{{$departamento->departamento}}" class="form-control" autofocus autocomplete="off"/>
                </div>
                <div class="form-group">
                    <label>Nivel</label>
                    <input type="text" name="nivel" value="{{$departamento->nivel}}" class="form-control" autofocus autocomplete="off"/>
                </div>
                <div class="form-group">
                    <label>Dependencia</label>
                    <select class="form-control" name="dependencia">
                        <option value="0">Seleccione</option>
                        @foreach ($departamentos as $department)
                            <option @if ($departamento->dependencia==$department->id) {{'selected'}} @endif value="{{$department->id}}">{{$department->departamento}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <a href="{{route('departamento.index')}}"><div class="btn btn-sm btn-secondary"><i class="fas fa-times"></i> Cancelar</div></a>
                    <button class="btn btn-sm btn-warning"><i class="fas fa-redo-alt"></i> Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop