@extends('plantilla')
@section('script')
<script>
    $("#pagina").load('{{$url}}');
</script>
@stop