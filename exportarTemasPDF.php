<?php
require('fpdf.php');
require "baseDatos/conexion.php";
$v1 = $_POST['variable1'];
class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    //$this->Image('logo.png',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',18);
    // Movernos a la derecha
    $this->Cell(60);
    // Título
    $this->Cell(70,20,utf8_decode('Comité Curricular'),0,0,'C');
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



$consulta = "SELECT * FROM tema";
$consulta2 = "SELECT * FROM reunion";
$resultado2 = $conexion->query($consulta2);
$resultado = $conexion->query($consulta);


// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);



    while($row = $resultado2->fetch_assoc()){

        if($row['id']==$v1){
            $pdf->SetFont('Arial','B',15);
            $pdf->Cell(30,5,utf8_decode( ''),0,0,'C',0);
            $pdf->Cell(10,10,"Reunion: ",0,0,'C',0);
            $pdf->SetFont('Arial','',15);
            $pdf->Cell(60,10,utf8_decode( $row['nombre']),0,1,'C',0);
            $pdf->SetFont('Arial','',12);


            $pdf->Cell(25,20,utf8_decode( ''),0,0,'C',0);
            $pdf->Cell(30,5,utf8_decode( '-Fecha: '),0,0,'L',0);
            $pdf->Cell(30,5,utf8_decode( $row['fecha']),0,1,'C',0);
            $pdf->Cell(25,5,utf8_decode( ''),0,0,'C',0);
            $pdf->Cell(30,5,utf8_decode( '-Hora inicio: '),0,1,'L',0);
            $pdf->Cell(25,5,utf8_decode( ''),0,0,'C',0);
            $pdf->Cell(30,5,utf8_decode( '-Hora termino: '),0,1,'L',0);
        }
        
    
    }    
    $pdf->Cell(70,15,utf8_decode( 'Temas Tratados:'),0,2,'C',0);
while($row = $resultado->fetch_assoc()){

    if($row['refreunion']==$v1){
        $pdf->Cell(20,10,utf8_decode( ''),0,0,'C',0);
        $pdf->Cell(5,5,utf8_decode( '-'),0,0,'C',0);
        $pdf->Cell(0,5,utf8_decode( $row['nombre']),0,1,'L',0);
    }
    

}

$pdf->Output();
?>