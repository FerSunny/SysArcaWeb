<?php
require('../../fpdf/fpdf.php');
require_once ("../../so_factura/config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../../so_factura/config/conexion.php");//Contiene funcion que conecta a la base de datos


$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'¡Hola, Mundo!');
$pdf->ln(10);
$pdf->SetFont('Arial','',9);
$sql="select nombre_plantilla,titulo_desc,descripcion,firma FROM cr_plantilla_usg
  where id_plantilla=588 and fk_id_estudio=978";

if ($result = mysqli_query($con, $sql)) {
while($row = $result->fetch_assoc())
    {
        $pdf->Cell(160,5,($row['descripcion']),0,0,'C');
        $pdf->ln(5);
    }
}



$pdf->Output();
?>