<?php

    require 'conexion.php';
    $idReunion = $_POST['idReunion'];
    $nombreTema = $_POST['nombre'];
    $seguir = false;
    
    $consulta = "SELECT * FROM tema WHERE nombre='$nombreTema' AND refreunion='$idReunion'";
    $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos1");
    while ($columna = mysqli_fetch_array( $resultado )){
        $seguir=true;
        
    }
    
    if ($seguir) {
        $consulta = "DELETE FROM tema WHERE nombre='$nombreTema' AND refreunion='$idReunion'";
        echo $result=mysqli_query($conexion,$consulta);
    }
    else{
        echo 6;
    }
  
  
?>