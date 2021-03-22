@extends('plantilla')
@section('pagina')
<div class="container-fluid">
  <!-- Page Heading -->
  <form action="{{route($excel)}}" method="get" target="print_popup" >
  <div class="row pt-3">
    <div class="col-12 col-lg-6 offset-lg-3">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{$titulo}}</h6>
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
                <?php echo $parametro;?>
                <div class="form-group">
                    
                </div>
                <button class="btn mt-3 btn-sm btn-success">Descargar Excel</button>
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