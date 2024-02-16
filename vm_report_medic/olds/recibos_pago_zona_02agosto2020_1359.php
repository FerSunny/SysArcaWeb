<?php
session_start();
date_default_timezone_set('America/Mexico_City');
header('Content-Type: text/html; charset=ISO-8859-1');
require('../../fpdf/fpdf.php');
include ("../../controladores/conex.php");

$id_zona=$_GET['id_zona'];
$periodo=$_GET['periodo'];


class PDF extends FPDF
{
// Cabecera de página
  function Header()
  {

      //$this->Ln();
  }

  // Pie de página
  function Footer()
  {

  }
}

// Creación del objeto de la clase heredada
$pdf = new PDF('P','mm','Letter');
$pdf->SetAutoPageBreak(true,5);
$pdf->AliasNbPages();
$pdf->AddPage();

$numero='1';
$corte_sucursal='0';
$imp_sucursal='0';
$primer_vez='s';
$linea='0';

$sql="SELECT  DISTINCT CONCAT(me.nombre,' ',me.a_paterno,' ',me.a_materno) AS medico,
  zo.desc_zona AS zona,
  me.`horario`,
  substr(CONCAT(me.`calle`,' No. ',me.`numero_exterior`),1,48) AS direccion,
  me.`colonia`,
  me.`id_medico`,
  CASE
    WHEN me.fk_id_sexo = '1' THEN
      'a.'
    ELSE
      '.'
  END AS sexo
FROM so_factura fa,
     so_medicos me,
     kg_zonas zo
WHERE DATE_FORMAT(fa.fecha_factura,'%Y-%m') = '".$periodo."' 
  AND fa.fk_id_medico = me.id_medico
  AND fa.afecta_comision = 1
  AND me.fk_id_zona = ".$id_zona." 
  AND me.`fk_id_zona` = zo.`id_zona`
   AND fa.estado_factura <> '5'
  AND me.`id_medico` <> 1607";
 // AND me.`id_medico` in ('988','1009')";
//echo $sql;
if ($result = mysqli_query($conexion, $sql)) {
  while($row = $result->fetch_assoc())
      {    
        $id_medico=$row['id_medico'];

        $pdf->cell(3);
        $pdf->SetFont('Arial','',8);

        $pdf->Cell(190,5,'Laboratorios de analisis clinicos ARCA',0,0,'C');
        $pdf->Ln(5);
        $pdf->cell(3);
        $pdf->Cell(190,5,'Recibo de participaciones medicas',0,0,'C');
        $pdf->Ln(5);
        $pdf->cell(3);
        $pdf->Cell(190,5,$periodo,0,0,'C');
        $pdf->Ln(5);
        $pdf->cell(3);
        $pdf->Cell(15,5,'Medico:',0,0,'L');
        $pdf->Cell(80,5,'('.$row['id_medico'].') '.$row['medico'],0,0,'L');
        $pdf->Cell(15,5,'Horario:',0,0,'L');
        $pdf->Cell(80,5,$row['horario'],0,0,'L');
        $pdf->Ln(5);
        $pdf->cell(3);
        $pdf->Cell(15,5,'Zona:',0,0,'L');
        $pdf->Cell(80,5,$row['zona'],0,0,'L');
        $pdf->Ln(5);
        $pdf->cell(3);
        $pdf->Cell(15,5,'Direccion:',0,0,'L');
        $pdf->Cell(80,5,$row['direccion'],0,0,'L');
        $pdf->Cell(15,5,'Colonia:',0,0,'L');
        $pdf->Cell(70,5,$row['colonia'],0,0,'L');
        $pdf->Ln(5);
        $pdf->cell(3);
        $pdf->Cell(190,5,'---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------',0,0,'L');
        $pdf->Ln(3);
        $pdf->cell(3);
        $pdf->Cell(15,5,'Solicitud',0,0,'L');
        $pdf->Cell(20,5,'Fecha',0,0,'C');
        $pdf->Cell(70,5,'Paciente',0,0,'C');
        $pdf->Cell(70,5,'Estudio',0,0,'C');
        $pdf->Cell(15,5,'Participacion',0,0,'C');
        $pdf->Ln(3);
        $pdf->cell(3);
        $pdf->Cell(190,5,'---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------',0,0,'L');

        $total_comision='0';
        $sql1="SELECT fa.id_factura,
        DATE(fa.fecha_factura) AS fecha,
        CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno) AS cliente,
        SUBSTR(es.`desc_estudio`,1,37) AS estudio,

        ROUND((df.precio_venta*(CASE
            WHEN es.costo = df.precio_venta THEN
              co.porcentaje
            ELSE
              10
            END))/100,2) AS comision

        FROM so_factura fa,
    so_detalle_factura df,
          so_clientes cl,
          km_estudios es,
          kg_comisiones co
        WHERE DATE_FORMAT(fa.fecha_factura,'%Y-%m') = '".$periodo."' 
          AND fa.afecta_comision = 1
          AND fa.fk_id_cliente = cl.id_cliente
          AND df.fk_id_estudio = es.id_estudio
          AND es.fk_id_comision = co.id_comision
          AND fa.id_factura = df.id_factura
          AND fa.`estado_factura` <> 5
          AND fa.fk_id_medico =".$id_medico;
      //echo $sql;
        if ($result1 = mysqli_query($conexion, $sql1)) {
        while($row1 = $result1->fetch_assoc())
            {
              $pdf->Ln(5);
              $pdf->cell(3);
              $pdf->Cell(15,5,$row1['id_factura'],0,0,'C');
              $pdf->Cell(20,5,$row1['fecha'],0,0,'C');
              $pdf->Cell(70,5,$row1['cliente'],0,0,'L');
              $pdf->Cell(70,5,$row1['estudio'],0,0,'L');
              $pdf->Cell(15,5,$row1['comision'],0,0,'R');
              $total_comision+=$row1['comision'];
            }
        }
        $pdf->Ln(3);
        $pdf->cell(178);
        $pdf->Cell(15,5,'----------',0,0,'R');
        $pdf->Ln(3);
        $pdf->cell(178);
        $pdf->Cell(15,5,$total_comision,0,0,'R');
        $pdf->Ln(3);
        $pdf->cell(3);
        $pdf->SetFont('Courier','I',7);
        $pdf->MultiCell(190,5,'Dr'.$row['sexo'].' '.$row['medico'].' agradecemos su preferencia y le informamos que ya proximamente, podra darle seguimiento a sus participaciones asi como revisar los resultados de sus pacientes en nuestro sitio web www.laboratoriosarca.com.mx',0,'L');
        $pdf->SetFont('Arial','',8);
        $pdf->Ln(3);
        $pdf->cell(3);
        $pdf->Cell(190,5,'- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  - - - - - - - - -  CORTE AQUI - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - ',0,0,'L');
        $pdf->Ln(3);
      }

}


$pdf->Output();

?>