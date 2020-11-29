<?php

require_once "vendor/autoload.php";






function selectReunion(){
    $v1 = $_POST['variable1'];
    $conexion = mysqli_connect("localhost", "root", "", "gestoractas");
    $consulta = "SELECT * FROM reunion WHERE id='$v1'";
    $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos1");
    $tabla="";
   
                while ($columna = mysqli_fetch_array( $resultado )){
                $tabla.="
                        <h1> Comite ICC <h1>
                        <a>".$columna['id']."</a>
                        <a>".$columna['tipoPredefinido']."</a>
                        <a>".$columna['fecha']."</a>
                        <a>".$columna['hora']."</a>
                        <a>".$columna['duracion']."</a>
                        <a>".$columna['tipoDuracion']."</a>
                        <a>".$columna['linkReunion']."</a>
                    ";
                   
        } 
        return $tabla;
    }    

$html = selectReunion();
$mpdf = new \Mpdf\Mpdf([]);
$mpdf->WriteHTML($html);
$mpdf->Output();
?>