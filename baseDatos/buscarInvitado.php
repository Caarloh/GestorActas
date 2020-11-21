<?php
  require 'conexion.php';
  
  $correo = $_GET['term'];
  $consulta = "SELECT correo FROM invitado WHERE correo LIKE '%$correo%'";
  $result = $conexion->query($consulta);
  if($result->num_rows > 0){
    while($fila = $result->fetch_array()){
      $matriculas[] = $fila['correo'];
    }
    echo json_encode($matriculas);
  }

?>