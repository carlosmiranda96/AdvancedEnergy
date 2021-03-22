@extends('plantilla')
@section('pagina')
<div class='container-fluid'>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-primary">Configuración de carnets</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Nuevo carnet</h6>
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
            <form method="POST" action="{{route('carnet.store')}}">
                @csrf
                <div class="form-group">
                    <label>Codigo</label>
                    <input type="text" name="codigo" value="{{old('codigo')}}" class="form-control" autofocus autocomplete="off"/>
                </div>
                <div class="form-group">
                    <label>Fecha vencimiento</label>
                    <input type="date" name="fechavencimiento" value="{{old('fechavencimiento')}}" class="form-control" autocomplete="off"/>
                </div>
                <div class="form-group">
                    <label>Empleado</label>
                    <p class="text-danger">* solo muestra empleados que no se les ha asignado carnet</p>
                    <select name="idempleado" class="form-control">
                        <option value="0">Seleccione</option>
                        @foreach ($empleados as $item)
                        <option value="{{$item->id}}">{{$item->nombreCompleto}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <a href="{{route('carnet.index')}}"><div class="btn btn-sm btn-secondary"><i class="fas fa-times"></i> Cancelar</div></a>
                    <button class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop