
<?php
require 'conexion.php';
    $id=$_POST['idReunionCalendar'];


    $seguir = true;
    
    $consulta = "SELECT * FROM reunion WHERE id='$id'";

    $consulta3 = "SELECT * FROM acta WHERE refreunion='$id'";
    $consulta4 = "SELECT * FROM accion WHERE refreunion='$id'";
    $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos1");

    date_default_timezone_set('America/Santiago');

        $columna = mysqli_fetch_array( $resultado); 
        $nuevaId = 0;
        $existe = false;       
        do{
            $nuevaId = rand();
            $consultaNuevaId = "SELECT * FROM reunion WHERE id='$nuevaId'";
            $resultadoNuevaId = mysqli_query($conexion, $consultaNuevaId) or die ( "Algo ha ido mal en la consulta a la base de datos1");
            while ($columnaNuevaId = mysqli_fetch_array( $resultadoNuevaId )){
                $existe=true;
            }
        }while($nuevaId==0 || $existe);

    

        
        /*Clonar reunión*/ 
        $fechaReunion= date("Y-m-d");
        $horaFinal= date("H:i");
        $tipoReunion=$columna['tipoPredefinido'];
        $duracionReunion=$columna['duracion'];
        $tipoDuracion=$columna['tipoDuracion'];
        $linkReunion=$columna['linkReunion'];
        $estadoReunion=$columna['estado'];
        $nombreReunion=$columna['nombre'];
        $nombreReunion=$nombreReunion;

        $existe = false;  
        $i=0;     
        $nombreoriginal=$nombreReunion;
        $nuevoNombre="";
        do{
            $i=$i+1;
            $nuevoNombre=$nombreReunion." ($i)";
            $consultaNuevonombre = "SELECT * FROM reunion WHERE nombre='$nuevoNombre'";
            $resultadoNuevonombre= mysqli_query($conexion, $consultaNuevonombre) or die ( "Algo ha ido mal en la consulta a la base de datos1");
            while ($columnaNuevonombre = mysqli_fetch_array( $resultadoNuevonombre )){
                $existe=true;
            }
        }while($nuevoNombre==$nombreReunion || $existe);

            


        $consulta = "INSERT INTO reunion(id, tipoPredefinido, fecha, hora, duracion, tipoDuracion, linkReunion, estado, nombre) VALUES ('$nuevaId', '$tipoReunion','$fechaReunion','$horaFinal','$duracionReunion', '$tipoDuracion', '$linkReunion', '$estadoReunion', '$nuevoNombre')";
        echo $result=mysqli_query($conexion,$consulta);





        /*Clonar temas reunión */
        $nuevaIdtema = 0;
        $idTema=0;
        $consultatemas = "SELECT * FROM tema WHERE refreunion='$id'";
        $resultadoTema = mysqli_query($conexion, $consultatemas) or die ( "Algo ha ido mal en la consulta a la base de reunion");
        while ($columnatemas = mysqli_fetch_array( $resultadoTema )){
            $tag = $columnatemas['tag'];
            $nombreTema = $columnatemas['nombre'];
            $idTema=$columnatemas['id'];
            $nuevaIdtema = 0;
            $existe = false;       
            do{
                $nuevaIdtema = rand();
                $consultaNuevaIdtema = "SELECT * FROM tema WHERE id='$nuevaIdtema'";
                $resultadoNuevaIdtema = mysqli_query($conexion, $consultaNuevaIdtema) or die ( "Algo ha ido mal en la consulta a la base de tema");
                while ($columnaNuevaId = mysqli_fetch_array( $resultadoNuevaIdtema )){
                    $existe=true;
                }
            }while($nuevaIdtema==0 || $existe);
    

            $consulta = "INSERT INTO tema(tag, refreunion, nombre, id) VALUES ('$tag', '$nuevaId','$nombreTema','$nuevaIdtema')";
            echo $result=mysqli_query($conexion,$consulta);
            $consultaacciones = "SELECT * FROM accion WHERE (refreunion='$id') and (reftema='$idTema')";
            $resultadoAcciones = mysqli_query($conexion, $consultaacciones) or die ( "Algo ha ido mal en la consulta a la base de accion");
            while ($columnaacciones = mysqli_fetch_array( $resultadoAcciones )){
    
                $nombreAccion = $columnaacciones['nombre'];
                $refinvitadoAccion = $columnaacciones['refinvitado'];
                $fechaterminoAccion = $columnaacciones['fechatermino'];
                $estadoAccion = $columnaacciones['estado'];
    
                $nuevaIdAccion = 0;
                $existe = false;       
                do{
                    $nuevaIdAccion = rand();
                    $consultaNuevaIdAccion = "SELECT * FROM accion WHERE id='$nuevaIdAccion'";
                    $resultadoNuevaIdaccion = mysqli_query($conexion, $consultaNuevaIdAccion) or die ( "Algo ha ido mal en la consulta a la base de nuevaaccion");
                    while ($columnaNuevaIdaccion = mysqli_fetch_array( $resultadoNuevaIdaccion )){
                        $existe=true;
                    }
                }while($nuevaIdAccion==0 || $existe);
        
    
    
    
    
    
                $consulta = "INSERT INTO accion(nombre,refreunion,reftema,refinvitado,fechatermino,estado,id) VALUES ('$nombreAccion', '$nuevaId','$nuevaIdtema','$refinvitadoAccion','$fechaterminoAccion','$estadoAccion','$nuevaIdAccion')";
                echo $result=mysqli_query($conexion,$consulta);
        
            }







        
            }
            $consultainvitados = "SELECT * FROM relacionreunioninvitado WHERE refid='$id'";
        $resultadoinvitados = mysqli_query($conexion, $consultainvitados) or die ( "Algo ha ido mal en la consulta a la base de actas");
        while ($columnainvitados = mysqli_fetch_array( $resultadoinvitados )){
            $correo = $columnainvitados['refcorreo'];


            $consulta = "INSERT INTO relacionreunioninvitado(refcorreo,refid) VALUES ('$correo', '$nuevaId')";
            echo $result=mysqli_query($conexion,$consulta);

        }
        


        /*Clonar actas reunion */
       /* $resultadoActa = mysqli_query($conexion, $consulta3) or die ( "Algo ha ido mal en la consulta a la base de actas");
        while ($columnaactas = mysqli_fetch_array( $resultadoActa )){
            $titulo = $columnaactas['titulo'];
            $consulta = "INSERT INTO acta(titulo, refreunion) VALUES ('$titulo', '$nuevaId')";
            echo $result=mysqli_query($conexion,$consulta);
    

        }*/
        /*Clonar acciones reunión */




        header('Location: ../index.php');
?>



