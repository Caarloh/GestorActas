<?php

    require 'conexion.php';
    $correoInvitado = $_POST['correo'];
    $idReunion = $_POST['idReunion'];
    $seguir = false;
    $asistencia = "";
    
    $consulta = "SELECT * FROM asistenciacomite WHERE refcorreo='$correoInvitado' AND refid='$idReunion'";
    $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos1");
    while ($columna = mysqli_fetch_array( $resultado )){
        $seguir=true;
        $asistencia = $columna['asistencia'];
    }
    
    if ($seguir) {
        if($asistencia == "NO"){
            $consulta = "UPDATE asistenciacomite SET asistencia='SI' WHERE refcorreo='$correoInvitado' AND refid='$idReunion'";
            echo $result=mysqli_query($conexion,$consulta);
        }
        else if($asistencia == "SI"){
            $consulta = "UPDATE asistenciacomite SET asistencia='NO' WHERE refcorreo='$correoInvitado' AND refid='$idReunion'";
            echo $result=mysqli_query($conexion,$consulta);
        }
        else{
            echo 0;
        }
        
    }
    else{
        echo 6;
    }
  
  
?>