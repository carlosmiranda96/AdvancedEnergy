@extends('plantilla')
@section('pagina')
    <div class='container-fluid'>
      <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-primary">Asistencia de mes actual</h1>
    </div>
    <div class="card shadow mb-4 mt-3">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lista de asistencia</h6>
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
                <table id="table_id" class="table table-sm display responsive nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Codigo</th>
                            <th>Empleado</th>
                            <th>Temperatura</th>
                            <th>Fecha</th>
                            <th>Entrada</th>
                            <th>Salida</th>
                            <th>Ubicación</th>
                            <th>Usuario</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Codigo</th>
                            <th>Empleado</th>
                            <th>Temperatura</th>
                            <th>Fecha</th>
                            <th>Entrada</th>
                            <th>Salida</th>
                            <th>Ubicación</th>
                            <th>Usuario</th>
                        </tr>
                    </tfoot>
                    <?php 
                        use App\Models\marcacionesempleados;
                    ?>
                    <tbody>
                        <?php $contador=0;?>
                        @foreach ($marcacionesempleados as $item)
                        <?php $contador++;?>
                        <tr>
                            <td>{{$contador}}</td>
                            <td>{{$item->codigoempleado}}</td>
                            <td>{{$item->empleado}}</td>
                            <td class="text-center">{{number_format($item->temp,2)}}</td>
                            <td>{{date('d/m/Y',strtotime($item->fecha))}}</td>
                            <td>{{date('h:i:s a',strtotime($item->instante))}}</td>
                            <?php
                                $salida = marcacionesempleados::where('tipo','Salida')->where('idempleado',$item->idempleado)->where('instante','>=',date('h:i:s a',strtotime($item->instante)))->where('fecha',$item->fecha)->first();
                                if($salida!=null){
                                    $hora = $salida->instante;
                                    $horasalida = date('h:i:s a',strtotime($hora));
                                }else{
                                    $hora = "00:00";
                                    $horasalida = "No disponible";
                                }
                            ?>
                            <td>{{$horasalida}}</td>                           
                            <td>{{$item->descripcion}}</td>
                            <td>{{$item->usuario}}</td>
                        </tr>
                        @endforeach
                        @if ($marcacionesempleados->count()==0)
                        <tr>
                            <td colspan="9" class="text-center">No hay datos</td>
                        </tr>
                        @endif
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
    function eliminar(key){
        alertify.confirm("Notificación","¿Desea eliminar el registro?",function(){
            $("#frmeliminar"+key).submit();
        },function(){

        });
    }
    function herramienta(id,div)
    {
        bootbox.alert('Mensaje');
    }
</script>
@stop