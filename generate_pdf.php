<?php

require_once "vendor/autoload.php";






function selectReunion(){
    $v1 = $_POST['variable1'];
    $conexion = mysqli_connect("localhost", "root", "", "gestoractas");
    $consulta = "SELECT * FROM reunion,tema WHERE reunion.id='$v1' and tema.refreunion='$v1";
    $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos1");
    $tabla="";
    $tabla.="<table>
                <tr>
                    <th>id</th>
                    <th>tipo</th>
                    <th>fecha</th>
                    <th>hora</th>
                    <th>duracion</th>
                    <th>tipoduracion</th>
                    <th>link</th>
                </tr>
                ";
                while ($columna = mysqli_fetch_array( $resultado )){
                $tabla.="<tr>
                        <th>".$columna['reuinion.id']."</th>
                        <th>".$columna['tipoPredefinido']."</th>
                        <th>".$columna['fecha']."</th>
                        <th>".$columna['hora']."</th>
                        <th>".$columna['duracion']."</th>
                        <th>".$columna['tipoDuracion']."</th>
                        <th>".$columna['linkReunion']."</th>
                    </tr>";
                   
        }
        $tabla.="</table>"  ;  
        return $tabla;
    }    

$html = selectReunion();
$mpdf = new \Mpdf\Mpdf([]);
$mpdf->WriteHTML($html);
$mpdf->Output();
?>