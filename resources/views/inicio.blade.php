@extends('plantillaInicio')
@section('pagina')
<div class="container-fluid p-0">
    <div class="row m-0 p-0" >
        <div class="col-md-8 col-lg-8 col-xl-9">
            <div class="row">
                <div class="col-12 p-0">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                            <img src="{{asset('img/banner1/img1.jpg')}}" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                            <img src="{{asset('img/banner1/img1.jpg')}}" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                            <img src="{{asset('img/banner1/img1.jpg')}}" class="d-block w-100" alt="...">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Anterior</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Siguiente</span>
                        </a>
                    </div>
                </div>
            </div>
            <!--div class="row">
                <div class="col-12">
                    <h5 class="text-primary mt-3">Accesos Directos</h5>
                    <hr>
                </div>
            </div>

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4">
                <div class="col mb-4">
                    <div class="card h-100"º>
                        <img width="100%" src="{{asset('img/menu/asistencia.jpg')}}" class="card-img-top"/>
                        <div class="card-body">
                            <h5 class="card-title">Marcar Asistencia</h5>
                            <p class="card-text">RRHH</p>
                        </div>
                    </div>
                </div>
                <div class="col mb-4">
                    <div class="card h-100">
                        <img width="100%" src="{{asset('img/menu/vehiculo.jpg')}}" class="card-img-top"/>
                        <div class="card-body">
                            <h5 class="card-title">Usar Vehiculo</h5>
                            <p class="card-text">Advanced Energy</p>
                        </div>
                    </div>
                </div>
                <div class="col mb-4">
                    <a href="https://cloud.ae-energiasolar.com" target="_blank">
                        <div class="card h-100">
                            <img width="100%" src="{{asset('img/menu/nube.jpg')}}" class="card-img-top"/>   
                            <div class="card-body">
                                <h5 class="card-title">Acceder a Nube AE</h5>
                                <p class="card-text">https://cloud.ae-energiasolar.com</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col mb-4">
                    <a href="https://avl.globalcomelsalvador.com" target="_blank">
                        <div class="card h-100">
                            <img width="100%" src="{{asset('img/menu/nube.jpg')}}" class="card-img-top"/>   
                            <div class="card-body">
                                <h5 class="card-title">Rastreo GPS</h5>
                                <p class="card-text">https://avl.globalcomelsalvador.com</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <h5 class="text-primary mt-3">Menu Principal</h5>
                    <hr>
                </div>
            </div>

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4">
                <div class="col mb-4">
                    <a href="{{route('api.form.covid',0)}}" target="_blank">
                        <div class="card h-100">
                            <img width="100%" src="{{asset('img/menu/menu.jpg')}}" class="card-img-top"/>
                            <div class="card-body">
                                <h5 class="card-title">Cuestionario COVID-19</h5>
                                <p class="card-text">RRHH</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>


            <div class="row">
                <div class="col-12">
                    <h5 class="text-primary mt-3">Formularios</h5>
                    <hr>
                </div>
            </div>

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4">
                <div class="col mb-4">
                    <a href="{{route('api.form.covid',0)}}" target="_blank">
                        <div class="card h-100">
                            <img width="100%" src="{{asset('img/menu/menu.jpg')}}" class="card-img-top"/>
                            <div class="card-body">
                                <h5 class="card-title">Cuestionario COVID-19</h5>
                                <p class="card-text">RRHH</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col mb-4">
                    <a href="https://forms.office.com/Pages/ResponsePage.aspx?id=-5WHxQI14EyokZ090rbkj9Km1aLk_TpHk4UiKMcVyB1UM0c4OVpBRUYxNzhLRlBQTU9CRFZJNzE1WCQlQCN0PWcu" target="_blank">
                        <div class="card h-100">
                            <img width="100%" src="{{asset('img/menu/menu.jpg')}}" class="card-img-top"/>
                            <div class="card-body">
                                <h5 class="card-title">Pedidos Proyectos</h5>
                                <p class="card-text">Proyectos y Supervision</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col mb-4">
                    <a href="https://forms.office.com/Pages/ResponsePage.aspx?id=-5WHxQI14EyokZ090rbkj-r2tuVKRLZOjMraYxTTgzhURENSSjAyTzdaRjgxSkZKWlBWNUxENTUzQSQlQCN0PWcu" target="_blank">
                        <div class="card h-100">
                            <img width="100%" src="{{asset('img/menu/menu.jpg')}}" class="card-img-top"/>
                            <div class="card-body">
                                <h5 class="card-title">Solicitud de permiso</h5>
                                <p class="card-text">RRHH</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div-->
           
           <div class="row pb-5">
                <div class="col-12">
                    <h5 class="text-primary mt-3">Formularios</h5>
                    <div class="metro">
                        <div class="l1">
                            <li class="item i1" id="btnmenu">
                                <span>Menu</span>
                            </li>
                            <a href="https://cloud.ae-energiasolar.com" style="color:white" target="_blank"><li class="item i2">
                                <span>NUBE PRIVADA</span>
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
        <div class="col-md-4 col-lg-4 col-xl-3" style="height:100%;background-color:#f8f9fa;overflow-y:scroll;">
            
            <link rel="stylesheet" href="{{asset('css/calendarioAE.css')}}">
        
            <!--div class="accordion mt-3 mb-3 acordion">
                <div class="card" id="calendario">
                    <div class="card-header m-0 p-0" id="heading1">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapseOne">
                            Calendario
                            </button>
                        </h2>
                    </div>
                    <div id="collapse1" class="collapse show" aria-labelledby="heading1" data-parent="#heading1">
                        <div class="card-body">
                            <div class="calendar-wrapper pb-2" id="calendar-wrapper" style="background-color: white;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card" id="formulario">
                    <div class="card-header m-0 p-0" id="headingNuevo">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseNuevo" aria-expanded="true" aria-controls="collapseOne">
                            Nuevo Evento
                            </button>
                        </h2>
                    </div>
                    <div id="collapseNuevo" class="collapse show" aria-labelledby="headingNuevo" data-parent="#headingNuevo">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Fecha</label>
                                <input type="date" class="form-control" name="" id="">
                            </div>
                            <div>
                                <button class="btn btn-success">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header m-0 p-0" id="heading2">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapseOne">
                            Mis calendarios
                            </button>
                        </h2>
                    </div>
                    <div id="collapse2" class="collapse show" aria-labelledby="heading2" data-parent="#heading2">
                        <div class="card-body">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    amiranda
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
                                <label class="form-check-label" for="defaultCheck2">
                                    Cumpleañeros AE
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header m-0 p-0" id="heading3">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapseOne">
                            Eventos
                            </button>
                        </h2>
                    </div>
                    <div id="collapse3" class="collapse show" aria-labelledby="heading3" data-parent="#heading3">
                        <div class="card-body p-0">
                            <div class="NotificacionList">
                                <a href="#">
                                    <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">List group item heading</h5>
                                    <small>3 days ago</small>
                                    </div>
                                    <p class="mb-1">Some placeholder content in a paragraph.</p>
                                    <small>And some small print.</small>
                                </a>
                            </div>
                            <div class="NotificacionList">
                                <a href="#">
                                    <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">List group item heading</h5>
                                    <small>3 days ago</small>
                                    </div>
                                    <p class="mb-1">Some placeholder content in a paragraph.</p>
                                    <small>And some small print.</small>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div-->
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
    //Calendario inicializacion
    function selectDate(date) {
        //alert("Actualizacio")
        $('#calendar-wrapper').updateCalendarOptions({
            date: date
         });
      }
      var defaultConfig = {
        weekDayLength: 1,
        date: new Date(),
        onClickDate: selectDate,
        showYearDropdown: true,
        startOnMonday: true,
      };
      var calendar = $('#calendar-wrapper').calendar(defaultConfig);
      //Calendario Finalizacion
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