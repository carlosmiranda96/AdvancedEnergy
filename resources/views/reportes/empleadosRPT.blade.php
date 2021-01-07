@extends('reportes.plantilla')
@section('reporte')
<h4 class="text-center">Empleados</h4>
    <table class="table table-sm">
        <thead>
            <tr>
                <td>#</td>
                <td>Foto</td>
                <td>Codigo</td>
                <td>Empleado</td>
                <td>Fecha ingreso</td>
                <td>Fecha nacimiento</td>
            </tr>
        </thead>
        <tbody>
            <?php $correlativo=0;?>
            @foreach($empleados as $item)
            <?php $correlativo++;?>
            <tr>
                <td class="align-middle">{{$correlativo}}</td>
                <td class="align-middle"><img width="100px" src="{{asset(Storage::url('app/'.$item->foto))}}"/></td>
                <td class="align-middle">{{$item->codigo}}</td>
                <td class="align-middle">{{$item->nombreCompleto}}</td>
                <td class="align-middle">{{$item->fechaingreso}}</td>
                <td class="align-middle">{{$item->fechanacimiento}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@stop