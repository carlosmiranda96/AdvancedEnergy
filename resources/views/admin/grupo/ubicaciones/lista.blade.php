@extends('plantilla')
@section('pagina')
<div class='container-fluid'>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-primary">Ubicaciones Asignadas al grupo ({{$grupo->grupo}})</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Listado de miembros</h6>
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
            <div class="form-inline">
                <div class="form-group mx-sm-3 mb-2">
                    <a href="{{route('grupo.index')}}"><button class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Regresar</button></a>
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <label>Ubicaciones</label>
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <select class="form-control form-control-sm" id="idubicacion" name="idubicacion">
                        <option value="0">Seleccione</option>
                        @foreach($ubicaciones as $user)
                            <option value="{{$user->id}}">{{$user->descripcion.' ('.$user->codigo.')'}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <button onclick="agregar('{{$idgrupo}}')" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Agregar</button>
                </div>
            </div>
            <div class="table-responsive mt-3">
                <table id="table_id" class="table table-sm display responsive nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>Ubicacion</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Ubicacion</th>
                            <th>Acciones</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($miembros as $item)
                        <tr>
                            <td>{{$item->descripcion.' ('.$item->codigo.')'}}</td>
                            <td>
                                <form id="frmeliminar{{$item->key}}" method="post" action="{{route('grupo.ubicaciones.destroy',$item->key)}}" class="form-inline">
                                @csrf
                                <a onclick="eliminar('{{$item->key}}')" class="btn btn-sm btn-danger" href="#"><i class="fas fa-trash-alt"></i> Eliminar</a>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        @if ($miembros->count()==0)
                        <tr>
                            <td colspan="5" class="text-center">No hay datos</td>
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
    function agregar(idgrupo){
        var idubicacion = $("#idubicacion").val();
        if(idubicacion==0){
            $("#idubicacion").focus();
            bootbox.dialog({
                title:"Notificación",
                message:"Por favor seleccione un usuario",
                buttons:{
                    ok:{
                        label:"Ok"
                    }
                }
            });
        }else{
            $.ajax({
                url:"{{route('grupo.ubicaciones.add')}}",
                type:"POST",
                data:"_token={{csrf_token()}}&idubicacion="+idubicacion+"&idgrupo="+idgrupo,
                success:function(r)
                {
                    if(r==1)
                    {
                        location.reload();
                    }else{
                        bootbox.dialog({
                            title:"Notificación",
                            message:"No se ha podido agregar el usuario "+r,
                            buttons:{
                                ok:{
                                    label:"Ok"
                                }
                            }
                        });
                    }
                }
            });
        }
    }
    function eliminar(key){
        alertify.confirm("Notificación","¿Desea eliminar el registro?",function(){
            $("#frmeliminar"+key).submit();
        },function(){

        });
    }
</script>
@stop