<?php
    require 'conexion.php';
    
    $tituloActa = $_POST['tituloActa'];  

    $consulta = "DELETE FROM acta WHERE titulo = '$tituloActa'";
    echo $result=mysqli_query($conexion,$consulta);
  
  
?>