<?php

	session_start();

	include ("../controladores/conex.php");
	$id_modulo=$_SESSION['id_modulo'];

	$fk_id_sucursal=$_SESSION['fk_id_sucursal'];
	$admin = $_SESSION['admin'];

	if($derechos == 1)
	{
	    $condicion = '> 0';
	    $fk_id_perfil = 1;
	}
	else
	{
	    $condicion = '='.$fk_id_sucursal;
	    $fk_id_perfil=$_SESSION['fk_id_perfil'];
	}

	$query="SELECT res.*,
				CASE
		WHEN p2.fk_id_estudio IS NULL THEN
			'No'
		ELSE
			'Si'  
	 END AS Registrado,
	ROUND((p2.num_imp/2),0) AS num_imp
FROM 
(
SELECT '".$fk_id_perfil."' AS perfil, fa.id_factura,
	pq.fk_id_estudio,
	CASE
		WHEN fa.estado_factura = 1 THEN
			'Elaborada'
		WHEN fa.estado_factura = 2 THEN
			'Terminada'
		WHEN fa.estado_factura = 3 THEN
			'Entregada'
		WHEN fa.estado_factura = 4 THEN
			'Impresa'
		WHEN fa.estado_factura = 5 THEN
			'Eliminada'
	END AS estado,
	DATE_FORMAT(fa.fecha_factura,'%d-%b-%y') AS fecha_factura,
	DATE_FORMAT(fa.fecha_entrega, '%k:%i') AS hora_entrega,
	su.desc_sucursal AS sucursal,
	CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno) paciente,
	CONCAT('PQ ',es.desc_estudio) AS estudio,
	fa.resta
FROM km_paquetes pq,
		 so_detalle_factura df,
		 so_factura fa,
		 so_clientes cl ,
		 kg_sucursales su,
		 km_estudios es
WHERE pq.estado = 'A'
	AND es.fk_id_plantilla = '5'
	AND pq.id_paquete = df.fk_id_estudio
	AND df.id_factura = fa.id_factura
	AND es.id_estudio = pq.fk_id_estudio
	AND su.id_sucursal = fa.fk_id_sucursal
	AND cl.id_cliente = fa.fk_id_cliente
	AND fa.estado_factura <> 5
	AND DATE(fa.fecha_entrega) BETWEEN DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND DATE_ADD(CURDATE(), INTERVAL 30 DAY)
	AND df.fk_id_estudio IN (SELECT DISTINCT fk_id_estudio FROM cr_plantilla_ekg WHERE estado = 'A')
	AND fa.fk_id_sucursal  $condicion
	 ) res
LEFT OUTER JOIN cr_plantilla_ekg_re p2 ON (p2.fk_id_factura = res.id_factura AND p2.fk_id_estudio = res.fk_id_estudio)
UNION
SELECT DISTINCT '".$fk_id_perfil."' AS perfil,fa.id_factura,
	df.fk_id_estudio,
	CASE
		WHEN fa.estado_factura = 1 THEN
		'Elaborada'
		WHEN fa.estado_factura = 2 THEN
		'Terminada'
		WHEN fa.estado_factura = 3 THEN
		'Entregada'
		WHEN fa.estado_factura = 4 THEN
		'Impresa'
		WHEN fa.estado_factura = 5 THEN
		'Eliminada'
	END AS estado,
	DATE_FORMAT(fa.fecha_factura,'%d-%b-%y') AS fecha_factura,
	DATE_FORMAT(fa.fecha_entrega, '%k:%i') AS hora_entrega,
			 su.desc_sucursal AS sucursal,
			 CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno) paciente,
			 es.desc_estudio AS estudio,
fa.resta,
	CASE
WHEN p2.fk_id_estudio IS NULL THEN
'No'
ELSE
'Si'
END AS Registrado,
ROUND((p2.num_imp/2),0) AS num_imp
FROM so_factura fa
LEFT OUTER JOIN kg_sucursales su ON (su.id_sucursal = fa.fk_id_sucursal)
LEFT OUTER JOIN so_clientes cl ON (cl.id_cliente = fa.fk_id_cliente)
LEFT OUTER JOIN so_detalle_factura df ON (df.id_factura = fa.id_factura)
LEFT OUTER JOIN cr_plantilla_ekg_re p2 ON (p2.fk_id_factura = df.id_factura AND p2.fk_id_estudio = df.fk_id_estudio),
km_estudios es
WHERE fa.estado_factura <> 5
AND es.fk_id_plantilla = '5'
AND es.id_estudio = df.fk_id_estudio
AND df.fk_id_estudio IN (SELECT DISTINCT fk_id_estudio FROM cr_plantilla_ekg WHERE estado = 'A')
AND DATE(fa.fecha_entrega) BETWEEN DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND DATE_ADD(CURDATE(), INTERVAL 30 DAY)
AND fa.fk_id_sucursal $condicion";

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
