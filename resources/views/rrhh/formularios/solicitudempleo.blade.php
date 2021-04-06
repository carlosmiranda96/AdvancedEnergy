@extends('plantilla')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/jquery.dataTables.min.css')}}">
<!--Script para tabla responsive-->
<link rel="stylesheet" type="text/css" href="{{asset('css/responsive.dataTables.min.css')}}" />
@stop
@section('pagina')
<div class='container-fluid'>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-primary">Solicitudes de empleos</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Solicitudes</h6>
        </div>
        <div class="card-body">
            <table id="table_id" class="display responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Fecha</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Dui</th>
                        <th>Fecha Nacimiento</th>
                        <th>Dirección Actual</th>
                        <th>Telefono</th>
                        <th>Celular</th>
                        <th>Aspiración Salarial</th>
                        <th>Email</th>
                        <th>Educación</th>
                        <th>Puesto</th>
                        <th>Empresa</th>
                        <th>Cargo</th>
                        <th>Fecha inicio</th>
                        <th>Salario</th>
                        <th>Responsabilidades</th>
                        <th>Es trabajo actual</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $contador=0;?>
                    @foreach($solicitudes as $item)
                    <?php $contador++;?>
                    <tr>
                        <td>{{$contador}}</td>
                        <td>{{$item->created_at}}</td>
                        <td>{{$item->nombre}}</td>
                        <td>{{$item->apellido}}</td>
                        <td>{{$item->dui}}</td>
                        <td>{{$item->fechanacimiento}}</td>
                        <td>{{$item->direccionactual}}</td>
                        <td>{{$item->telefono}}</td>
                        <td>{{$item->celular}}</td>
                        <td>{{$item->aspiracionsalarial}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->educacion}}</td>
                        <td>{{$item->puesto}}</td>
                        <td>{{$item->Eempresa}}</td>
                        <td>{{$item->Ecargo}}</td>
                        <td>{{$item->Efechainicio}}</td>
                        <td>{{$item->Esalario}}</td>
                        <td>{{$item->Eresponsabilidades}}</td>
                        <td>{{$item->Etrabajoactual}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop
@section('script')
<script type="text/javascript" src="{{asset('js/jquery.dataTables.min.js')}}"></script>
<!--Script para tabla responsive-->
<script type="text/javascript" src="{{asset('js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/dataTables.responsive.min.js')}}"></script>
<script>
    $(document).ready(function(){
        $('#table_id').DataTable({
            language: {
                url: "{{route('datatable-es')}}"
            }
        });
    });
</script>
@stop