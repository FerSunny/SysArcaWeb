<?php

session_start();

date_default_timezone_set('America/Mexico_City');

header('Content-Type: text/html; charset=ISO-8859-1');

require('../../fpdf/fpdf.php');

 require_once ("../../so_factura/config/db.php");//Contiene las variables de configuracion para conectar a la base de datos

 require_once ("../../so_factura/config/conexion.php");//Contiene funcion que conecta a la base de datos



//se recibe los paramteros para la generación del reporte

$id_imagen=$_GET['id_imagen'];

$fk_id_queja=$_GET['fk_id_queja'];



$por_red=.15;

$alto=0;

$ancho=0;



$sql_imagenes="SELECT * FROM ac_quejas_img 

WHERE estado = 'A'

AND id_imagen =".$id_imagen;

//echo $sql_imagenes;

if ($result = mysqli_query($con, $sql_imagenes)) {

  while($row = $result->fetch_assoc())

  {

      $nombre=$row['nombre'];

      $ruta=$row['ruta'];

      $v_alto=$row['alto'];

      $v_ancho=$row['ancho'];



      $imagen=$ruta.$row['nombre'];

//echo $imagen;

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