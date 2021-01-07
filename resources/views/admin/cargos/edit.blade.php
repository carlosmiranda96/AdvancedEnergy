@extends('plantilla')
@section('pagina')
<div class='container-fluid'>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-primary">Configuración de cargos</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Actualizar cargo</h6>
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
            <form method="POST" action="{{route('cargos.update',$cargos->id)}}">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label>Cargo</label>
                    <input type="text" name="cargo" value="{{$cargos->cargo}}" class="form-control" autofocus autocomplete="off"/>
                </div>
                <div class="form-group">
                    <label>Departamento</label>
                    <select class="form-control" name="idDepartamento">
                        <option value="0">Seleccione</option>
                        @foreach ($departamento as $department)
                            <option @if($cargos->idDepartamento==$department->id) {{'selected'}} @endif value="{{$department->id}}">{{$department->departamento}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <a href="{{route('cargos.index')}}"><div class="btn btn-sm btn-secondary"><i class="fas fa-times"></i> Cancelar</div></a>
                    <button class="btn btn-sm btn-warning"><i class="fas fa-redo-alt"></i> Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop