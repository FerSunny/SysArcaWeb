<?php 
	session_start();
	include ("../../controladores/conex.php");

$factura = $_POST['factura'];
$estudio = $_POST['estudio'];	

$query = "UPDATE cr_plantilla_2_re SET validado = 1 WHERE fk_id_factura = $factura AND fk_id_estudio = $estudio";

$result = $conexion->query($query);

if($result)
{
 echo 1;
}else
{
	$codigo = mysqli_errno($conexion); 
  	echo $codigo;
}
$conexion->close();

 ?>