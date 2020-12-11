<?php

    require 'conexion.php';
    $idAccion = $_POST['idAccion'];
    $seguir = false;
    
    $consulta = "SELECT * FROM accion WHERE id='$idAccion'";
    $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos1");
    while ($columna = mysqli_fetch_array( $resultado )){
        $seguir=true;
        
    }
    
    if ($seguir) {
        $consulta = "DELETE FROM accion WHERE id='$idAccion'";
        echo $result=mysqli_query($conexion,$consulta);
    }
    else{
        echo 6;
    }
  
  
?>