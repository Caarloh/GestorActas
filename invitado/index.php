<?php
    require "../baseDatos/conexion.php";
    session_start();
    $correoSession = $_SESSION['correo'];
    $contrasenaSession = $_SESSION['contrasena'];
    if (!isset($correoSession) || !isset($contrasenaSession)) {
        session_destroy();
        $_SESSION = array();
        header("Location: ../inicioSesion.php");
    }

    if (isset($_POST['salir'])) {
        session_destroy();
        $_SESSION = array();
        header("Location: ../inicioSesion.php");
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

    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../alertifyjs/css/alertify.css">
    <link rel="stylesheet" type="text/css" href="../alertifyjs/css/themes/default.css">
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <script src="../alertifyjs/alertify.js"></script>
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
    <a class="nav-link " href="acciones.php">
        <i class="fas fa-scroll"></i>
        <span>Acciones</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    </div>
</li>

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
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">Invitado</span>
                        <img class="img-profile rounded-circle" src="https://cdn.discordapp.com/attachments/569659673792479252/569662825195372564/unknown.png">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <form action="" method="POST">
                            <button class="dropdown-item" name="salir"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Salir</button>
                        </form>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->

                        <!-- Begin Page Content -->
        <div class="container-fluid">
                    <center>
                        <h1 class="h3 mb-0 text-gray-800">Reuniones</h1>
                        
                    </center>

                    <br>

                   
                    <div class="grid-container">
                            <?php
                                $consulta0 = "SELECT * FROM relacionreunioninvitado WHERE refcorreo='$correoSession'";
                                $resultado0 = mysqli_query($conexion, $consulta0) or die ( "Algo ha ido mal en la consulta a la base de datos1");
                                while ($columna0 = mysqli_fetch_array( $resultado0 )){
                                    $idReunion0 = $columna0['refid'];
                                    $consulta = "SELECT * FROM reunion WHERE id='$idReunion0'";
                                    $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos1");
                                    while ($columna = mysqli_fetch_array( $resultado )){

                                        $datos = $columna["id"].'||'.$columna["tipoPredefinido"].'||'.$columna["fecha"].'||'.$columna["hora"].'||'.$columna["duracion"].'||'.$columna["tipoDuracion"].'||'.$columna["linkReunion"].'||'.$columna["nombre"];
                                        $usarFuncion = "formEditarReunionIndex('".$datos."')";

                                        $id = $columna['id'];
                                        $linkReunion = $columna['linkReunion'];
                                        $colorCard = "bg-create";
                                        $horaReunion= $columna['hora'];
                                        $colorBoton = "btn-primary";
                                        $fecha = $columna['fecha'];
                                        $estado = $columna['estado'];
                                        $fechaActual = date("Y-m-d");
                
                                        if($estado == "Terminado"){
                                            $colorCard = "bg-success";
                                            $colorBoton = "btn-success";
                                        }
                                        else if($estado=="En Proceso"){
                                            $colorCard = "bg-info";
                                            $colorBoton = "btn-info";

                                        }
                                        else if($estado=="En Espera"){
                                            $colorCard = "bg-danger";
                                            $colorBoton = "btn-danger";


                                        }

                                        echo '


                                        
                                                <div class="card text-white '.$colorCard.' mb-3">
                                                    <div class="d-flex bd-highlight mb-3">
                                                        <div class="mr-auto p-2 bd-highlight"><h5 class="card-title"> Nombre: '.$columna['nombre'].'</h5></div>
                                                        ';
                                                    echo '
                                                    </div> 

                                                    <div class="card-body">
                                                        <h6 class="m-b-20">Reunión: '.$columna['tipoPredefinido'].'</h6>
                                                        
                                                        <h5 class="card-title"><i class="far fa-calendar"></i> '.$columna['fecha'].'</h5>
                                                        <h5 class="card-title"><i class="far fa-clock"></i> '.$columna['hora'].'</h5>
                                                        <h5 class="card-title"><i class="fas fa-stopwatch"></i> '.$columna['duracion'].' '.$columna['tipoDuracion'].'</h5>';
                                                        
                                                        if($linkReunion == "" || $linkReunion==" "){
                                                            echo '<h5 class="card-title"><i class="fas fa-link"></i><a class="btn '.$colorBoton.'" href=""></a></h5>';
                                                        }
                                                        else {
                                                            echo ' 
                                                                    <a href="'.$linkReunion.'" class="btn '.$colorBoton.'" id="copy-button" data-clipboard-target="#G'.$id.'"><i class="fas fa-chevron-right"></i>Link Reunion</a>';
                                                        }
                                                        
                                                        echo'

                                                        

                                                        
                                                    
                                                    </div>';
                                                    echo'
                                            
                                                        
                                                </div>
                                            ';
                                            
                    
                                    }

                                }

                                
                            
                            
                            
                            ?>
                    </div>
 

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->


        </div>

        <!-- End of Content Wrapper -->


        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">¿Listo para salir?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Seleccione "Cerrar sesión" a continuación si está listo para finalizar su
                        sesión
                        actual.</div>
                    <div class="modal-footer">
                        <button class="button-rojo" type="button" data-dismiss="modal">Cancelar</button>
                        <a class="btn btn-primary" href="login.html">Cerrar sesión</a>
                    </div>
                </div>
            </div>
        </div>


    </div>
     
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Gestor Actas 2020</span>
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
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>  

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>
  <script src="../js/iniciarReunion.js"></script>

  
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  
    <!-- código propio JS --> 
    <script type="text/javascript" src="../js/acta.js"></script>
    <script type="text/javascript" src="../js/index.js"></script>
    <script type="text/javascript" src="../js/alerta.js"></script>
   
</body>

</html>