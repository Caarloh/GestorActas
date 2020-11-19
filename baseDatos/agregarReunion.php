<?php

    require 'conexion.php';
    
    $idReunion = $_POST['idReunion'];
    $tipoReunion = $_POST['tipoReunion'];
    $fechaReunion = $_POST['fechaReunion'];
    $hora = $_POST['hora'];
    $minuto = $_POST['minuto'];
    $duracionReunion = $_POST['duracionReunion'];
    $tipoDuracion = $_POST['tipoDuracion'];
    $linkReunion = $_POST['linkReunion'];
    $seguir = true;
    
    $consulta = "SELECT * FROM reunion WHERE id='$idReunion'";
    $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos1");
    while ($columna = mysqli_fetch_array( $resultado )){
        $seguir=false;
        echo $result=6;
    }
    
    if ($seguir) {
        $horaFinal = $hora.':'.$minuto;
        $consulta = "INSERT INTO reunion(id, tipoPredefinido, fecha, hora, duracion, tipoDuracion, linkReunion) VALUES ('$idReunion', '$tipoReunion','$fechaReunion','$horaFinal','$duracionReunion', '$tipoDuracion', '$linkReunion')";
        echo $result=mysqli_query($conexion,$consulta);
    }
  
  
?>