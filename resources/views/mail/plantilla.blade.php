<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta name="x-apple-disable-message-reformatting">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="telephone=no" name="format-detection">
    <title>Validar Registro</title>
    <style>
    @font-face {
        font-family: 'Alright-Regular';
        src: url('https://portal.ae-energiasolar.com/fonts/AlrightSans-Regular.otf');
    }
    @font-face {
        font-family: 'Alright-Bold';
        src: url('https://portal.ae-energiasolar.com/fonts/AlrightSans-Bold.otf');
    }
    body{
        padding: 0;
        margin: 0;
    }
    h1{
        font-family: 'Alright-Bold';
        color: #2E9A73;
    }
    .cajon{
        margin: 0;
        padding: 0;
        width: 90%;
        margin-left: 5%;
    }
    .header{
        background-color: #0E5155;
        margin: 0;
        padding: 0;
        height: 70px;
    }
    .body{
        padding:20px;
        min-height: 250px;
        background-color: #F8F9F9;
        margin-bottom: 0px;
    }
    .footer{
        margin: 0;
        background-color: #F2F3F4;
        font-family: 'Alright-Regular';
        font-size: 12px;
        padding: 25px;
    }
    img{
        height: 70px;
        padding-left: 50px;
    }
    p{
        margin: 0px;
        font-family: 'Alright-Regular';
    }
    button{
        background-color: #2E9A73;
        padding:15px;
        color: white;
        font-family: 'Alright-Regular';
        border-radius: 25px;
        cursor: pointer;
        border: none;
    }
    button:hover{
        background-color: #0E5155;
    }
</style>
</head>
<body>
    <div class="cajon">
        <div class="header">
            <img src="https://portal.ae-energiasolar.com/img/logoblanco2m.png">
        </div>
        @yield('pagina')
        <div class="footer">
            <p>Este mensaje es generado por un sistema automático, agradecemos no responder a su dirección.</p>
            <br>
            <p>Soporte IT (+503) 7399-7030</p>
            <hr>
            <center><p>2021 © Advanced Energy. Todos los derechos reservados.</p></center>
        </div>
    </div>
</body>
</html>