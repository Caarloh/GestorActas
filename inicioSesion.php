<?php
    require "baseDatos/conexion.php";

    session_set_cookie_params(0);
    session_start();
    

    if (isset($_POST['inicioSesionConsejo'])) {
        $correo = $_POST['correoInicio'];
        $contrasena = $_POST['contrasenaInicio'];
        if($correo == "" || $correo == " " || $contrasena == "" || $contrasena == " "){
            echo '<script>alert("Todos los datos deben ser completados")</script>';
        }
        else{
            $error = true;
        

            $consulta = "SELECT * FROM consejo WHERE correo='$correo' AND contrasena='$contrasena'";
            $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos");

            while ($columna = mysqli_fetch_array( $resultado )){
                if ($columna['correo'] == $correo && $columna['contrasena'] == $contrasena) {
                    $_SESSION['correo'] = $correo;
                    $_SESSION['contrasena'] = $contrasena;
                    $error = false;
                    header("Location: index.php");

                }
                

            }

            if($error){
                echo '<script>alert("Error en los datos ingresados.")</script>';
            }

        }
        

    }

    if (isset($_POST['recuperarContrasenaConsejo'])) {
        $correo = $_POST['correoInicio'];
        if($correo == "" || $correo == " "){
            echo '<script>alert("Se debe ingresar correo")</script>';
        }
        else{

            $error = true;

            $consulta = "SELECT * FROM consejo WHERE correo='$correo'";
            $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos");

            while ($columna = mysqli_fetch_array( $resultado )){
                $enviarContrasena = $columna['contrasena'];
                //Enviar Correo
                $error = false;
                include 'envio_de_correos/superiorenviarcorreo.php';
                //Destinatario
                $mail->addAddress($correo, $nombre);     

                //Contenido del correo
                $mail->isHTML(true);

                $topico = "Recuperar Contraseña";                                  
                $mail->Subject = $topico;
                
                $cuerpo = "<!DOCTYPE html>
                <html>
                <head>
                <title></title>
                <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
                <meta name='viewport' content='width=device-width, initial-scale=1'>
                <meta http-equiv='X-UA-Compatible' content='IE=edge' />
                <style type='text/css'>
                    @media screen {
                        @font-face {
                        font-family: 'Lato';
                        font-style: normal;
                        font-weight: 400;
                        src: local('Lato Regular'), local('Lato-Regular'), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format('woff');
                        }
                        
                        @font-face {
                        font-family: 'Lato';
                        font-style: normal;
                        font-weight: 700;
                        src: local('Lato Bold'), local('Lato-Bold'), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format('woff');
                        }
                        
                        @font-face {
                        font-family: 'Lato';
                        font-style: italic;
                        font-weight: 400;
                        src: local('Lato Italic'), local('Lato-Italic'), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format('woff');
                        }
                        
                        @font-face {
                        font-family: 'Lato';
                        font-style: italic;
                        font-weight: 700;
                        src: local('Lato Bold Italic'), local('Lato-BoldItalic'), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format('woff');
                        }
                    }
                    
                    
                    body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
                    table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
                    img { -ms-interpolation-mode: bicubic; }
                
                    
                    img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; }
                    table { border-collapse: collapse !important; }
                    body { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; }
                
                
                    a[x-apple-data-detectors] {
                        color: inherit !important;
                        text-decoration: none !important;
                        font-size: inherit !important;
                        font-family: inherit !important;
                        font-weight: inherit !important;
                        line-height: inherit !important;
                    }
                    
                    
                    @media screen and (max-width:600px){
                        h1 {
                            font-size: 32px !important;
                            line-height: 32px !important;
                        }
                    }
                
                    
                    div[style*='margin: 16px 0;'] { margin: 0 !important; }
                </style>
                
                </head>
                <body style='background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;'>
                
                <!-- HIDDEN PREHEADER TEXT -->
                <div style='display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: 'Lato', Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;'>
                    We're thrilled to have you here! Get ready to dive into your new account.
                </div>
                
                <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                    <!-- LOGO -->
                    <tr>
                        <td bgcolor='#3A85A8' align='center'>
                            
                            <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;' >
                                <tr>
                                    <td align='center' valign='top' style='padding: 40px 10px 40px 10px;'>
                                        
                                    </td>
                                </tr>
                            </table>
                            
                        </td>
                    </tr>
                    <!-- HERO -->
                    <tr>
                        <td bgcolor='#3A85A8' align='center' style='padding: 0px 10px 0px 10px;'>
                            
                            <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;' >
                                <tr>
                                    <td bgcolor='#ffffff' align='center' valign='top' style='padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;'>
                                    <h1 style='font-size: 48px; font-weight: 400; margin: 0;'>Recuperar Contraseña</h1>
                                    </td>
                                </tr>
                            </table>
                            
                        </td>
                    </tr>
                    <!-- COPY BLOCK -->
                    <tr>
                        <td bgcolor='#f4f4f4' align='center' style='padding: 0px 10px 0px 10px;'>
                            
                            <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;' >
                            <!-- COPY -->
                            <tr>
                                <td bgcolor='#ffffff' align='left' style='padding: 20px 30px 40px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;' >
                                <p style='margin: 0;'>Estimad@, para el correo: ".$correo." la contraseña es: ".$enviarContrasena."</p><br>
                                
                                </td>
                            </tr>
                            
                            <tr>
                                <td bgcolor='#ffffff' align='left' style='padding: 0px 30px 20px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;' >
                                <p style='margin: 0;'>Si tiene alguna duda, por favor consultar con el administrador Daniel Moreno .</p>
                                </td>
                            </tr>
                            <!-- COPY -->
                            <tr>
                                <td bgcolor='#ffffff' align='left' style='padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;' >
                                <p style='margin: 0;'>Daniel,<br>Comite Curricular,<br> Universidad de Talca, Curico</p>
                                </td>
                            </tr>
                            </table>
                            
                        </td>
                    </tr>
                    <!-- SUPPORT CALLOUT -->
                    <tr>
                        <td bgcolor='#f4f4f4' align='center' style='padding: 30px 10px 0px 10px;'>
                            
                            <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;' >
                                <!-- HEADLINE -->
                                <tr>
                                <td bgcolor='#FFECD1' align='center' style='padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;' >
                                    <h2 style='font-size: 20px; font-weight: 400; color: #111111; margin: 0;'>Utalca</h2>
                                    
                                </td>
                                </tr>
                            </table>
                            
                        </td>
                    </tr>
                    <!-- FOOTER -->
                    <tr>
                        <td bgcolor='#f4f4f4' align='center' style='padding: 0px 10px 0px 10px;'>
                        
                            <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;' >
                            <!-- NAVIGATION -->
                            <tr>
                                <td bgcolor='#f4f4f4' align='left' style='padding: 30px 30px 30px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;' >
                                <p style='margin: 0;'>
                                    
                                </p>
                                </td>
                            </tr>
                            
                            </table>
                            
                        </td>
                    </tr>
                </table>
                    
                </body>
                </html>";

                $mail->Body    = $cuerpo;
                
                include 'envio_de_correos/inferiorenviarcorreo.php';
                echo '<script>alert("Correo Enviado.")</script>';
                
            }

            if($error){
                
                echo '<script>alert("Correo no existe en nuestros registros.")</script>';
            }

        }
        

    }
    

    if (isset($_POST['inicioSesionInvitado'])) {
        $correo = $_POST['correoInicio'];
        $contrasena = $_POST['contrasenaInicio'];
        if($correo == "" || $correo == " " || $contrasena == "" || $contrasena == " "){
            echo '<script>alert("Todos los datos deben ser completados")</script>';
        }
        else{
            $error = true;

            $consulta = "SELECT * FROM invitado WHERE correo='$correo' AND codigoAcceso='$contrasena'";
            $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos");

            while ($columna = mysqli_fetch_array( $resultado )){
                if ($columna['correo'] == $correo && $columna['codigoAcceso'] == $contrasena) {
                    $_SESSION['correo'] = $correo;
                    $_SESSION['contrasena'] = $contrasena;
                    $error = false;
                    header("Location: invitado/index.php");

                }
                
            }

            if($error){
                
                echo '<script>alert("Error en los datos ingresados.")</script>';
            }

        }
        

    }

    if (isset($_POST['recuperarContrasenaInvitado'])) {
        $correo = $_POST['correoInicio'];
        if($correo == "" || $correo == " "){
            echo '<script>alert("Se debe ingresar correo")</script>';
        }
        else{
            $error = true;

            $consulta = "SELECT * FROM invitado WHERE correo='$correo'";
            $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos");

            while ($columna = mysqli_fetch_array( $resultado )){
                $enviarContrasena = $columna['codigoAcceso'];
                //Enviar Correo
                $error = false;
                include 'envio_de_correos/superiorenviarcorreo.php';
                //Destinatario
                $mail->addAddress($correo, $nombre);     

                //Contenido del correo
                $mail->isHTML(true);

                $topico = "Recuperar Contraseña";                                  
                $mail->Subject = $topico;
                
                $cuerpo = "<!DOCTYPE html>
                <html>
                <head>
                <title></title>
                <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
                <meta name='viewport' content='width=device-width, initial-scale=1'>
                <meta http-equiv='X-UA-Compatible' content='IE=edge' />
                <style type='text/css'>
                    @media screen {
                        @font-face {
                        font-family: 'Lato';
                        font-style: normal;
                        font-weight: 400;
                        src: local('Lato Regular'), local('Lato-Regular'), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format('woff');
                        }
                        
                        @font-face {
                        font-family: 'Lato';
                        font-style: normal;
                        font-weight: 700;
                        src: local('Lato Bold'), local('Lato-Bold'), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format('woff');
                        }
                        
                        @font-face {
                        font-family: 'Lato';
                        font-style: italic;
                        font-weight: 400;
                        src: local('Lato Italic'), local('Lato-Italic'), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format('woff');
                        }
                        
                        @font-face {
                        font-family: 'Lato';
                        font-style: italic;
                        font-weight: 700;
                        src: local('Lato Bold Italic'), local('Lato-BoldItalic'), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format('woff');
                        }
                    }
                    
                    
                    body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
                    table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
                    img { -ms-interpolation-mode: bicubic; }
                
                    
                    img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; }
                    table { border-collapse: collapse !important; }
                    body { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; }
                
                
                    a[x-apple-data-detectors] {
                        color: inherit !important;
                        text-decoration: none !important;
                        font-size: inherit !important;
                        font-family: inherit !important;
                        font-weight: inherit !important;
                        line-height: inherit !important;
                    }
                    
                    
                    @media screen and (max-width:600px){
                        h1 {
                            font-size: 32px !important;
                            line-height: 32px !important;
                        }
                    }
                
                    
                    div[style*='margin: 16px 0;'] { margin: 0 !important; }
                </style>
                
                </head>
                <body style='background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;'>
                
                <!-- HIDDEN PREHEADER TEXT -->
                <div style='display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: 'Lato', Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;'>
                    We're thrilled to have you here! Get ready to dive into your new account.
                </div>
                
                <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                    <!-- LOGO -->
                    <tr>
                        <td bgcolor='#3A85A8' align='center'>
                            
                            <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;' >
                                <tr>
                                    <td align='center' valign='top' style='padding: 40px 10px 40px 10px;'>
                                        
                                    </td>
                                </tr>
                            </table>
                            
                        </td>
                    </tr>
                    <!-- HERO -->
                    <tr>
                        <td bgcolor='#3A85A8' align='center' style='padding: 0px 10px 0px 10px;'>
                            
                            <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;' >
                                <tr>
                                    <td bgcolor='#ffffff' align='center' valign='top' style='padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;'>
                                    <h1 style='font-size: 48px; font-weight: 400; margin: 0;'>Recuperar Contraseña</h1>
                                    </td>
                                </tr>
                            </table>
                            
                        </td>
                    </tr>
                    <!-- COPY BLOCK -->
                    <tr>
                        <td bgcolor='#f4f4f4' align='center' style='padding: 0px 10px 0px 10px;'>
                            
                            <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;' >
                            <!-- COPY -->
                            <tr>
                                <td bgcolor='#ffffff' align='left' style='padding: 20px 30px 40px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;' >
                                <p style='margin: 0;'>Estimad@, para el correo: ".$correo." la contraseña es: ".$enviarContrasena."</p><br>
                                
                                </td>
                            </tr>
                            
                            <tr>
                                <td bgcolor='#ffffff' align='left' style='padding: 0px 30px 20px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;' >
                                <p style='margin: 0;'>Si tiene alguna duda, por favor consultar con el administrador Daniel Moreno .</p>
                                </td>
                            </tr>
                            <!-- COPY -->
                            <tr>
                                <td bgcolor='#ffffff' align='left' style='padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;' >
                                <p style='margin: 0;'>Daniel,<br>Comite Curricular,<br> Universidad de Talca, Curico</p>
                                </td>
                            </tr>
                            </table>
                            
                        </td>
                    </tr>
                    <!-- SUPPORT CALLOUT -->
                    <tr>
                        <td bgcolor='#f4f4f4' align='center' style='padding: 30px 10px 0px 10px;'>
                            
                            <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;' >
                                <!-- HEADLINE -->
                                <tr>
                                <td bgcolor='#FFECD1' align='center' style='padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;' >
                                    <h2 style='font-size: 20px; font-weight: 400; color: #111111; margin: 0;'>Utalca</h2>
                                    
                                </td>
                                </tr>
                            </table>
                            
                        </td>
                    </tr>
                    <!-- FOOTER -->
                    <tr>
                        <td bgcolor='#f4f4f4' align='center' style='padding: 0px 10px 0px 10px;'>
                        
                            <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;' >
                            <!-- NAVIGATION -->
                            <tr>
                                <td bgcolor='#f4f4f4' align='left' style='padding: 30px 30px 30px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;' >
                                <p style='margin: 0;'>
                                    
                                </p>
                                </td>
                            </tr>
                            
                            </table>
                            
                        </td>
                    </tr>
                </table>
                    
                </body>
                </html>";

                $mail->Body    = $cuerpo;
                
                include 'envio_de_correos/inferiorenviarcorreo.php';
                echo '<script>alert("Correo Enviado.")</script>';
                
            }

            if($error){
                
                echo '<script>alert("Correo no existe en nuestros registros.")</script>';
            }

        }
        

    }

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Gestion de Actas</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="alertifyjs/css/alertify.css">
    <link rel="stylesheet" type="text/css" href="alertifyjs/css/themes/default.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>

    

    <script src="alertifyjs/alertify.js"></script>
    

