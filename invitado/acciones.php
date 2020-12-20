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
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Salir
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->

                        <!-- Begin Page Content -->
        <div class="container-fluid">
                    <center>
                        <h1 class="h3 mb-0 text-gray-800">Acciones</h1>
                        
                    </center>

                    <br>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">Reunión</th>
                                <th scope="col">Tema</th>
                                <th scope="col">Acción</th>
                                <th scope="col">Limite Acción</th>
                                <th scope="col">Estado Acción</th>
                                <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $consulta_0 = "SELECT * FROM accion WHERE refinvitado='$correoSession' AND estado!='Terminado'";
                                    $resultado_0 = mysqli_query($conexion, $consulta_0) or die ( "Algo ha ido mal en la consulta a la base de datos1");
                                    while ($columna_0 = mysqli_fetch_array( $resultado_0 )){
                                        $refTema = $columna_0['reftema'];
                                        $refReunion = $columna_0['refreunion'];
                                        $nombreAccion = $columna_0['nombre'];
                                        $fechaAccion = $columna_0['fechatermino'];
                                        $estadoAccion = $columna_0['estado'];
                                        $nombreTema = "";
                                        $nombreReunion = "";
                                        $tipoReunion = "";


                                        $datos = $columna_0["id"].'||'.$columna_0['nombre'].'||'.$columna_0["fechatermino"].'||'.$columna_0["estado"]."||".$columna_0["comentario"];
                                        $usarFuncion = "formVerAccion('".$datos."')";

                                        $consulta_1 = "SELECT * FROM tema WHERE id='$refTema'";
                                        $resultado_1 = mysqli_query($conexion, $consulta_1) or die ( "Algo ha ido mal en la consulta a la base de datos1");
                                        while ($columna_1 = mysqli_fetch_array( $resultado_1 )){
                                            $nombreTema = $columna_1['nombre'];

                                        }

                                        $consulta_2 = "SELECT * FROM reunion WHERE id='$refReunion'";
                                        $resultado_2 = mysqli_query($conexion, $consulta_2) or die ( "Algo ha ido mal en la consulta a la base de datos1");
                                        while ($columna_2 = mysqli_fetch_array( $resultado_2 )){
                                            $nombreReunion = $columna_2['nombre'];
                                            $tipoReunion = $columna_2['tipoPredefinido'];

                                        }

                                        echo '<tr>
                                            <td>
                                                <form method="post" action="../generate_pdf.php">                                        
                                                    <input type="hidden" name="variable1" value="'.$refReunion.'"/>
                                                    <div class="d-flex flex-row-reverse">
                    
                    
                                            
                                                        <div class="p-2">
                    
                                                            <button id="pdf" name="generate_pdf" class="button-verde">Reunión</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </td>
                                            <td>'.$nombreTema.'</td>
                                            <td>'.$nombreAccion.'</td>
                                            <td>'.$fechaAccion.'</td>
                                            <td>'.$estadoAccion.'</td>
                                            <td><button type="button" class="button-amarillo" data-toggle="modal" data-target="#verAccion" onclick="'.$usarFuncion.'">Ver</button></td>
                                        </tr>';


                                    }
                                ?>
                            </tbody>
                        </table>
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
                        <form action="" method="POST">
                            <button class="btn btn-primary" name="salir">Cerrar sesión</button>
                        </form>
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

  <!-- Modal Ver Accion -->
  <div class="modal fade" id="verAccion" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Ver Accion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="cerrarX">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div hidden class="form-group">
                            <input type="text" class="form-control" id="idAccion" readonly>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label>Nombre Accion</label>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" id="nombreAccion" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label>Fecha Termino Accion</label>
                                </div>
                                <div class="col">
                                    <input type="date" class="form-control" id="fechaTermino" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label>Estado Accion</label>
                                </div>
                                <div class="col">
                                    <select class="form-control" id="estadoAccion">
                                        <option value="Pendiente">Pendiente</option>
                                        <option value="Terminado">Terminado</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <label>Comentarios</label>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" id="comentarioInvitado" cols="30" rows="10"></textarea>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="button-rojo" data-dismiss="modal" id="cerrar">Cerrar</button>
                    <button type="button" class="button-azul" id="guardarAccion">Guardar</button>
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

  
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
    function formVerAccion(datos){
      d=datos.split('||');
      $('#idAccion').val(d[0]);
      $('#nombreAccion').val(d[1]);
      $('#fechaTermino').val(d[2]);
      $('#estadoAccion').val(d[3]);
      $('#comentarioInvitado').val(d[4]);
    }
  $(document).ready(function(){
  $('#guardarAccion').click(function(){
      
        idAccion = $('#idAccion').val();
        nombreAccion = $('#nombreAccion').val();
        estadoAccion= $('#estadoAccion').val();
        comentarioAccion= $('#comentarioInvitado').val();
        correoUsuario = '<?php echo $correoSession; ?>';
        


        if(nombreAccion == "" || nombreAccion==" "){
            alert("Error, nombre accion en blanco.");

        }
        else if(estadoAccion == "Terminado" && (comentarioAccion == "" || comentarioAccion == " ")){
            alert("Error, se debe escribir un comentario");
        }
        else{
            cadena = "idAccion=" + idAccion + "&nombreAccion=" + nombreAccion + "&estadoAccion=" + estadoAccion + "&comentarioAccion=" + comentarioAccion + "&refEditor=" + correoUsuario;
            $.ajax({
                type:"POST",
                url:"../baseDatos/actualizarAccionInvitado.php",
                data:cadena,
                success:function(r){
                  if(r==1){
                    location.reload();
                    
                  }else{
                    if (r==6) {
                        alertify.error("Accion No existe en el sistema");
                    }
                    else{
                        alert(r);
                    }
                  }
                }
              });
        }

    });
});
  </script>
  

   
</body>

</html>