@extends('plantilla')
@section('pagina')
<div class='container-fluid'>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-primary">Configuración de dias feriados</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Nuevo dia feriado</h6>
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
            <form method="POST" action="{{route('diasFeriados.store')}}">
                @csrf
                <div class="form-group">
                    <label>Fecha <span class="text-danger">*</span></label>
                    <input type="date" name="fecha" class="form-control" value="{{old('fecha')}}" autofocus autocomplete="off"/>
                </div>
                <div class="form-group">
                    <label>Descripción <span class="text-danger">*</span></label>
                    <input type="text" name="descripcion" class="form-control" value="{{old('descripcion')}}" autocomplete="off"/>
                </div>
                <div class="form-group">
                    <a href="{{route('diasFeriados.index')}}"><div class="btn btn-sm btn-secondary"><i class="fas fa-times"></i> Cancelar</div></a>
                    <button class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop