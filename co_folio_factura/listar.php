<?php 
include ("../controladores/conex.php");
$stmt = $conexion->prepare("SET lc_time_names = 'es_ES'");
		$stmt->execute(); 
		$query = "SELECT *,COUNT(*) total,SUM(importe) suma,
					DATE_FORMAT(fecha_inicio, '%d de %M de %Y') inicio,
					DATE_FORMAT(fecha_final, '%d de %M de %Y') final
					 FROM so_folios
					GROUP BY folio_factura";

		$stmt = $conexion->prepare($query);
		$stmt->execute();
		$result = $stmt->get_result();

			while($row = $result->fetch_assoc())
		    {
		    	$data["data"][]=$row;
		    }

		    echo json_encode($data)
 ?>