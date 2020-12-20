<?php

    require 'conexion.php';
    $idAccion = $_POST['idAccionModalEdicion'];
    $nombreAccion = $_POST['nombreAccionModalEdicion'];
    $encargadoAccionModal= $_POST['encargadoAccionModalEdicion'];        
    $fechaAccionModal= $_POST['fechanuevaterminoAccion'];
    $estadoAccionModal= $_POST['estadoAccionModalEdicion'];
    $seguir = false;
    
    $consulta = "SELECT * FROM accion WHERE id='$idAccion'";
    $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos1");
    while ($columna = mysqli_fetch_array( $resultado )){
        $seguir=true;
    }
    
    if ($seguir) {
        if($nombreAccion != ""){
            $consulta = "UPDATE accion SET nombre='$nombreAccion' WHERE id='$idAccion'";
            $result=mysqli_query($conexion,$consulta);
        }
        if($encargadoAccionModal != ""){
            $consulta = "UPDATE accion SET refinvitado='$encargadoAccionModal' WHERE id='$idAccion'";
            $result=mysqli_query($conexion,$consulta);
        }
        if($fechaAccionModal != ""){
            $consulta = "UPDATE accion SET fechatermino='$fechaAccionModal' WHERE id='$idAccion'";
            $result=mysqli_query($conexion,$consulta);
        }
        if($estadoAccionModal != ""){
            $consulta = "UPDATE accion SET estado='$estadoAccionModal' WHERE id='$idAccion'";
            $result=mysqli_query($conexion,$consulta);
        }
        echo $result;
    }
    else{
        echo 6;
    }
  
  
?>