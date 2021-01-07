@extends('plantilla')
@section('pagina')
<?php
    use App\Models\modulos;
?>
<div class='container-fluid'>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-primary">Estructura de menú</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Menú</h6>
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
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Menú</th>
                            <th>Nivel</th>
                            <th>Orden</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Menú</th>
                            <th>Nivel</th>
                            <th>Orden</th>
                            <th>Acciones</th>
                        </tr>
                    </tfoot>
                    <tbody>
                                <?php
                                echo '<tr><td class="nav-link" href="#">
                                <strong>Menu principal</strong>
                            </td>
                            <td>0</td>
                            <td>0</td>
                            <td class="p-1">
                                <a class="btn btn-sm btn-primary" href="'.route('modulos.crear',['id'=>0,'nivel'=>0,'orden'=>0]).'"><i class="fas fa-plus"></i></a>
                            </td>
                            </tr>';

                                menu2(1,0);
                                function menu2($nivel,$dependencia){
                                    $userid = session('user_id');
                                    if($userid==1){
                                        $menu = modulos::where('nivel',$nivel)->where('dependencia',$dependencia)->orderby('orden')->get();
                                    }else{
                                        
                                    }
                                    $nivel++;
                                    if($nivel!=2){
                                        $nivelanterior = $nivel-2;
                                        $nivelanterior2 = $nivel-1;
                                        echo ' <div class="collapse" id="collapse'.$dependencia.'" data-parent="#navnivel'.$nivelanterior.'">
                                        <div class="sb-sidenav-menu-nested nav accordion" id="navnivel'.$nivelanterior2.'">';
                                    }
                                    foreach($menu as $item)
                                    {
                                        $tiponivel = modulos::where('dependencia',$item->id)->first();
                                        if(isset($tiponivel->modulo)){
                                            if($nivel==2){
                                                echo '<tr><td class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse'.$item->id.'">
                                                    <strong>'.$item->modulo.'</strong>
                                                </td>
                                                <td>'.$item->nivel.'</td>
                                                <td>'.$item->orden.'</td>
                                                <td class="p-1">
                                                    <a class="btn btn-sm btn-primary" href="'.route('modulos.crear',['id'=>$item->id,'nivel'=>$item->nivel,'orden'=>$item->orden]).'"><i class="fas fa-plus"></i></a>
                                                    <a class="btn btn-sm btn-warning" href="'.route('modulos.edit',$item->id).'"><i class="fas fa-edit"></i></a>
                                                </td>
                                                </tr>';
                                            }else{
                                                $espacio = $nivel*10;
                                                echo '<tr><td style="padding-left:'.$espacio.'px" class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse'.$item->id.'">
                                                '.$item->modulo.'
                                                </td>
                                                <td>'.$item->nivel.'</td>
                                                <td>'.$item->orden.'</td>
                                                <td class="p-1">
                                                    <a class="btn btn-sm btn-primary" href="'.route('modulos.crear',['id'=>$item->id,'nivel'=>$item->nivel,'orden'=>$item->orden]).'"><i class="fas fa-plus"></i></a>
                                                    <a class="btn btn-sm btn-warning" href="'.route('modulos.edit',$item->id).'"><i class="fas fa-edit"></i></a>
                                                </td>
                                                </tr>';
                                            }
                                            menu2($nivel,$item->id);
                                        }else{
                                            if($nivel==2){
                                                echo '<tr><td class="nav-link" href="#">
                                                    <strong>'.$item->modulo.'</strong>
                                                </td>
                                                <td>'.$item->nivel.'</td>
                                                <td>'.$item->orden.'</td>
                                                <td class="p-1">
                                                    <a class="btn btn-sm btn-primary" href="'.route('modulos.crear',['id'=>$item->id,'nivel'=>$item->nivel,'orden'=>$item->orden]).'"><i class="fas fa-plus"></i></a>
                                                    <a class="btn btn-sm btn-warning" href="'.route('modulos.edit',$item->id).'"><i class="fas fa-edit"></i></a>
                                                </td>
                                                </tr>';
                                            }else{
                                                $espacio = $nivel*15;
                                                echo '<tr><td style="padding-left:'.$espacio.'px" class="nav-link" href="#">
                                                    '.$item->modulo.'
                                                </td>
                                                <td>'.$item->nivel.'</td>
                                                <td>'.$item->orden.'</td>
                                                <td class="p-1">
                                                    <a class="btn btn-sm btn-primary" href="'.route('modulos.crear',['id'=>$item->id,'nivel'=>$item->nivel,'orden'=>$item->orden]).'"><i class="fas fa-plus"></i></a>
                                                    <a class="btn btn-sm btn-warning" href="'.route('modulos.edit',$item->id).'"><i class="fas fa-edit"></i></a>
                                                </td>
                                                </tr>';
                                            }
                                        }
                                    }
                                    if($nivel!=2){
                                        echo '</div>
                                        </div>';
                                    }
                                }
                            ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop
@section('script')
<script>
    function eliminar(key){
        alertify.confirm("Notificación","¿Desea eliminar el registro?",function(){
            $("#frmeliminar"+key).submit();
        },function(){

        });
    }
</script>
@stop