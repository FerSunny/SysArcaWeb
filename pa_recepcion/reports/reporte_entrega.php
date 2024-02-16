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
    $this->Cell(190,5,'Reporte de ventas por recepcionista',0,0,'C');
    $this->Ln(5);
    $this->cell(3);
    $this->Cell(15,5,'Periodo: '.$anio.'-'.$mes,0,0,'L');
    $this->cell(55);
    $this->Cell(15,5,'Filtro: No aplica',0,0,'L');
    $this->SetFont('Arial','',8);
    $this->Ln(3);
    $this->Cell(190,5,'------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------',0,0,'L');

    $this->Ln(3);
    $this->cell(3);

    $this->Cell(40,5,'Recepcionista',0,0,'C');
    $this->Cell(20,5,'Unidad',0,0,'R');
    $this->Cell(15,5,'Notas',0,0,'R');
    $this->Cell(35,5,'Notas Acumuladas',0,0,'R');


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



$id_usuario=0;
$tot_not=0;

$sql="
SELECT 	CONCAT(us.nombre,' ',us.a_paterno, ' ',us.a_materno) AS nombre,
	su.`desc_corta`,
  us.id_usuario,
	COUNT(id_factura) AS notas
FROM so_factura fa, se_usuarios us, kg_sucursales su
WHERE fa.estado_factura <> 5
AND fa.`fk_id_usuario` = us.`id_usuario`
AND fa.`fk_id_sucursal` = su.`id_sucursal`
 AND YEAR(fa.`fecha_factura`) = ".$anio."
AND MONTHNAME(fa.fecha_factura) = '".$mes."'
GROUP BY CONCAT(us.nombre,' ',us.a_paterno, ' ',us.a_materno),su.`desc_corta`,
us.id_usuario
"
;

//echo $sql;

//echo $sql;
if ($result = mysqli_query($conexion, $sql)) {
  while($row = $result->fetch_assoc())
      {    

        
        
        $pdf->SetFont('Arial','',8);
        if($id_usuario <> $row['id_usuario'] ){
          //$pdf->Ln(5);
            $pdf->Cell(60,5,utf8_decode($row['nombre']),0,0,'L');
            //$pdf->Ln(5);
            //$pdf->cell(55);
            $id_usuario=$row['id_usuario'];
            $final=0;
            $tot_not=0;

            $pdf->Cell(15,5,$row['desc_corta'],0,0,'L');
            $pdf->Cell(20,5,$row['notas'],0,0,'L');
            
            $tot_not= $tot_not +$row['notas'];
            $pdf->Cell(20,5,$tot_not,0,0,'L');
            $pdf->Ln(5);
        }else{
          $pdf->cell(60);
          $pdf->Cell(15,5,$row['desc_corta'],0,0,'L');
          $pdf->Cell(20,5,$row['notas'],0,0,'L');
          
          $tot_not= $tot_not +$row['notas'];
          $pdf->Cell(20,5,$tot_not,0,0,'L');
          $pdf->Ln(5);          
        }
              

        

      }
}


$pdf->Output();

?>