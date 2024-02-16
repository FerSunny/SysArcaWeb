<?php
session_start();
date_default_timezone_set('America/Mexico_City');
header('Content-Type: text/html; charset=ISO-8859-1');
require('../../fpdf/fpdf.php');
 require_once ("../../so_factura/config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
 require_once ("../../so_factura/config/conexion.php");//Contiene funcion que conecta a la base de datos

//se recibe los paramteros para la generación del reporte
$numero_factura=$_GET['numero_factura'];
$studio=$_GET['studio'];

$por_red=.13;
$alto=0;
$ancho=0;

$sql_imagenes="SELECT * FROM cr_plantilla_rx_img 
WHERE estado = 'A'
AND id_imagen =".$studio;
//echo $sql_imagenes;
if ($result = mysqli_query($con, $sql_imagenes)) {
  while($row = $result->fetch_assoc())
  {
      $nombre=$row['nombre'];
      $ruta=$row['ruta'];
      $v_alto=$row['alto'];
      $v_ancho=$row['ancho'];

      $imagen="../img_rx/".$numero_factura."/".$row['nombre'];

	  $pdf = new FPDF(); 
	  $pdf->AddPage(); 
	  
            $columna=5;
            $renglon=3;
	  
	  		$alto=$alto-($v_alto*$por_red);
	  		$ancho=$ancho-($v_ancho*$por_red);
	  
            $pdf->Image($imagen,$columna,$renglon,$alto,$ancho);
           
	  
  }
}
$pdf->Output();
?>