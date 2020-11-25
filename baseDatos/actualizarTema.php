<?php

    require 'conexion.php';
    $idTema = $_POST['idTemaModalEdicion'];
    $nombreTema = $_POST['nombreTemaModalEdicion'];
    $seguir = false;
    
    $consulta = "SELECT * FROM tema WHERE nombre='$nombreTema' AND id = '$idTema'";
    $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos1");
    while ($columna = mysqli_fetch_array( $resultado )){
        $seguir=true;
        
    }
    
    if (!$seguir) {
        $consulta = "UPDATE tema SET tag='Editado', nombre='$nombreTema' WHERE id='$idTema'";
        echo $result=mysqli_query($conexion,$consulta);
    }
    else{
        echo 6;
    }
  
  
?>