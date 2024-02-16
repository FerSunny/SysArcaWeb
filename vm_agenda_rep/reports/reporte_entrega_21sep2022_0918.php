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
    $this->SetTextColor(0,0,0);
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
    $this->Cell(190,5,'--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------',0,0,'L');

    $this->Ln(3);
    $this->cell(3);

    $this->Cell(3,5,'Id',0,0,'C');
    $this->Cell(68,5,'Medico',0,0,'C');
    $this->Cell(10,5,'Hora Ag.',0,0,'C');
    $this->Cell(12,5,'Plan',0,0,'C');
    $this->Cell(10,5,'Hora Vi.',0,0,'C');
    $this->Cell(12,5,'Anti',0,0,'C');
    $this->Cell(8,5,'Ago',0,0,'C');
    $this->Cell(8,5,'Jul',0,0,'C');
    $this->Cell(8,5,'Jun',0,0,'C');
    $this->Cell(8,5,'May',0,0,'C');
    $this->Cell(8,5,'Abr',0,0,'C');
    $this->Cell(8,5,'Mar',0,0,'C');
    $this->Cell(8,5,'Feb',0,0,'C');
    $this->Cell(8,5,'Ene',0,0,'C');
    $this->Cell(8,5,'Avg7',0,0,'C');
    $this->Cell(8,5,'Avg8',0,0,'C');
    $this->Cell(10,5,'Encue',0,0,'C');
    $this->Cell(20,5,'No. Cuenta',0,0,'C');
    $this->Cell(20,5,'F. Nac',0,0,'C');
    $this->Cell(10,5,'RD',0,0,'C');

    $this->Ln(3);

    $this->Cell(190,5,'--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------',0,0,'L');    
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
(
SELECT ag.planeado,ag.fk_id_medico, CONCAT(me.nombre,' ',me.`a_paterno`,' ',me.`a_materno`) AS nombre, 
ag.hora, me.`colonia`, me.calle, me.cp, me.numero_exterior, 
mu.`desc_municipio`, me.telefono_fijo, 
me.telefono_movil, me.e_mail, me.horario, me.referencia,
hv.`hora_visita`, hv.`quejas`, hv.`sugerencias`,
rm.agosto,
rm.julio,
rm.junio,
rm.`mayo`,
rm.`abril`,
rm.`marzo`,
rm.`febrero`,
rm.`enero`,
((rm.julio+rm.junio+rm.`mayo`+rm.`abril`+rm.`marzo`+rm.`febrero`+rm.`enero`)/7) as avg7,
((rm.agosto+rm.julio+rm.junio+rm.`mayo`+rm.`abril`+rm.`marzo`+rm.`febrero`+rm.`enero`)/8) as avg8,
TIMESTAMPDIFF(MONTH,`me`.`fecha_registro`,CURDATE()) AS `antiguedad`,
CASE
WHEN en.idmedico IS NULL THEN
  'No'
ELSE
  'Si'
END AS encuesta,
date(en.fechanacimiento) as fechanacimiento,
en.numerotransfer,
en.recibidigital
FROM vm_agenda ag 
LEFT OUTER JOIN vm_hoja_visita hv ON (hv.`fk_id_medico` = ag.`fk_id_medico` AND hv.`fecha_visita` = ag.`fecha`)
LEFT OUTER JOIN vm_encuesta en ON (en.`idmedico` = ag.`fk_id_medico`)
LEFT OUTER JOIN vw_bi_vm_rkg_medico_all rm ON (rm.`fk_id_medico` = ag.`fk_id_medico`),
so_medicos me
LEFT OUTER JOIN ku_municipios mu ON (me.`fk_id_estado` = mu.`fk_id_estado` AND  me.`fk_id_municipio` = mu.`id_municipio`)
WHERE ag.estado = 'A' 
AND ag.fk_id_medico = me.`id_medico`
AND ag.fk_id_usuario = ".$id_usuario."
AND ag.fecha = '".$fecha."'
)

union all

(
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
ag.`sugerencias`,
rm.agosto,
rm.julio,
rm.junio,
rm.`mayo`,
rm.`abril`,
rm.`marzo`,
rm.`febrero`,
rm.`enero`,
((rm.julio+rm.junio+rm.`mayo`+rm.`abril`+rm.`marzo`+rm.`febrero`+rm.`enero`)/7) as avg7,
((rm.agosto+rm.julio+rm.junio+rm.`mayo`+rm.`abril`+rm.`marzo`+rm.`febrero`+rm.`enero`)/7) as avg8,
TIMESTAMPDIFF(MONTH,`me`.`fecha_registro`,CURDATE()) AS `antiguedad`,
CASE
WHEN en.idmedico IS NULL THEN
  'No'
ELSE
  'Si'
END AS encuesta,
date(en.fechanacimiento) as fechanacimiento,
en.numerotransfer,
en.recibidigital
FROM vm_hoja_visita ag 
LEFT OUTER JOIN vm_encuesta en ON (en.`idmedico` = ag.`fk_id_medico`)
LEFT OUTER JOIN vw_bi_vm_rkg_medico_all rm ON (rm.`fk_id_medico` = ag.`fk_id_medico`),
so_medicos me
LEFT OUTER JOIN ku_municipios mu ON (me.`fk_id_estado` = mu.`fk_id_estado` AND me.`fk_id_municipio` = mu.`id_municipio` )
WHERE ag.estado = 'A' 
AND ag.fk_id_medico = me.`id_medico`
AND ag.`fk_id_medico` NOT IN (SELECT a.fk_id_medico FROM vm_agenda a WHERE a.`fecha` = ag.`fecha_visita`)
AND me.fk_id_usuario =  ".$id_usuario."
AND ag.fecha_visita = '".$fecha."'
)
order by hora
"

