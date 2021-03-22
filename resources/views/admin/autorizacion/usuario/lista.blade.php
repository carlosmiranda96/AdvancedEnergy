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
                        <option @if($idusuario==$item1->id){{'selected'}} @endif value="{{$item1->id}}">{{$item1->name}}</option>
                    @endforeach
                    </select>
            </div>
                <div class="form-group">
                    <label>Permisos</label>
                    <div class="table-responsive"  style="height:300px;">
                <table class="table table-sm table-bordered" width="100%" cellspacing="0">
                    <tbody>
                        <thead>
                            <tr>
                                <th>Permiso</th>
                                <th class="text-center">Ver</th>
                                <th class="text-center">Crear</th>
                                <th class="text-center">Editar</th>
                                <th class="text-center">Eliminar</th>
                                <th class="text-center">Excel</th>
                                <th class="text-center">PDF</th>
                            </tr>
                        </thead>
                                <?php

use App\Models\autorizacionusuarios;
use App\Models\modulos;

                                menu2(1,0,$idusuario);

                                function menu2($nivel,$dependencia,$iduser){
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
                                                echo '<tr>
                                                <td>
                                                    <strong>'.$item->modulo.'</strong>
                                                </td>
                                                <td colspan="6"></td>
                                                </tr>';
                                            }else{
                                                
                                                echo '<tr>
                                                <td style="padding-left:'.$espacio.'px">
                                                '.$item->modulo.'
                                                </td>
                                                <td colspan="6"></td>
                                                </tr>';
                                            }
                                            menu2($nivel,$item->id,$iduser);
                                        }else{
                                            if($iduser>0){
                                                $disabled =  "";
                                            }else{
                                                $disabled = "disabled";
                                            }
                                            $check1 = "";
                                            $check2 = "";
                                            $check3 = "";
                                            $check4 = "";
                                            $check5 = "";
                                            $check6 = "";
                                            $permiso = autorizacionusuarios::where('idusuario',$iduser)->where('idpermiso',$item->id)->first();
                                            if(isset($permiso)){
                                                if($permiso->ver==1){
                                                    $check1 = "checked";
                                                }
                                                if($permiso->crear==1){
                                                    $check2 = "checked";
                                                }
                                                if($permiso->editar==1){
                                                    $check3 = "checked";
                                                }
                                                if($permiso->eliminar==1){
                                                    $check4 = "checked";
                                                }
                                                if($permiso->excel==1){
                                                    $check5 = "checked";
                                                }
                                                if($permiso->pdf==1){
                                                    $check6 = "checked";
                                                }
                                            }
                                            if($nivel==2){
                                                echo '<tr class="fila">
                                                <td onclick="seleccionar('.$item->id.')">
                                                    <strong>'.$item->modulo.'</strong>
                                                </td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-checkbox">
                                                        <input '.$disabled.' '.$check1.' class="custom-control-input" onchange="cambio(this,1)" type="checkbox" value="'.$item->id.'" id="ch1'.$item->id.'">
                                                        <label class="custom-control-label" for="ch1'.$item->id.'"></label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-checkbox">
                                                        <input '.$disabled.' '.$check2.' class="custom-control-input" onchange="cambio(this,2)" type="checkbox" value="'.$item->id.'" id="ch2'.$item->id.'">
                                                        <label class="custom-control-label text-white" for="ch2'.$item->id.'"></label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-checkbox">
                                                        <input '.$disabled.' '.$check3.' class="custom-control-input" onchange="cambio(this,3)" type="checkbox" value="'.$item->id.'" id="ch3'.$item->id.'">
                                                        <label class="custom-control-label text-white" for="ch3'.$item->id.'"></label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-checkbox">
                                                        <input '.$disabled.' '.$check4.' class="custom-control-input" onchange="cambio(this,4)" type="checkbox" value="'.$item->id.'" id="ch4'.$item->id.'">
                                                        <label class="custom-control-label text-white" for="ch4'.$item->id.'"></label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-checkbox">
                                                        <input '.$disabled.' '.$check5.' class="custom-control-input" onchange="cambio(this,5)" type="checkbox" value="'.$item->id.'" id="ch5'.$item->id.'">
                                                        <label class="custom-control-label text-white" for="ch5'.$item->id.'"></label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-checkbox">
                                                        <input '.$disabled.' '.$check6.' class="custom-control-input" onchange="cambio(this,6)" type="checkbox" value="'.$item->id.'" id="ch6'.$item->id.'">
                                                        <label class="custom-control-label text-white" for="ch6'.$item->id.'"></label>
                                                    </div>
                                                </td>
                                                </tr>';
                                            }else{
                                                //$espacio = $nivel*20;
                                                echo '<tr class="fila">
                                                <td style="padding-left:'.$espacio.'px" onclick="seleccionar('.$item->id.')">
                                                    '.$item->modulo.'
                                                </td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" '.$disabled.' '.$check1.' class="custom-control-input" onchange="cambio(this,1)" value="'.$item->id.'" id="ch1'.$item->id.'">
                                                        <label class="custom-control-label text-white" for="ch1'.$item->id.'"></label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-checkbox">
                                                        <input '.$disabled.' '.$check2.' class="custom-control-input" onchange="cambio(this,2)" type="checkbox" value="'.$item->id.'" id="ch2'.$item->id.'">
                                                        <label class="custom-control-label text-white" for="ch2'.$item->id.'"></label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-checkbox">
                                                        <input '.$disabled.' '.$check3.' class="custom-control-input" onchange="cambio(this,3)" type="checkbox" value="'.$item->id.'" id="ch3'.$item->id.'">
                                                        <label class="custom-control-label text-white" for="ch3'.$item->id.'"></label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-checkbox">
                                                        <input '.$disabled.' '.$check4.' class="custom-control-input" onchange="cambio(this,4)" type="checkbox" value="'.$item->id.'" id="ch4'.$item->id.'">
                                                        <label class="custom-control-label text-white" for="ch4'.$item->id.'"></label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-checkbox">
                                                        <input '.$disabled.' '.$check5.' class="custom-control-input" onchange="cambio(this,5)" type="checkbox" value="'.$item->id.'" id="ch5'.$item->id.'">
                                                        <label class="custom-control-label text-white" for="ch5'.$item->id.'"></label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="custom-control custom-checkbox">
                                                        <input '.$disabled.' '.$check6.' class="custom-control-input" onchange="cambio(this,6)" type="checkbox" value="'.$item->id.'" id="ch6'.$item->id.'">
                                                        <label class="custom-control-label text-white" for="ch6'.$item->id.'"></label>
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
        </div>
    </div>
</div>
@stop
@section('script')
<script>

    function cambio(input,opcion)
    {
        var idusuario = $("#idusuario").val();
        if(idusuario>0){
            //ACTUALIZAR EN BASE DE DATOS
            var id = $(input).val();
            var autorizacion = $(input).prop('checked');
            $.ajax({
                url:"{{route('autorizacion.usuario.update')}}",
                type:"get",
                data:"idpermiso="+id+"&idusuario="+idusuario+"&autorizacion="+autorizacion+"&opcion="+opcion,
                success:function(r)
                {
                    if(r==1){
                        //alertify.success("Dato guardado");
                    }else if(r==2){
                        alertify.success("Dato ya ha sido guardado");
                    }else{
                        alertify.error("No se ha podido guardar");
                    }
                }
            });
        }else{
            bootbox.alert({title:"Notificación",message:"Por favor selecciona un usuario"});
            idusuario.focus();
        }
    }
    $("#idusuario").on("change",function()
    {
        window.location = "{{route('autorizacion.usuario')}}?id="+$(this).val();
    });
</script>
@stop