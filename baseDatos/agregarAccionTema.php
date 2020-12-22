<?php

    require 'conexion.php';
    

    $encargadoAccionModal = $_POST['encargadoAccionModal'];
    $nombre = $_POST['nombre'];
    $idTema = $_POST['idTema'];
    $idReunion = $_POST['idReunion'];
    $refInvitado = $_POST['encargadoAccionModal'];
    $fecha = $_POST['fecha'];
    $idAccion = 0;
    $existe = false;

    //if(empty($seleccionencargado)){
        //$consulta = "INSERT INTO invitado(correo, nombre) VALUES ('$correoInvitadoAccion','$nombreInvitadoAccion')";
        //echo $result=mysqli_query($conexion,$consulta);
        //$consulta = "INSERT INTO relacionreunioninvitado(refcorreo, refid) VALUES ('$correoInvitadoAccion','$idReunion')";
        //echo $result=mysqli_query($conexion,$consulta);
    //}

    do{
        $idAccion = rand();
        $consulta = "SELECT * FROM accion WHERE id='$idAccion'";
        $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos1");
        while ($columna = mysqli_fetch_array( $resultado )){
            $existe=true;
        }
    }while($idAccion==0 || $existe);

    $crearAccion = true;
    
    $consulta = "SELECT * FROM accion WHERE nombre='$nombre' AND reftema='$idTema'";
    $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos2");
    while ($columna = mysqli_fetch_array( $resultado )){
        $crearAccion=false;   
    }

    if($crearAccion){
        $consulta1 = "INSERT INTO accion (nombre, refreunion, reftema, refinvitado, fechatermino, estado, id, refeditor, comentario) VALUES ('$nombre','$idReunion','$idTema','$encargadoAccionModal', '$fecha','Pendiente','$idAccion', '', '')";
        echo $resultado = mysqli_query($conexion,$consulta1) or die ( "'$nombre','$idReunion','$idTema','$refInvitado', '$fecha','Pendiente','$idAccion', ''");
    }
    else{
        echo 6;
    }
  
?>