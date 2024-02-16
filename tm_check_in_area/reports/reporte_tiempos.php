<?php
session_start();
date_default_timezone_set('America/Mexico_City');
header('Content-Type: text/html; charset=ISO-8859-1');
require('../../fpdf/fpdf.php');
include ("../../controladores/conex.php");

$diafactura=$_GET['diafactura'];
$id_sucursal=$_GET['id_sucursal'];
$desc_sucursal=$_GET['desc_sucursal'];

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

    global $diafactura,
            $desc_sucursal;

    $this->cell(3);
    $this->SetFont('Arial','',12);

    $this->Cell(190,5,'Laboratorios CLINICOS ARCA',0,0,'C');
    $this->Ln(5);
    $this->cell(3);
    $this->Cell(190,5,'Reporte de indicadores de tiempo PRE-EXAMEN',0,0,'C');
    $this->Ln(5);
    $this->cell(3);
    $this->Cell(15,5,'Periodo: '.$diafactura,0,0,'L');
    $this->cell(55);
    $this->Cell(15,5,'Sucursal: '.$desc_sucursal,0,0,'L');
    $this->cell(20);
    $this->Cell(15,5,'IQ1 Time: 10 min',0,0,'L');
    $this->cell(20);
    $this->Cell(15,5,'IQ2 Time: 10 min',0,0,'L');
    $this->SetFont('Arial','',8);
    $this->Ln(3);
    $this->Cell(190,5,'------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------',0,0,'L');

    $this->Ln(3);
    $this->cell(1);

    $this->Cell(16,5,'Id OT',0,0,'C');
    $this->Cell(14,5,'Iniciales',0,0,'L');
    $this->Cell(30,5,'Estudio',0,0,'L');
    $this->Cell(8,5,'Turno',0,0,'L');
    $this->Cell(15,5,'HT',0,0,'C');
    $this->Cell(15,5,'HOT',0,0,'C');
    $this->Cell(15,5,'IQ1',0,0,'C');
    $this->Cell(15,5,'HTM',0,0,'C');
    $this->Cell(15,5,'IQ2',0,0,'C');
    $this->Cell(25,5,'Flebotomista',0,0,'C');


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
SELECT
fa.id_factura,
us.`iniciales`as vendedor,
es.`iniciales`,
fa.`turno_num`,
TIME(tu.`fecha`) AS hora_turno,
TIME(fa.`fecha_factura`) AS hora_ot,
TIMEDIFF(TIME(fa.`fecha_factura`),TIME(tu.`fecha`) ) indica_1,
tm.`fecha` AS tiempo_muestra,
TIMEDIFF(tm.`fecha`, TIME(fa.`fecha_factura`)) AS indica_2,
tm.`fk_id_usuario`
FROM 
so_factura fa
LEFT OUTER JOIN so_detalle_factura df ON (df.id_factura = fa.`id_factura`)
LEFT OUTER JOIN so_turnos tu ON (  tu.`turno` = fa.`turno_num` AND tu.`fk_id_sucursal` = fa.`fk_id_sucursal` AND DATE(tu.`fecha`) = DATE(fa.`fecha_factura`) )

LEFT OUTER JOIN vw_iq_tomas tm ON (tm.`fecha_toma` = DATE(fa.`fecha_factura`) AND tm.`fk_id_factura` = df.`id_factura` AND tm.`fk_id_estudio` = df.`fk_id_estudio` ),
km_estudios es,
se_usuarios us
WHERE DATE(fa.`fecha_factura`) = '$diafactura'
AND fa.`estado_factura` <> 5
AND df.`fk_id_estudio` = es.`id_estudio`
AND fa.`fk_id_usuario` = us.`id_usuario`
AND fa.`fk_id_sucursal` = $id_sucursal
order by 1
"
;

//echo $sql;

//echo $sql;
if ($result = mysqli_query($conexion, $sql)) {
  while($row = $result->fetch_assoc())
      {    
        $pdf->cell(1);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(18,5,$row['id_factura'],0,0,'L');

        if ($row['turno_num'] == 0 ){
          $pdf->SetTextColor(255, 0, 0);
        }else{
          $pdf->SetTextColor(0, 0, 0);
        }

        $pdf->Cell(10,5,$row['vendedor'],0,0,'L');
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(35,5,utf8_decode(substr($row['iniciales'],1,20)),0,0,'L');

        if ($row['turno_num'] == 0 ){
          $pdf->SetTextColor(255, 0, 0);
        }else{
          $pdf->SetTextColor(0, 0, 0);
        }
        $pdf->Cell(5,5,$row['turno_num'],0,0,'L');
    
        $pdf->Cell(15,5,$row['hora_turno'],0,0,'L');
        $pdf->Cell(15,5,$row['hora_ot'],0,0,'L');
        if ($row['indica_1'] < "00:00:00" or $row['indica_1'] > "00:11:00"){
          $pdf->SetTextColor(255, 0, 0);
        }elseif($row['indica_1'] >= "00:00:01" and $row['indica_1'] <= "00:10:00"){
          $pdf->SetTextColor(0, 204, 102);
        }
        $pdf->Cell(15,5,$row['indica_1'],0,0,'L');
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(15,5,$row['tiempo_muestra'],0,0,'L');
        if ($row['indica_2'] < "00:00:00" or $row['indica_2'] > "00:11:00"){
          $pdf->SetTextColor(255, 0, 0);
        }elseif($row['indica_2'] >= "00:00:01" and $row['indica_2'] <= "00:10:00"){
          $pdf->SetTextColor(0, 204, 102);
        }
        $pdf->Cell(15,5,$row['indica_2'],0,0,'L');
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(15,5,$row['fk_id_usuario'],0,0,'L');
          $pdf->Ln(5);          
        }
              

        

      }


$pdf->Output();

?>