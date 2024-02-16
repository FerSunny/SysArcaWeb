<?php 

	session_start();
	include ("../../../controladores/conex.php");
	date_default_timezone_set('America/Mexico_City');
	$fecha = date("Y-m-d H:i:s");
	$td0 = $_POST['td0']; //Orden
	$td1 = $_POST['td1']; //Tipo
	$td2 = $_POST['td2']; //Concepto
	$td3 = $_POST['td3']; //Resultado
	$td4 = $_POST['td4']; //Verificado
	$td5 = $_POST['td5']; //Unidad de medida
	$td6 = $_POST['td6']; //Valor Referencia
	$observaciones = $_POST['observaciones'];
	$factura = $_POST['factura'];
	$estudio = $_POST['estudio'];
	$eritrocitos='0';
	$hematocrito='0';
	$hemoglobina='0';


	$stmt = $conexion->prepare("UPDATE cr_plantilla_1_re SET valor = ?, verificado = ?, fecha_modificacion = ? WHERE orden = ? AND fk_id_factura = ? AND fk_id_estudio = ?");
    $stmt->bind_param('ssssii', $td3,$td4,$fecha,$td0,$factura,$estudio);

	if($stmt->execute())
	{
		echo 1;
	}else{
		$codigo = mysqli_errno($conexion); 
	  	echo $sql;
	}
	
	$stmt->close();
?>