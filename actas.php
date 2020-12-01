<?php  require "baseDatos/conexion.php";?>
<?php require_once "vistas/partesuperior.php"?>



<!-- Begin Page Content -->
<div class="container-fluid">
    <center>
    <h3 style="color:#242c75" ;> Acta de la Reunion: <?php echo $id ?></h3>    </center>
    <br>

    <div class="card">
        <div class="card-body">
            <div class="container">
                <div class="row row-cols-3">
                    <div class="col">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#crearActa">Crear
                            Acta</button>

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
                        $consulta = "SELECT * FROM reunion, acta
                        WHERE reunion.id= acta.refreunion";
                        $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos1");
                        while ($columna = mysqli_fetch_array( $resultado )){
                            echo '<div class="col">
                                    <div class="card text-white bg-primary mb-3">
                                    <div class="d-flex bd-highlight mb-3">
                                    <div class="mr-auto p-2 bd-highlight"><h5 class="card-title"> Nro: '.$columna['id'].'</h5></div>
                                    <div class="p-2 bd-highlight"><button class="btn-sm btn-info" data-toggle="modal" data-target="#editarActa"><i class="fas fa-pen"></i></button></div>
                                    </div>                                                    
                                        <div class="card-body">                                                            
                                            <h5 class="card-title">Reunión: '.$columna['tipoPredefinido'].'</h5>
                                            <h5 class="card-title"><i class="far fa-calendar"></i> '.$columna['fecha'].'</h5>
                                        </div>
                                        <div class="card-footer text-muted">
                                        <div class="d-flex flex-row-reverse"><div class="p-2"><a href="#" class="btn btn-primary">Generar Documento  </a></div></div>
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


</div>

<!-- End of Content Wrapper -->


<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="actas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-primary" href="login.html">Cerrar sesión</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal Crear Acta -->
<div class="modal fade" id="crearActa" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Nueva Acta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="cerrarX">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label>ID de Reunion</label>
                            </div>
                            <div class="col">
                                <select class="form-control" id="reunion">
                                    <?php
                                        $query = "SELECT * FROM reunion";
                                        $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos1");
                                         while ($columna = mysqli_fetch_array( $resultado )){                                                 
                                            echo "<option value='".$columna['id']."'>".$columna['id']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>                    

                    <div class="form-group">
                        <label for="exampleInputEmail1">Temas</label>
                        <input type="text" class="form-control" placeholder="" required>
                    </div>
                    <div id="more-tema"></div>
                    <div class="form-group">
                        <button id="addTema" class="btn btn-primary">Agregar Tema</button>
                        <button id="removeTema" class="btn btn-danger">Eliminar Ultimo</button>
                    </div>
                   

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cerrar">Cerrar</button>
                <button type="button" id="finalizado" class="btn btn-primary">Finalizado</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Acta -->
<div class="modal fade" id="editarActa" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Editar Acta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="cerrarX">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label>ID de Reunion</label>
                            </div>
                            <div class="col">
                                <select class="form-control" id="reunion">
                                    <?php
                                        $query = "SELECT * FROM reunion";
                                        $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos1");
                                         while ($columna = mysqli_fetch_array( $resultado )){                                                 
                                            echo "<option value='".$columna['id']."'>".$columna['id']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>                    

                    <div class="form-group">
                        <label for="exampleInputEmail1">Temas</label>
                        <input type="text" class="form-control" placeholder="" required>
                    </div>
                    <div id="more-tema"></div>
                    <div class="form-group">
                        <button id="addTema" class="btn btn-primary">Agregar Tema</button>
                        <button id="removeTema" class="btn btn-danger">Eliminar Ultimo</button>
                    </div>
                   

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cerrar">Cerrar</button>
                <button type="button" id="finalizado" class="btn btn-primary">Finalizado</button>
            </div>
        </div>
    </div>
</div>

</div>


<?php require_once "vistas/parteinferior.php"?>