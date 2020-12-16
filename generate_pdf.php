<?php

require_once "vendor/autoload.php";

$css = file_get_contents('css/plantillaActa.css');




function selectReunion(){
    $v1 = $_POST['variable1'];
    $conexion = mysqli_connect("localhost", "root", "", "gestoractas");
    $consulta = "SELECT * FROM reunion, tema WHERE reunion.id='$v1'  AND reunion.id=refreunion";
    $resultado = mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos1");
    $tabla="";
   
                while ($columna = mysqli_fetch_array( $resultado )){
                $tabla="
                
                <body style='background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;'>
                    <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                    <!-- LOGO -->
                    <tr>
                        <td bgcolor='#B916CD' align='center'>
                            
                            <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;' >
                                <tr>
                                    <td align='center' valign='top' style='padding: 40px 10px 40px 10px;'>
                                         
                                    </td>
                                </tr>
                            </table>
                            
                        </td>
                    </tr>
                    <!-- HERO -->
                    <tr>
                        <td bgcolor='#B916CD' align='center' style='padding: 0px 10px 0px 10px;'>
                            
                            <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;' >
                                <tr>
                                    <td bgcolor='#ffffff' align='center' valign='top' style='padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;'>
                                    <h1 style='font-size: 48px; font-weight: 400; margin: 0;'>Resumen!</h1>
                                    </td>
                                </tr>
                            </table>
                            
                        </td>
                    </tr>
                    <!-- COPY BLOCK -->
                    <tr>
                        <td bgcolor='#f4f4f4' align='center' style='padding: 0px 10px 0px 10px;'>
                            
                            <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;' >
                            <!-- COPY -->
                            <tr>
                                <td bgcolor='#ffffff' align='left' style='padding: 20px 30px 40px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;' >
                                
                                <h2>Reunión ".$columna['tipoPredefinido']."</h2>
                                <h2>Fecha: ".$columna['fecha']."</h2>
                                <h2>Hora de Inicio:        ".$columna['hora']."</h2>
                                <h2>Duracion: ".$columna['duracion']." ".$columna['tipoDuracion']."</h2>
                                <br>
                                <h2>Temas Tratados: </h2>
                                <br>
                                <h2>".$columna['nombre']."</h2>
                                    
                                </td>
                            </tr>
                            <!-- BULLETPROOF BUTTON -->
                            
                            
                            
                    
                            <!-- COPY -->
                            <tr>
                                <td bgcolor='#ffffff' align='left' style='padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;' >
                                <p style='margin: 0;'>Daniel,<br>Comite Curricular<br> Utalca, Ing. Civil Computacion </p>
                                </td>
                            </tr>
                            </table>
                            
                        </td>
                    </tr>
                    <!-- SUPPORT CALLOUT -->
                    <tr>
                        <td bgcolor='#f4f4f4' align='center' style='padding: 30px 10px 0px 10px;'>
                            
                            <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;' >
                                <!-- HEADLINE -->
                                <tr>
                                <td bgcolor='#FFECD1' align='center' style='padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;' >
                                    <h2 style='font-size: 20px; font-weight: 400; color: #111111; margin: 0;'></h2>
                                    
                                </td>
                                </tr>
                            </table>
                            
                        </td>
                    </tr>
                    
                    </table>
                    
                </body>
            ";
                   
        } 
        return $tabla;
    }    

$html = selectReunion();
$mpdf = new \Mpdf\Mpdf([]);
$mpdf->WriteHTML($css,\Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html);
$mpdf->Output();
?>