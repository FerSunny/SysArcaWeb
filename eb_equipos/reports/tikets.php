<?php
date_default_timezone_set('America/Mexico_City');
header('Content-Type: text/html; charset=ISO-8859-1');
require('../../fpdf/fpdf.php');
 require_once ("../../so_factura/config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
 require_once ("../../so_factura/config/conexion.php");//Contiene funcion que conecta a la base de datos
 //require_once('../reports/barcode.inc.php'); 
include './barcode/barcode.php';
//se recibe los paramteros para la generación del reporte
$id_medico=$_GET['codigo'];
$id_equipo = $_GET['id_equipo'];
//$studio=$_GET['studio'];

//new barCodeGenrator($numero_factura,1,'../reports/codes/'.$numero_factura.'.gif', 160, 50, true);

barcode('codes/'.$id_equipo.'.png',$id_equipo, 20, 'horizontal', 'code128', true);
/*
//Obtener los datos, de la cabecera, (datos del estudio)
$entro=0;
$sql="
SELECT m.`id_medico`, 
CONCAT(m.`nombre`,' ',m.`a_paterno`,' ',m.`a_materno`) AS nombre, 
MAX(e.folio_final) AS foliofinal 
FROM so_medicos m 
LEFT OUTER JOIN so_medicos_etq e ON (e.`fk_id_medico` = m.`id_medico`) 
WHERE m.`id_medico` = $id_medico 
GROUP BY 1,2
";
//echo $sql;
    if ($result = mysqli_query($con, $sql)) {
        while($row = $result->fetch_assoc())
        {
            $nombre=utf8_decode($row['nombre']);
            $foliofinal=($row['foliofinal']);
            if($foliofinal == NULL){
              $foliofinal=0;
            }
        }
    }
*/

class PDF extends FPDF
{
// Cabecera de página
  function Header()
  {

      global  $nombre,
              $foliofinal;

/*
      $this->Ln(3);
      $this->Cell(3);
      $this->SetFont('Arial','',15);
      $this->Cell(33,5,utf8_decode($nombre),0,0,'L');

      
      $this->ln(6);
      $this->Cell(3);
      $this->SetFont('Arial','B',16);
      $this->Cell(75,5,$edad,0,'L');
*/
      //$this->Ln(8);

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
//$pdf = new PDF('L','mm','ticket');
$pdf = new PDF('L','mm',array(100,60));
//$pdf = new PDF('L','mm',array(80,60));
$pdf->SetMargins(0,0,0);
$pdf->SetAutoPageBreak(true,20);

$pdf->AliasNbPages();
$pdf->AddPage();




    $pdf->Cell(5);
    $pdf->ln(0);
    $pdf->SetFont('Arial','B',18);
    $pdf->Image('../reports/codes/'.$id_equipo.'.png',1,27,100,40);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(1,5,'FOR-EQU-02',0,0,'L');
    $pdf->ln(16); 
    $pdf->Cell(4);
    $pdf->SetFont('Arial','',22);
    $pdf->Cell(1,5,$id_medico,0,0,'L');
    $pdf->ln(1); 
    




$pdf->Output();
?>