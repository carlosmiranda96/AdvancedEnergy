@extends('plantilla')
@section('pagina')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h4 class="text-primary">Accesos directos</h4>
        <div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="metro">
                <div class="l1">
                    <li class="item i1" id="btnmenu">
                        <span>Menu</span>
                    </li>

                    <li class="item i2">
                        <span>Operación y mantenimiento</span>
                    </li>
                    
                    
                    <li class="item i3">
                        <span>Finanzas</span>
                    </li>

                    <li class="item i4">
                        <span>COVID-19</span>
                    </li>

                    <li class="item i5">
                        <span>Empleados</span>
                    </li>

                </div>
            
                <div class="l2">
                    <li class="item i3">
                        <span>Asistencia</span>
                    </li>

                    <li class="item i4">
                        <span>Permisos</span>
                    </li>

                    <li class="item i5">
                        <span>Vacaciones</span>
                    </li>

                    <li class="item i1">
                        <span>Finanzas</span>
                    </li>

                    <li class="item i2">
                        <span>Recursos humanos</span>
                    </li>
                </div>
                
            </div>
        </div>
    </div>
</div>
@stop
@section('css')
<link rel="stylesheet" href="{{asset('css/menumetro.css')}}">
<script src="{{asset('js/instascan.js')}}"></script>
@stop
@section('script')
@if (!$empleado)
<script>
    var dialogo;
    $(document).ready(function(){
        dialogo = bootbox.dialog({
            title:"Notificación",
            message:"<h6 class='text-center'>Al parecer, es primera vez que inicias sesión.<br> Como ultimo paso escanea el codigo QR del carnet de la empresa poder utilizar el portal</h6><div class='row'><hr><div ><video style='width:90%;margin-left:5%' id='preview' class='video' playsinline></video></div></div><div class='text-center'><button onclick='cerrarsesion()' class='btn btn-sm btn-danger'>Cerrar Sesión</button></div>",
            closeButton:false
        });
        var scanner = new Instascan.Scanner({ video: document.getElementById('preview'), scanPeriod: 3, mirror:false });
        Instascan.Camera.getCameras().then(function (cameras){
        if (cameras.length > 0) {
            scanner.start(cameras[0]);
        }
        else {
                        
        }
        }).catch (function(e){  

        });
        scanner.addListener('scan',function(content)
        {
            $.ajax({
                url:"{{route('escanearCarnet')}}",
                type:"post",
                data:"_token={{csrf_token()}}&contenido="+content,
                success:function(r)
                {
                    if(r==1)
                    {
                        dialogo.modal('hide');
                    }else{
                        bootbox.dialog({
                            title:"Notificación",
                            message:r,
                            buttons:{
                                ok:{
                                    label:"Ok"
                                }
                            }
                        });
                    }
                }
            });
        });
    });
</script>
@endif
<script>
    function cerrarsesion(){
        bootbox.confirm({ 
            size: "small",
            title:'Notificación',
            message: "¿Desea cerrar la sesión?",
            callback: function(result)
            {
                if(result==true){
                    window.location.href = "{{route('cerrarsesion')}}";
                }
            }
        });
    };
</script>
@stop