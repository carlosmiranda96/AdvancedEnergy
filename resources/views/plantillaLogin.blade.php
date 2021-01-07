<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
   <title>Advanced Energy</title>
  <link rel="icon" type="image/png" href="img/isotipo.png">

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/styles.css" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('css/mystyleQR.css')}}"/>
  <style>
    html{
        /*
        background:url('{{asset('img/fondo.jpg')}}') no-repeat center center;
        min-height:100%;
        background-size:cover;
        */
        background-color:#0E5155;
    }
    body{
      background:transparent;
    }
  </style>
</head>

<body class="" >
    @yield('pagina')
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{asset('js/bootbox.min.js')}}"></script>
</body>
</html>
@yield('script')
