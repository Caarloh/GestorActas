<?php
    require 'conexion.php';
    
    $correo = $_POST['correo'];  

    $consulta = "DELETE FROM invitado WHERE correo = '$correo'";
    echo $result=mysqli_query($conexion,$consulta);
  
  
?>