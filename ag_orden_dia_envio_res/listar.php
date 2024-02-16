<?php

	session_start();

	include ("../controladores/conex.php");
	$id_modulo=$_SESSION['id_modulo'];
	$fk_id_perfil=$_SESSION['fk_id_perfil'];
	$fk_id_sucursal=$_SESSION['fk_id_sucursal'];

	if ($fk_id_perfil==1 or $fk_id_perfil==13 or $fk_id_perfil==33 or $fk_id_perfil==45 or $fk_id_perfil==46) 
		{
			$condicion=' > 0';
		}
		else
		{
			$condicion=' = '.$fk_id_sucursal;
		}
	
	$query="
	select a.* from
	(
	SELECT DISTINCT '".$fk_id_perfil."' AS perfil,
	fa.id_factura,
	df.fk_id_estudio,
	DATE_FORMAT(fa.fecha_factura,'%d-%b-%y') AS fecha_factura,
	DATE_FORMAT(fa.fecha_entrega, '%k:%i') AS hora_entrega,
	su.desc_sucursal AS sucursal,
	CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno) paciente,
	es.desc_estudio AS estudio,
	fa.resta,
	es.fk_id_plantilla as num_plantilla,
	CASE
		WHEN es.fk_id_plantilla = 1 THEN
			CASE
				WHEN p1.fk_id_estudio IS NULL THEN
					'No'
					ELSE
					'Si'
			END 

		WHEN es.fk_id_plantilla = 2 THEN
			CASE
				WHEN p2.fk_id_estudio IS NULL THEN
					'No'
					ELSE
					'Si'
			END 			

		WHEN es.fk_id_plantilla = 5 THEN
			CASE
				WHEN p5.fk_id_estudio IS NULL THEN
					'No'
					ELSE
					'Si'
			END 
	  
		WHEN es.fk_id_plantilla = 6 THEN
			CASE
			WHEN p6.fk_id_estudio IS NULL THEN
				'No'
				ELSE
				'Si'
			END 
	   
		WHEN es.fk_id_plantilla = 7 THEN
			CASE
			WHEN p7.fk_id_estudio IS NULL THEN
				'No'
				ELSE
				'Si'
			END 
	END AS Registrado,
	email_medico,
	email_paciente,
	CASE
		WHEN es.fk_id_plantilla = 1 THEN
			p1.validado
		WHEN es.fk_id_plantilla = 2 THEN
			p2.validado
		WHEN es.fk_id_plantilla = 3 THEN
			p2.validado
		ELSE
			1
	END AS revisado
	FROM so_factura fa
	LEFT OUTER JOIN kg_sucursales su ON (su.id_sucursal = fa.fk_id_sucursal)
	LEFT OUTER JOIN so_clientes cl ON (cl.id_cliente = fa.fk_id_cliente)
	LEFT OUTER JOIN so_detalle_factura df ON (df.id_factura = fa.id_factura)
	LEFT OUTER JOIN cr_plantilla_1_re p1 ON (p1.fk_id_factura = df.id_factura AND p1.fk_id_estudio = df.fk_id_estudio)
	LEFT OUTER JOIN cr_plantilla_2_re p2 ON (p2.fk_id_factura = df.id_factura AND p2.fk_id_estudio = df.fk_id_estudio)
	LEFT OUTER JOIN cr_plantilla_cvo_re p3 ON (p3.fk_id_factura = df.id_factura AND p3.fk_id_estudio = df.fk_id_estudio)

	LEFT OUTER JOIN cr_plantilla_ekg_re p5 ON (p5.fk_id_factura = df.id_factura AND p5.fk_id_estudio = df.fk_id_estudio)
	LEFT OUTER JOIN cr_plantilla_rx_re p6 ON (p6.fk_id_factura = df.id_factura AND p6.fk_id_estudio = df.fk_id_estudio)
	LEFT OUTER JOIN cr_plantilla_usg_re p7 ON (p7.fk_id_factura = df.id_factura AND p7.fk_id_estudio = df.fk_id_estudio),
	km_estudios es
	WHERE fa.estado_factura <> 5
	AND es.fk_id_plantilla IN (1,2,3,5,6,7)
	AND es.id_estudio = df.fk_id_estudio
	AND DATE(fa.fecha_entrega) BETWEEN DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND DATE_ADD(CURDATE(), INTERVAL 30 DAY)
	AND fa.fk_id_sucursal ".$condicion."
	) a
	WHERE a.revisado = 1
	AND a.registrado = 'Si'
	AND (a.resta = 0 or a.resta < 0)
	"
	;

	$resultado = mysqli_query($conexion, $query);

		if(!$resultado){
				die("Error");
				echo '<script> alert("No hay agenda para este dia")</script>';
				echo "<script>location.href='../ag_agenda/tabla_agenda.php'</script>";

		}else{
				while($data=mysqli_fetch_assoc($resultado)){
						$arreglo["data"][]=$data;
				}
				echo json_encode($arreglo);
		}

		mysqli_free_result($resultado);
		mysqli_close($conexion);
