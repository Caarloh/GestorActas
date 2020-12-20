<?php

    require 'conexion.php';
    $correoConsejo = $_POST['correo'];
    $estadoConsejo = $_POST['estado'];

    if($estadoConsejo == "SI"){
        $consulta = "DELETE FROM `admin` WHERE correo='$correoConsejo'";
        $result=mysqli_query($conexion,$consulta);
        echo $result;
    }
    else{
        $consulta = "INSERT INTO `admin`(correo) VALUES ('$correoConsejo')";
        $result=mysqli_query($conexion,$consulta);
        echo $result;
    }
  
?>