<?php
    require "baseDatos/conexion.php";
    


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

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">ACTAS</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-users"></i>
                    <span>Reuniones</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-file-download"></i>
                    <span>Reportes</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="buttons.html">Reporte1</a>
                        <a class="collapse-item" href="cards.html">Reporte2</a>
                    </div>
                </div>
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
                    <center><h1 class="h3 mb-0 text-gray-800">Reuniones</h1></center>

                    <br>

                    <div class="card">
                        <div class="card-body">
                            <div class="container">
                                <div class="row row-cols-3">
                                    <div class="col">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#crearReunion">Crear Reunion</button>
            
                                    </div>
                                </div>
                              </div>
                        </div>
                    </div>

                    <br>

                    <div class="card">
                        <div class="card-body">
                            <div class="card-head py-3">
                                <center><h6 class="m-0 font-weight-bold text-primary">Estado de Reuniones</h6></center>
                            </div>
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        <button type="button" class="btn btn-primary">Creada</button>
            
                                    </div>
                                    <div class="col">
                                        <button type="button" class="btn btn-info">En Proceso</button>
            
                                    </div>
                                    <div class="col">
                                        <button type="button" class="btn btn-danger">En Espera de Acciones</button>
            
                                    </div>
                                    <div class="col">
                                        <button type="button" class="btn btn-success">Terminada</button>
            
                                    </div>
                                </div>
                              </div>
                        </div>
                    </div>

                    <br>

                    <div class="card">
                        <div class="card-body">
                            <div class="container">
                                <div class="row row-cols-2">
                                    <?php
                                        $consulta = "SELECT * FROM reunion";
                                        $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos1");
                                        while ($columna = mysqli_fetch_array( $resultado )){
                                            $linkReunion = $columna['linkReunion'];
                                            $colorCard = "bg-primary";
                                            $colorBoton = "btn-primary";
                                            $estado = $columna['estado'];
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
                                            
                                            echo '<div class="col">
                                                    <div class="card text-white '.$colorCard.' mb-3">

                                                        <div class="card-body">
                                                            <h5 class="card-title">Reunión: '.$columna['tipoPredefinido'].'</h5>
                                                            <h5 class="card-title"><i class="far fa-calendar"></i> '.$columna['fecha'].'</h5>
                                                            <h5 class="card-title"><i class="far fa-clock"></i> '.$columna['hora'].'</h5>
                                                            <h5 class="card-title"><i class="fas fa-stopwatch"></i> '.$columna['duracion'].' '.$columna['tipoDuracion'].'</h5>';
                                                            if($linkReunion == "" || $linkReunion==" "){
                                                                echo '<h5 class="card-title"><i class="fas fa-link"></i><a class="btn '.$colorBoton.'" href=""></a></h5>';
                                                            }
                                                            else{
                                                                echo '<h5 class="card-title"><i class="fas fa-link"></i><a class="btn '.$colorBoton.'" href="'.$columna['linkReunion'].'">Link Reunion</a></h5>';
                                                            }
                                                            
                                                        echo '</div>
                                                        <div class="card-footer text-muted">
                                                            <center><a href="#" class="btn '.$colorBoton.'"><i class="fas fa-chevron-right"></i></a></center>
                                                        </div>
                                                    </div>
                                                </div>';
                                        }
                                    ?>
                                </div>
                                
                              </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-6 mb-4">

                        </div>

                        <div class="col-lg-6 mb-4">

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

    <!-- Modal Crear Reunion -->
    <div class="modal fade" id="crearReunion" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Nuevo Tema</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="cerrarX">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <?php
                            $idReunion = 0;
                            $existe = false;
                            
                            do{
                                $idReunion = rand();
                                $consulta = "SELECT * FROM reunion WHERE id='$idReunion'";
                                $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos1");
                                while ($columna = mysqli_fetch_array( $resultado )){
                                    $existe=true;
                                }
                            }while($idReunion==0 || $existe);
                        ?>
                        <div class="form-group">
                            <input type="text" class="form-control" id="idReunion" value="<?php echo $idReunion;?>" readonly>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label>Tipo Reunión</label>
                                </div>
                                <div class="col">
                                    <select class="form-control" id="tipoReunion">
                                        <option value="Seleccionar">Seleccionar Tipo Reunión</option>
                                        <option value="Regular">Regular</option>
                                        <option value="Extraordinaria">Extraordinaria</option>
                                        <option value="Consejo de Escuela">Consejo de Escuela</option>
                                    </select>
                                </div>
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label>Fecha Reunión</label>
                                </div>
                                <div class="col">
                                    <input type="date" class="form-control" id="fechaReunion" requiered>
                                </div>
                            </div>
                            
                            
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label>Hora de Inicio Reunión</label>
                                </div>
                                <div class="col">
                                    <select class="form-control" id="hora">
                                        <?php
                                            echo '<option value="Seleccionar">Seleccionar Hora Reunion</option>';
                                            
                                            for($i =0; $i<=23; $i++){
                                                if($i<10){
                                                    echo '<option value="0'.$i.'">0'.$i.'</option>';
                                                }
                                                else{
                                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                                }
                                                

                                            }
                                        ?>
                                    </select>
                                </div>

                                <div class="col">
                                    <select class="form-control" id="minuto">
                                        <?php
                                            echo '<option value="Seleccionar">Seleccionar Minuto Reunion</option>';
                                            
                                            for($i=0; $i<=60; $i++){
                                                if($i<10){
                                                    echo '<option value="0'.$i.'">0'.$i.'</option>';
                                                }
                                                else{
                                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                                }
                                                

                                            }
                                        ?>
                                    </select>

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label>Duracion Reunión</label>
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control" id="duracionReunion" placeholder="Duración Reunión" requiered>
                                </div>
                                <div class="col">
                                    <select class="form-control" id="tipoDuracion">
                                        <option value="Seleccionar">Seleccionar Tipo Duración</option>
                                        <option value="Minutos">Minutos</option>
                                        <option value="Horas">Horas</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label>Link de Reunión</label>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" id="linkReunion" placeholder="Link de la Reunión">
                                </div>
                            </div>
                            
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cerrar">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="siguientePaso">Siguiente Paso</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script src="js/index.js"></script>


</body>

</html>