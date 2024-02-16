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

    $this->Cell(30,5,'Fecha',0,0,'C');
    $this->Cell(3,5,'Id',0,0,'C');
    $this->Cell(85,5,'Medico',0,0,'C');
    $this->Cell(10,5,'Hora',0,0,'C');
    $this->Cell(20,5,'Planeado',0,0,'C');



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


$fecha_cambio ='';


$sql="
SELECT 
date_format(ag.fecha,'%D %W %Y') as fecha,
ag.planeado,
ag.fk_id_medico, 
CONCAT(me.nombre,' ',me.`a_paterno`,' ',me.`a_materno`) AS nombre, 
ag.hora,
 me.`colonia`
FROM vm_agenda ag, so_medicos me 
WHERE ag.estado = 'A' 
AND ag.fk_id_medico = me.`id_medico`
AND ag.fk_id_usuario = ".$id_usuario."
AND monthname(ag.fecha) = '".$fecha."'
ORDER BY ag.fecha, ag.hora
"
;

//echo $sql;

//echo $sql;
if ($result = mysqli_query($conexion, $sql)) {
  while($row = $result->fetch_assoc())
      {    

        $pdf->SetFont('Arial','',8);

        $pdf->cell(3);
        if ($fecha_cambio <> $row['fecha'])
        {
         $pdf->Cell(29,5,$row['fecha'],0,0,'L'); 
         $fecha_cambio =$row['fecha'];
        }
        else{
          $pdf->cell(29);
        }
        
        $pdf->Cell(10,5,$row['fk_id_medico'],0,0,'L');
        $pdf->Cell(75,5,$row['nombre'],0,0,'L');
        $pdf->Cell(15,5,$row['hora'],0,0,'L');
        $pdf->Cell(10,5,$row['planeado'],0,0,'C');
        $pdf->Ln(5);  
        $pdf->SetFont('Arial','I',6);        
        $pdf->cell(32);
        $pdf->Cell(75,5,$row['colonia'],0,0,'L'); 
        $pdf->Ln(5);          

        

      }
}


$pdf->Output();

?>