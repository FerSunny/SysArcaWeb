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
    $this->Cell(15,5,'Filtro: EKG',0,0,'L');
    $this->SetFont('Arial','',8);
    $this->Ln(3);
    $this->Cell(190,5,'------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------',0,0,'L');

    $this->Ln(3);
    $this->cell(3);
    $this->Cell(5,5,'#',0,0,'L');
    $this->Cell(8,5,'Folio',0,0,'L');
    $this->Cell(45,5,'Fecha',0,0,'C');
    $this->Cell(35,5,'Estudio',0,0,'C');
    $this->Cell(30,5,'Paciente',0,0,'C');


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

$fk_id_medico=0;
$lineas=1;

$sql="
SELECT 	ek.fk_id_factura,
	ek.`fecha_registro`,
	ek.fk_id_medico, 
  us.id_usuario,
	CONCAT(us.`nombre`,' ',us.`a_paterno`,' ',us.a_materno) AS nombre,
	es.`iniciales`,
	CONCAT(cl.nombre,' ',cl.a_paterno, ' ',cl.a_materno) AS paciente
FROM cr_plantilla_ekg_re ek, se_usuarios us, km_estudios es, so_factura fa, so_clientes cl
WHERE ek.`estado` = 'A'
AND ek.`fk_id_medico` = us.`id_usuario`
AND ek.`fk_id_estudio` = es.`id_estudio`
AND ek.`fk_id_factura` = fa.`id_factura`
AND fa.`fk_id_cliente` = cl.id_cliente
AND year(fa.`fecha_factura`) = ".$anio."
AND monthname(fa.fecha_factura) = '".$mes."'
order by us.id_usuario,ek.`fecha_registro` "
;

//echo $sql;

//echo $sql;
if ($result = mysqli_query($conexion, $sql)) {
  while($row = $result->fetch_assoc())
      {    

          
        $pdf->SetFont('Arial','B',10);
        if ($fk_id_medico <> $row['fk_id_medico']){
          $pdf->Cell(15,5,utf8_decode($row['nombre']),0,0,'L');
          $pdf->Ln(5);
          $fk_id_medico=$row['fk_id_medico'];
          $lineas=1;
        }

          $pdf->SetFont('Arial','',8);
          $pdf->cell(3);
          $pdf->Cell(5,5,$lineas,0,0,'R');
          $pdf->Cell(15,5,$row['fk_id_factura'],0,0,'L');
          $pdf->Cell(40,5,$row['fecha_registro'],0,0,'L');
          $pdf->Cell(40,5,$row['iniciales'],0,0,'L');
          $pdf->Cell(35,5,utf8_decode($row['paciente']),0,0,'L');
          $pdf->Ln(5);

          $lineas=$lineas+1;
        
      }

}


$pdf->Output();

?>