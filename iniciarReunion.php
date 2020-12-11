<?php  require "baseDatos/conexion.php";?>
<?php require_once "vistas/partesuperior.php"?>


<?php  


$dateReunion="";
$dateTimeReunion ="";

$name="";
$id="";
if(isset($_POST['idReunionCalendar'])){
    $id=$_POST['idReunionCalendar'];
    $condicion=$_POST['clausula'];
}
if(isset($_GET['variable1'])){
    $id=$_GET['variable1'];
}
$consultaR = "SELECT * FROM reunion";
$resultadoR = mysqli_query($conexion, $consultaR) or die ( "Algo ha ido mal en la consulta a la base de datos1");
while ($columna = mysqli_fetch_array( $resultadoR )){
    $id2 = $columna['id'];
    if($id2== $id){
        $dateReunion = $columna['fecha'];
        $dateTimeReunion = $columna['hora'];
        $name=$columna['nombre'];

    }
}


?>



 <?php
                                               
 ?>




<!-- Begin Page Content -->
<div class="container-fluid">
    <center>
        <h1 class="h3 mb-0 text-gray-800">Reunion: <?php echo $name ?> </h3> </h1>                
    </center>
    <h4 class="fas fa-calendar-alt" aria-hidden="true"> Fecha reunion: <?php echo $dateReunion ?></h4>
    <br>
    <h4 class="far fa-clock" aria-hidden="true"> Hora de inicio: <?php echo $dateTimeReunion ?></h4>
    <br>
 






    
                        <div class="bg-card mb-4">
                        <div class="bg-card-head py-3">
                        <br>
                        <br>
                        <br>
                        <h3 class="fas fa-book"></i> Temas a Tratar:</h3> </h3>                

                        </div>
                        <div class="bg-card-body">
                            <div class="row">
                            <button type="button" class="button-azul" data-toggle="modal" data-target="#crearTema">Agregar Tema</button>
                            </div>

                            <br>

                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table" id="tablaTema">
                                        <thead>
                                          <tr>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Tag</th>
                                            <th scope="col">Acciones</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $idReunion = $id;
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
                                                        <td>'.$columna['nombre'].'</td>

                                                        <td>'.$columna['tag'].'</td>
                                                        <td><button type="button" class="button-amarillo" data-toggle="modal" data-target="#editarTema" onclick="'.$usarFuncion2.'">Editar</button>   <button type="button" class="button-rojo" onclick="'.$usarFuncion.'">Eliminar</button>   <button type="button" class="button-azul" onclick="'.$accionFuncion.'" data-toggle="modal" data-target="#adminAccion">Administrar Acciones</button></td>
                                                    </tr>';
                                                    
                                                }
                                            ?>
                                        </tbody>
                                      </table>
                                </div>
                            </div>
            
                        </div>
      


</div>





<div class="bg-card">
                        <div class="bg-card-head py-3">
                        <h2 class="fas fa-smile-wink">Invitados</i></h2> </h1> 
                        </div>
                        <div class="bg-card-body">
                            <div class="row">
                                <button type="button" class="button-azul" data-toggle="modal" data-target="#crearInvitado">Agregar Invitado</button>
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
                                                $consulta = "SELECT * FROM relacionreunioninvitado WHERE refid='$id'";
                                                $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos1");
                                                while ($columna = mysqli_fetch_array( $resultado )){
                                                    $refCorreo = $columna['refcorreo'];

                                                    $consulta2 = "SELECT * FROM invitado WHERE correo='$refCorreo'";
                                                    $resultado2 = mysqli_query($conexion, $consulta2) or die ( "Algo ha ido mal en la consulta a la base de datos1");
                                                    while ($columna2 = mysqli_fetch_array( $resultado2 )){
                                                        $datos = $columna2["correo"].'||'.$id;
                                                        $usarFuncion = "preguntarSiNo('".$datos."')";
                                                        echo '<tr>
                                                            <td>'.$columna2['nombre'].'</td>
                                                            <td>'.$columna2['correo'].'</td>
                                                            <td><button type="button" class="button-rojo" onclick="'.$usarFuncion.'">Eliminar</button></td>
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
                    <button type="button" class="button-verde" id="editarTemaModalEdicion">Guardar</button>
                </div>
            </div>
        </div>
    </div>


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
                    <a class="button-azul" href="login.html">Cerrar sesión</a>
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
                            <button type="button" class="button-azul" data-toggle="modal" data-target="#modalAccion">Agregar Acciones</button>
                        </div>
                    </div>
                    <h2></h2>
                    <table class="table table-hover table-condensed table-bordered">
                        <thead>
                            <tr>
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
                    <button class="button-azul" type="button" data-dismiss="modal">Listo</button>
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
                                        <select class="form-control" id="encargadoAccionModal" required>
                                            <option value="">Seleccionar invitado</option>
                                            <?php
                                                $consulta2 = "SELECT * FROM relacionreunioninvitado WHERE refid='$idReunion'";
                                                $resultado2 = mysqli_query($conexion, $consulta2) or die ( "Algo ha ido mal en la consulta a la base de datos1");
                                                while ($columna = mysqli_fetch_array($resultado2)){
                                                    $refCorreo = $columna['refcorreo'];
                                                    echo '<option value="'.$refCorreo.'">'.$refCorreo .'</option>';
                                                }
                                            ?>
                                        </select>
                                        <br>
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
                    <button type="button" class="button-azul" id="crearAccionBoton">Guardar</button>
                </div>
            </div>
        </div>
    </div>

<!-- Modal Editar Accion -->
    <div class="modal fade" id="editarAccion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Accion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="idAccionModalEdicion">ID Accion</label>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" id="idAccionModalEdicion" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="nombreAccionEditarModal">Nombre Accion</label>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" id="nombreAccionModalEdicion">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="encargadoAccionModalEdicion">Encargado</label>
                                </div>
                                <div class="col">
                                    <select class="form-control" id="encargadoAccionModalEdicion" required>
                                        <option value="">Seleccione nuevo encargado</option>
                                        <?php
                                            $consulta2 = "SELECT * FROM relacionreunioninvitado WHERE refid='$idReunion'";
                                            $resultado2 = mysqli_query($conexion, $consulta2) or die ( "Algo ha ido mal en la consulta a la base de datos1");
                                            while ($columna = mysqli_fetch_array($resultado2)){
                                                $refCorreo = $columna['refcorreo'];
                                                echo '<option value="'.$refCorreo.'">'.$refCorreo .'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="fechanuevaterminoAccion">Fecha nueva de accion</label>
                                </div>
                                <div class="col">
                                    <input type="date" class="form-control" id="fechanuevaterminoAccion" requiered>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="estadoAccionModalEdicion">Estado</label>
                                </div>
                                <div class="col">
                                    <select class="form-control" id="encargadoAccionModal" required>
                                        <option value="seleccionencargado">Seleccione estado</option>
                                        <option value="enproceso">En proceso</option>
                                        <option value="enpausa">En pausa</option>
                                        <option value="terminado">Terminado</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="button-verde" id="editarAccionModal">Actualizar</button>
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
                            <input type="text" class="form-control" id="idReunionTemaModal" value="<?php echo $id;?>" readonly>
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
                    <button type="button" class="button-azul" id="crearTemaBoton">Guardar</button>
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
                            <input type="text" class="form-control" id="idReunionInvitadoModal" value="<?php echo $id;?>" readonly>
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
                    <button type="button" class="btn-verde" id="crearInvitadoBoton">Guardar</button>
                </div>
            </div>
        </div>
    </div>


<?php require_once "vistas/parteinferior.php"?>