;

//echo $sql;

//echo $sql;
if ($result = mysqli_query($conexion, $sql)) {
  while($row = $result->fetch_assoc())
      {    

        $pdf->SetFont('Arial','',8);
        if($row['planeado']=='N'){
          $pdf->SetTextColor(0,0,255);
        }
        
        $pdf->cell(3);
        $pdf->Cell(10,5,$row['fk_id_medico'],0,0,'L');
        $pdf->Cell(60,5,utf8_decode($row['nombre']),0,0,'L');
        $pdf->Cell(15,5,$row['hora'],0,0,'L');
        $pdf->Cell(8,5,$row['planeado'],0,0,'C');
        $pdf->Cell(10,5,$row['hora_visita'],0,0,'C');
        if($row['antiguedad'] >= 0 and $row['antiguedad'] <= 1){
          $pdf->SetFillColor(224, 224, 224); // naranja
          $pdf->Cell(12,5,$row['antiguedad'],0,0,'C',true);
        }else{
          $pdf->Cell(12,5,$row['antiguedad'],0,0,'C');
        }
        
        if($row['agosto'] == 0){
          $pdf->SetTextColor(255,0,127);
        }
        $pdf->Cell(8,5,$row['agosto'],0,0,'C');
        $pdf->SetTextColor(0,0,0);
        if($row['planeado']=='N'){
          $pdf->SetTextColor(0,0,255);
        }
        $pdf->Cell(8,5,$row['julio'],0,0,'C');
        $pdf->Cell(8,5,$row['junio'],0,0,'C');
        $pdf->Cell(8,5,$row['mayo'],0,0,'C');
        $pdf->Cell(8,5,$row['abril'],0,0,'C');
        $pdf->Cell(8,5,$row['marzo'],0,0,'C');
        $pdf->Cell(8,5,$row['febrero'],0,0,'C');
        $pdf->Cell(8,5,$row['enero'],0,0,'C');

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

        if($row['avg8'] >= .1 and $row['avg8'] <= 1 ){
          $pdf->SetFillColor(255, 153, 51); // naranja
          $pdf->Cell(8,5, number_format(($row['avg8']),2) ,0,0,'C',true);
        }elseif($row['avg8'] == 0){
            $pdf->SetFillColor(255, 0, 0); // rojo
            $pdf->Cell(8,5, number_format(($row['avg8']),2) ,0,0,'C',true);
        }elseif($row['avg8'] >= 1.1 and $row['avg8'] <= 2 ){
              $pdf->SetFillColor(255, 255, 0); // amarillo
              $pdf->Cell(8,5, number_format(($row['avg8']),2) ,0,0,'C',true);
        }elseif($row['avg8'] >= 2.1 and $row['avg8'] <= 3 ){
              $pdf->SetFillColor(0, 204, 0); // verde
              $pdf->Cell(8,5, number_format(($row['avg8']),2) ,0,0,'C',true);
        }elseif($row['avg8'] >= 3.1  ){
              $pdf->SetFillColor(102, 178, 255); // azul
              $pdf->Cell(8,5, number_format(($row['avg8']),2) ,0,0,'C',true);
        }else{
              $pdf->Cell(8,5, number_format(($row['avg8']),2) ,0,0,'C');
        } 

        $pdf->Cell(10,5,utf8_decode(trim($row['encuesta'])),0,0,'C');
        $pdf->Cell(25,5,utf8_decode(trim($row['numerotransfer'])),0,0,'C');
        $pdf->Cell(20,5,(($row['fechanacimiento'])),0,0,'C');
        $pdf->Cell(8,5,utf8_decode(trim($row['recibidigital'])),0,0,'C');

        //$pdf->Cell(8,5, number_format(($row['avg8']),2) ,0,0,'C');
        // $pdf->Cell(120,5,utf8_decode(substr($row['quejas'],1,120)),0,0,'L');
	  
	  	if (strlen ($row['quejas']) > 0) 
  		{
  			$pdf->Ln(5);
  			$pdf->cell(8);
  			$pdf->Cell(120,5,'Queja: '.utf8_decode(trim($row['quejas'])),0,0,'L');
  		}

	  	if (strlen (trim($row['sugerencias'])) > 0 )
  		{
   	  	$pdf->Ln(5);
  			$pdf->cell(8);       	
  			$pdf->Cell(30,5,'Sugerencia: '.utf8_decode(trim($row['sugerencias'])),0,0,'L');
  		}
        
        $pdf->Ln(5);  
        $pdf->SetFont('Arial','I',6);        
        $pdf->cell(13);
        $pdf->Cell(75,5,utf8_decode($row['calle']).', '.$row['numero_exterior'].', '.utf8_decode($row['colonia']).', '.$row['cp'].', ' .$row['desc_municipio'].', ' .utf8_decode($row['referencia']).' -- ' .$row['telefono_fijo'].', ' .$row['telefono_movil'].', ' .$row['e_mail'],0,0,'L'); 
        $pdf->Ln(5);          
        $pdf->SetTextColor(0,0,0);
        

      }
}


$pdf->Output();

?>