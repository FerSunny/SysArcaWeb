<?php
date_default_timezone_set('America/Mexico_City');
header('Content-Type: text/html; charset=ISO-8859-1');
require('../../fpdf/fpdf.php');
 require_once ("../../so_factura/config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
 require_once ("../../so_factura/config/conexion.php");//Contiene funcion que conecta a la base de datos
 //require_once('../reports/barcode.inc.php'); 
//include './barcode/barcode.php';
//se recibe los paramteros para la generación del reporte

require_once('code128.php');

$numero_factura=$_GET['numero_factura'];
//$studio=$_GET['studio'];

//new barCodeGenrator($numero_factura,1,'../reports/codes/'.$numero_factura.'.gif', 160, 50, true);
$id_factura_num=(int)$numero_factura;

//barcode('codes/'.$id_factura_num.'.png',$id_factura_num, 25, 'horizontal', 'code128', true);

//Obtener los datos, de la cabecera, (datos del estudio)
$sql="SELECT fa.id_factura,
  DATE(fa.fecha_factura) AS fecha_factura, 
    UPPER(su.desc_sucursal) AS desc_sucursal,
    SUBSTRING(CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno),1,25) paciente,
    CASE 
      WHEN cl.anios > 0 THEN
        CONCAT(cl.anios,' Años')
      WHEN cl.dias > 0 THEN
        CONCAT(cl.dias,' Dias')
      WHEN cl.meses > 0 THEN
        CONCAT(cl.meses,' Meses')
    END AS edad,
    urgente,
    pendiente
    FROM so_factura fa
    LEFT OUTER JOIN kg_sucursales su ON (su.id_sucursal = fa.fk_id_sucursal)
    LEFT OUTER JOIN so_clientes cl ON (cl.id_cliente = fa.fk_id_cliente)
    WHERE fa.id_factura= ".$numero_factura;
 //echo $sql;
    if ($result = mysqli_query($con, $sql)) {
        while($row = $result->fetch_assoc())
        {
            $paciente=$row['paciente'];
            $fecha_factura=$row['fecha_factura'];
            $desc_sucursal=$row['desc_sucursal'];
            $edad=utf8_decode($row['edad']);
            $urgente=utf8_decode($row['urgente']);
            $pendiente=utf8_decode($row['pendiente']);
        }
    }

