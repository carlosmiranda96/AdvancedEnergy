@extends('plantilla')
@section('pagina')
<div class='container-fluid'>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-primary">Configuración de autorizacion</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Autorizaciones por usuario</h6>
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
                <div class="form-group">
                    <label>Usuario</label>
                    <select class="form-control" name="idusuario" id="idusuario" autocomplete="off" autofocus>
                        <option value="0">Seleccione</option>
                        @foreach ($usuarios as $item1)
                            <option @if(old('idusuario')==$item1->id){{'selected'}} @endif value="{{$item1->id}}">{{$item1->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Permisos</label>
                    <div class="table-responsive">
                <table class="table table-sm table-bordered" width="100%" cellspacing="0">
                    <tbody>
                                <?php

use App\Models\modulos;

                                menu2(1,0);

                                function menu2($nivel,$dependencia){
                                    $menu = modulos::where('nivel',$nivel)->where('dependencia',$dependencia)->orderby('orden')->get();

                                    $nivel++;
                                    if($nivel!=2){
                                        $nivelanterior = $nivel-2;
                                        $nivelanterior2 = $nivel-1;
                                    }
                                    foreach($menu as $item)
                                    {
                                        $espacio = ($nivel-2)*25;
                                        $tiponivel = modulos::where('dependencia',$item->id)->first();
                                        if(isset($tiponivel->modulo)){
                                            if($nivel==2){
                                                echo '<tr><td>
                                                    <strong>'.$item->modulo.'</strong>
                                                </td>
                                                <td></td>
                                                </tr>';
                                            }else{
                                                
                                                echo '<tr><td style="padding-left:'.$espacio.'px">
                                                '.$item->modulo.'
                                                </td>
                                                <td></td>
                                                </tr>';
                                            }
                                            menu2($nivel,$item->id);
                                        }else{
                                            if($nivel==2){
                                                echo '<tr class="fila"><td onclick="seleccionar('.$item->id.')">
                                                    <strong>'.$item->modulo.'</strong>
                                                </td>
                                                <td class="text-center">
                                                    <div class="form-check">
                                                        <input class="form-check-input" onchange="cambio(this)" type="checkbox" value="'.$item->id.'" id="ch'.$item->id.'">
                                                    </div>
                                                </td>
                                                </tr>';
                                            }else{
                                                //$espacio = $nivel*20;
                                                echo '<tr class="fila"><td style="padding-left:'.$espacio.'px" onclick="seleccionar('.$item->id.')">
                                                    '.$item->modulo.'
                                                </td>
                                                <td class="text-center">
                                                    <div class="form-check">
                                                        <input class="form-check-input" onchange="cambio(this)" type="checkbox" value="'.$item->id.'" id="ch'.$item->id.'">
                                                    </div>
                                                </td>
                                                </tr>';
                                            }
                                        }
                                    }
                                }
                            ?>
                    </tbody>
                </table>
            </div>
                </div>
                <div class="form-group">
                    <a href="{{route('autorizacion.index')}}"><div class="btn btn-sm btn-secondary"><i class="fas fa-times"></i> Cancelar</div></a>
                    <button class="btn btn-sm btn-warning"><i class="fas fa-redo-alt"></i> Actualizar</button>
                </div>
        </div>
    </div>
</div>
@stop
@section('script')
<script>
    function eliminar(key){
        alertify.confirm("Notificación","¿Desea eliminar todos los permisos del usuario seleccionado?",function(){
            $("#frmeliminar"+key).submit();
        },function(){

        });
    }
    function seleccionar(id)
    {
        var idusuario = $("#idusuario").val();
        if(idusuario>0){
            $("#ch"+id).prop('checked',!$("#ch"+id).prop('checked'));
            $("#ch"+id).change();
        }else{
            bootbox.alert({title:"Notificación",message:"Por favor selecciona un usuario"});
            idusuario.focus();
        }
    }
    function cambio(input)
    {
        var idusuario = $("#idusuario").val();
        if(idusuario>0){
            //ACTUALIZAR EN BASE DE DATOS
            var id = $(input).val();
            var autorizacion = $(input).prop('checked');
            alert(id+" "+autorizacion);
        }else{
            bootbox.alert({title:"Notificación",message:"Por favor selecciona un usuario"});
            idusuario.focus();
        }
    }
</script>
@stop