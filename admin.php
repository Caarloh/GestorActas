<?php  require "baseDatos/conexion.php";?>
<?php require_once "vistas/partesuperior.php"?>
    <div class="bg-card">
        <div class="bg-card-head py-3">
            <center><h3 class="m-0 font-weight-bold text-primary"><i class="fas fa-user-cog"></i>  Administración</h3></center>
        </div>
    </div>
    <div class="bg-card">
        <div class="bg-card-body">
            <h3 class="m-0 font-weight-bold text-primary"><i class="fas fa-user-cog"></i>  Comite</h3>
            <br>
            <div class="row">
                <div class="col">
                    <a  class="button add" data-toggle="modal" data-target="#usuarioConsejo">Nuevo Usuario Comite</a>
                </div>
            </div>
            <br>
            <div class="table-responsive">
                <table class="table" id="tablaTema">
                    <thead>
                        <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Administrador</th>
                        <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $consulta = "SELECT * FROM consejo";
                            $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos1");
                            while ($columna = mysqli_fetch_array( $resultado )){
                                
                                $correoConsejo = $columna['correo'];
                                $nombreConsejo = $columna['nombre'].' '.$columna['apellidos'];
                                $datosConsejo = $correoConsejo;
                                $adminSi = "NO";
                                $usarFuncionConsejo = "preguntarSiNo('".$datosConsejo."')";
                                $consulta2 = "SELECT * FROM `admin` WHERE correo = '$correoConsejo'";
                                $resultado2 = mysqli_query($conexion, $consulta2) or die ( "Algo ha ido mal en la consulta a la base de datos1");
                                while ($columna2 = mysqli_fetch_array( $resultado2 )){
                                    $adminSi = "SI";
                                }
                                $datosConsejo2 = $correoConsejo.'||'.$adminSi;
                                $usarFuncionConsejo2 = "actualizarAdmin('".$datosConsejo2."')";

                                echo '<tr>
                                <td>'.$nombreConsejo.'</td>
                                <td>'.$correoConsejo.'</td>
                                <td><a class="buttonYellow edit" onclick="'.$usarFuncionConsejo2.'"> '.$adminSi.' </a></td>
                                <td><a  class="buttonRed delete" onclick="'.$usarFuncionConsejo.'"> Eliminar </a></td>
                                

                                </tr>';







                            }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="bg-card">
        <div class="bg-card-body">
            <h3 class="m-0 font-weight-bold text-primary"><i class="fas fa-user-cog"></i>  Invitados</h3>
            <br>
            <div class="table-responsive">
                <table class="table" id="tablaTema">
                    <thead>
                        <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $consulta = "SELECT * FROM invitado";
                            $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos1");
                            while ($columna = mysqli_fetch_array( $resultado )){
                                
                                $correoInvitado = $columna['correo'];
                                $nombreInvitado = $columna['nombre'];
                                $datosInvitado = $correoInvitado;
                                $usarFuncionInvitado= "preguntarSiNo2('".$datosInvitado."')";

                                echo '<tr>
                                <td>'.$nombreInvitado.'</td>
                                <td>'.$correoInvitado.'</td>
                                <td><a  class="buttonRed delete" onclick="'.$usarFuncionInvitado.'"> Eliminar </a></td>
                                

                                </tr>';







                            }
                        ?>

                    </tbody>
                </table>
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

        <!-- Modal Crear Usuario Consejo -->
        <div class="modal fade" id="usuarioConsejo" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Nueva Usuario Comite</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label>Correo (*)</label>
                                    </div>
                                    <div class="col">
                                        <input type="email" class="form-control" id="correoUsuarioComite">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label>Nombre (*)</label>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" id="nombreUsuarioComite">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label>Apellidos (*)</label>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" id="apellidosUsuarioComite">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label>Contraseña (*)</label>
                                    </div>
                                    <div class="col">
                                        <input type="password" class="form-control" id="contrasenaUsuarioComite">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label>Verificación Contraseña (*)</label>
                                    </div>
                                    <div class="col">
                                        <input type="password" class="form-control" id="verificacionContrasenaUsuarioComite">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                         <a class = "buttonRed delete" data-dismiss="modal">Cerrar </a>
                         <a class = "button next" data-dismiss="modal" id="btnNuevoUsuarioComite"> Guardar </a>
                    </div>
                </div>
            </div>
        </div>


        

</div>


<?php require_once "vistas/parteinferior.php"?>