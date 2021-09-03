@extends('plantilla')
@section('pagina')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-primary">Control de vehiculos</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Control de vehiculos</h6>
        </div>
        <div class="card-body">
            @if (session('mensaje'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('mensaje')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="table-responsive">
                <table id="table_id" class="display responsive nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Equipo</th>
                            <th>Empleado</th>
                            <th>Uso</th>
                            <th>Proyecto</th>
                            <th>kilometraje</th>
                            <th>Combustible</th>
                            <th>Herramientas</th>
                            <th>Observaciones</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Equipo</th>
                            <th>Empleado</th>
                            <th>Uso</th>
                            <th>Proyecto</th>
                            <th>kilometraje</th>
                            <th>Combustible</th>
                            <th>Herramientas</th>
                            <th>Observaciones</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    <?php $correlativo = 1;?>
                    @foreach($controlvehiculo as $item)
                        <tr>
                            <th>{{$correlativo}}</th>
                            <td>{{date("d/m/Y",strtotime($item->instante))}}</td>
                            <td>{{date("h:i a",strtotime($item->instante))}}</td>
                            <td>{{$item->codigo." / ".$item->placa}}</td>
                            <td>{{$item->nombreCompleto}}</td>
                            <td>{{$item->uso}}</td>
                            <td>{{$item->proyecto}}</td>
                            <td>{{$item->kilometraje}}</td>
                            <td>{{$item->combustible}}</td>
                            <td>{{$item->herramienta}}</td>
                            <td>{{$item->observaciones}}</td>
                        </tr>
                        <?php $correlativo++;?>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop
@section('script')
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