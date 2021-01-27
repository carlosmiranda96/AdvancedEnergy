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
        src: url('./fonts/AlrightSans-Regular.otf');
    }
    @font-face {
        font-family: 'Alright-Bold';
        src: url('./fonts/AlrightSans-Bold.otf');
    }
    body{
        padding: 0;
        margin: 0;
    }
    h1{
        font-family: 'Alright-Bold';
        color: #2E9A73;
    }
    #cajon{
        margin: 0;
        padding: 0;
        width: 90%;
        margin-left: 5%;
    }
    #cajon .header{
        background-color: #0E5155;
        margin: 0;
        padding: 0;
        height: 70px;
    }
    #cajon .body{
        padding:20px;
        min-height: 250px;
        background-color: #F8F9F9;
        margin-bottom: 0px;
    }
    #cajon .footer{
        margin: 0;
        background-color: #F2F3F4;
        font-family: 'Alright-Regular';
        font-size: 12px;
        padding: 25px;
    }
    #logo{
        height: 100%;
        padding-left: 50px;
    }
    p{
        margin: 0px;
        font-family: 'Alright-Regular';
    }
    .boton{
        background-color: #2E9A73;
        padding:15px;
        color: white;
        font-family: 'Alright-Regular';
        border-radius: 25px;
        cursor: pointer;
        border: none;
    }
    .boton:hover{
        background-color: #0E5155;
    }
</style>
</head>
<body>
    <div id="cajon">
        <div class="header">
            <img id="logo" src="https://portal.ae-energiasolar.com/img/logoblanco2.png">
        </div>
        <div class="body">
            <h1>¡Bienvenido! {{$usuario->name}}</h1>
            <hr>
            <p>Se registro correctamente tu cuenta. Por favor da clic en el siguiente enlace para validar tu correo.</p>
            <br>
            <center><a href="https://portal.ae-energiasolar.com/validate?a={{$usuario->id}}&b={{$usuario->email}}&c={{$usuario->remember_token}}"><button class="boton">Validar correo</button></a></center>
        </div>
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