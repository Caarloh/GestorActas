<?php

    require 'conexion.php';


    $correoUsuarioComite = $_POST['correoUsuarioComite'];
    $nombreUsuarioComite = $_POST['nombreUsuarioComite'];
    $apellidosUsuarioComite = $_POST['apellidosUsuarioComite'];
    $contrasenaUsuarioComite = $_POST['contrasenaUsuarioComite'];


    $seguir = true;
    
    $consulta = "SELECT * FROM consejo WHERE correo='$correoUsuarioComite'";
    $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos1");
    while ($columna = mysqli_fetch_array( $resultado )){
        $seguir=false;
    }
    
    if ($seguir) {
        $consulta = "INSERT INTO consejo(correo, nombre, apellidos, contrasena) VALUES ('$correoUsuarioComite','$nombreUsuarioComite','$apellidosUsuarioComite','$contrasenaUsuarioComite')";
        echo $result=mysqli_query($conexion,$consulta);
    }
    else{
        echo $result=6;
    }
  
  
?>