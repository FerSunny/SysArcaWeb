<?php 
date_default_timezone_set('America/Mexico_City');
require('../../fpdf/fpdf.php');
require_once ("../../so_factura/config/db.php");//Contiene las variables de configuracion para conectar a la 
require_once ("../../so_factura/config/conexion.php");//Contiene funcion que conecta a la base de datos
$factura=$_GET['factura'];


$query = "SELECT CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno) paciente FROM so_factura fa
LEFT OUTER JOIN so_clientes cl ON (cl.id_cliente = fa.fk_id_cliente)
WHERE fa.id_factura = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i",$factura);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc())
{
  $paciente = $row['paciente'];
  
}

$stmt->close();


$stmt = $con->prepare("SELECT * FROM so_c_publicidad WHERE estado = 'A'");
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc())
{
  $titulo = $row['titulo'];
  $texto = $row['texto'];
  
}

$stmt->close();


class PDF extends FPDF
{

  function Header()
  {

      global  $paciente;

  }

  function Cuerpo()
  {
    global  $paciente,$titulo,$texto;

    $this->ln(10);
    $this->Cell(3);
    $this->SetFont('Arial','B',16);
    $this->SetXY(80,10);
    $this->Cell(77,5,utf8_decode($titulo),0,'J');
    $this->Ln(5);

    $this->Ln(5);
    $this->SetXY(15,30);
    $this->SetFont('Arial','',12);
    $this->MultiCell(180,5,$texto,0,'J');
    $this->ln(20);
    $this->SetXY(50,140);
    $this->Cell(77,5,"_____________________________________________",0,'J');
    $this->SetXY(61,148);
    $this->Cell(77,5,utf8_decode($paciente),0,'J');
  }


}

$pdf = new PDF('P','mm','Letter');
$pdf->SetMargins(0,0,0);
$pdf->SetAutoPageBreak(true,20);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Cuerpo();
$pdf->Output();


 ?>