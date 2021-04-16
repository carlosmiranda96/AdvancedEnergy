@extends('plantillaForm')
@section('pagina')
<div class="row">
    <div class="col-12 text-center pt-2">
        <label class="font-gotham-medium color-secondary">Ubicación</label>
        <select class="input" id="idubicacion">
        </select>
    </div>
</div>
<div class="card bg-secondary mt-5">
    <div class="card-body">
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body" id="formulario">
                <div class="col-12">
                    <h1 class="h3 mb-0 font-gotham-medium text-secondary text-center">Auto-cuestionario COVID-19</h1>
                </div>
                <div class="col-12">
        <form id="frm" class="row"  method="POST" action="{{route('api.form.covid.enviar')}}">
            @csrf
            <div class="form-group col-12">
                <label>Fecha <span class="text-danger">*</span></label>
                <input type="date" class="form-control input" value="{{date('Y-m-d')}}" id="fecha" name="fecha" required/>
            </div>
            <div class="form-group col-12">
                <label>Nombre Completo <span class="text-danger">*</span></label>
                <input type="text" class="form-control input" value="@if($empleado) {{$empleado->nombreCompleto}} @endif" id="nombrecompleto" name="nombrecompleto" required/>
            </div>
            <div class="form-group col-12">
                <label>Dui <span class="text-danger">*</span></label>
                <input type="text" class="form-control input" value="@if($dui) {{$dui->numerodocumento}} @endif" id="dui" name="dui" required/>
            </div>
            <div class="form-group col-12">
                <label>Genero <span class="text-danger">*</span></label>
                <select class="form-control input" id="idgenero" name="idgenero" required>
                    <option value="0">Seleccione</option>
                    @foreach($genero as $item)
                    <option @if($empleado && $empleado->idgenero==$item->id) {{'selected'}} @endif value="{{$item->id}}">{{$item->genero}}</option>  
                    @endforeach
                </select>
            </div>
            <div class="form-group col-12">
                <label>Empresa <span class="text-danger">*</span></label>
                <select class="form-control input" id="empresa" name="empresa" required>
                    <option value="OTRA">Seleccione</option>
                    <option value="Advanced Energy" selected>Advanced Energy</option>
                    <option value="AES">AES</option>
                    <option value="Almaco">Almaco</option>
                    <option value="EDECSA">EDECSA</option>
                    <option value="EDECSA">DIPAL</option>
                    <option value="OTRA">OTRA</option>
                </select>
            </div>
            <div class="form-group col-12">
                <label>Si su respuesta anterior fue "OTRA" especifique que empresa</label>
                <input type="text" class="form-control input" value="" id="otraempresa" name="otraempresa"/>
            </div>
            <div class="form-group col-12">
                <label>Nombre y ubicación del proyecto en que se encuentra trabajando <span class="text-danger">*</span></label>
                <input type="text" class="form-control input" value="" id="proyecto" name="proyecto" required/>
            </div>
            <div class="form-group col-12">
            <style>
                #tablasintomas:hover{
                    background-color: #2E9A73;
                    color: white;
                }
            </style>
                <label>Marque en "SI" o "NO" en los siguientes sintomas</label>
                <table class="table bg-white">
                    <tbody>
                        @foreach($sintomas as $item)
                        <tr id="tablasintomas">
                            <td>{{$item->sintoma}}</td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input sintoma" type="radio" name="c{{$item->id}}" id="si{{$item->id}}" value="SI" @if($item->requerido=="SI"){{'required'}}@endif>
                                    <label class="form-check-label" for="si{{$item->id}}">
                                        SI
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input sintoma" type="radio" name="c{{$item->id}}" id="no{{$item->id}}" value="NO" @if($item->requerido=="SI"){{'required'}}@endif>
                                    <label class="form-check-label" for="no{{$item->id}}">
                                        NO
                                    </label>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="form-group col-12">
                <label>Temperatura registrada en grados C</label>
                <input type="number" class="form-control input" step="0.01" value="{{$temp}}" id="temperatura" name="temperatura" required/>
            </div>
            <div class="form-group col-12">
                <label>Es responsabilidad de todos cuidarnos. Juntos saldremos adelante! Déjanos tus comentarios</label>
                <textarea class="form-control" id="comentarios" name="comentarios"></textarea>
            </div>
            <div class="form-group col-12">
                <input type="submit" id="btnenviar" class="btn btn-secondary" value="ENVIAR">
                <div id="btnlimpiar" class="btn btn-danger"><i class="fas fa-broom"></i> LIMPIAR CAMPOS</div>
            </div>
        </form>
    </div>
            </div>
        </div>
    </div>

