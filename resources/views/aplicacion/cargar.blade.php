@extends('plantilla')
@section('script')
<script>
    $(document).ready(function(){
        window.open("<?php echo $url;?>", '_blank');
    })
</script>
@stop