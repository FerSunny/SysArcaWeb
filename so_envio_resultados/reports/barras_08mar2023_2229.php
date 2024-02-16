<?php
date_default_timezone_set('America/Mexico_City');
header('Content-Type: text/html; charset=ISO-8859-1');
require('../../fpdf/fpdf.php');
include './barcode/barcode.php';
include ("../../controladores/conex.php");

$cod=$_GET['cod'];

barcode('codigos/'.$cod.'.png', $cod,20, 'horizontal', 'code128', true);


$sql="SELECT 
pr.id_producto,
CONCAT(pr.producto,' (',um.abreviatura,')') as nombre,
um.`abreviatura`
FROM eb_productos pr 
LEFT OUTER JOIN eb_unidad_medida um ON (um.`id_unidad` = pr.`fk_unidad_medida`)
WHERE pr.`id_producto` = $cod";

if ($result = mysqli_query($conexion, $sql)) {
  while($row = $result->fetch_assoc())
  {
      $nombre=$row['nombre'];
  }
  }



class PDF extends FPDF
{
// Cabecera de página
  function Header()
  {

  }

}
//
// Creación del objeto de la clase heredada
//
//echo $nombre;
$pdf = new PDF('L','mm','ticket');
//$pdf = new PDF('L','mm',array(80,60));
$pdf->SetMargins(0,0,0);
$pdf->SetAutoPageBreak(true,20);

$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->Cell(5);
$pdf->ln(8);
$pdf->SetFont('Arial','B',18);
$pdf->Cell(30,5,$nombre,0,'L');
$pdf->Image('codigos/'.$cod.'.png',5,20,100,40);
$pdf->Output();
?>