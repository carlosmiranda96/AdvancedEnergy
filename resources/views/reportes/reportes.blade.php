@extends('plantilla')
@section('pagina')
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-primary">Reportes</h1>
  </div>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('inicio')}}">Pagina principal</a></li>
      <li class="breadcrumb-item active">Reportes</li>
    </ol>
  </nav>
  <form action="{{route('reportes.pdf')}}" method="get" target="print_popup" >
  <div class="row pt-3">
    <div class="col-12 col-lg-6 offset-lg-3">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Reportes</h6>
            </div>
            <div class="card-body">
                @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{session('error')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <div class="form-group">
                    <label>Reporte</label>
                    <select class="form-control" onchange="cargarParametros(this)" name="idreporte">
                        <option value="0">Seleccione</option>
                        @foreach($reportes as $item)
                        <option value="{{$item->id}}">{{$item->nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-6 offset-lg-3" id="cardParametros" style="display:none">
        <div class="card shadow mb-4" id="parametros">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Parametros</h6>
            </div>
            <div class="card-body" id="parametrosbody">
                
            </div>
        </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12 col-lg-6 offset-lg-3">
        <button class="btn btn-primary float-right"><i class="fas fa-file-excel"></i> Generar PDF</button>
    </div>
  </div>
  </form>
</div>
@stop
@section('script')
<script>
    function cargarParametros(input)
    {
        $.ajax({
            type:"GET",
            data:"idreporte="+input.value,
            url:"{{route('reportes.parametros')}}",
            success:function(r)
            {
                if(r!=0){
                    $("#cardParametros").fadeIn();
                    $("#parametrosbody").empty();
                    $("#parametrosbody").html(r);
                }else{
                    //alert("No fue posible generar el reporte");
                    $("#cardParametros").fadeOut();
                }
            },
            error:function(){
                alert("No fue posible generar el reporte");
                $("#cardParametros").fadeOut();
            }
        })
    }
</script>
@stop