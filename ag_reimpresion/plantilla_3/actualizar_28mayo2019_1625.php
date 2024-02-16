<?php 

	session_start();
	include ("../../controladores/conex.php");

	$td0 = $_POST['td0']; //Orden
	$td1 = $_POST['td1']; //Tipo
	$td2 = $_POST['td2']; //Concepto
	$td3 = $_POST['td3']; //Resultado
	$observaciones = $_POST['observaciones'];
	$factura = $_POST['factura'];
	$estudio = $_POST['estudio'];

 	$stmt = $conexion->prepare("UPDATE cr_plantilla_cvo_re SET valor = ?, observaciones = ? WHERE orden = ? AND fk_id_factura = ? AND fk_id_estudio = ?");

	$stmt->bind_param('ssdii', $td3,$observaciones,$td0,$factura,$estudio);
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