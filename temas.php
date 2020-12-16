<?php  require "baseDatos/conexion.php";?>
<?php require_once "vistas/partesuperior.php"?>
    <div class="bg-card">
        <div class="bg-card-head py-3">
            <center><h3 class="m-0 font-weight-bold text-primary"><i class="fas fa-book"></i> Temas</h3></center>
    </div>
    </div>



    <div class="bg-card">
    <div class="bg-card-body">

    <div class="table-responsive">
                    <table class="table" id="tablaTema">
                        <thead>
                            <tr>
                            <th scope="col">Nombre Tema</th>
                            <th scope="col">Tag</th>
                            <th scope="col">Reunion</th>
                            </tr>
                        </thead>
                        <tbody>
                                    <?php
                                        $consulta = "SELECT * FROM reunion";
                                        $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos1");
                                        while ($columna = mysqli_fetch_array( $resultado )){
                                            $idReunion = $columna['id'];
                                            $nameReunion = $columna['nombre'];
                                            $consulta2 = "SELECT * FROM tema WHERE refreunion='$idReunion'";
                                            $resultado2 = mysqli_query($conexion, $consulta2) or die ( "Algo ha ido mal en la consulta a la base de datos1");
                                            while ($columna = mysqli_fetch_array( $resultado2 )){
                                                $name = $columna['nombre'];
                                                echo '<tr>
                                                <td>'.$columna['nombre'].'</td> 
                                                <td>'.$columna['tag'].'</td>
                                                <td>'.$nameReunion.'</td>

                                                </tr>';

                                            }







                                        }
                                            ?>

                        </tbody>
                    </table>
                </div>
                </div>




    </div>