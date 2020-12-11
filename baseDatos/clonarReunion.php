
<?php
require 'conexion.php';
    $id=$_POST['idReunionCalendar'];


    $seguir = true;
    
    $consulta = "SELECT * FROM reunion WHERE id='$id'";
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



        $idReunion=$nuevaId;
        
        $fechaReunion= date("Y-m-d");
        $horaFinal= date("H:i");
        $tipoReunion=$columna['tipoPredefinido'];
        $duracionReunion=$columna['duracion'];
        $tipoDuracion=$columna['tipoDuracion'];
        $linkReunion=$columna['linkReunion'];
        $estadoReunion=$columna['estado'];
        $nombreReunion=$columna['nombre'];
        

        $consulta = "INSERT INTO reunion(id, tipoPredefinido, fecha, hora, duracion, tipoDuracion, linkReunion, estado, nombre) VALUES ('$idReunion', '$tipoReunion','$fechaReunion','$horaFinal','$duracionReunion', '$tipoDuracion', '$linkReunion', '$estadoReunion', '$nombreReunion')";
        echo $result=mysqli_query($conexion,$consulta);

        header('Location: ../index.php');
?>



