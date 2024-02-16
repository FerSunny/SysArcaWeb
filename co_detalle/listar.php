<?php 
include ("../controladores/conex.php");
$folio = $_GET['val'];


$stmt = $conexion->prepare("SET lc_time_names = 'es_ES'");
		$stmt->execute(); 
		$query = "SELECT 
				fo.folio_factura,
				fo.fk_id_factura,
				CONCAT(cl.nombre, ' ',cl.a_paterno, ' ',cl.a_materno) paciente,
				fo.importe,
				DATE_FORMAT(fecha_inicio, '%d de %M de %Y') inicio,
				DATE_FORMAT(fecha_final, '%d de %M de %Y') final
				FROM so_folios fo
				LEFT OUTER JOIN so_factura fa ON (fa.id_factura = fo.fk_id_factura)
				LEFT OUTER JOIN so_clientes cl ON (cl.id_cliente = fa.fk_id_cliente)
				WHERE folio_factura = ?";
		$stmt = $conexion->prepare($query);
		$stmt->bind_param("s",$folio);
		$stmt->execute();
		$result = $stmt->get_result();

			while($row = $result->fetch_assoc())
		    {
		    	$data["data"][]=$row;
		    }

		    echo json_encode($data)
 ?>