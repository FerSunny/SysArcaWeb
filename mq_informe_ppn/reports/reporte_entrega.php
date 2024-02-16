<?php
session_start();
date_default_timezone_set('America/Mexico_City');
header('Content-Type: text/html; charset=ISO-8859-1');
require('../../fpdf/fpdf.php');
include ("../../controladores/conex.php");

$anio=$_GET['anio'];
$mes=$_GET['mes'];

//$anio=2021;
//$mes=1;

//echo $tipo;

/*
if($tipo=='Pendiente'){
  $condicion='AND p1.fecha_hora_entregada is null';
}else
{
  $condicion='AND p1.fecha_hora_entregada is not null';
}
*/

class PDF extends FPDF
{
// Cabecera de página
  function Header()
  {

    global $anio,
            $mes;

    $this->cell(3);
    $this->SetFont('Arial','',12);

    $this->Cell(190,5,'Laboratorios ARCA',0,0,'C');
    $this->Ln(5);
    $this->cell(3);
    $this->Cell(190,5,'Reporte de entrega de maquila',0,0,'C');
    $this->Ln(5);
    $this->cell(3);
    $this->Cell(15,5,'Periodo: '.$anio.'-'.$mes,0,0,'L');
    $this->cell(55);
    $this->Cell(15,5,'Filtro: (COLPO/PAPA)',0,0,'L');
    $this->SetFont('Arial','',8);
    $this->Ln(3);
    $this->Cell(190,5,'------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------',0,0,'L');

    $this->Ln(3);
    $this->cell(3);
    $this->Cell(5,5,'#',0,0,'L');
    $this->Cell(8,5,'Folio',0,0,'L');
    $this->Cell(45,5,'Fecha',0,0,'C');
    $this->Cell(35,5,'Estudio',0,0,'C');
    $this->Cell(20,5,'Paciente',0,0,'C');


    $this->Ln(3);

    $this->Cell(190,5,'------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------',0,0,'L');    
    $this->Ln(5);
  }

  // Pie de página
  function Footer()
  {

  }
}

// Creación del objeto de la clase heredada
$pdf = new PDF('P','mm','Letter');
$pdf->SetAutoPageBreak(true,15);
$pdf->AliasNbPages();
$pdf->AddPage();


$lineas=1;

$sql="
SELECT 	fa.id_factura,
	fa.`fecha_factura`,
	es.`iniciales`,
	CONCAT(cl.nombre,' ',cl.a_paterno, ' ',cl.a_materno) AS paciente
FROM so_factura fa, so_detalle_factura df, km_estudios es, so_clientes cl
WHERE 
 YEAR(fa.`fecha_factura`) = ".$anio."
AND MONTHNAME(fa.fecha_factura) = '".$mes."'
AND fa.estado_factura <> 5
AND fa.`id_factura` = df.`id_factura`
AND fa.`fk_id_cliente` = cl.id_cliente
AND df.`fk_id_estudio` = es.`id_estudio`
AND es.`fk_id_plantilla` = 4
ORDER BY fa.`fecha_factura`
"
;

//echo $sql;

//echo $sql;
if ($result = mysqli_query($conexion, $sql)) {
  while($row = $result->fetch_assoc())
      {    

          
          $pdf->SetFont('Arial','',8);
          $pdf->cell(3);
          $pdf->Cell(5,5,$lineas,0,0,'R');
          $pdf->Cell(15,5,$row['id_factura'],0,0,'L');
          $pdf->Cell(40,5,$row['fecha_factura'],0,0,'L');
          $pdf->Cell(35,5,$row['iniciales'],0,0,'L');
          $pdf->Cell(13,5,$row['paciente'],0,0,'L');
          $pdf->Ln(5);

          $lineas=$lineas+1;
        
      }

}


$pdf->Output();

?>