<?php
date_default_timezone_set('America/Mexico_City');
header('Content-Type: text/html; charset=ISO-8859-1');
require('../../fpdf/fpdf.php');
require_once ("../../so_factura_pre/config/db.php");
require_once ("../../so_factura_pre/config/conexion.php");
require_once('../reports/barcode.inc.php'); 

//se recibe los paramteros para la generación del reporte
$numero_factura=$_GET['numero_factura'];

/*
//Obtener los datos, de la cabecera, (datos del estudio)
$sql="SELECT DATE(fa.fecha_factura) AS fecha, 
    su.desc_sucursal,
    SUBSTRING(CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno),1,22) paciente,
    CASE 
      WHEN cl.anios > 0 THEN
        CONCAT(cl.anios,' Años')
      WHEN cl.dias > 0 THEN
        CONCAT(cl.dias,' Dias')
      WHEN cl.meses > 0 THEN
        CONCAT(cl.meses,' Meses')
    END AS edad
    FROM so_factura_pre fa
    LEFT OUTER JOIN kg_sucursales su ON (su.id_sucursal = fa.fk_id_sucursal)
    LEFT OUTER JOIN so_clientes cl ON (cl.id_cliente = fa.fk_id_cliente)
    WHERE fa.id_factura".$numero_factura;
 //echo $sql;

     if ($result = mysqli_query($con, $sql)) {
        while($row = $result->fetch_assoc())
        {
            $paciente=$row['paciente'];
            $fecha=$row['fecha'];
            $edad=utf8_decode($row['edad']);
            $sucursal=$row['sucursal'];
        }
    }
*/
//
// Creación del objeto de la clase heredada
//
new barCodeGenrator($numero_factura,1,'../reports/codes/'.$numero_factura.'.gif', 160, 50, true);
$pdf = new FPDF();
$pdf->SetMargins(0,0,0);
//$pdf->SetAutoPageBreak(true,50);

//$pdf->AliasNbPages();
$pdf->AddPage('L','ticket');

$sql="SELECT fa.id_factura,
  DATE(fa.fecha_factura) AS fecha_factura, 
    UPPER(su.desc_sucursal) AS desc_sucursal,
    SUBSTRING(CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno),1,22) paciente,
    CASE 
      WHEN cl.anios > 0 THEN
        CONCAT(cl.anios,' Años')
      WHEN cl.dias > 0 THEN
        CONCAT(cl.dias,' Dias')
      WHEN cl.meses > 0 THEN
        CONCAT(cl.meses,' Meses')
    END AS edad,
    es.iniciales
    FROM so_factura_pre fa
    LEFT OUTER JOIN kg_sucursales su ON (su.id_sucursal = fa.fk_id_sucursal)
    LEFT OUTER JOIN so_clientes cl ON (cl.id_cliente = fa.fk_id_cliente)
    LEFT OUTER JOIN so_detalle_factura_pre df ON (df.id_factura = fa.id_factura)
    LEFT OUTER JOIN km_estudios es ON (es.id_estudio = df.fk_id_estudio)
    WHERE fa.id_factura=".$numero_factura;
//echo $sql;
  if ($result = mysqli_query($con, $sql)) {
    while($row = $result->fetch_assoc())
      {

              $pdf->ln(1);
              $pdf->Cell(3);
              $pdf->SetFont('Arial','',14);
              $pdf->Cell(28,5,$row['fecha_factura'],0,0,'L');
              $pdf->Cell(47,5,$row['desc_sucursal'],0,0,'L');
              
              $pdf->ln(6);
              $pdf->Cell(3);
              $pdf->SetFont('Arial','B',16);
              $pdf->MultiCell(75,5,$row['paciente'],0,'L');

              $pdf->ln(6);
              $pdf->Cell(3);
              $pdf->SetFont('Arial','',15);
              $pdf->Cell(75,5,utf8_decode($row['edad']),0,0,'L');

              $pdf->ln(8);
              $pdf->Cell(3);
              $pdf->SetFont('Arial','',12);
              $pdf->Cell(75,5,utf8_decode($row['iniciales']),0,0,'L');

              $pdf->Image('../reports/codes/'.$numero_factura.'.gif',25,35,70,0);
/*
              //$pdf->Cell(9);
              $pdf->SetFont('Arial','B',$row['tamfue']);
              $pdf->Cell(18,5,$row['unidad_medida'],0,0,'L');

              $pdf->Cell(8);
              $pdf->SetFont('Arial',$row['tipfue'],$row['tamfue']);
              if($row['concepto']=='Volumen Recibido'){
                $nle+=1;
                $nle-=1;
              }else{
                $pdf->Cell(18,5,utf8_decode($row['valor_refe']).$sexo,0,0,'L');
              }
              //$pdf->Cell(18,5,utf8_decode($row['valor_refe']).$sexo,0,0,'L');
              $pdf->ln(4);
*/
      }  
  }

$pdf->Output();
?>