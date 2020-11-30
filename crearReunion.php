<?php
    require "baseDatos/conexion.php";
    $idReunion = $_GET['id'];
    $existe = false;

    $consulta = "SELECT * FROM reunion WHERE id='$idReunion'";
    $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos1");
    while ($columna = mysqli_fetch_array( $resultado )){
        $existe=true;
    }
    
    if(empty($idReunion) || $existe==false){
        header('Location: index.php');

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
    <style>
        .ui-autocomplete {
            z-index: 10000000;
        }
    </style>
    

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="crearReunion.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">ACTAS</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-chevron-left"></i>
                    <span>Volver</span></a>
            </li>

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
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Nombre Usuario</span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>
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

                    <div class="card shadow mb-4">
                        <div class="card-head py-3">
                            <center><h6 class="m-0 font-weight-bold text-primary"> ID Reunion</h6></center>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="idReunion" value="<?php echo $idReunion;?>" readonly>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-head py-3">
                            <center><h6 class="m-0 font-weight-bold text-primary">Temas a tratar</h6></center>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#crearTema">Agregar Tema</button>
                            </div>

                            <br>

                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table" id="tablaTema">
                                        <thead>
                                          <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Tag</th>
                                            <th scope="col">Acciones</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $consulta = "SELECT * FROM tema WHERE refreunion='$idReunion'";
                                                $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos1");
                                                while ($columna = mysqli_fetch_array( $resultado )){
                                                    $datos = $columna["nombre"].'||'.$idReunion;
                                                    $datos2 = $columna["id"].'||'.$columna["nombre"];
                                                    $usarFuncion2 = "formEditarTema('".$datos2."')";
                                                    
                                                    $datos3 = $columna["nombre"].'||'.$idReunion.'||'.$columna["id"];
                                                    $usarFuncion = "preguntarSiNo2('".$datos."')";
                                                    $accionFuncion = "getIdTemaAcciones('".$datos3."')";
                                                    echo '<tr>
                                                        <td>'.$columna['id'].'</td>
                                                        <td>'.$columna['nombre'].'</td>
                                                        <td>'.$columna['tag'].'</td>
                                                        <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editarTema" onclick="'.$usarFuncion2.'">Editar</button><button type="button" class="btn btn-danger" onclick="'.$usarFuncion.'">Eliminar</button><button type="button" class="btn btn-secondary" onclick="'.$accionFuncion.'" data-toggle="modal" data-target="#adminAccion">Administrar Acciones</button></td>
                                                    </tr>';
                                                    
                                                }
                                            ?>
                                        </tbody>
                                      </table>
                                </div>
                            </div>
            
                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-head py-3">
                            <center><h6 class="m-0 font-weight-bold text-primary">Invitados</h6></center>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#crearInvitado">Agregar Invitado</button>
                            </div>

                            <br>

                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                          <tr>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Correo</th>
                                            <th scope="col">Acciones</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $consulta = "SELECT * FROM relacionreunioninvitado WHERE refid='$idReunion'";
                                                $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos1");
                                                while ($columna = mysqli_fetch_array( $resultado )){
                                                    $refCorreo = $columna['refcorreo'];

                                                    $consulta2 = "SELECT * FROM invitado WHERE correo='$refCorreo'";
                                                    $resultado2 = mysqli_query($conexion, $consulta2) or die ( "Algo ha ido mal en la consulta a la base de datos1");
                                                    while ($columna2 = mysqli_fetch_array( $resultado2 )){
                                                        $datos = $columna2["correo"].'||'.$idReunion;
                                                        $usarFuncion = "preguntarSiNo('".$datos."')";
                                                        echo '<tr>
                                                            <td>'.$columna2['nombre'].'</td>
                                                            <td>'.$columna2['correo'].'</td>
                                                            <td><button type="button" class="btn btn-danger" onclick="'.$usarFuncion.'">Eliminar</button></td>
                                                        </tr>';
                                                    }

                                                    
                                                }
                                            ?>
                                        </tbody>
                                      </table>
                                </div>
                            </div>
            
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
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
                <div class="modal-body">Seleccione "Cerrar sesión" a continuación si está listo para finalizar su sesión actual.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="login.html">Cerrar sesión</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Administrar Acciones Modal-->
    <div class="modal fade" id="adminAccion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" style="overflow-y: scroll;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Administrador Acciones</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <h5>Acciones</h5>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAccion">Agregar Acciones</button>
                        </div>
                    </div>
                    <h2></h2>
                    <table class="table table-hover table-condensed table-bordered">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>Nombre</td>
                                <td>Encargado</td>
                                <td>Fecha termino</td>
                                <td>Editar</td>
                                <td>Eliminar</td>
                            </tr>
                        </thead>
                        <tbody id="relleno">
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Listo</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Crear Accion -->
    <div class="modal fade" id="modalAccion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear Accion</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>   
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label>Nombre Accion</label>
                                    <input type="text" class="form-control" id="nombreAccionModal" placeholder="Nombre Accion" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label>Encargado</label>
                                    <input type="text" class="form-control" id="correoInvitadoAccion" placeholder="Correo Encargado" required>
                                </div>
                            </div>
                            <div class="row">
                                    <div class="col">
                                        <label>Fecha Reunión</label>
                                        <input type="date" class="form-control" id="fechaterminoAccion" requiered>
                                    </div>
                                </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="crearAccionBoton">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Crear Tema -->
    <div class="modal fade" id="crearTema" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo Tema</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>   
                        <div class="form-group">
                            <input type="text" class="form-control" id="idReunionTemaModal" value="<?php echo $idReunion;?>" readonly>
                        </div>
                        <?php
                            $idTema = 0;
                            $existe = false;
                            
                            do{
                                $idTema = rand();
                                $consulta = "SELECT * FROM tema WHERE id='$idTema'";
                                $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos1");
                                while ($columna = mysqli_fetch_array( $resultado )){
                                    $existe=true;
                                }
                            }while($idTema==0 || $existe);
                        ?>
                        <div class="form-group">
                            <label>Id tema</label>
                            <input type="text" class="form-control" id="idTemaCrear" value="<?php echo $idTema;?>" readonly>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label>Nombre Tema</label>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" id="nombreTemaModal" placeholder="Nombre Tema" required>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="crearTemaBoton">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Crear Invitado -->
    <div class="modal fade" id="crearInvitado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo Invitado</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <input type="text" class="form-control" id="idReunionInvitadoModal" value="<?php echo $idReunion;?>" readonly>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="correoInvitadoModal">Correo Invitado</label>
                                </div>
                                <div class="col">
                                    <input type="email" class="form-control" id="correoInvitadoModal" placeholder="Correo Invitado" required>
                                </div>
                            </div>
                            
                            
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="correoInvitadoModal">Nombre Invitado</label>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" id="nombreInvitadoModal" placeholder="Nombre Invitado" required>
                                </div>
                            </div>
                            
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="crearInvitadoBoton">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar Tema -->
    <div class="modal fade" id="editarTema" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Tema</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="correoInvitadoModal">ID Tema</label>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" id="idTemaModalEdicion" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="correoInvitadoModal">Nombre Tema</label>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" id="nombreTemaModalEdicion">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="editarTemaModalEdicion">Guardar</button>
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