class PDF extends FPDF
{
// Cabecera de página
  function Header()
  {

      global  $paciente,
              $fecha_factura,
              $edad,
              $desc_sucursal;


      $this->Ln(3);
      $this->Cell(3);
      $this->SetFont('Arial','',15);
      $this->Cell(33,5,$fecha_factura,0,0,'L');
      $this->Cell(47,5,$desc_sucursal,0,0,'L');

      $this->ln(10);
      $this->Cell(3);
      $this->SetFont('Arial','B',20);
      $this->Cell(77,5,utf8_decode($paciente),0,'L');

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
//$pdf = new PDF('L','mm','ticket');
//$pdf = new PDF('L','mm',array(80,60));

$pdf=new PDF_Code128('L','mm',array(100,60));
//$pdf->AddPage();

$pdf->SetMargins(0,0,0);
$pdf->SetAutoPageBreak(true,30);

$pdf->AliasNbPages();
$pdf->AddPage();

$sql="

-- Muestra UNO (0)

SELECT df.id_factura,
       es.iniciales,
       mu.`recoleccion`
FROM so_detalle_factura df
LEFT OUTER JOIN km_estudios es ON (es.id_estudio = df.fk_id_estudio)
LEFT OUTER JOIN km_muestras mu ON (mu.`id_muestra` = es.`fk_id_muestra`and mu.estado = 'A')
WHERE fk_id_muestra <> 539
  AND es.`per_paquete`='No'
  AND df.id_factura= ".$numero_factura." 

UNION ALL 

-- Muestra DOS (1)

SELECT df.id_factura,
       es.iniciales,
       mu.`recoleccion`
FROM so_detalle_factura df
LEFT OUTER JOIN km_estudios es ON (es.id_estudio = df.fk_id_estudio)
LEFT OUTER JOIN km_muestras mu ON (mu.`id_muestra` = es.`fk_id_muestra_1` and mu.estado = 'A')
WHERE fk_id_muestra_1 <> 539
  AND es.`per_paquete`='No'
  AND df.id_factura= ".$numero_factura." 

UNION ALL 

-- Muestra TRES (2)

SELECT df.id_factura,
       es.iniciales,
       mu.`recoleccion`
FROM so_detalle_factura df
LEFT OUTER JOIN km_estudios es ON (es.id_estudio = df.fk_id_estudio)
LEFT OUTER JOIN km_muestras mu ON (mu.`id_muestra` = es.`fk_id_muestra_2` and mu.estado = 'A')
WHERE fk_id_muestra_2 <> 539
  AND es.`per_paquete`='No'
  AND df.id_factura= ".$numero_factura." 

UNION ALL 

-- Muestra CUATRO (3)

SELECT df.id_factura,
       es.iniciales,
       mu.`recoleccion`
FROM so_detalle_factura df
LEFT OUTER JOIN km_estudios es ON (es.id_estudio = df.fk_id_estudio)
LEFT OUTER JOIN km_muestras mu ON (mu.`id_muestra` = es.`fk_id_muestra_3` and mu.estado = 'A')
WHERE fk_id_muestra_3 <> 539
  AND es.`per_paquete`='No'
  AND df.id_factura= ".$numero_factura." 

UNION ALL
-- Muestra CINCO (4)

SELECT df.id_factura,
       es.iniciales,
       mu.`recoleccion`
FROM so_detalle_factura df
LEFT OUTER JOIN km_estudios es ON (es.id_estudio = df.fk_id_estudio)
LEFT OUTER JOIN km_muestras mu ON (mu.`id_muestra` = es.`fk_id_muestra_4` and mu.estado = 'A')
WHERE fk_id_muestra_4 <> 539
  AND es.`per_paquete`='No'
  AND df.id_factura= ".$numero_factura."

UNION ALL

SELECT df.`id_factura`, es.`iniciales`,mu.`recoleccion`
FROM km_paquetes pq,
     km_estudios es
     LEFT OUTER JOIN km_muestras mu ON (mu.`id_muestra` = es.`fk_id_muestra`),
     so_detalle_factura df
WHERE pq.`fk_id_estudio` = es.`id_estudio`
  AND pq.`id_paquete` = df.fk_id_estudio
  AND es.`estatus`='A'
  AND pq.`estado`='A'
  AND es.`fk_id_muestra` <> 539
  AND df.`id_factura` = ".$numero_factura."
  ORDER BY 2";

  if ($result = mysqli_query($con, $sql)) {
    while($row = $result->fetch_assoc())
      {
              
              $pdf->Cell(5);
              $pdf->ln(1);
              $pdf->SetFont('Arial','B',18);
              $pdf->Cell(40,5,$fecha_factura,0,0,'L');
              $pdf->Cell(47,5,$desc_sucursal,0,0,'L');
              $pdf->ln(6);
              $pdf->Cell(77,5,utf8_decode($paciente),0,'L');
              $pdf->ln(5.5);
              $pdf->Cell(1);
              $pdf->Cell(30,5,$edad,0,'L');
              $pdf->Cell(70,5,' - '.$row['iniciales'],0,0,'L');
              if($urgente == 1){
                $pdf->SetTextColor(255,0,0);
                $pdf->Cell(5,5,'U',0,0,'L');
                $pdf->SetTextColor(51,0,0);
              }
              if($pendiente == 1){
                $pdf->SetTextColor(0,204,0);
                $pdf->Cell(5,5,'P',0,0,'L');
                $pdf->SetTextColor(51,0,0);
              }
              $pdf->ln(6);
              $pdf->Cell(1);
              $pdf->Cell(30,5,$row['recoleccion'],0,'L');
              $pdf->Code128(5,30,$numero_factura,80,20);
              $pdf->ln(6);
              $pdf->Cell(1);
              $pdf->Cell(90,5,$numero_factura,0,0,'R');
              //$pdf->Write(5,$numero_factura);


            //  $pdf->Image('../reports/codes/'.$numero_factura.'.png',0,35,100,40);

              $pdf->ln(20);

              //$pdf->AddPage();
      }
  }  
$pdf->Output();
?>