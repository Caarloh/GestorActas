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
        //Send Mail
        
        include '../envio_de_correos/superiorenviarcorreo.php';
        //Destinatario
        $mail->addAddress($correo, $nombre);     

        //Contenido del correo
        $mail->isHTML(true);

        $topico = "Invitacion a reunion $idReunion";                                  
        $mail->Subject = $topico;
        
        $consulta ="SELECT * FROM reunion WHERE id='$idReunion'";
        $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos1");
        $columna = mysqli_fetch_array( $resultado );
        
        $linkreunion = $columna['linkReunion'];
        $fecha = $columna['fecha'];
        $hora = $columna['hora'];
        
        $cuerpo = "Has sido invitad@ a la reunion con fecha $fecha, a las $hora";

        if (empty($linkreunion)){
            
        }else{
            $cuerpo = "$cuerpo \n enlace de reunion : $linkreunion";
        }
        $mail->Body    = $cuerpo;
        
        include '../envio_de_correos/inferiorenviarcorreo.php';
    }
    else{
        echo 6;
    }


  
  
?>