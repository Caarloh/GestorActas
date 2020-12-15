<?php  require "baseDatos/conexion.php";?>
<?php require_once "vistas/partesuperior.php"?>
<?php
$consulta = "SELECT nombre,refreunion,reftema,refinvitado,fechatermino,estado FROM accion";
$resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos1");
$columna=$resultado->fetch_all(MYSQLI_ASSOC)
?>


<div class="bg-card">
    <div class="bg-card-head py-3">
        <center>
            <h3 class="m-0 font-weight-bold text-primary"><i class="fas fa-address-book"></i> Acciones</h3>
        </center>
    </div>
    <div style="margin-left: 2em; margin-right: 2em;">
        <table id="example" class="display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Reunion</th>
                    <th>Tema</th>
                    <th>Encargado</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                </tr>
            </thead>

            <tfoot>
                <tr>
                    <th>Nombre</th>
                    <th>Reunion</th>
                    <th>Tema</th>
                    <th>Encargado</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                </tr>
            </tfoot>

            <tbody>
                <?php                            
                foreach($columna as $columna) {                                                        
                            ?>
                <tr>
                    <td><?php echo $columna['nombre'] ?></td>
                    <td><?php echo $columna['refreunion'] ?></td>
                    <td><?php echo $columna['reftema'] ?></td>
                    <td><?php echo $columna['refinvitado'] ?></td>
                    <td><?php echo $columna['fechatermino'] ?></td>
                    <td><?php echo $columna['estado'] ?></td>

                </tr>
                <?php
                                }
                            ?>
            </tbody>
        </table>
    </div>
    <br>

</div>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="js/acciones.js"></script>