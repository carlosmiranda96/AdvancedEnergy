@extends('reportes.plantilla')
@section('reporte')
<h4 class="text-center">Asistencia de empleados</h4>
<h6 class="text-center">Desde {{date('d/m/Y',strtotime($desde))}} hasta {{date('d/m/Y',strtotime($hasta))}}</h6>
<table class="table table-sm table-bordered" style="font-size: 12px;">
    <thead>
        <tr class="">
            <td>#</td>
            <td>Nombre</td>
            <td>Tipo</td>
            <td>Hora</td>
            <td>Ubicación</td>
        </tr>
    </thead>
    <tbody>
        <?php $correlativo=0;?>
            @foreach($asistencia as $item)
        <?php 
            $correlativo++;
        ?>
        <tr>
            <td>{{$correlativo}}</td>
            <td>{{$item->nombre}}</td>
            <td>@if($item->tipo=="E") {{'Entrada'}} @else {{'Salida'}} @endif</td>
            <td>{{date('h:m a',strtotime($item->instante))}}</td>
            <td>{{$item->ubicacion}}</td>
        </tr>
        @endforeach
    </tbody>
</table> 
@stop  
