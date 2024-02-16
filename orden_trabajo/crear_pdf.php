<?php 
include("../pdf/fpdf.php");
    $usuario = $_POST['unidad'];
    $contra  = $_POST['fecha'];
/*$h1="Hola";
$pdf = new FPDF();
$pdf->AddPage();
$pdf->setFont('Arial','B',15);
$pdf->Cell(100,10,$usuario,1,1,'C');
$pdf->Cell(100,10,$contra,1,1,'C');
$pdf->Output('recibos.pdf', 'D');
*/

   echo "Uniad: ".$usuario; 
     echo "Fecha: ".$contra; 

?>