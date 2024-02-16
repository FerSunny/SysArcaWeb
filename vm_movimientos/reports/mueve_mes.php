<?php
date_default_timezone_set('America/Mexico_City');
header('Content-Type: text/html; charset=ISO-8859-1');
require('../../fpdf/fpdf.php');
 require_once ("../../so_factura/config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
 require_once ("../../so_factura/config/conexion.php");//Contiene funcion que conecta a la base de datos
 //require_once('../reports/barcode.inc.php'); 

//se recibe los paramteros para la generación del reporte
$anio=$_GET['anio'];
$mes=$_GET['mes'];
$id_usuario=$_GET['id_usuario'];
$dia=$_GET['dia'];

//Obtener los datos, de la cabecera, (datos del estudio)
$entro=0;
$sql="
SELECT 
CONCAT(m.`nombre`,' ',m.`a_paterno`,' ',m.`a_materno`) AS nombre
FROM se_usuarios m 
WHERE m.`id_usuario` = $id_usuario
";
//echo $sql;
    if ($result = mysqli_query($con, $sql)) {
        while($row = $result->fetch_assoc())
        {
            $nombre=utf8_decode($row['nombre']);

        }
    }

class PDF extends FPDF
{
// Cabecera de página
  function Header()
  {

  global  $nombre,
            $id_usuario,
            $anio,
            $mes,
            $dia
            ;

  $this->Ln(3);
  $this->Cell(3);
  $this->SetFont('Arial','',10);
  $this->Cell(250,5,'Laboratorio de Analisis Clinicos ARCA',0,0,'C');
  $this->Ln(4);
  $this->Cell(250,5,'Resumen de operaciones de la VM',0,0,'C');

  $this->Ln(5);
  $this->Cell(3);
  $this->SetFont('Arial','',10);
  $this->Cell(150,5,'Visitador Medico: '.$id_usuario.'-'.utf8_decode($nombre),0,0,'L');
  $this->Cell(80);
  $this->Cell(0,5,'Page '.$this->PageNo().'/{nb}',0,0,'C');

  $this->Ln(5);
  $this->Cell(3);
  $this->SetFont('Arial','',10);
  $this->Cell(150,5,'Dia de operacion: '.$anio.'-'.$mes.'-'.$dia,0,0,'L');  

  $this->Ln(4);
  $this->Cell(3);
  $this->Cell(250,5,'----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------',0,0,'L');
/*      
      $this->ln(6);
      $this->Cell(3);
      $this->SetFont('Arial','B',16);
      $this->Cell(75,5,$edad,0,'L');
*/
      $this->Ln(5);

  }

/*
// Pie de página
  function Footer()
  {

    global $numero_factura;

    $this->SetY(-50); //
    //$this->ln(10);
    $this->Cell(8);

    $this->SetFont('Arial','',12);
    $this->Cell(30,5,$numero_factura,0,0,'L'); 
    $this->ln(10); // aqui
    //$this->Cell(5);
  }
*/
}
//
// Creación del objeto de la clase heredada
//
$pdf = new PDF('L','mm','Letter');
//$pdf = new PDF('L','mm',array(80,60));
$pdf->SetMargins(0,0,0);
$pdf->SetAutoPageBreak(true,50);

$pdf->AliasNbPages();
$pdf->AddPage();


//$pdf->Ln(5);
$pdf->Cell(3);
$pdf->SetFont('Arial','',10);
$pdf->Cell(250,5,'RESUMEN DE LA VISITA MEDICA',0,0,'L');

$pdf->Ln(5);
$pdf->Cell(3);
$pdf->SetFont('Arial','',10);
$pdf->Cell(50,5,'Nombre del medico',0,0,'L');
$pdf->Cell(4);
$pdf->Cell(10,5,'ctg',0,0,'C');
$pdf->Cell(5);
$pdf->Cell(10,5,'h. Agen',0,0,'C');
$pdf->Cell(5);
$pdf->Cell(10,5,'h. Visit',0,0,'C');
$pdf->Cell(6);
$pdf->Cell(13,5,'h. Real',0,0,'C');
$pdf->Cell(2);
$pdf->Cell(2,5,'P',0,0,'C');
$pdf->Cell(1);
$pdf->Cell(8,5,'mr',0,0,'C');
$pdf->Cell(1);
$pdf->Cell(10,5,'F. Ini',0,0,'C');
$pdf->Cell(1);
$pdf->Cell(10,5,'F. Fin',0,0,'C');
$pdf->Cell(4);
$pdf->Cell(3,5,'pl',0,0,'C');
$pdf->Cell(6);
$pdf->Cell(5,5,'Anti',0,0,'C');
$pdf->Cell(6);
$pdf->Cell(15,5,'Zona',0,0,'C');


$pdf->Ln(3);
$pdf->Cell(3);
$pdf->Cell(50,5,'-------------------------------------------',0,0,'L');
$pdf->Cell(5);
$pdf->Cell(10,5,'-------',0,0,'L');
$pdf->Cell(2);
$pdf->Cell(10,5,'-----------',0,0,'L');
$pdf->Cell(6);
$pdf->Cell(10,5,'-----------',0,0,'L');
$pdf->Cell(6);
$pdf->Cell(10,5,'-----------',0,0,'L');
$pdf->Cell(5);
$pdf->Cell(1,5,'--',0,0,'L');
$pdf->Cell(5);
$pdf->Cell(5,5,'--',0,0,'L');
$pdf->Cell(2);
$pdf->Cell(10,5,'-------',0,0,'L');
$pdf->Cell(1);
$pdf->Cell(10,5,'--------',0,0,'L');
$pdf->Cell(3);
$pdf->Cell(5,5,'---',0,0,'L');
$pdf->Cell(2);
$pdf->Cell(10,5,'------',0,0,'L');
$pdf->Cell(2);
$pdf->Cell(10,5,'-----------------',0,0,'L');
$pdf->Ln(7);

$stmt_select_ag="
SELECT  
    'E' as origen,
    ag.*,
    CONCAT(me.`nombre`,' ',me.`a_paterno`,' ',me.`a_materno`) AS medico,
    h.`hora_visita`,
    h.`mail_resultados`,
    h.`participaciones`,
    h.`ordenes_fi`,
    h.`ordenes_ff`,
    (r.enero+r.`febrero`+r.`marzo`+r.`abril`+r.`mayo`+r.`junio`+r.`julio`+r.`agosto`+r.`septiembre`)/9 AS avg7,
    TIME(h.fecha_actualiza) hora_real,
    TIMESTAMPDIFF(MONTH,`me`.`fecha_registro`,CURDATE()) AS antiguedad,
    z.desc_zona
FROM vm_agenda ag
LEFT OUTER JOIN so_medicos me ON (me.`id_medico` = ag.`fk_id_medico`)
LEFT OUTER JOIN vm_hoja_visita h ON (h.fk_id_medico = ag.`fk_id_medico` AND h.`fecha_visita` = ag.`fecha` AND ag.`estado` = 'A')
LEFT OUTER JOIN vw_bi_vm_rkg_medico_all r ON (r.`fk_id_medico` = me.`id_medico`)
LEFT OUTER JOIN kg_zonas z ON (z.id_zona = me.fk_id_zona)
WHERE ag.`estado` = 'A'
AND YEAR(ag.`fecha`) = $anio
AND MONTH(ag.`fecha`) = $mes
AND ag.`fk_id_usuario` = $id_usuario
AND DAY(ag.`fecha`) = $dia

union

SELECT 
    'N' as origen,
    ag.*,
    CONCAT(me.`nombre`,' ',me.`a_paterno`,' ',me.`a_materno`) AS medico,
    hv.`hora_visita`,
    hv.`mail_resultados`,
    hv.`participaciones`,
    hv.`ordenes_fi`,
    hv.`ordenes_ff`,
    (r.enero+r.`febrero`+r.`marzo`+r.`abril`+r.`mayo`+r.`junio`+r.`julio`+r.`agosto`+r.`septiembre`)/9 AS avg7,
    TIME(hv.fecha_actualiza) hora_real,
    TIMESTAMPDIFF(MONTH,`me`.`fecha_registro`,CURDATE()) AS antiguedad,
    z.desc_zona 
FROM 
vm_hoja_visita hv
LEFT OUTER JOIN vm_agenda ag ON (ag.`fk_id_medico` = hv.fk_id_medico AND  ag.`fecha` = hv.`fecha_visita`AND ag.`estado` = 'A'),
so_medicos me
LEFT OUTER JOIN vw_bi_vm_rkg_medico_all r ON (r.`fk_id_medico` = me.`id_medico`)
LEFT OUTER JOIN kg_zonas z ON (z.id_zona = me.fk_id_zona)
WHERE hv.`estado` = 'A'
AND hv.`fk_id_medico` = me.`id_medico`
AND YEAR (me.`fecha_registro`) = $anio
AND MONTH(me.`fecha_registro`) = $mes
AND me.`fk_id_usuario` = $id_usuario
AND DAY(me.`fecha_registro`) = $dia

";
//echo $sql;
    if ($result_ag = mysqli_query($con, $stmt_select_ag)) {
        while($row = $result_ag->fetch_assoc())
        {
            $pdf->Cell(3);
            $pdf->SetFont('Arial','',9);
            //$pdf->SetFillColor(0, 0, 0);
            if ($row['origen'] == 'N') {
                $pdf->SetTextColor(0, 0, 255);
            }
            $pdf->Cell(1,5,utf8_decode(strtolower($row['medico'])),0,0,'L');
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(55);
            if($row['avg7'] >= .1 and $row['avg7'] <= 1 ){
              $pdf->SetFillColor(255, 153, 51); // naranja
              $pdf->Cell(8,5, number_format(($row['avg7']),2) ,0,0,'C',true);
            }elseif($row['avg7'] == 0){
                $pdf->SetFillColor(255, 0, 0); // rojo
                $pdf->Cell(8,5, number_format(($row['avg7']),2) ,0,0,'C',true);
            }elseif($row['avg7'] >= 1.1 and $row['avg7'] <= 2 ){
                  $pdf->SetFillColor(255, 255, 0); // amarillo
                  $pdf->Cell(8,5, number_format(($row['avg7']),2) ,0,0,'C',true);
            }elseif($row['avg7'] >= 2.1 and $row['avg7'] <= 3 ){
                  $pdf->SetFillColor(0, 204, 0); // verde
                  $pdf->Cell(8,5, number_format(($row['avg7']),2) ,0,0,'C',true);
            }elseif($row['avg7'] >= 3.1 ){
                  $pdf->SetFillColor(102, 178, 255); // azul
                  $pdf->Cell(8,5, number_format(($row['avg7']),2) ,0,0,'C',true);
            }else{
                  $pdf->Cell(8,5, number_format(($row['avg7']),2) ,0,0,'C');
            }

            $pdf->Cell(3);
            $pdf->Cell(1,5,utf8_decode(strtolower($row['hora'])),0,0,'L');
            $pdf->Cell(15);
            $pdf->Cell(1,5,utf8_decode(strtolower($row['hora_visita'])),0,0,'L');
            $pdf->Cell(15);
            $pdf->Cell(1,5,utf8_decode(strtolower($row['hora_real'])),0,0,'L');
            $pdf->Cell(15);
            $pdf->Cell(1,5,utf8_decode(strtolower($row['participaciones'])),0,0,'L');
            $pdf->Cell(4);
            $pdf->Cell(1,5,utf8_decode(strtolower($row['mail_resultados'])),0,0,'L');
            $pdf->Cell(4);
            $pdf->Cell(12,5,utf8_decode($row['ordenes_fi']),0,0,'R');
            $pdf->Cell(4);
            $pdf->Cell(7,5,utf8_decode($row['ordenes_ff']),0,0,'R');
            $pdf->Cell(4);
            $pdf->Cell(2,5,utf8_decode(strtolower($row['planeado'])),0,0,'L');
            $pdf->Cell(4);
            $pdf->Cell(8,5,utf8_decode(strtolower($row['antiguedad'])),0,0,'R');
            $pdf->Cell(4);
            $pdf->Cell(8,5,utf8_decode(strtolower($row['desc_zona'])),0,0,'L');
            $pdf->ln(5);

        }
    }

$pdf->Output();
?>