<?php

require_once "vendor/autoload.php";

$css = file_get_contents('css/plantillaActa.css');




function selectReunion(){
    $v1 = $_POST['variable1'];
    $conexion = mysqli_connect("localhost", "root", "", "gestoractas");
    $consulta = "SELECT * FROM reunion WHERE reunion.id='$v1'";
    $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos1");
    $tabla=""; 
    $temas="";  
    $consulta2 = "SELECT nombre FROM reunion, tema WHERE reunion.id='$v1' AND reunion.id=refreunion";
    $resultado2 = mysqli_query($conexion, $consulta2) or die ( "Algo ha ido mal en la consulta a la base de datos1");  
        while ($columna2 = mysqli_fetch_array( $resultado2 )){
            $temas.="            
            <h2>".$columna2['nombre']."</h2>
            ";                   
         }
   
                while ($columna = mysqli_fetch_array( $resultado )){
                $tabla.="
                <h1>Comité Curricular ICC </h1>
                <br>
                <h2>Reunión ".$columna['tipoPredefinido']."</h2>
                <h2>Fecha: ".$columna['fecha']."</h2>
                <h2>Hora de Inicio:        ".$columna['hora']."</h2>
                <h2>Duracion: ".$columna['duracion']." ".$columna['tipoDuracion']."</h2>
                <h2>Temas Tratados:</h2>
                <br>
            ".$temas;                   
        }
    
        
        return $tabla;
    }    

$html = selectReunion();
$mpdf = new \Mpdf\Mpdf([]);
$mpdf->WriteHTML($css,\Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html);
$mpdf->Output();
?>