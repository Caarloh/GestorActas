<?php  
    require 'conexion.php';

    $idReunion = $_POST['idReunion'];
    $estadoReunion = "Terminado";
    $existeReunion = "";
    $horaInicio = "";

    

    $nombreReunion = "";
    $fechaReunion = "";
    date_default_timezone_set("America/Santiago");
    $hora = date("G:i");



    $consulta = "SELECT * FROM reunion WHERE id = '$idReunion'";
    $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos1");
    while ($columna = mysqli_fetch_array( $resultado )){
        $existe=true;
        $nombreReunion = $columna["nombre"];
        $fechaReunion = $columna["fecha"];
        $horaInicio = $columna["horaInicio"];
        
    }

    
    if ($existe) {
        if($horaInicio == "" || $horaInicio==" "){
            echo 3;
        }
        else{
            $consulta = "UPDATE reunion SET horaTermino='$hora', estado='$estadoReunion' WHERE id='$idReunion'";
            $result=mysqli_query($conexion,$consulta);

            

            $consulta2 = "SELECT * FROM relacionreunioninvitado WHERE refid = '$idReunion'";
            $resultado2 = mysqli_query($conexion, $consulta2) or die ( "Algo ha ido mal en la consulta a la base de datos1");
            while ($columna2 = mysqli_fetch_array( $resultado2 )){
                $correoDestinatario = $columna2['refcorreo'];
                $nombreDestinatario = "";

                $consulta3 = "SELECT * FROM invitado WHERE correo = '$correoDestinatario'";
                $resultado3 = mysqli_query($conexion, $consulta3) or die ( "Algo ha ido mal en la consulta a la base de datos1");
                while ($columna3 = mysqli_fetch_array( $resultado3 )){
                    $nombreDestinatario = $columna3['nombre'];
                }

                //Enviar Correo al consejo e invitados
                
            }
            echo $result;
            
        }
        
        
    }
    else{
        echo 6;
    }



?>