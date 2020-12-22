<?php  require "baseDatos/conexion.php";?>
<?php require_once "vistas/partesuperior.php"?>


<?php  

$correoSesion="";
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
$idReunion = "";

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
        $idReunion = $columna['id'];
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
        <div <?php echo "hidden"; ?>><input type="text" class="form-control" value="<?php echo $idReunion; ?>" id="idReunion" readonly></div>         
    </center>
    <div class="grid-contenedor">
    <div class="col" style ="text-align: center;">
    <img src="https://1.bp.blogspot.com/-d0OHqC6htlI/X85zKl4ksbI/AAAAAAAACPY/hLqGbvYeYkME3fre5k-m0kxAs9Gq8342QCLcBGAsYHQ/s320/calendario.png" style="width:50%; float:none" alt="Girl in a jacket">
    <br>
    <br>
    <label>Fecha Reunión:  <?php echo $dateReunion;?></label>
 
    <br>
    
    </div>
    <div class="col" style ="text-align: center;">
   
    <img src="https://1.bp.blogspot.com/-hoI545pBr-k/X85zLbHDdwI/AAAAAAAACPg/xjcgnzRVJJQDip2qcuAcnO3LjgJbus4kQCLcBGAsYHQ/s320/despertador.png" style="width:50%;" alt="Girl in a jacket">
    <br>
    <br>
    <label>Hora Estimada de Inicio: <?php echo $dateTimeReunion;?></label>
    <br>
    <br>
    </div>
    <div class="col" style ="text-align: center;">
    <img src="https://1.bp.blogspot.com/-QBY582jrcCI/X85zLw2faMI/AAAAAAAACPo/kSAE_RMX2FYsx6Xo9f8BKWhiR5x72pmfQCLcBGAsYHQ/s320/notas.png" style="width:50%;"alt="Girl in a jacket">
    <br>
    <br>
    <label>Tipo Reunión: <?php echo $tipoPredefinido;?></label>
    <br>
    <br>

    </div>
    <div class="col" style ="text-align: center;">
    <img src="https://1.bp.blogspot.com/-Xm8dB7Gry4A/X86b54sg6oI/AAAAAAAACQU/LJkbwlF-w8wRxbMV2cXhni6epro1QJeEQCLcBGAsYHQ/s320/reloj-de-arena%2B%25281%2529.pn" style="width:50%;"alt="Girl in a jacket">
    <br>
    <br>
    <label>Duracion Reunión: <?php echo $duracion.' '.$tipoDuracion;?> </label>

    </div>
    </div>
    
    <div class="col">
                            <label style="    margin: 10px 14px;">Hora Real de Inicio Reunión</label>
                        </div>
                        <div class="col">
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
                                                        <a href="'.$linkReunion. '" class="button-azul"><i class="fas fa-chevron-right"></i>Link Reunion</a>

                                            </div>
                                        </div>';

                                }
                                else{
                                    echo '<input type="text" class="form-control" value="'.$horaInicio.'" readonly>';

                                }
                                
                            ?>
                        </div>



                        <br>             
    <div class="bg-card">
        <div class="bg-card-head py-3">
            <center><h3 class="m-0 font-weight-bold text-primary"><i class="fas fa-book"></i> Temas a tratar</h3></center>
        </div>
        <div class="bg-card-body">
            <div class="row">
            <?php
            if($estado=="Terminado"){
                echo'';


            }
            else{

                echo '<a href="" class="button add" data-toggle="modal" data-target="#crearTema">Agregar Tema</a>';


            }
            ?>
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
                                        <td><a class="buttonYellow edit" data-toggle="modal" data-target="#editarTema" onclick="'.$usarFuncion2.'"> Editar </a>
                                        <a  class="buttonBlue next" onclick="'.$accionFuncion.'" data-toggle="modal" data-target="#adminAccion"> Acciones </a>

                                        ';
                                        if($estado == "Terminado"){



                                        }
                                        else{

                                            echo'<a  class="buttonRed delete" onclick="'.$usarFuncion.'"> Eliminar </a> </td>
                                            ';
                                        }

                                        echo'
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
            <center><h3 class="m-0 font-weight-bold text-primary"><i class="fas fa-smile-wink"></i> Comite</h3></center>
        </div>
        <div class="bg-card-body">

            <div class="row">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Correo</th>
                            <th scope="col">Asistencia</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $consulta = "SELECT * FROM consejo";
                                $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos1");
                                while ($columna = mysqli_fetch_array( $resultado )){
                                    $correo = $columna['correo'];
                                    $nombre = $columna['nombre'].' '.$columna['apellidos'];
                                    $asistencia2 = "";
                                    

                                    $existeAsistencia = false;

                                    $consulta2 = "SELECT * FROM asistenciacomite WHERE refcorreo='$correo' AND refid='$id'";
                                    $resultado2 = mysqli_query($conexion, $consulta2) or die ( "Algo ha ido mal en la consulta a la base de datos1");
                                    while ($columna2 = mysqli_fetch_array( $resultado2 )){
                                        $existeAsistencia = true;
                                        $asistencia2 = $columna2['asistencia'];
                                        
                                    }

                                    if(!$existeAsistencia){
                                        $consulta3 = "INSERT INTO asistenciacomite(refcorreo, refid, asistencia) VALUES ('$correo','$id','NO')";
                                        mysqli_query($conexion, $consulta3);
                                        $asistencia2 = "NO";
                                    }

                                    $botonAsistencia2 = "";
                                    $datosAsistencia2 = $correo.'||'.$id;

                                    $funcionAsistenciaTermi = "reunionTerminada()";
                                    $funcionAsistenciaNoIniciada = "reunionNoIniciada()";

                                    $funcionAsistencia2 = "modificarAsistenciaComite('".$datosAsistencia2."')";

                                    if($asistencia2 == "SI" && $estado !="Terminado" && $horaInicio!="" && $horaInicio!=" "){
                                        $botonAsistencia2 = '<a class="button save" onclick="'.$funcionAsistencia2.'"></a>';
                                    }
                                    else if($asistencia2 == "NO" && $estado !="Terminado" && $horaInicio!="" && $horaInicio!=" "){
                                        $botonAsistencia2 = '<a class="buttonRed delete" onclick="'.$funcionAsistencia2.'"></a>';

                                    }
                                    else if($estado == "Terminado"){
                                        if($asistencia2 == "SI"){
                                            $botonAsistencia2 = '<a class="button save" onclick="'.$funcionAsistenciaTermi.'"></a>';
                                        }
                                        else{
                                            $botonAsistencia2 = '<a class="buttonRed delete" onclick="'.$funcionAsistenciaTermi.'"></a>';
                                        }
                                        

                                    }
                                    else if($horaInicio == "" || $horaInicio == " "){
                                        if($asistencia2 == "SI"){
                                            $botonAsistencia2 = '<a class="button save" onclick="'.$funcionAsistenciaNoIniciada.'"></a>';
                                        }
                                        else{
                                            $botonAsistencia2 = '<a class="buttonRed delete" onclick="'.$funcionAsistenciaNoIniciada.'"></a>';
                                        }
                                        

                                    }


                                    echo '<tr>
                                            <td>'.$nombre.'</td>
                                            <td>'.$correo.'</td>
                                            <td>'.$botonAsistencia2.'</td>
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
            <center><h3 class="m-0 font-weight-bold text-primary"><i class="fas fa-smile-wink"></i> Invitados</h3></center>
        </div>
        <div class="bg-card-body">
            <div class="row">
                <?php
                    if($estado=="Terminado"){
                        echo'';


                    }
                    else{

                        echo '<a href="" class="button add" data-toggle="modal" data-target="#crearInvitado">Agregar Invitado</a>
                        ';


                    }
                ?> 
            </div>

            <br>

            <div class="row">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Correo</th>
                            
                            <th scope="col">Asistencia</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $consulta = "SELECT * FROM relacionreunioninvitado WHERE refid='$id'";
                                $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos1");
                                $contador = 0;
                                while ($columna = mysqli_fetch_array( $resultado )){
                                    $refCorreo = $columna['refcorreo'];
                                    $asistencia = $columna['asistencia'];
                                    $botonAsistencia = "";
                                    $datosAsistencia = $refCorreo.'||'.$id;

                                    $funcionAsistencia = "modificarAsistenciaInvitado('".$datosAsistencia."')";
                                    $funcionAsistenciaTermi = "reunionTerminada()";
                                    $funcionAsistenciaNoIniciada = "reunionNoIniciada()";

                                    if($asistencia == "SI" && $estado !="Terminado" && $horaInicio!="" && $horaInicio!=" "){
                                        $botonAsistencia = '<a class="button save" onclick="'.$funcionAsistencia.'"></a>';
                                    }
                                    else if($asistencia == "NO" && $estado !="Terminado" && $horaInicio!="" && $horaInicio!=" "){
                                        $botonAsistencia = '<a class="buttonRed delete" onclick="'.$funcionAsistencia.'"></a>';

                                    }
                                    else if($estado == "Terminado"){
                                        if($asistencia == "SI"){
                                            $botonAsistencia = '<a class="button save" onclick="'.$funcionAsistenciaTermi.'"></a>';
                                        }
                                        else{
                                            $botonAsistencia = '<a class="buttonRed delete" onclick="'.$funcionAsistenciaTermi.'"></a>';
                                        }
                                        

                                    }
                                    else if($horaInicio == "" || $horaInicio == " "){
                                        if($asistencia == "SI"){
                                            $botonAsistencia = '<a class="button save" onclick="'.$funcionAsistenciaNoIniciada.'"></a>';
                                        }
                                        else{
                                            $botonAsistencia = '<a class="buttonRed delete" onclick="'.$funcionAsistenciaNoIniciada.'"></a>';
                                        }
                                        

                                    }

                                    $consulta2 = "SELECT * FROM invitado WHERE correo='$refCorreo'";
                                    $resultado2 = mysqli_query($conexion, $consulta2) or die ( "Algo ha ido mal en la consulta a la base de datos1");
                                    while ($columna2 = mysqli_fetch_array( $resultado2 )){
                                        $datos = $columna2["correo"].'||'.$id;
                                        $usarFuncion = "preguntarSiNo('".$datos."')";
                                        echo '<tr>
                                            <td>'.$columna2['nombre'].'</td>
                                            <td>'.$columna2['correo'].'</td>


                                            <td>'.$botonAsistencia.'</td>

                                        </tr>';
                                        $contador = $contador + 1;
                                    }

                                    
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
            <center><h3 class="m-0 font-weight-bold text-primary"><i class="fas fa-book"></i> Resumen Reunión</h3></center>
        </div>
        <div class = "bg-card-body">
        <table class="table" id="tableMain">
                                    <thead>
                                        <tr class="tableheader">
                                          <th>Tema</th>
                                          <th></th>
                                          <th></th>
                                          <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
        <?php
                                $idReunion = $id;
                                $consulta = "SELECT * FROM tema WHERE refreunion='$idReunion'";
                                $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos1");
                                while ($columna = mysqli_fetch_array( $resultado )){
                                    $reftemas = $columna['id'];

                                    echo'
                                    
                                    <tr class="breakrow"><td>'.$columna['nombre'].'</td><td></td><td></td><td></td></tr>
                                    <tr class="datarow" data-class="hidden" style ="background-color: #148F77; color:white;"><td>Accion</td><td>Encargado</td><td>Estado</td><td>Fecha de Termino</td></tr>

                                  
                    
                                
                            ';
                                  
                                            $consulta2 = "SELECT * FROM accion WHERE reftema='$reftemas'";
                                            $resultado2 = mysqli_query($conexion, $consulta2) or die ( "Algo ha ido mal en la consulta a la base de datos1");
                                            while ($columna = mysqli_fetch_array( $resultado2 )){
                                                echo'
                                                <tr class="datarow"><td>'.$columna['nombre'].'</td><td>'.$columna['refinvitado'].'</td><td>'.$columna['estado'].'</td><td>'.$columna['fechatermino'].'</td></tr>
                  
                                
                                            
                                        ';
                                            }
                                        }

                                  
                            ?>
                                                                </tbody>

                            </table>

       




                            </div>          
    </div>

 


    <div class="bg-card">
        <div class="bg-card-head py-3">
            <center><h3 class="m-0 font-weight-bold text-primary"><i class="fas fa-book-reader"></i> Actas</h3></center>
        </div>
        <div class="bg-card-body">
         <div class="row row-cols-3">
                <div class="col">
                    <form method="post" action="generate_pdfcc.php">                                        
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
                <div class="col">
                <?php
                    if($estado == "Terminado"){

                    }
                    else{
                        echo '<center><button type="button" class="button-rojo" id="btnTerminarReunion">Terminar Reunión</button></center>';
                    }
                ?>                


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
                        <div <?php echo "hidden";?> class="form-group" >
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
                     <a class="buttonRed delete" data-dismiss="modal"> Cerrar </a>
                     <a class="button save" id="editarTemaModalEdicion"> Guardar </a>
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

    <!-- Administrar Acciones Modal-->
    <div class="modal fade" id="adminAccion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" style="overflow-y: scroll;">
        <div class="modal-dialog modal-xl">
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
                             <a  class="button add" data-toggle="modal" data-target="#modalAccion"> Agregar Acciones </a>
                        </div>
                    </div>
                    <h2></h2>
                    <div class="table-responsive">
                        <table class="table table-hover table-condensed table-bordered">
                            <thead>
                                <tr>
                                    <td>Nombre</td>
                                    <td>Encargado</td>
                                    <td>Fecha termino</td>
                                    <td>Editar</td>
                                    <td>Eliminar</td>
                                    <td>Editado por</td>
                                </tr>
                            </thead>
                            <tbody id="relleno">
                            </tbody>
                        </table>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <a class="button save" data-dismiss="modal"> Listo </a>

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
                                            <option value="">Seleccionar encargado</option>
                                            <?php
                                                echo '<option value="">-- Invitados --</option>';
                                                $consulta2 = "SELECT * FROM relacionreunioninvitado WHERE refid='$idReunion'";
                                                $resultado2 = mysqli_query($conexion, $consulta2) or die ( "Algo ha ido mal en la consulta a la base de datos1");
                                                while ($columna = mysqli_fetch_array($resultado2)){
                                                    $refCorreo = $columna['refcorreo'];
                                                    $nombre = $columna['nombre'];
                                                    echo '<option value="'.$refCorreo.'">'.$refCorreo .'</option>';
                                                }
                                                echo '<option value="">-- Miembros del consejo --</option>';
                                                $consulta3 = "SELECT * FROM consejo";
                                                $resultado3 = mysqli_query($conexion, $consulta3) or die ( "Algo ha ido mal en la consulta a la base de datos1");
                                                while ($columna = mysqli_fetch_array($resultado3)){
                                                    $refCorreo = $columna['correo'];
                                                    $nombre = $columna['nombre'];
                                                    echo '<option value="'.$refCorreo.'">'.$refCorreo .'</option>';
                                                }
                                            ?>
                                        </select>
                                        <br>
                                </div>
                            </div>
                            <div class="row">
                                    <div class="col">
                                        <label>Fecha Acción</label>
                                        <input type="date" class="form-control" id="fechaterminoAccion" requiered>
                                    </div>
                                </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    
                    <a class="buttonRed delete" data-dismiss="modal"> Cerrar </a>
                    <a class="button save" id="crearAccionBoton"> Guardar </a>

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
                        <div <?php //echo "hidden";?> class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="idAccionModalEdicion">Correo Session</label>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" id="correoSesionModalEdicion" value="<?php echo $correoSession;?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div <?php echo "hidden";?> class="form-group">
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
                                                echo '<option value="">-- Invitados --</option>';
                                                $consulta2 = "SELECT * FROM relacionreunioninvitado WHERE refid='$idReunion'";
                                                $resultado2 = mysqli_query($conexion, $consulta2) or die ( "Algo ha ido mal en la consulta a la base de datos1");
                                                while ($columna = mysqli_fetch_array($resultado2)){
                                                    $refCorreo = $columna['refcorreo'];
                                                    $nombre = $columna['nombre'];
                                                    echo '<option value="'.$refCorreo.'">'.$refCorreo .'</option>';
                                                }
                                                echo '<option value="">-- Miembros del consejo --</option>';
                                                $consulta3 = "SELECT * FROM consejo";
                                                $resultado3 = mysqli_query($conexion, $consulta3) or die ( "Algo ha ido mal en la consulta a la base de datos1");
                                                while ($columna = mysqli_fetch_array($resultado3)){
                                                    $refCorreo = $columna['correo'];
                                                    $nombre = $columna['nombre'];
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
                                    <select class="form-control" id="estadoAccionModalEdicion" required>
                                        <option value="">Seleccione estado</option>
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
                            <textarea class="form-control" id="comentarioAccionModalEdicion" cols="30" rows="10"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">

                    <a  class="buttonRed delete" data-dismiss="modal"> Cerrar </a>
                    <a class="button save" id="editarAccionModal"> Actualizar </a>
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
                        <div <?php echo "hidden";?> class="form-group">
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
                        
                            <input type="hidden" class="form-control" id="idTemaCrear" value="<?php echo $idTema;?>" readonly>
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



                    <a class="buttonRed delete" data-dismiss="modal"> Cerrar </a>

                    <a class="button save" id="crearTemaBoton"> Guardar </a>
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
                        <div <?php echo "hidden";?> class="form-group">
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
                    <a class="buttonRed delete" data-dismiss="modal"> Cerrar </a>

                    <a class="button save" id="crearInvitadoBoton"> Guardar </a>

                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


    <script>
        $( document ).ready(function() {


            //collapse and expand sections

            //$('.breakrow').click(function(){
			$('#tableMain').on('click', 'tr.breakrow',function(){
                $(this).nextUntil('tr.breakrow').slideToggle(200);
            });
        });
    </script>


<?php require_once "vistas/parteinferior.php"?>