<?php

    require 'conexion.php';
    $existe = false;

    $idReunion = $_POST['idReunion'];
    $hora= $_POST['horaReunion'];
    $minuto= $_POST['minutoReunion'];
    
    $consulta = "SELECT * FROM reunion WHERE id = '$idReunion'";
    $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos1");
    while ($columna = mysqli_fetch_array( $resultado )){
        $existe=true;
        
    }
    
    if ($existe) {
        $horaFinal = $hora.":".$minuto;
        $consulta = "UPDATE reunion SET horaInicio='$horaFinal', estado='En Proceso' WHERE id='$idReunion'";
        echo $result=mysqli_query($conexion,$consulta);
    }
    else{
        echo 6;
    }
  
  
?>