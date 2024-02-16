<?php
session_start();
date_default_timezone_set('America/Mexico_City');
header('Content-Type: text/html; charset=ISO-8859-1');
require('../../fpdf/fpdf.php');
include ("../../controladores/conex.php");

$fecha=$_GET['fecha'];
$id_usuario=$_GET['id_usuario'];

//$anio=2021;
//$mes=1;

$sql="
SELECT 	CONCAT(us.nombre,' ',us.a_paterno, ' ',us.a_materno) AS nombre
FROM  se_usuarios us
WHERE id_usuario = ".$id_usuario
;

//echo $sql;

//echo $sql;
if ($result = mysqli_query($conexion, $sql)) {
  while($row = $result->fetch_assoc())
      {    
        $nombre_vm = $row['nombre'] ;
      }
}


class PDF extends FPDF
{
// Cabecera de página
  function Header()
  {

    global $fecha,
            $id_usuario,
            $nombre_vm;

    $this->cell(3);
    $this->SetFont('Arial','',12);

    $this->Cell(190,5,'Laboratorios ARCA',0,0,'C');
    $this->Ln(5);
    $this->cell(3);
    $this->Cell(190,5,'AGENDA DE VISITA MEDICA',0,0,'C');
    $this->Ln(5);
    $this->cell(3);
    $this->Cell(15,5,'Fecha: '.$fecha,0,0,'L');
    $this->cell(55);
    $this->Cell(15,5,'Filtro: '.$id_usuario."-".$nombre_vm,0,0,'L');
    $this->SetFont('Arial','',8);
    $this->Ln(3);
    $this->Cell(190,5,'------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------',0,0,'L');

    $this->Ln(3);
    $this->cell(3);

    $this->Cell(3,5,'Id',0,0,'C');
    $this->Cell(68,5,'Medico',0,0,'C');
    $this->Cell(10,5,'Hora Ag.',0,0,'C');
    $this->Cell(12,5,'Plan',0,0,'C');
    $this->Cell(10,5,'Hora Vi.',0,0,'C');
    $this->Cell(20,5,'Quejas',0,0,'C');
    $this->Cell(40,5,'Sugerencias',0,0,'C');


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
$pdf = new PDF('L','mm','Letter');
$pdf->SetAutoPageBreak(true,15);
$pdf->AliasNbPages();
$pdf->AddPage();




$sql="
SELECT ag.planeado,ag.fk_id_medico, CONCAT(me.nombre,' ',me.`a_paterno`,' ',me.`a_materno`) AS nombre, 
ag.hora, me.`colonia`, me.calle, me.cp, me.numero_exterior, 
mu.`desc_municipio`, me.telefono_fijo, 
me.telefono_movil, me.e_mail, me.horario, me.referencia,
hv.`hora_visita`, hv.`quejas`, hv.`sugerencias`
FROM vm_agenda ag 
LEFT OUTER JOIN vm_hoja_visita hv ON (hv.`fk_id_medico` = ag.`fk_id_medico` AND hv.`fecha_visita` = ag.`fecha`),
so_medicos me, ku_municipios mu
WHERE ag.estado = 'A' 
AND ag.fk_id_medico = me.`id_medico`
AND me.`fk_id_estado` = mu.`fk_id_estado`
AND me.`fk_id_municipio` = mu.`id_municipio`
AND ag.fk_id_usuario = ".$id_usuario."
AND ag.fecha = '".$fecha."'


union

SELECT 
'N' planeado,
ag.fk_id_medico, 
CONCAT(me.nombre,' ',me.`a_paterno`,' ',me.`a_materno`) AS nombre, 
ag.hora_visita, 
me.`colonia`,
me.calle, 
me.cp, 
me.numero_exterior, 
mu.`desc_municipio`, 
me.telefono_fijo, 
me.telefono_movil, 
me.e_mail, 
me.horario, 
me.referencia,
ag.`hora_visita`, 
ag.`quejas`, 
ag.`sugerencias`
FROM vm_hoja_visita ag ,
so_medicos me, ku_municipios mu
WHERE ag.estado = 'A' 
AND ag.fk_id_medico = me.`id_medico`
AND me.`fk_id_estado` = mu.`fk_id_estado`
AND me.`fk_id_municipio` = mu.`id_municipio`
AND ag.`fk_id_medico` NOT IN (SELECT a.fk_id_medico FROM vm_agenda a WHERE a.`fecha` = ag.`fecha_visita`)
AND me.fk_id_usuario =  ".$id_usuario."
AND ag.fecha_visita = '".$fecha."'"

;

//echo $sql;

//echo $sql;
if ($result = mysqli_query($conexion, $sql)) {
  while($row = $result->fetch_assoc())
      {    

        $pdf->SetFont('Arial','',8);

        $pdf->cell(3);
        $pdf->Cell(10,5,$row['fk_id_medico'],0,0,'L');
        $pdf->Cell(60,5,$row['nombre'],0,0,'L');
        $pdf->Cell(15,5,$row['hora'],0,0,'L');
        $pdf->Cell(8,5,$row['planeado'],0,0,'C');
        $pdf->Cell(7,5,$row['hora_visita'],0,0,'C');
        $pdf->Cell(35,5,$row['quejas'],0,0,'L');
        $pdf->Cell(10,5,$row['sugerencias'],0,0,'L');
        $pdf->Ln(5);  
        $pdf->SetFont('Arial','I',6);        
        $pdf->cell(13);
        $pdf->Cell(75,5,utf8_decode($row['calle']).', '.$row['numero_exterior'].', '.utf8_decode($row['colonia']).', '.$row['cp'].', ' .$row['desc_municipio'].', ' .utf8_decode($row['referencia']).' -- ' .$row['telefono_fijo'].', ' .$row['telefono_movil'].', ' .$row['e_mail'],0,0,'L'); 
        $pdf->Ln(5);          

        

      }
}


$pdf->Output();

?>