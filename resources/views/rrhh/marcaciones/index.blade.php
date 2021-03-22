@extends('plantilla')
@section('pagina')
<div class="container-fluid">
    <div hidden>
        <input id="cant" value="0"/>
        <input id="latitud" value="0"/>
        <input id="longitud" value="0"/>
        <input id="idusuario" value="{{session()->get('user_id')}}"/>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-primary">Asistencia</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <a href="{{route('marcacionesempleados.show',session()->get('user_id'))}}" style="text-decoration: none;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="h5 mb-0 font-weight-bold text-gray-800">Lista de asistencia</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-list fa-2x text-gray-300"></i>
                </div>
                </div>
            </div>
            </a>
        </div>
        </div>
    </div>
</div>
@stop