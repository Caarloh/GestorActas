<?php
require "baseDatos/conexion.php";
session_start();
$correoSession = $_SESSION['correo'];
$contrasenaSession = $_SESSION['contrasena'];
$nombreSession = "";
$admin = "";
if (!isset($correoSession) || !isset($contrasenaSession)) {
    session_destroy();
    $_SESSION = array();
    header("Location: inicioSesion.php");
}
if (isset($_POST['salir'])) {
    session_destroy();
    $_SESSION = array();
    header("Location: inicioSesion.php");
}
if (isset($_POST['cambiarContrasena'])) {
    $contrasena = $_POST['contrasenaUsuario'];
    $verificacionContrasena = $_POST['verificacionContrasenaUsuario'];

    if($contrasena == $verificacionContrasena){
        $consulta = "UPDATE consejo SET contrasena='$contrasena' WHERE correo='$correoSession'";
        $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos1");
        $_SESSION['contrasena'] = $contrasena;
        echo '<script>alert("Contraseña cambiada con exito");</script>';
    }
    else{
        echo '<script>alert("Contraseñas no coinciden");</script>';
    }
    
}
$encontro = false;
$consulta = "SELECT * FROM consejo WHERE correo='$correoSession'";
$resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos1");
while ($columna = mysqli_fetch_array( $resultado )){
    $nombreSession = $columna['nombre'];
    $encontro = true;
}
if(!$encontro){
    session_destroy();
    $_SESSION = array();
    header("Location: inicioSesion.php");
}

$consulta = "SELECT * FROM `admin` WHERE correo='$correoSession'";
$resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos1");
while ($columna = mysqli_fetch_array( $resultado )){
    $admin = "SI";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Gestion de Actas</title>

    <!-- Custom fonts for this template-->

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="alertifyjs/css/alertify.css">
    <link rel="stylesheet" type="text/css" href="alertifyjs/css/themes/default.css">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <script src="alertifyjs/alertify.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>
    


    <style>
        .ui-autocomplete {
            z-index: 10000000;
        }
    </style>
</head>

<body id="page-top">
<div id="wrapper">
  <!-- Page Wrapper -->

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
    <div class="sidebar-brand-icon">
    <i class="fab fa-earlybirds"></i>
    </div>
    <div class="sidebar-brand-text mx-3">GESTOR ACTAS</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item ">
    <a class="nav-link" href="index.php">
        <i class="fas fa-users"></i>
        <span>Reuniones</span></a>
</li>





<!-- Divider -->
<hr class="sidebar-divider">

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item ">
    <a class="nav-link " href="temas.php">
     <i class="fas fa-book-open"></i>
        <span>Temas</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    </div>
</li>
<!-- Divider -->
<hr class="sidebar-divider">

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item ">
    <a class="nav-link " href="acciones.php">
    <i class="fas fa-marker"></i>
        <span>Acciones</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    </div>
</li>

<?php 
    if($admin == "SI"){
        echo '
        <hr class="sidebar-divider">

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item ">
            <a class="nav-link " href="admin.php">
            <i class="fas fa-user-cog"></i>
                <span>Administrar</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            </div>
        </li>';

    }
    
?>




<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline"><button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>
</ul>




<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">Hola <?php echo $nombreSession; ?></span>
                        <img class="img-profile rounded-circle" src="https://cdn.discordapp.com/attachments/569659673792479252/569662825195372564/unknown.png">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <a class="dropdown-item" data-toggle="modal" data-target="#perfilModal">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Perfil
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Salir
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->

