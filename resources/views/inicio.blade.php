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
            <!--div class="metro">
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
                
            </div-->

            <div class="metro">
                <div class="l1">
                    <li class="item i1" id="btnmenu">
                        <span>Menu</span>
                    </li>
                    <a href="https://netorgft4827275-my.sharepoint.com/:u:/g/personal/amiranda_ae-energiasolar_com/Ea8nYqenPZ1KgFoSuvyKlgwBg6lID_ANkL9PEcoXgnq0LQ?e=pqx42L" style="color:white" target="_blank"><li class="item i2">
                        <span>Descargar App Android</span>
                    </li>
                    </a>                    
                    <a href="{{route('load.aplicacion')}}" style="color:white" target="_blank"><li class="item i5">
                        <span>Asistencia</span>
                    </li></a>
                </div>
            </div>

        </div>
    </div>
</div>
<div id="rmenu">
    <ul>
        <li id="copiar">Copiar</li>
        <li id="mover">Mover</li>
        <li id="eliminar">Eliminar</li>
    </ul>
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
                type:"get",
                data:"_token={{csrf_token()}}&contenido="+content,
                success:function(r)
                {
                    if(r==1)
                    {
                        dialogo.modal('hide');
                        location.reload();
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
    /*
    if (document.addEventListener) {
        document.addEventListener('contextmenu', function(e) {
            alert("Menu clic derecho"); //here you draw your own menu
            e.preventDefault();
        }, false);
    }else
    {
        document.attachEvent('oncontextmenu', function(){
            alert("Menu clic derecho 2");
            window.event.returnValue = false;
        });
    }*/

    $(document).ready(function(){
             
             //Ocultamos el menú al cargar la página
             $("#rmenu").hide();
             //$("#rmenu").css({'display':'block', 'left':'141px', 'top':'171px'});
             /* mostramos el menú si hacemos click derecho
             con el ratón */
             $(document).bind("contextmenu", function(e){
                var ancho = $(window).width();
                var alto = $(window).height();
                    //alert("a:"+ancho+",a:"+alto+"---"+e.pageX+" + "+e.pageY);
                   $("#rmenu").css({'display':'block', 'left':e.pageX+'px', 'top':e.pageY+'px'});
                   return false;
             });
              
              
             //cuando hagamos click, el menú desaparecerá
             $(document).click(function(e){
                   if(e.button == 0){
                         $("#rmenu").css("display", "none");
                   }
             });
              
             //si pulsamos escape, el menú desaparecerá
             $(document).keydown(function(e){
                   if(e.keyCode == 27){
                         $("#rmenu").css("display", "none");
                   }
             });
              
             //controlamos los botones del menú
             $("#rmenu").click(function(e){
                    
                   // El switch utiliza los IDs de los <li> del menú
                   switch(e.target.id){
                         case "copiar":
                               alert("copiado!");
                               break;      
                         case "mover":
                               alert("movido!");
                               break;
                         case "eliminar":
                               alert("eliminado!");
                               break;
                   }
                    
             });
              
                          
       }); 
</script>
@stop