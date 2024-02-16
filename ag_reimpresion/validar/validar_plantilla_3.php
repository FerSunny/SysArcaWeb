<?php 
	session_start();
	include ("../../controladores/conex.php");

$factura = $_POST['factura'];
$estudio = $_POST['estudio'];	

$stmt = $conexion->prepare("UPDATE cr_plantilla_cvo_re SET validado = 1 WHERE fk_id_factura = ? AND fk_id_estudio = ?");
$stmt->bind_param('ii', $factura,$estudio);
$result = $stmt->execute();

if($result)
{
 echo 1;
}else
{
	$codigo = mysqli_errno($conexion); 
  	echo $codigo;
}
$stmt->close();
 ?>