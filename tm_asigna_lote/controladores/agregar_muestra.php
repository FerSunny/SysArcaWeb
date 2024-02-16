<?php 
date_default_timezone_set('America/Mexico_City');
session_start();
include ("../../controladores/conex.php");
$nombre = $_SESSION['nombre'];
$lote = $_SESSION['lote'];
$lote_max = $_SESSION['lote_max'];
//$id_factura=$_POST['id_factura'];
//$studio=$_POST['id_estudio'];
$id_toma=$_POST['id_toma'];
$fecha_toma=date("y/m/d H:i:s");
//$echo $lote;
//echo 'id_facttura='.$id_factura;
$query ="update tm_tomas set lote = '$lote',ultimo_lote = '$lote_max' where id_toma = $id_toma";

//echo $query;

$result = $conexion -> query($query);
if ($result) {
   echo 1;
   
}else{
  $codigo = mysqli_errno($conexion); 
  echo $codigo;
}
$conexion->close();


?>
