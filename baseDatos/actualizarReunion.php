<?php

    require 'conexion.php';
    $existe = false;

    $idReunion = $_POST['idReunion'];
    $tipoReunion = $_POST['tipoReunion'];
    $fechaReunion = $_POST['fechaReunion'];
    $hora = $_POST['hora'];
    $minuto = $_POST['minuto'];
    $duracionReunion = $_POST['duracionReunion'];
    $tipoDuracion = $_POST['tipoDuracion'];
    $linkReunion = $_POST['linkReunion'];
    $nombreReunion = $_POST['nombreReunion'];
    
    $consulta = "SELECT * FROM reunion WHERE id = '$idReunion'";
    $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos1");
    while ($columna = mysqli_fetch_array( $resultado )){
        $existe=true;
        
    }
    
    if ($existe) {
        $horaFinal = $hora.":".$minuto;
        $consulta = "UPDATE reunion SET tipoPredefinido='$tipoReunion', fecha='$fechaReunion', hora='$horaFinal', duracion='$duracionReunion', tipoDuracion='$tipoDuracion', linkReunion='$linkReunion', nombre='$nombreReunion' WHERE id='$idReunion'";
        echo $result=mysqli_query($conexion,$consulta);
    }
    else{
        echo 6;
    }
  
  
?>