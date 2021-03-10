@extends('plantilla')
@section('pagina')
<div class='container-fluid'>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-primary">Configuración de vehiculos</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><a href="{{route('equipos.index')}}" style="color: #2E9A73"><i class="fas fa-arrow-left"></i></a>&nbsp&nbsp&nbspActualizar vehiculo</h6>
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
            <form method="POST" action="{{route('equipos.update',$equipostrabajo->id)}}">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label>Codigo</label>
                    <input disabled type="text"value="{{$equipostrabajo->codigo}}" class="form-control" autofocus autocomplete="off"/>
                </div>
                <div class="form-group">
                    <label>Tipo</label>
                    <select name="tipo" class="form-control">
                        <option value="0" @if($equipostrabajo->tipo==0) {{'selected'}} @endif>Seleccione</option>
                        <option value="1" @if($equipostrabajo->tipo==1) {{'selected'}} @endif>Vehiculo</option>
                        <option value="2" @if($equipostrabajo->tipo==2) {{'selected'}} @endif>Maquinaria</option>
                        <option value="3" @if($equipostrabajo->tipo==3) {{'selected'}} @endif>Herramientas</option>
                    </select>
                </div>
                <input hidden type="text" name="codigo" value="{{$equipostrabajo->codigo}}" class="form-control"/>
                <div class="form-group">
                    <label>Placa</label>
                    <input type="text" name="placa" value="{{$equipostrabajo->placa}}" class="form-control" autocomplete="off"/>
                </div>
                <div class="form-group">
                    <label>Marca</label>
                    <input type="text" name="marca" value="{{$equipostrabajo->marca}}" class="form-control" autocomplete="off"/>
                </div>
                <div class="form-group">
                    <label>Modelo</label>
                    <input type="text" name="modelo" value="{{$equipostrabajo->modelo}}" class="form-control" autocomplete="off"/>
                </div>
                <div class="form-group">
                    <label>Año</label>
                    <input type="number" name="año" value="{{$equipostrabajo->año}}" class="form-control" autocomplete="off"/>
                </div>
                <div class="form-group">
                    <label>Descripción</label>
                    <textarea type="text" name="descripcion" class="form-control" autocomplete="off">{{$equipostrabajo->descripcion}}</textarea>
                </div>
                <div class="form-group">
                    <a href="{{route('equipos.index')}}"><div class="btn btn-sm btn-secondary"><i class="fas fa-times"></i> Cancelar</div></a>
                    <button class="btn btn-sm btn-warning"><i class="fas fa-redo-alt"></i> Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop