<?php
    require 'conexion.php';
    
    $tituloModificado = $_POST['tituloModificado'];  
    $refReunion = $_POST['refReunion'];  

    $consulta = "UPDATE acta set titulo = '$tituloModificado' WHERE refreunion = '$refReunion'";
    echo $result=mysqli_query($conexion,$consulta);
  
  
?>