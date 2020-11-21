<?php

    require 'conexion.php';
    
    $idReunion = $_POST['idReunion'];
    $nombre = $_POST['nombre'];
    $crearTema = true;

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

    $consulta = "SELECT * FROM tema WHERE nombre='$nombre' AND refreunion='$idReunion'";
    $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos1");
    while ($columna = mysqli_fetch_array( $resultado )){
        $crearTema=false;
        
    }

    if($crearTema){
        $consulta = "INSERT INTO tema (tag, refreunion, nombre, id) VALUES ('','$idReunion','$nombre','$idTema')";
        echo $result=mysqli_query($conexion,$consulta);

    }
    else{
        echo 6;
    }


  
  
?>