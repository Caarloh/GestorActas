<?php
  require "conexion.php";

  $matricula = $_POST['rutEmpresa'];
  $consulta = "SELECT * FROM invitado WHERE correo = '$matricula'";
  $result = $conexion->query($consulta);

  $respuesta = new stdClass();
  if($result->num_rows > 0){
      $fila = $result->fetch_array();
      $respuesta->nombreEmpresa = $fila['nombre'];

  }
  echo json_encode($respuesta);

?>