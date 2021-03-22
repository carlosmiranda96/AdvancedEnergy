<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Alexander Miranda">
  <meta name="apple-mobile-web-app-capable" content="yes">

  <title>Advanced Energy</title>
  <link rel="icon" type="image/png" href="{{asset('img/isotipo.png')}}">

  <!-- Custom fonts for this template-->
  <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
  <!-- Custom styles for this page -->
  <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
  <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
  <!-- Alertify -->
  <link rel="stylesheet" href="{{asset('css/mystyle.css')}}"/>
  <link rel="stylesheet" href="{{asset('vendor/alertify/css/alertify.min.css')}}" />
  <link rel="stylesheet" href="{{asset('vendor/alertify/css/themes/default.min.css')}}" />
  @yield('head')
</head>
<?php
use App\Models\autorizacionusuarios;
$autorizacionModulos = autorizacionusuarios::join('permisos','idpermiso','permisos.id')->join('modulos','idmodulo','modulos.id')->
select('modulos.modulo','modulos.ruta','modulos.icono')->groupby('modulo','icono')->groupby('ruta')->where('autorizacionusuarios.idusuario',session('user_id'))->get();
?>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('inicio')}}">
        <div id="isotipo" class="sidebar-brand-icon" style="display: none;">
          <img class="col-12" src="{{asset('')}}img/isotipo.png">
        </div>
        <div class="sidebar-brand-text mx-3">
          <img class="col-12" src="{{asset('')}}img/logo.png">
        </div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item @if(in_array(Route::current()->getName(),array('inicio','aj_perfil'))) active @endif">
        <a class="nav-link" href="{{ route('inicio')}}">
          <i class="fas fa-home fa-3x"></i>
          <span>Inicio</span></a>
      </li>
      
      <!-- Heading -->
      <div class="sidebar-heading">
        
      </div>

      @foreach($autorizacionModulos as $item)
      <li class="nav-item">
        <a class="nav-link" href="{{ route($item->ruta)}}">
          <?php echo $item->icono;?>
          <span>{{$item->modulo}}</span></a>
      </li>
      @endforeach
      <!-- Nav Item - Pages Collapse Menu -->
      
      @if(session()->get('idrol')==1)
        <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">
      <!-- Heading -->
      <div class="sidebar-heading" style="color:#2E9A73">
        ADMIN
      </div>
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item @if(in_array(Route::current()->getName(),array('departamento.index','departamento.create','departamento.edit','departamento.show')))||
      strrpos(Route::current()->getName(),'cargos')!==false ||
      strrpos(Route::current()->getName(),'ubicacion')!==false ||
      strrpos(Route::current()->getName(),'dias')!==false ||
      strrpos(Route::current()->getName(),'diasFeriados')!==false ||
      strrpos(Route::current()->getName(),'grupohorario')!==false ||
      strrpos(Route::current()->getName(),'equipos')!==false
      ) active @endif">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Empresa</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Mantenimiento</h6>
            <a class="collapse-item @if(in_array(Route::current()->getName(),array('departamento.index','departamento.create','departamento.edit','departamento.show'))) active @endif" href="{{ route('departamento.index')}}">Departamentos</a>
            <a class="collapse-item @if(strrpos(Route::current()->getName(),'cargos')!==false) active @endif" href="{{ route('cargos.index')}}">Cargos</a>
            <a class="collapse-item @if(strrpos(Route::current()->getName(),'ubicacion')!==false) active @endif" href="{{ route('ubicacion.index')}}">Ubicaciones</a>
            <a class="collapse-item @if(strrpos(Route::current()->getName(),'dias')!==false) active @endif" href="{{ route('dias.index')}}">Dias laborales</a>
            <a class="collapse-item @if(strrpos(Route::current()->getName(),'diasFeriados')!==false) active @endif" href="{{ route('diasFeriados.index')}}">Dias Feriados</a>
            <a class="collapse-item @if(strrpos(Route::current()->getName(),'grupohorario')!==false) active @endif" href="{{ route('grupohorario.index')}}">Horarios laborales</a>
          </div>
        </div>
      </li>
      <li class="nav-item @if(strrpos(Route::current()->getName(),'tipodocumento')!==false||
      strrpos(Route::current()->getName(),'pais')!==false||
      strrpos(Route::current()->getName(),'svdepartamento')!==false||
      strrpos(Route::current()->getName(),'svmunicipio')!==false||
      strrpos(Route::current()->getName(),'estadocivil')!==false||
      strrpos(Route::current()->getName(),'genero')!==false
      ) active @endif">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Empleado</span>
        </a>
        <div id="collapseFour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Mantenimiento</h6>
            <a class="collapse-item @if(strrpos(Route::current()->getName(),'pais')!==false) active @endif" href="{{ route('pais.index')}}">Paises</a>
            <a class="collapse-item @if(strrpos(Route::current()->getName(),'svdepartamento')!==false) active @endif" href="{{ route('svdepartamento.index')}}">Departamentos</a>
            <a class="collapse-item @if(strrpos(Route::current()->getName(),'svmunicipio')!==false) active @endif" href="{{ route('svmunicipio.index')}}">Municipios</a>
            <a class="collapse-item @if(strrpos(Route::current()->getName(),'tipodocumento')!==false) active @endif" href="{{ route('tipodocumento.index')}}">Tipo documentos</a>
            <a class="collapse-item @if(strrpos(Route::current()->getName(),'estadocivil')!==false) active @endif" href="{{ route('estadocivil.index')}}">Estado civil</a>
            <a class="collapse-item @if(strrpos(Route::current()->getName(),'genero')!==false) active @endif" href="{{ route('genero.index')}}">Genero</a>
          </div>
        </div>
      </li>
      <li class="nav-item @if(strrpos(Route::current()->getName(),'modulos')!==false||
      strrpos(Route::current()->getName(),'permisos')!==false||
      strrpos(Route::current()->getName(),'usuarios')!==false||
      strrpos(Route::current()->getName(),'autorizacion')!==false
      ) active @endif">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
          <i class="fas fa-fw fa-cog"></i>
          <span>Configuración</span>
        </a>
        <div id="collapse3" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Mantenimiento</h6>
            <a class="collapse-item @if(strrpos(Route::current()->getName(),'modulos')!==false) active @endif" href="{{ route('modulos.index')}}">Modulos</a>
            <a class="collapse-item @if(strrpos(Route::current()->getName(),'permisos')!==false) active @endif" href="{{ route('permisos.index')}}">Permisos</a>
            <a class="collapse-item @if(strrpos(Route::current()->getName(),'usuarios')!==false) active @endif" href="{{ route('usuarios.index')}}">Usuarios</a>
            <a class="collapse-item @if(strrpos(Route::current()->getName(),'autorizacion')!==false) active @endif" href="{{ route('autorizacion.index')}}">Autorización</a>
          </div>
        </div>
      </li>
      @endif

  
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-dark topbar mb-4 static-top shadow barrasuperior">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn d-md-none rounded-circle mr-3" style="color:#0E5155">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Buscar" aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a style="color:#0E5155" class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Buscar" aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <!-- Nav Item - Alerts -->
            <!--li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <span class="badge badge-danger badge-counter">3+</span>
              </a>
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Notificaciones
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-warning">
                      <i class="fas fa-exclamation-triangle text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">27 octubre 2020</div>
                    Notificación
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Ver todas las alertas</a>
              </div>
            </li>
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                <span class="badge badge-danger badge-counter">7</span>
              </a>
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                  Mensajes
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="{{asset(session('foto'))}}" alt="">
                    <div class="status-indicator bg-success"></div>
                  </div>
                  <div class="font-weight-bold">
                    <div class="text-truncate">Hola este es un mensaje</div>
                    <div class="small text-gray-500">Carlos Miranda · 58m</div>
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Leer mas mensajes</a>
              </div>
            </li-->

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{session('name')}}</span>
                <img class="img-profile rounded-circle" src="{{asset(session('foto'))}}">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{route('aj_perfil')}}">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Perfil
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Cerrar sesión
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->
        @yield('pagina')
      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Advanced Energy 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">¿Quieres cerrar sesión?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Da clic en <strong>Cerrar sesión</strong> para finalizar su sesión actual</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
          <a class="btn btn-primary" href="{{ route('cerrarsesion')}}">Cerrar sesión</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
  <!-- Custom scripts for all pages-->
  <script src="{{asset('js/sb-admin-2.js')}}"></script>
  <!-- Page level plugins -->
  <script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>
  <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <!-- Page level custom scripts -->
  <!--script src="{{asset('js/demo/chart-area-demo.js')}}"></script>
  <script src="{{asset('js/demo/chart-pie-demo.js')}}"></script-->
  <!-- Page level custom scripts -->
  <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
  <!-- Script alertify-->
  <script src="{{asset('vendor/alertify/alertify.min.js')}}"></script>
  <script>
    var mostrar = false;
    $("#sidebarToggle").click(function(){
      if(mostrar==false){
        mostrar = true;
        $("#isotipo").show();
      }else{
        mostrar = false;
        $("#isotipo").hide();
      }
    });
    if(screen.width<768){
      mostrar = true;
      $("#isotipo").show();
    }
  </script>
  @yield('script')
  @yield('script2')
</body>

</html>