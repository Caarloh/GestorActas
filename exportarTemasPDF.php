<?php
require('fpdf.php');

$v1 = $_POST['variable1'];
class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    //$this->Image('logo.png',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(60);
    // Título
    $this->Cell(70,10,'Temas tratados',0,0,'C');
    
    // Salto de línea
    $this->Ln(20);


 

}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
}
}

require "baseDatos/conexion.php";

$consulta = "SELECT * FROM tema";
$resultado = $conexion->query($consulta);


// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);



    $pdf->Cell(20,10,utf8_decode("Reunion: "),0,0,'C',0);
$pdf->Cell(30,10,utf8_decode( $v1),0,1,'C',0);


while($row = $resultado->fetch_assoc()){

    if($row['refreunion']==$v1){
        $pdf->Cell(20,10,'-',0,0,'C',0);
        $pdf->Cell(20,10,utf8_decode( $row['nombre']),0,1,'L',0);
    }
    

}

$pdf->Output();
?>