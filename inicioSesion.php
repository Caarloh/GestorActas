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