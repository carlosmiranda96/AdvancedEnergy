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
                    <h6 class="m-0 font-weight-bold text-primary"><a href="{{route('equipos.index')}}" style="color: #2E9A73"><i class="fas fa-arrow-left"></i></a>&nbsp&nbsp&nbspEquipo {{$equipostrabajo->codigo}}</h6>
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
                        <label>Codigo</label>
                        <input disabled type="text"value="{{$equipostrabajo->codigo}}" class="form-control" autofocus autocomplete="off"/>
                    </div>
                    <div class="form-group">
                        <label>Placa</label>
                        <input disabled type="text" name="placa" value="{{$equipostrabajo->placa}}" class="form-control" autocomplete="off"/>
                    </div>
                    <div class="form-group">
                        <label>Marca</label>
                        <input disabled type="text" name="marca" value="{{$equipostrabajo->marca}}" class="form-control" autocomplete="off"/>
                    </div>
                    <div class="form-group">
                        <label>Modelo</label>
                        <input disabled type="text" name="modelo" value="{{$equipostrabajo->modelo}}" class="form-control" autocomplete="off"/>
                    </div>
                    <div class="form-group">
                        <label>Año</label>
                        <input disabled type="text" name="año" value="{{$equipostrabajo->año}}" class="form-control" autocomplete="off"/>
                    </div>
                    <div class="form-group">
                        <label>Descripción</label>
                        <textarea disabled type="text" name="descripcion" class="form-control" autocomplete="off">{{$equipostrabajo->descripcion}}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-5 text-center">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Codigo QR</h6>
                </div>
                <div class="card-body">
                    <center><div id="codigoQR"></div></center>
                    <a id="descargarCodigo"><button class="btn btn-primary mt-3"><i class="fas fa-download"></i> Descargar</button></a>
                </div>
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
    </script>
@stop