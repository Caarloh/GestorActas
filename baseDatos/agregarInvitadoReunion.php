<?php

    require 'conexion.php';
    
    $idReunion = $_POST['idReunion'];
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $crear = true;
    
    $consulta = "SELECT * FROM invitado WHERE correo='$correo'";
    $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos1");
    while ($columna = mysqli_fetch_array( $resultado )){
        $crear=false;
        $nombre = $columna['nombre'];
    }
    
    if ($crear) {
        $consulta = "INSERT INTO invitado (correo, nombre) VALUES ('$correo', '$nombre')";
        mysqli_query($conexion,$consulta);
    }

    $copiarInvitado = true;
    $consulta = "SELECT * FROM relacionreunioninvitado WHERE refcorreo='$correo' AND refid='$idReunion'";
    $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos1");
    while ($columna = mysqli_fetch_array( $resultado )){
        $copiarInvitado=false;
        
    }

    if($copiarInvitado){
        $consulta = "INSERT INTO relacionreunioninvitado (refcorreo, refid) VALUES ('$correo', '$idReunion')";
        echo $result=mysqli_query($conexion,$consulta);

    }
    else{
        echo 6;
    }


  
  
?>