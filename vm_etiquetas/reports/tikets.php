<?php
date_default_timezone_set('America/Mexico_City');
header('Content-Type: text/html; charset=ISO-8859-1');
require('../../fpdf/fpdf.php');
 require_once ("../../so_factura/config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
 require_once ("../../so_factura/config/conexion.php");//Contiene funcion que conecta a la base de datos
 //require_once('../reports/barcode.inc.php'); 
include './barcode/barcode.php';
//se recibe los paramteros para la generación del reporte
$id_medico=$_GET['id_medico'];
//$studio=$_GET['studio'];

//new barCodeGenrator($numero_factura,1,'../reports/codes/'.$numero_factura.'.gif', 160, 50, true);

barcode('codes/'.$id_medico.'.png',$id_medico, 20, 'horizontal', 'code128', true);

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

class PDF extends FPDF
{
// Cabecera de página
  function Header()
  {

      global  $nombre,
              $foliofinal;


      $this->Ln(3);
      $this->Cell(3);
      $this->SetFont('Arial','',15);
      $this->Cell(33,5,utf8_decode($nombre),0,0,'L');

/*      
      $this->ln(6);
      $this->Cell(3);
      $this->SetFont('Arial','B',16);
      $this->Cell(75,5,$edad,0,'L');
*/
      $this->Ln(8);

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
$pdf = new PDF('L','mm','ticket');
//$pdf = new PDF('L','mm',array(80,60));
$pdf->SetMargins(0,0,0);
$pdf->SetAutoPageBreak(true,20);

$pdf->AliasNbPages();
$pdf->AddPage();

$folioinicial = $foliofinal+1;


$idx = $foliofinal;
$foliofinal = $foliofinal+24;
while ($idx <= ($foliofinal)) {
    $idx=$idx+1;

    $entro=1;
    $pdf->ln(6);
    $pdf->Cell(3);
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(75,5,$idx,0,0,'L');

    $pdf->Cell(5);
    $pdf->ln(0);
    $pdf->SetFont('Arial','B',18);
    $pdf->Image('../reports/codes/'.$id_medico.'.png',0,35,100,40);
    $pdf->ln(20); 
    
}

if($entro == 1){
  $stmt_insert = "
    INSERT INTO so_medicos_etq
                (fk_id_empresa,
                 id_etiqueta,
                 fk_id_medico,
                 folio_inicio,
                 folio_final,
                 num_ocupadas,
                 lote,
                 fecha_impresion,
                 fecha_actualiza,
                 estado)
    VALUES (1,
            0,
            $id_medico,
            $folioinicial,
            $idx,
            0,
            now(),
            now(),
            NULL,
            'A')
  ";  
  $result = $con -> query($stmt_insert);
}

$pdf->Output();
?>