<?php  require "baseDatos/conexion.php";?>
<?php require_once "vistas/partesuperior.php"?>


<?php  


$dateReunion="";
$dateTimeReunion ="";
$tipoPredefinido = "";
$duracion = "";
$tipoDuracion = "";
$linkReunion = "";
$horaInicio = "";
$estado = "";
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
        $horaInicio = $columna['horaInicio'];
        $tipoPredefinido = $columna['tipoPredefinido'];
        $duracion = $columna['duracion'];
        $tipoDuracion = $columna['tipoDuracion'];
        $linkReunion = $columna['linkReunion'];
        $estado = $columna['estado'];

    }
}


?>



 <?php
                                               
 ?>




<!-- Begin Page Content -->
<div class="container-fluid">
    <center>
        <h1 class="m-0 font-weight-bold text-primary">Reunión: <?php echo $name ?></h1>             
    </center>

    <div class="bg-card shadow mb-4">
        <div class="bg-card-body">
            <form>
                <div class="form-group">
                    <input type="text" class="form-control" id="idReunion" value="<?php echo $id;?>" readonly>
                </div>


                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <label>Tipo Reunión</label>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" id="tipoReunion" value="<?php echo $tipoPredefinido;?>" readonly>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <label>Fecha Reunión</label>
                        </div>
                        <div class="col">
                            <input type="date" class="form-control" id="fechaReunion" value="<?php echo $dateReunion;?>" readonly>
                        </div>
                    </div>


                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <label>Hora Estimada de Inicio Reunión</label>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" id="tipoReunion" value="<?php echo $dateTimeReunion;?>" readonly>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <label>Hora Real de Inicio Reunión</label>
                        </div>
                        <div class="col">
                            <?php
                                if($horaInicio == "" || $horaInicio == " "){
                                    echo '<div class="row">
                                            <div class="col">
                                                <select class="form-control" id="horaReunion">';
                                                
                                                    echo '<option value="Seleccionar">Seleccionar Hora Reunion</option>';
                                            
                                                    for($i =0; $i<=23; $i++){
                                                        if($i<10){
                                                            echo '<option value="0'.$i.'">0'.$i.'</option>';
                                                        }
                                                        else{
                                                            echo '<option value="'.$i.'">'.$i.'</option>';
                                                        }
                                                    }
                                    echo '      </select>
                                            </div>
                                            <div class="col">
                                                <select class="form-control" id="minutoReunion">';
                                                    echo '<option value="Seleccionar">Seleccionar Minuto Reunion</option>';
                                                    for($i=0; $i<=60; $i++){
                                                        if($i<10){
                                                            echo '<option value="0'.$i.'">0'.$i.'</option>';
                                                        }
                                                        else{
                                                            echo '<option value="'.$i.'">'.$i.'</option>';
                                                        }
                                                        
            
                                                    }
                                                echo '</select>
                                            </div>
                                            <div class="col">
                                                <button type="button" class="button-verde" id="iniciarReunionHora">Iniciar Reunión</button>
                                            </div>
                                        </div>';

                                }
                                else{
                                    echo '<input type="text" class="form-control" value="'.$horaInicio.'" readonly>';

                                }
                            ?>
                        </div>

                        
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <label>Duracion Reunión</label>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" id="horaRealReunion" value ="<?php echo $duracion.' '.$tipoDuracion;?>" readonly>
                        </div>
                        
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <label>Link de Reunión</label>
                        </div>
                        <div class="col">
                            <a href="<?php echo $linkReunion?> " class="btn btn-primary"><i class="fas fa-chevron-right"></i>Link Reunion</a>
                        </div>
                    </div>
                </div>
                
            </form>
        </div>
    </div>

    <div class="bg-card shadow mb-4">
        <div class="bg-card-head py-3">
            <center><h3 class="m-0 font-weight-bold text-primary"><i class="fas fa-book"></i> Temas a tratar</h3></center>
        </div>
        <div class="bg-card-body">
            <div class="row">
                <button type="button" class="button-verde" data-toggle="modal" data-target="#crearTema">Agregar Tema</button>
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

    <div class="bg-card shadow mb-4">
        <div class="bg-card-head py-3">
            <center><h3 class="m-0 font-weight-bold text-primary"><i class="fas fa-smile-wink"></i> Invitados</h3></center>
        </div>
        <div class="bg-card-body">
            <div class="row">
                <button type="button" class="button-verde" data-toggle="modal" data-target="#crearInvitado">Agregar Invitado</button>
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

    <div class="bg-card shadow mb-4">
        <div class="bg-card-head py-3">
            <center><h3 class="m-0 font-weight-bold text-primary"><i class="fas fa-book-reader"></i> Actas</h3></center>
        </div>
        <div class="bg-card-body">
            <div class="row">
                <div class="col">
                    <form method="post" action="generate_pdf.php">                                        
                        <input type="hidden" name="variable1" value="<?php echo $id;?>"/>
                        <div class="d-flex flex-row-reverse">
                            <div class="p-2">
                                <button id="pdf" name="generate_pdf" class="button-verde">Generar Acta Comite Curricular</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col">
                    <form method="post" action="generate_pdf.php">                                        
                        <input type="hidden" name="variable1" value="<?php echo $id;?>"/>
                        <div class="d-flex flex-row-reverse">
                            <div class="p-2">
                                <button id="pdf" name="generate_pdf" class="button-verde">Generar Acta Publica</button>
                            </div>
                        </div>
                    </form>
                </div>
                
            </div>



        </div>
    </div>

    <div class="bg-card shadow mb-4">
        <div class="bg-card-head py-3">
            <center><button type="button" class="button-rojo">Terminar Reunión</button></center>
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
                                            <option value="seleccionencargado">Seleccionar invitado</option>
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