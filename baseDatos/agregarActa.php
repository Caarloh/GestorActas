<?php
    require 'conexion.php';
    
    $idReunion = $_POST['idReunion'];
    $titulo = $_POST['titulo'];  

    $consulta = "INSERT INTO acta(titulo, refreunion) VALUES ('$titulo', '$idReunion')";
    echo $result=mysqli_query($conexion,$consulta);
  
  
?>