</head>

<body class="log-bg">
<div id="wrapper">   
<!-- Topbar -->
	<nav class="lg-bar">

		<img class="im-login" id=im-login src="https://1.bp.blogspot.com/-oNO-o42-0U8/X9kFEhNhWyI/AAAAAAAACRY/X80xha0kIFsOUH-edOdCpSUIMGALX1s_ACLcBGAsYHQ/s300/LOGOTIPO.png">

	</nav>
</div>
    <div class="container">

    <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="login-card o-hidden border-0 shadow-lg my-5">
                    <div class="login-card-body p-0">
                        <br>
                        <center><h1 class="h4 text-gray-900 mb-4">¡Bienvenidos!</h1></center>
                        <div class="container">
                            <form method="POST" action="">
                                <div class="row">
                                    <div class="col">
                                        <input type="email" class="form-control" id="correoInicio" name="correoInicio" placeholder="Correo (*)">
                                    </div>
                                </div>

                                <br>

                                <div class="row">
                                    <div class="col">
                                        <input type="password" class="form-control" id="contrasenaInicio" name="contrasenaInicio" placeholder="Contraseña (*)">
                                    </div>
                                </div>
                                <br>

                                <div class="row">
                                    <div class="col">
                                    
                                    
                                        <button class="button-lg" name="inicioSesionConsejo">Inicio Sesión Consejo</button>
                                        <br>
                                    
                                    </div>
                                    <br>
                                    <div class="col">
                                        <button class="button-lg" name="inicioSesionInvitado">Inicio Sesión Invitado</button>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <button class="button-lg" name="recuperarContrasenaConsejo">Recuperar Contraseña Consejo</button>
                                        <br>
                                    </div>
                                    <br>
                                    <div class="col">
                                        <button class="button-lg" name="recuperarContrasenaInvitado">Recuperar Contraseña Invitado</button>
                                    </div>
                                </div>
                                
                                
                            </form>
                            <br>
                        </div>

                        
                    </div>
                    
                </div>

            </div>

        </div>

    </div>



    
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages -->
    <script src="js/sb-admin-2.min.js"></script>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script src="js/crearReunion.js"></script>

</body>

</html>