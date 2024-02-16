<?php 

session_start();
include ("../../controladores/conex.php");

$td0 = $_POST['td0']; //Orden   
$td1 = $_POST['td1']; //Tipo  
$td2 = $_POST['td2']; //Concepto 
$td3 = $_POST['td3']; //Resultado
$td4 = $_POST['td4']; //Verificado
$observaciones = $_POST['observaciones'];
$factura = $_POST['factura'];
$estudio = $_POST['estudio'];


$query ="UPDATE cr_plantilla_2_re SET valor = '$td3', verificado = '$td4', observaciones = '$observaciones', validado = 1 WHERE orden = '$td0' AND fk_id_factura = $factura AND fk_id_estudio = $estudio";
 
$result = $conexion -> query($query);

$conexion->close();

?>