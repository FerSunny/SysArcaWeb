<?php 

	session_start();
	include ("../../../controladores/conex.php");
	date_default_timezone_set('America/Mexico_City');
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
	$fk_id_empresa = 1;
	$num_imp = 0;
	$tamfue = 11;
	$tipfue = 'B';
	$posini = 11;
	$fecha_registro = date("Y-m-d H:i:s");
	$origen = 'C';
	$fecha_impresion = null;

	$stmt = $conexion->prepare("INSERT INTO cr_plantilla_1_re(fk_id_empresa,fk_id_factura,fk_id_estudio,orden,tipo,concepto,valor,verificado,valor_refe,unidad_medida,observaciones,num_imp,tamfue,tipfue,posini,fecha_registro,fecha_impresion,origen) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param('iiidsssssssiisisss',$fk_id_empresa,$factura,$estudio,$td0,$td1,$td2,$td3,$td4,$td6,$td5,$observaciones,$num_imp,$tamfue,$tipfue,$posini,$fecha_registro,$fecha_impresion,$origen);
	
	if($stmt->execute())
	{
		echo 1;
	}else{
		$codigo = mysqli_errno($conexion); 
	  	echo $sql;
	}
	
	$stmt->close();
?>