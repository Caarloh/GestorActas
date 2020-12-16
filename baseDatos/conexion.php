<?php
  $user = 'root';
  $password = '';
  $basededatos = 'gestoractas';
  $host = 'localhost';


  $conexion = mysqli_connect($host, $user, $password) or die ("No se ha podido conectar al servidor de Base de datos");
  $db = mysqli_select_db($conexion, $basededatos) or die ( "Upps! Pues va a ser que no se ha podido conectar a la base de datos" );
  if (!$db) {
    die('Error de conexion ' . mysql_error());
  }
?>