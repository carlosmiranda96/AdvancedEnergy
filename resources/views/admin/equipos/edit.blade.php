@extends('plantilla')
@section('pagina')
<div class='container-fluid'>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-primary">Configuración de vehiculos</h1>
    </div>
    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><a href="{{route('equipos.index')}}" style="color: #2E9A73"><i class="fas fa-arrow-left"></i></a>&nbsp&nbsp&nbspActualizar vehiculo</h6>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="m-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <form method="POST" action="{{route('equipos.update',$equipostrabajo->id)}}">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label>Codigo</label>
                            <input disabled type="text"value="{{$equipostrabajo->codigo}}" class="form-control" autofocus autocomplete="off"/>
                        </div>
                        <div class="form-group">
                            <label>Tipo</label>
                            <select name="tipo" class="form-control">
                                <option value="0" @if($equipostrabajo->tipo==0) {{'selected'}} @endif>Seleccione</option>
                                <option value="1" @if($equipostrabajo->tipo==1) {{'selected'}} @endif>Vehiculo</option>
                                <option value="2" @if($equipostrabajo->tipo==2) {{'selected'}} @endif>Maquinaria</option>
                                <option value="3" @if($equipostrabajo->tipo==3) {{'selected'}} @endif>Herramientas</option>
                            </select>
                        </div>
                        <input hidden type="text" name="codigo" value="{{$equipostrabajo->codigo}}" class="form-control"/>
                        <div class="form-group">
                            <label>Placa</label>
                            <input type="text" name="placa" value="{{$equipostrabajo->placa}}" class="form-control" autocomplete="off"/>
                        </div>
                        <div class="form-group">
                            <label>Marca</label>
                            <input type="text" name="marca" value="{{$equipostrabajo->marca}}" class="form-control" autocomplete="off"/>
                        </div>
                        <div class="form-group">
                            <label>Modelo</label>
                            <input type="text" name="modelo" value="{{$equipostrabajo->modelo}}" class="form-control" autocomplete="off"/>
                        </div>
                        <div class="form-group">
                            <label>Año</label>
                            <input type="number" name="año" value="{{$equipostrabajo->año}}" class="form-control" autocomplete="off"/>
                        </div>
                        <div class="form-group">
                            <label>Descripción</label>
                            <textarea type="text" name="descripcion" class="form-control" autocomplete="off">{{$equipostrabajo->descripcion}}</textarea>
                        </div>
                        <div class="form-group">
                            <a href="{{route('equipos.index')}}"><div class="btn btn-sm btn-secondary"><i class="fas fa-times"></i> Cancelar</div></a>
                            <button class="btn btn-sm btn-warning"><i class="fas fa-redo-alt"></i> Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4 text-center">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Codigo QR</h6>
                </div>
                <div class="card-body">
                    <center><div id="codigoQR"></div></center>
                    <a id="descargarCodigo"><button class="btn btn-primary mt-3"><i class="fas fa-download"></i> Descargar</button></a>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3 text-center">
                    <h6 class="m-0 font-weight-bold text-primary">Accesorios</h6>
                </div>
                <div class="card-body">
                    <button class="btn btn-sm btn-primary mb-3" onclick="agregarAccesorio()">Agregar</button>
                    <div id="tablaAccessorio">
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalAccesorio" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Accesorios</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label>Descripcion</label>
            <input type="text" id="accDescripcion" class="form-control"/>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="guardarAccesorio()">Guardar</button>
      </div>
    </div>
  </div>
</div>
@stop
@section('script')
    <script src="{{asset('js/qrcode.min.js')}}"></script>
    <script>
        var qrcode = new QRCode("codigoQR");
        qrcode.clear(); // clear the code.
        qrcode.makeCode("{{route('lectorqr',['a'=>$equipostrabajo->id])}}");
        $("#descargarCodigo").on("click",function(){
            var base64 = $("#codigoQR img").attr('src');
            $("#descargarCodigo").attr('href', base64);
            $("#descargarCodigo").attr('download', "codigoQR");
            $("#descargarCodigo").trigger("click");
        });
        $(document).ready(function(){
            cargarAccesorios();
        });
        function cargarAccesorios(){
            $.ajax({
                type:"get",
                data:"id={{$equipostrabajo->id}}",
                url:"{{route('getAccesorio')}}",
                success:function(r){
                    $("#tablaAccessorio").html(r);
                },
                error:function(){
                    alert("Problemas de conexión");
                }
            });
        }
        function agregarAccesorio(){
            $("#accDescripcion").val('');
            $("#modalAccesorio").modal("show");
        }
        function guardarAccesorio(){
            var descripcion = $("#accDescripcion").val();
            if(descripcion!=""){
                $.ajax({
                    type:"get",
                    data:"id={{$equipostrabajo->id}}&descripcion="+descripcion,
                    url:"{{route('addAccesorio')}}",
                    success:function(r){
                        cargarAccesorios();
                        $("#modalAccesorio").modal("hide");
                    },
                    error:function(){
                        alert("Problemas de conexión");
                    }
                });
            }else{
                bootbox.alert("Por favor ingresar una descripción");
            }
        }
    </script>
@stop