@extends('plantillaQR')
@section('pagina')
<div class="row">
    <div class="col-12 text-center pt-2">
        @if(session('name'))
            <label class="font-gotham-medium color-secondary">Identificado como {{session('name')}} <button onclick="cerrarsesion()" class="btn btn-sm text-white">Cerrar sesión</button></label>
        @else
            <label class="font-gotham-medium color-secondary">No identificado</label>
        @endif
    </div>
</div>
<div class="row pt-5 mt-4 pb-5">
    <div class="col-12">
        <div class="card_amarilla caja">
            <img class="fotoperfil" src="{{asset(Storage::url('app/fotoempleado/perfilDefault.jpg'))}}">
        </div>
    </div>
    <div class="col-12 mt-4 mb-2 pb-2">
        <h5 class="font-gotham-medium color-white text-center">Carnet no asignado</h5>
        <h6 class="font-gotham-medium color-secondary text-center m-0 mt-3">Correlativo #</h6>
        <h3 class="font-gotham-medium color-secondary text-center">{{$carnet->codigo}}</h3>
    </div>
</div>
@stop