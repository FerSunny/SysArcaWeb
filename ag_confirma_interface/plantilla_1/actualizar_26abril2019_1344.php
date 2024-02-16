<?php 

	session_start();
	include ("../../controladores/conex.php");

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

		if($td2 == 'Volumen Corpuscular Medio (VCM)')
		{
			$query = "SELECT valor FROM cr_plantilla_1_re_i WHERE  fk_id_estudio = $estudio AND fk_id_factura = $factura and concepto = 'Eritrocitos'";
			$result = $conexion->query($query);
			$row = mysqli_fetch_array($result);
			$eritrocitos = $row['valor'];

			$query2 = "SELECT valor FROM cr_plantilla_1_re_i WHERE  fk_id_estudio = $estudio AND fk_id_factura = $factura and concepto = 'Hematocrito'";
			$result2 = $conexion->query($query2);
			$row2 = mysqli_fetch_array($result2);
			$hematocrito = $row2['valor'];

			$resultado=bcdiv((($hematocrito/($eritrocitos/1000000))*10),'1',2);

			 	$query3 ="UPDATE cr_plantilla_1_re_i SET valor = '$resultado', verificado = '$td4', observaciones = '$observaciones', validado = 1 WHERE orden = '$td0' AND fk_id_factura = $factura AND fk_id_estudio = $estudio";
 
				$result3 = $conexion -> query($query3);
		}else
		if($td2 == 'Conc Media de Hemoglobina (CMH)')
		{
			$query = "SELECT valor FROM cr_plantilla_1_re_i WHERE  fk_id_estudio = $estudio AND fk_id_factura = $factura and concepto = 'Eritrocitos'";
			$result = $conexion->query($query);
			$row = mysqli_fetch_array($result);
			$eritrocitos = $row['valor'];

			$query2 = "SELECT valor FROM cr_plantilla_1_re_i WHERE  fk_id_estudio = $estudio AND fk_id_factura = $factura and concepto = 'Hemoglobina'";
			$result2 = $conexion->query($query2);
			$row2 = mysqli_fetch_array($result2);
			$hemoglobina = $row2['valor'];

			$resultado=bcdiv((($hemoglobina/($eritrocitos/1000000))*10),'1',2);

			 	$query3 ="UPDATE cr_plantilla_1_re_i SET valor = '$resultado', verificado = '$td4', observaciones = '$observaciones', validado = 1 WHERE orden = '$td0' AND fk_id_factura = $factura AND fk_id_estudio = $estudio";
 
				$result3 = $conexion -> query($query3);
		}else
		if($td2 == 'Conc Media de Hemoglobina Corpuscular (CMHC)')
		{
			$query = "SELECT valor FROM cr_plantilla_1_re_i WHERE  fk_id_estudio = $estudio AND fk_id_factura = $factura and concepto = 'Hematocrito'";
			$result = $conexion->query($query);
			$row = mysqli_fetch_array($result);
			$hematocrito = $row['valor'];

			$query2 = "SELECT valor FROM cr_plantilla_1_re_i WHERE  fk_id_estudio = $estudio AND fk_id_factura = $factura and concepto = 'Hemoglobina'";
			$result2 = $conexion->query($query2);
			$row2 = mysqli_fetch_array($result2);
			$hemoglobina = $row2['valor'];

			$resultado=bcdiv((($hemoglobina/$hematocrito)*100),'1',2);

			 	$query3 ="UPDATE cr_plantilla_1_re_i SET valor = '$resultado', verificado = '$td4', observaciones = '$observaciones', validado = 1 WHERE orden = '$td0' AND fk_id_factura = $factura AND fk_id_estudio = $estudio";
 
				$result3 = $conexion -> query($query3);
		}else
		{
			$query ="UPDATE cr_plantilla_1_re_i SET valor = '$td3', verificado = '$td4', observaciones = '$observaciones', validado = 1 WHERE orden = '$td0' AND fk_id_factura = $factura AND fk_id_estudio = $estudio";
 
			$result = $conexion -> query($query);
		}
		
	$result = $conexion -> query($query);
	
	$conexion->close();
?>