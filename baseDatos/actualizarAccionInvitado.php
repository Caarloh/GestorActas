<?php

    require 'conexion.php';
    $idAccion = $_POST['idAccion'];
    $nombreAccion = $_POST['nombreAccion'];
    $estadoAccion = $_POST['estadoAccion'];
    $seguir = false;
    
    $consulta = "SELECT * FROM accion WHERE nombre='$nombreAccion' AND id = '$idAccion'";
    $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos1");
    while ($columna = mysqli_fetch_array( $resultado )){
        $seguir=true;
        
    }
    
    if ($seguir) {
        $consulta = "UPDATE accion SET estado='$estadoAccion' WHERE id='$idAccion'";
        echo $result=mysqli_query($conexion,$consulta);
    }
    else{
        echo 6;
    }
  
  
?>