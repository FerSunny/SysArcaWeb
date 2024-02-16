<?php
session_start();
date_default_timezone_set('America/Mexico_City');
header('Content-Type: text/html; charset=ISO-8859-1');
require('../../fpdf/fpdf.php');
include ("../../controladores/conex.php");

$id_usuario=$_GET['id_usuario'];
$id_zona=$_GET['id_zona'];

//$anio=2021;
//$mes=1;

$fecha= date('d-m-Y');

$sql="
SELECT 	CONCAT(us.nombre,' ',us.a_paterno, ' ',us.a_materno) AS nombre
FROM  se_usuarios us
WHERE id_usuario = ".$id_usuario
;

//echo $sql;
if ($result = mysqli_query($conexion, $sql)) {
  while($row = $result->fetch_assoc())
      {    
        $nombre_vm = $row['nombre'] ;
      }
}

// obtenemos el nombre de la zona
$sql2="
SELECT  z.desc_zona
FROM  kg_zonas z
WHERE id_zona = ".$id_zona
;

//echo $sql;
if ($result2 = mysqli_query($conexion, $sql2)) {
  while($row2 = $result2->fetch_assoc())
      {    
        $desc_zona = $row2['desc_zona'] ;
      }
}



class PDF extends FPDF
{
// Cabecera de página
  function Header()
  {

    global $fecha,
            $id_usuario,
            $desc_zona,
            $nombre_vm;


    $this->Image('../../imagenes/logo_arca.png',15,5,30,0);
    $this->Image('../../imagenes/logo_arca_sys_web.jpg',75,150,90,0);


    $this->cell(3);
    $this->SetFont('Arial','',12);
    $this->SetTextColor(0,0,0);
    $this->Cell(190,5,'Laboratorios ARCA',0,0,'C');
    $this->Ln(5);
    $this->cell(3);
    $this->Cell(190,5,'Reporte de medicos de la zona '.$desc_zona,0,0,'C');
    $this->Ln(5);
    $this->cell(3);
    $this->Cell(15,5,'Fecha: '.$fecha,0,0,'L');
    $this->cell(55);
    $this->Cell(15,5,'VM: '.$id_usuario."-".$nombre_vm,0,0,'L');
    $this->SetFont('Arial','',8);
    $this->Ln(3);
    $this->Cell(190,5,'------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------',0,0,'L');

    $this->Ln(3);
    $this->cell(3);

    $this->Cell(3,5,'Id',0,0,'C');
    $this->Cell(67,5,'Medico',0,0,'C');
    $this->Cell(35,5,'Telefono',0,0,'L');
    $this->Cell(25,5,'Celular',0,0,'L');
    $this->Cell(15,5,'Horario',0,0,'L');
    //$this->Cell(20,5,'Quejas',0,0,'C');
    //$this->Cell(40,5,'Sugerencias',0,0,'C');


    $this->Ln(3);

    $this->Cell(190,5,'------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------',0,0,'L');    
    $this->Ln(5);
  }

  // Pie de página
  function Footer()
  {
  $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
  }
}

// Creación del objeto de la clase heredada
$pdf = new PDF('L','mm','Letter');
$pdf->SetAutoPageBreak(true,15);
$pdf->AliasNbPages();
$pdf->AddPage();




$sql="
SELECT m.id_medico,
  CONCAT(m.`nombre`,' ',m.`a_paterno`,' ',m.`a_materno`) AS nombre,
  m.`telefono_fijo`,
  m.`telefono_movil`,
  m.`horario`,
  mu.`desc_municipio`,
  m.`colonia`,
  m.`calle`,
  m.`numero_exterior`,
  m.`cp`,
  m.`referencia`,
  m.`e_mail`
  
FROM so_medicos m
LEFT OUTER JOIN ku_municipios mu ON (mu.fk_id_estado = m.fk_id_estado AND mu.`id_municipio` = m.`fk_id_municipio`)
WHERE m.`estado` = 'A'
AND m.`fk_id_zona` = $id_zona
order by m.nombre,m.a_paterno,m.a_materno
"
;

//echo $sql;

//echo $sql;
if ($result = mysqli_query($conexion, $sql)) {
  while($row = $result->fetch_assoc())
      {    

        $pdf->SetFont('Arial','',8);
        /*
        if($row['planeado']=='N'){
          $pdf->SetTextColor(0,0,255);
        }
        */
        $pdf->cell(3);
        $pdf->Cell(10,5,$row['id_medico'],0,0,'L');
        $pdf->Cell(60,5,utf8_decode($row['nombre']),0,0,'L');
        $pdf->Cell(35,5,$row['telefono_fijo'],0,0,'L');
        $pdf->Cell(35,5,$row['telefono_movil'],0,0,'L');
        $pdf->Cell(20,5,$row['horario'],0,0,'L');
       // $pdf->Cell(35,5,$row['quejas'],0,0,'L');
       // $pdf->Cell(10,5,$row['sugerencias'],0,0,'L');
        
        $pdf->Ln(5);  
        $pdf->SetFont('Arial','I',6);        
        $pdf->cell(13);
        $pdf->Cell(75,5,utf8_decode($row['calle']).', '.$row['numero_exterior'].', '.utf8_decode($row['colonia']).', '.$row['cp'].', ' .$row['desc_municipio'].', ' .utf8_decode($row['referencia']).' -- ' .$row['e_mail'],0,0,'L'); 
        $pdf->Ln(5);          
        $pdf->SetTextColor(0,0,0);
        

      }
}


$pdf->Output();

?>