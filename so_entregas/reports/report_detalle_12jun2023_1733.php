<?php
session_start();
date_default_timezone_set('America/Mexico_City');
header('Content-Type: text/html; charset=ISO-8859-1');
require('../../fpdf/fpdf.php');
include ("../../controladores/conex.php");

$id_sucursal=$_GET['id_sucursal'];
$servicio=$_GET['servicio'];

// obtenemos el nombre de la secursal
$query = "SELECT * FROM kg_sucursales
WHERE id_sucursal = ".$id_sucursal;
//echo $query;
$resultado = mysqli_query($conexion, $query);

if($row = mysqli_fetch_array($resultado))
{
  $desc_sucursal=$row['desc_sucursal'];
  //$dia=curdate();
  //$hora=time();
}

// obtenemos el nombre del servicio
$query1 = "SELECT * FROM km_tipo_estudio
WHERE id_tipo_estudio = ".$servicio;
//echo $query;
$resultado1 = mysqli_query($conexion, $query1);

if($row1 = mysqli_fetch_array($resultado1))
{
  $nombre_tipo_estudio=$row1['nombre_tipo_estudio'];
}



class PDF extends FPDF
{
// Cabecera de página
  function Header()
  {

    global $desc_sucursal,$nombre_tipo_estudio;
      // Logo
      //$this->Image('logo_pb.png',10,8,33);
      // Arial bold 15
      setlocale(LC_ALL,"es_ES");
      $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
      $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
      $fecha=$dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
      

      $this->SetFont('Arial','B',14);
      // Movernos a la derecha
      $this->Cell(3);
      // Título
      $this->Image('../imagenes/logo_arca.png',13,7,40,15);
      /*
      $this->SetTextColor(0,0,255);
      $this->Cell(193,5,'LABORATORIOS ARCA',0,0,'C');
      $this->SetTextColor(0,102,204);
      $this->Ln(5);
      */
      $this->SetTextColor(0,0,255);
      $this->Cell(3);
      $this->SetFont('Arial','B',12);
      $this->Cell(200,15,'LISTA DE PENDIENTES DE'.' ('.$nombre_tipo_estudio.')',0,0,'C');
      $this->Ln(10);
      $this->Cell(3);
      $this->SetTextColor(0,0,0);
      $this->SetFont('Arial','B',10);
      $this->Cell(17,10,'Sucursal: ',0,0,'L');
      $this->SetFont('Arial','',10);
      $this->Cell(20,10,$desc_sucursal,0,0,'L');
      $this->Cell(100);
      $this->Cell(20,10,utf8_decode($fecha),0,0,'L');
      $this->Ln(1);
      $this->Cell(3);
      $this->Cell(193,10,'_______________________________________________________________________________________________________',0,0,'L');
      $this->Ln(4);
      $this->Cell(10);
      $this->SetFont('Arial','B',8);
      $this->Cell(15,10,'Folio',0,0,'L');
      $this->Cell(15,10,'Edad',0,0,'L');
      $this->Cell(70,10,'Paciente',0,0,'C');
      $this->Cell(73,10,'Estudio',0,0,'C');
      $this->Cell(30,10,'Hora',0,0,'C');
     // $this->Cell(30,10,'Firma',0,0,'C');
      $this->Ln(1);
      $this->Cell(3);
      $this->Cell(193,10,'_________________________________________________________________________________________________________________________________',0,0,'L');
      // Salto de línea
      $this->Ln(10);
  }

  // Pie de página
  function Footer()
  {
      // Posición: a 1,5 cm del final
      $this->SetY(-15);
      // Arial italic 8
      $this->SetFont('Arial','I',8);
      // Número de página
      $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
  }
}

// Creación del objeto de la clase heredada
$pdf = new PDF('L','mm','Letter');
$pdf->SetAutoPageBreak(true,25);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);

$numero='1';
$corte_sucursal='0';
$imp_sucursal='0';
$primer_vez='s';
$total_comision='0';
$totgra_comision='0';


$sql="
SELECT
fa.`id_factura`,
cl.`anios`,
CONCAT(cl.`nombre`,' ',cl.`a_paterno`,' ',cl.`a_materno`) paciente,
es.`desc_estudio`,
TIME(fa.`fecha_entrega`) AS hora_entrega
FROM so_factura fa, so_detalle_factura df,so_clientes cl, km_estudios es
WHERE fa.`estado_factura` <> 5
AND DATE(fa.`fecha_entrega`) = CURDATE()
AND fa.`id_factura` = df.`id_factura`
AND fa.`fk_id_cliente` = cl.`id_cliente`
AND df.`fk_id_estudio` = es.`id_estudio`
AND fa.fk_id_sucursal = $id_sucursal
AND es.`fk_id_tipo_estudio` = $servicio
  ";
//echo $sql;
if ($result = mysqli_query($conexion, $sql)) {
  while($row = $result->fetch_assoc())
      {        
        $pdf->cell(3);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(5,5,$numero,0,0,'L');
        $pdf->Cell(20,5,$row['id_factura'],0,0,'L');
        $pdf->Cell(10,5,$row['anios'],0,0,'L');
        $pdf->Cell(55,5,trim($row['paciente']),0,0,'L');
        $pdf->Cell(100,5,$row['desc_estudio'],0,0,'L');
        $pdf->Cell(10,5,$row['hora_entrega'],0,0,'L');
        $numero+=1;

        $pdf->Ln(5);
      }
}

//$nomrep = 'Pendientes'.$dia.$hora.$desc_sucursal.$nombre_tipo_estudio

$pdf->Output();
//$pdf->Output("../emails_pdf/".$nomrep.".pdf","F");

?>