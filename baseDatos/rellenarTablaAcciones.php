<?php 
    require 'conexion.php';

    $idTema = $_POST['idTema'];
    $consulta = "SELECT * FROM accion WHERE reftema='$idTema'";
    $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos1");
    while ($columna = mysqli_fetch_array( $resultado )){
        echo '<tr>
            <td>'.$columna['id'].'</td>
            <td>'.$columna['nombre'].'</td>
            <td>'.$columna['refinvitado'].'</td>
            <td>'.$columna['fechatermino'].'</td>
            <td><button type="button" class="btn btn-warning">Editar</button></td>
            <td><button type="button" class="btn btn-danger">Eliminar</button></td>
        </tr>';
    }
 ?>