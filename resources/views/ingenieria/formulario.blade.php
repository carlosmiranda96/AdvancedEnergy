@extends('plantilla')
@section('pagina')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-primary">Generales</h1>
    </div>

    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('inicio')}}">Pagina principal</a></li>
            <li class="breadcrumb-item"><a href="{{route('ingenieria.index')}}">Ingenieria</a></li>
            <li class="breadcrumb-item active">Formulario</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12" id="formulario" >

        </div>
    </div>
    <textarea id="texto" hidden>
        {{$formulario}}
    </textarea>
</div>
@stop
@section('script')
<script>
    var prtContent = $("#formulario");
    var text = $("#texto");
    prtContent.html(text.val());
    var height = $(window).height();
    $('#formulario').height(height-305);
</script>
@stop