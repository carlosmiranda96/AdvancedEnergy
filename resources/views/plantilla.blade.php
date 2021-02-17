<?php
use App\Models\empleadoUser;
use App\Models\modulos;
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="Sitio web de advanced energy solar project"/>
        <meta name="author" content="Alexander Miranda - IT" />
        <title>Portal Advanced Energy</title>
        <link rel="icon" type="image/png" href="{{asset('img/isotipo.png')}}">
        <link href="{{asset('css/styles.css')}}" rel="stylesheet" />
        <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{asset('vendor/alertify/css/alertify.min.css')}}" />
        <link rel="stylesheet" href="{{asset('vendor/alertify/css/themes/default.min.css')}}" />
        @yield('css')
        @yield('head')
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark navae">
            <a class="navbar-brand p-5" href="{{route('inicio')}}"><img width="100%" src="{{asset('img/logo.png')}}"></a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="{{route('aj_perfil')}}">Perfil</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" onclick="cerrarsesion()">Cerrar sesión</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-light" id="navnivel1">
                    <div class="sb-sidenav-menu" data-parent="#navnivel1">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Menu principal</div>
                            <?php
                                menu(1,0);
                                session()->put('buscar',true);
                                function menu($nivel,$dependencia)
                                {
                                    $userid = session('user_id');
                                    if($userid==1){
                                        $menu = modulos::where('nivel',$nivel)->where('dependencia',$dependencia)->orderby('orden')->get();
                                    }else{
                                        $idusuario = session('user_id');
                                        $empleado = empleadoUser::join('empleados','idempleado','empleados.id')->where('idusuario',$idusuario)->first();
                                        if(isset($empleado->idgrupo)&&$empleado->idgrupo!=0)
                                        {
                                            $menu = modulos::join('autorizaciongrupos','modulos.id','autorizaciongrupos.idpermiso')->select('modulos.*')->where('idgrupo',$empleado->idgrupo)
                                        ->where('nivel',$nivel)->where('dependencia',$dependencia)->orderby('modulos.orden')->get();
                                        }else{
                                            $menu = modulos::join('autorizacionusuarios','modulos.id','autorizacionusuarios.idpermiso')->select('modulos.*')->where('idusuario',$idusuario)
                                        ->where('nivel',$nivel)->where('dependencia',$dependencia)->orderby('modulos.orden')->get();
                                        }
                                    }
                                    if(isset($menu)){
                                        $nivel++;                                    
                                    $menu_id = session('menu_id');                           
                                    foreach($menu as $item)
                                    {
                                        $estado1 = "collapse";//cerrado
                                        $estado2 = "collapsed";//cerrado etiqueta
                                        $tiponivel = modulos::where('dependencia',$item->id)->first();
                                        $activo = "";
                                        if($menu_id==$item->id){
                                            $activo = "active";
                                            $buscar = false;
                                            session()->put('buscar',$buscar);
                                        }
                                        if(isset($tiponivel->modulo)){
                                            $buscar = session('buscar');
                                            if($buscar==true)
                                            {

                                                if($item->id==16){
                                                    $estado1 = "";
                                                    $estado2 = "";
                                                }
                                                //echo "Nivel ".$item->nivel.' id '.$item->id.' menu'.$menu_id;
                                            }
                                            if($nivel==2){
                                                echo '<a class="nav-link '.$estado2.'" href="#" data-toggle="collapse" data-target="#collapse'.$item->id.'">
                                                    <div class="sb-nav-link-icon">'.$item->icono.'</div>
                                                    '.$item->modulo.'
                                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                                </a>';
                                            }else{
                                                echo '<a class="nav-link '.$estado2.'" href="#" data-toggle="collapse" data-target="#collapse'.$item->id.'">
                                                '.$item->modulo.'
                                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                            </a>';
                                            }
                                            echo '<div class="test '.$estado1.'" id="collapse'.$item->id.'" data-parent="#navnivel'.$item->nivel.'">
                                        <nav class="sb-sidenav-menu-nested nav accordion" id="navnivel'.$nivel.'">';
                                            menu($nivel,$item->id,$buscar);
                                        }else{
                                            if(isset($item->ruta))
                                            {
                                                //$ruta = $item->ruta;
                                                $div = explode(',',$item->ruta);
                                                $ruta='';
                                                $parametro = '';
                                                $ruta = $div[0];
                                                if(isset($div[1])){
                                                    $parametro = $div[1];
                                                }
                                                $ruta = route($ruta,$parametro);
                                            }else{
                                                $ruta = "#";
                                            }
                                            if($nivel==2){
                                                //GUARDAR MENU
                                                echo '<a class="nav-link '.$activo.'" href="#" id="enlace'.$item->id.'" onclick="abrir('.$item->id.','."'".$ruta."'".')">
                                                    <div class="sb-nav-link-icon">'.$item->icono.'</div>
                                                    '.$item->modulo.'
                                                </a>';
                                            }else{
                                                //GUARDAR MENU
                                                echo '<a class="nav-link '.$activo.'" href="#" id="enlace'.$item->id.'"  onclick="abrir('.$item->id.','."'".$ruta."'".')">
                                                    '.$item->modulo.'
                                                </a>';
                                            }
                                        }
                                    }
                                    if($nivel!=2){
                                        echo '</nav>
                                        </div>';
                                    }
                                    }
                                }
                            ?>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Identificado como:</div>
                        {{session('name')}}
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <nav class="p-0 m-0" style="z-index: 1000;">
                    <ul class="menu bg-white">
                        <li><button class="btn" onclick="herramienta(1)"><img height="20px" src="{{asset('img/iconos/preview.png')}}" /></button></li>
                        <li><button class="btn" onclick="herramienta(2)"><img height="20px" src="{{asset('img/iconos/view.png')}}" /></button></li>
                        <li><button class="btn" onclick="herramienta(3)"><img height="20px" src="{{asset('img/iconos/new.png')}}" /></button></li>
                        <li><button class="btn" onclick="herramienta(4)"><img height="20px" src="{{asset('img/iconos/excel.png')}}" /></button></li>
                        <li><button class="btn" onclick="herramienta(5)"><img height="20px" src="{{asset('img/iconos/pdf.png')}}" /></button></li>
                        <li><button class="btn" onclick="herramienta(6)"><img height="20px" src="{{asset('img/iconos/left2.png')}}" /></button></li>
                        <li><button class="btn" onclick="herramienta(7)"><img height="20px" src="{{asset('img/iconos/left1.png')}}" /></button></li>
                        <li><button class="btn" onclick="herramienta(8)"><img height="20px" src="{{asset('img/iconos/right1.png')}}" /></button></li>
                        <li><button class="btn" onclick="herramienta(9)"><img height="20px" src="{{asset('img/iconos/right2.png')}}" /></button></li>
                        <li><button class="btn" onclick="herramienta(10)"><img height="20px" src="{{asset('img/iconos/enlace.png')}}" /></button></li>
                    </ul>
                </nav>
                <main class="mt-5 pt-4" id="pagina">
                    @yield('pagina')
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; 2021 <a target="_blank" href="https://www.ae-energiasolar.com">Advanced Energy</a></div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('js/bootbox.min.js')}}"></script>
        <script src="{{asset('js/scripts.js')}}"></script>
        <script src="{{asset('vendor/alertify/alertify.min.js')}}"></script>
        @yield('script')
        <script>
            function cerrarsesion()
            {
                bootbox.confirm({ 
                    size: "small",
                    title:'Notificación',
                    message: "¿Desea cerrar la sesión?",
                    callback: function(result)
                    {
                        if(result==true){
                            window.location.href = "{{route('cerrarsesion')}}";
                        }
                    }
                });
            };
            function abrir(id,ruta)
            {
                $.ajax({
                    url:"{{route('session.guardarmenu')}}",
                    type:"GET",
                    data:"id="+id,
                    success:function(r){
                        window.location.href = ruta;
                    }
                });
            }
        </script>
    </body>
</html>