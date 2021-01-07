@extends('plantilla')
@section('pagina')
<div class='container-fluid'>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-primary">Configuración de vehiculos</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><a href="{{route('equipos.index')}}" style="color: #2E9A73"><i class="fas fa-arrow-left"></i></a>&nbsp&nbsp&nbspNuevo vehiculo</h6>
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
            <form method="POST" action="{{route('equipos.store')}}">
                @csrf
                <div class="form-group">
                    <label>Codigo <span class="text-danger">*</span></label>
                    <input type="text" name="codigo" value="{{old('codigo')}}" class="form-control" autofocus autocomplete="off"/>
                </div>
                <div class="form-group">
                    <label>Placa <span class="text-danger">*</span></label>
                    <input type="text" name="placa" value="{{old('placa')}}" class="form-control"  autocomplete="off"/>
                </div>
                <div class="form-group">
                    <label>Marca <span class="text-danger">*</span></label>
                    <input type="text" name="marca" value="{{old('marca')}}" class="form-control"  autocomplete="off"/>
                </div>
                <div class="form-group">
                    <label>Modelo</label>
                    <input type="text" name="modelo" value="{{old('modelo')}}" class="form-control"  autocomplete="off"/>
                </div>
                <div class="form-group">
                    <label>Año</label>
                    <input type="number" name="año" value="{{old('año')}}" class="form-control"  autocomplete="off"/>
                </div>
                <div class="form-group">
                    <label>Descripción</label>
                    <textarea type="text" name="descripcion" value="{{old('descripcion')}}" class="form-control"  autocomplete="off"></textarea>
                </div>
                <div class="form-group">
                    <a href="{{route('equipos.index')}}"><div class="btn btn-sm btn-secondary"><i class="fas fa-times"></i> Cancelar</div></a>
                    <button class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop