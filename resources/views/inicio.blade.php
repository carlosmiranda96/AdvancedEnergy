@extends('plantilla')
@section('pagina')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h4 class="text-primary">Accesos directos Advanced Energy</h4>
        <div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="metro">
                <div class="l1">
                    <li class="item i1" id="btnmenu">
                        <span>Menu</span>
                    </li>

                    <li class="item i2">
                        <span>Operación y mantenimiento</span>
                    </li>
                    
                    
                    <li class="item i3">
                        <span>Photos</span>
                    </li>

                    <li class="item i4">
                        <span>Music</span>
                    </li>

                    <li class="item i5">
                        <span>Setting</span>
                    </li>

                </div>
            
                <div class="l2">
                    <li class="item i3">
                        <span>Photos</span>
                    </li>

                    <li class="item i4">
                        <span>Music</span>
                    </li>

                    <li class="item i5">
                        <span>Setting</span>
                    </li>

                    <li class="item i1">
                        <span>Android</span>
                    </li>

                    <li class="item i2">
                        <span>Videos</span>
                    </li>
                </div>
                
            </div>
        </div>
    </div>
</div>
@stop
@section('css')
<link rel="stylesheet" href="{{asset('css/menumetro.css')}}">
@stop