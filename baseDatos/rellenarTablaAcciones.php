<?php 
    require 'conexion.php';

    $idTema = $_POST['idTema'];
    $consulta = "SELECT * FROM accion WHERE reftema='$idTema'";
    $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos1");
    while ($columna = mysqli_fetch_array( $resultado )){
        $datosEditar=$columna["id"].'||'.$columna["nombre"].'||'.$columna["refinvitado"];
        $datosEliminar=$columna["id"];
        
        $usarFuncionEliminar="preguntarSiNo3('".$datosEliminar."')";
        $usarFuncionEditar="formEditarAccion('".$datosEditar."')";

        echo '<tr>
            <td>'.$columna['id'].'</td>
            <td>'.$columna['nombre'].'</td>
            <td>'.$columna['refinvitado'].'</td>
            <td>'.$columna['fechatermino'].'</td>
            <td><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editarAccion" onclick="'.$usarFuncionEditar.'">Editar</button></td>
            <td><button type="button" class="btn btn-danger" onclick="'.$usarFuncionEliminar.'">Eliminar</button></td>
        </tr>';
    }
    //btn btn-danger
 ?>