</div>
@stop
@section('script')
    <script>
        $(document).ready(function () {
            $("#frm").bind("submit",function(){
                var datos = $("#frm").serialize();
                $.ajax({
                    type:"get",
                    url:"{{route('api.form.covid.enviar')}}",
                    data:datos+'&_token={{csrf_token()}}',
                    success:function(r)
                    {
                        $("#formulario").empty();
                        $("#formulario").html('<h3 class="text-center text-primary font-gotham-bold">Gracias por completar el formulario!! <br><br><div onclick="reenviar()" class="btn btn-primary">Enviar otra respuesta</div></h3><hr><div class="text-center"><a href="{{URL::previous()}}"><div class="btn btn-secondary"><i class="fas fa-arrow-left"></i>Atrás</div></a></div>');
                    }
                });
                return false;
            });
        });
        $("#btnlimpiar").on('click',function(){
            $("#nombrecompleto").val('');
            $("#dui").val('');
            $("#idgenero").val(0);
            $("#proyecto").val('');
            $(".sintoma").prop("checked",false);
            $("#nombrecompleto").focus();
        });        
        function reenviar(){
            location.reload();
        };
        if(navigator.geolocation){
        //intentamos obtener las coordenadas del usuario
        navigator.geolocation.getCurrentPosition(function(objPosicion){
            //almacenamos en variables la longitud y latitud
            var iLongitud=objPosicion.coords.longitude;
            var iLatitud=objPosicion.coords.latitude;
            $("#latitud").val(iLatitud);
            $("#longitud").val(iLongitud);
            obtenerUbicacion(iLatitud,iLongitud);             
        },function(objError){
            //manejamos los errores devueltos por Geolocation API
            switch(objError.code){
                //no se pudo obtener la informacion de la ubicacion
                case objError.POSITION_UNAVAILABLE:
                    alertify.alert('Notificación GPS','La información de tu posición no es posible');
                    break;
                    //timeout al intentar obtener las coordenadas
                case objError.TIMEOUT:
                    alertify.alert('Notificación GPS','Tiempo de espera agotado');
                    break;
                    //el usuario no desea mostrar la ubicacion
                case objError.PERMISSION_DENIED:
                    alertify.alert('Notificación GPS','Necesitas permitir tu localización');
                    break;
                    //errores desconocidos
                case objError.UNKNOWN_ERROR:
                    alertify.alert('Notificación GPS','Error desconocido');
                    break;
            }
        });
    }else{
        //el navegador del usuario no soporta el API de Geolocalizacion de HTML5
        alertify.alert('Tu navegador no soporta la Geolocalización en HTML5');
    }
    function obtenerUbicacion(lat,lon){
        var datos = {latitud:lat,longitud:lon};
        $.ajax({
            url:"{{route('api.getUbicacion')}}",
            type:"get",
            data: datos,
            success:function(r)
            {
                var json = JSON.parse(r);
                var contador = 0;
                $.each(json,function(e,key){
                    contador++;
                    $("#idubicacion").append('<option value="'+key.id+'">'+key.descripcion+'</option>');
                    if(contador==1){
                        $("#proyecto").val(key.descripcion);
                    }
                });
                if(contador==1){
                    $("#proyecto").val('');
                }
            }
        });
    }
    </script>
@stop