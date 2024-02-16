<?php
session_start();
date_default_timezone_set('America/Mexico_City');
header('Content-Type: text/html; charset=ISO-8859-1');
require('../../fpdf/fpdf.php');
include ("../../controladores/conex.php");

//$fk_id_sucursal=$_SESSION['fk_id_sucursal'];
//$id_usuario=$_SESSION['nombre'];

$id_estudio=$_GET['id_estudio'];
$numot=$_GET['numot'];

//echo $periodo;



class PDF extends FPDF
{
// Cabecera de página
  function Header()
  {

    global $desc_zona,$periodo ;
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
     // $this->Image('../imagenes/logo_arca.png',13,7,40,15);
      
      $this->SetTextColor(0,0,255);
      $this->Cell(200,5,'LABORATORIOS ARCA',0,0,'C');
      $this->SetTextColor(0,102,204);
      $this->Ln(5);

      $this->SetTextColor(0,0,255);
      $this->Cell(3);
      $this->SetFont('Arial','B',12);
      $this->Cell(200,15,'Lista de trabajo',0,0,'C');
      $this->Ln(10);
      $this->Cell(3);
      $this->SetTextColor(0,0,0);
      $this->SetFont('Arial','B',10);
     // $this->Cell(17,10,'Zona: ',0,0,'L');
      $this->SetFont('Arial','',10);
      $this->Cell(20,10,$desc_zona,0,0,'L');
      $this->Cell(100);
      $this->Cell(20,10,utf8_decode($fecha),0,0,'L');
      $this->Ln(1);
      $this->Cell(3);
      $this->Cell(193,10,'_________________________________________________________________________________________________',0,0,'L');
      $this->Ln(4);
      $this->Cell(3);
      $this->SetFont('Arial','B',8);
      $this->Cell(5,10,'#',0,0,'L');
      $this->Cell(13,10,'Suc.',0,0,'L');
      $this->Cell(12,10,'OT',0,0,'L');
      $this->Cell(19,10,'Fecha Ot',0,0,'L');
      $this->Cell(65,10,'Paciente',0,0,'L');
      $this->Cell(9,10,'Edad',0,0,'L');
      $this->Cell(25,10,'Estudio',0,0,'L');
      $this->Cell(15,10,'Fecha Entrega',0,0,'L');
      $this->Ln(1);
      $this->Cell(3);
      $this->Cell(193,10,'_________________________________________________________________________________________________________________________',0,0,'L');
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
$pdf = new PDF('P','mm','Letter');
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
  su.`desc_corta`,
  fa.`id_factura`,
  DATE(fa.`fecha_factura`) AS fecha_ot,
  CONCAT(cl.`nombre`,' ',cl.`a_paterno`,' ',cl.`a_materno`) AS paciente,
  cl.`anios`,
  es.`iniciales`,
  fa.`fecha_entrega`
FROM
  so_factura fa,
  so_detalle_factura df,
  kg_sucursales su,
  so_clientes cl,
  km_estudios es
  WHERE fa.`id_factura` = df.`id_factura` 
  AND DATE(fa.`fecha_factura`) = CURDATE()
  AND fa.`fk_id_sucursal` = su.`id_sucursal` 
  AND fa.`fk_id_cliente` = cl.`id_cliente`
  AND df.`fk_id_estudio` = es.`id_estudio`
  AND df.`fk_id_estudio` = $id_estudio 
";
//echo $sql;

if ($result = mysqli_query($conexion, $sql)) {
  while($row = $result->fetch_assoc())
      {
        
        $pdf->cell(3);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(5,5,$numero,0,0,'L');
        $pdf->Cell(13,5,$row['desc_corta'],0,0,'L');
        $pdf->Cell(12,5,$row['id_factura'],0,0,'L');
        $pdf->Cell(19,5,$row['fecha_ot'],0,0,'L');
        $pdf->Cell(65,5,$row['paciente'],0,0,'L');
        $pdf->Cell(8,5,$row['anios'],0,0,'L');
        $pdf->Cell(30,5,$row['iniciales'],0,0,'L');
        $pdf->Cell(12,5,$row['fecha_entrega'],0,0,'L');
        $numero+=1;
        $pdf->Ln(4);
      }

}


$pdf->Output();

?>