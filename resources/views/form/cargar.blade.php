@extends('plantilla')
@section('script')
<script>
    $("#pagina").load('<?php echo $url;?>');
</script>
@stop