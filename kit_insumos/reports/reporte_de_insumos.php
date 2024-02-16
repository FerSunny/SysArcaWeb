<?php
session_start();
date_default_timezone_set('America/Mexico_City');
header('Content-Type: text/html; charset=ISO-8859-1');
require('../../fpdf/fpdf.php');
include ("../../controladores/conex.php");

$fk_id_sucursal=$_SESSION['fk_id_sucursal'];
$id_usuario=$_SESSION['nombre'];

$query = "SELECT
  id_usuario,
  id_usr,
  fk_id_sucursal,
  nombre,
  a_paterno,
  a_materno,
  telefono_fijo,
  telefono_movil,
   us.mail,
  su.desc_sucursal
FROM se_usuarios us 
LEFT OUTER JOIN `kg_sucursales` su ON (su.id_sucursal = us.fk_id_sucursal)
WHERE us.activo = 'A' 
AND id_usr= '" . $id_usuario . "' ";
//echo $query;
$resultado = mysqli_query($conexion, $query);

if($row = mysqli_fetch_array($resultado))
{
  $sucursal=$row['desc_sucursal'];
}

class PDF extends FPDF
{
// Cabecera de página
  function Header()
  {

    global $sucursal;
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
      $this->Cell(180,5,'LABORATORIOS ARCA',0,0,'C');
      $this->Ln(5);
      $this->SetFont('Arial','B',12);
      $this->Cell(190,10,'REPORTE DE INSUMOS',0,0,'C');
      $this->Ln(10);
      $this->SetFont('Arial','B',10);
      $this->Cell(17,10,'UNIDAD: ',0,0,'L');
      $this->SetFont('Arial','',10);
      $this->Cell(20,10,$sucursal,0,0,'L');
      $this->Cell(100);
      $this->Cell(20,10,utf8_decode($fecha),0,0,'L');
      $this->Ln(1);
      $this->Cell(250,10,'_____________________________________________________________________________________________________',0,0,'L');
      $this->Ln(4);
      $this->SetFont('Arial','B',8);
      $this->Cell(10,10,'FOLIO',0,0,'C');
      $this->Cell(60,10,'PACIENTE',0,0,'C');
      $this->Cell(65,10,'PRODUCTO',0,0,'C');
      $this->Cell(20,10,'CANTIDAD',0,0,'C');
      $this->Cell(35,10,'FECHA REGISTRO',0,0,'C');
      $this->Ln(1);
      $this->Cell(250,10,'______________________________________________________________________________________________________________________________',0,0,'L');
      // Salto de línea
      $this->Ln(5);
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
$v_id_factura='0';
$v_nombre='0';

$sql="SELECT
  f.`fk_id_factura`,
  f.`fk_id_producto`,
  pr.`desc_producto`,
  f.`cantidad`,
  f.`fecha_registro`,
  CONCAT(cl.nombre,' ',cl.`a_paterno`,' ',cl.`a_materno`) AS nombre
FROM `bd_arca`.`tm_folio_articulo` f
LEFT OUTER JOIN eb_productos pr ON (pr.`id_producto` = f.`fk_id_producto`)
LEFT OUTER JOIN so_factura fa ON (fa.`id_factura` = f.`fk_id_factura`)
LEFT OUTER JOIN so_clientes cl ON (cl.`id_cliente` = fa.`fk_id_cliente`)
WHERE f.estado = 'A'
AND f.fk_id_sucursal = ".$fk_id_sucursal."
order by 1,2";
//echo $sql;
if ($result = mysqli_query($conexion, $sql)) {
  while($row = $result->fetch_assoc())
      {
        $pdf->Ln(5);
        $pdf->SetFont('Courier','',9);

        if ($v_id_factura != $row['fk_id_factura']) {
          $pdf->Cell(15,5,$row['fk_id_factura'],0,0,'L');
          $v_id_factura = $row['fk_id_factura'];
        }else {
          $pdf->Cell(15,5,"",0,0,'L');
        }

        if ($v_nombre != $row['fk_id_factura']) {
          $pdf->Cell(55,5,utf8_decode($row['nombre']),0,0,'L');
          $v_nombre = $row['fk_id_factura'];
        }else {
          $pdf->Cell(55,5,"",0,0,'L');
        }

        $pdf->Cell(67,5,utf8_decode($row['desc_producto']),0,0,'L');
      
        $pdf->Cell(20,5,$row['cantidad'],0,0,'L');

        $pdf->Cell(45,5,$row['fecha_registro'],0,0,'L');

        
      }
}


$pdf->Output();

?>