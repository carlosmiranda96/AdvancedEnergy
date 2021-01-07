@extends('plantilla')
@section('pagina')
<div class='container-fluid'>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-primary">Configuración de horarios</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Actualizar horario {{$grupohorario->nombre}}</h6>
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
            <form method="POST" action="{{route('grupohorariosd.update',$grupohorariosd->id)}}">
                @method('PUT')
                @csrf
                <input hidden type="text" name="idgrupohorario" value="{{$grupohorario->id}}"/>
                <div class="form-group">
                    <label>Dia</label>
                    <select class="form-control" name="iddia" autofocus>
                        <option value="0">Seleccione</option>
                        @foreach ($dias as $item)
                        <option @if($grupohorariosd->iddia==$item->id) {{'selected'}} @endif value="{{$item->id}}">{{$item->dia}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Hora inicio</label>
                    <input type="time" name="horainicio" value="{{$grupohorariosd->horainicio}}" class="form-control" autocomplete="off"/>
                </div>
                <div class="form-group">
                    <label>Hora fin</label>
                    <input type="time" name="horafin" value="{{$grupohorariosd->horafin}}" class="form-control" autocomplete="off"/>
                </div>
                <div class="form-group">
                    <a href="{{route('grupohorario.show',$grupohorario->id)}}"><div class="btn btn-sm btn-secondary"><i class="fas fa-times"></i> Cancelar</div></a>
                    <button class="btn btn-sm btn-warning"><i class="fas fa-redo-alt"></i> Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop