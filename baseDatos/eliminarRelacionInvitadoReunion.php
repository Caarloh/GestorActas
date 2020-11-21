<?php

    require 'conexion.php';
    $idReunion = $_POST['idReunion'];
    $correo = $_POST['correo'];
    $seguir = false;
    
    $consulta = "SELECT * FROM relacionreunioninvitado WHERE refcorreo='$correo' AND refid='$idReunion'";
    $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos1");
    while ($columna = mysqli_fetch_array( $resultado )){
        $seguir=true;
        
    }
    
    if ($seguir) {
        $consulta = "DELETE FROM relacionreunioninvitado WHERE refcorreo='$correo' AND refid='$idReunion'";
        echo $result=mysqli_query($conexion,$consulta);
    }
    else{
        echo 6;
    }
  
  
?>