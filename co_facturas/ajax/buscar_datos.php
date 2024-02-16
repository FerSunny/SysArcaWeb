<?php

include '../../controladores/conex.php';

$tipo = $_POST['tipo'];
$f_inicio = $_POST['f_inicio'];
$f_final = $_POST['f_final'];
$grupo = $_POST['grupo'];

$query = "SELECT '1' tipo,'1' tipo_pago, SUM(fa.imp_total) total,SUM(fa.a_cuenta) cuenta,SUM(fa.resta) resta,COUNT(*) folios FROM so_factura fa
		WHERE DATE(fa.fecha_factura) >= '$f_inicio' AND DATE(fa.fecha_factura) <= '$f_final' AND fa.fk_id_tipo_pago = 1 AND fa.grupo = '$grupo'

		UNION ALL

		SELECT '1' tipo, '2' tipo_pago, SUM(fa.imp_total) total,SUM(fa.a_cuenta) cuenta,SUM(fa.resta) resta,COUNT(*) folios FROM so_factura fa
		WHERE DATE(fa.fecha_factura) >= '$f_inicio' AND DATE(fa.fecha_factura) <= '$f_final' AND fa.fk_id_tipo_pago = 2 AND fa.grupo = '$grupo'

		UNION ALL

		SELECT '1' tipo, '3' tipo_pago, SUM(fa.imp_total) total,SUM(fa.a_cuenta) cuenta,SUM(fa.resta) resta,COUNT(*) folios FROM so_factura fa
		WHERE DATE(fa.fecha_factura) >= '$f_inicio' AND DATE(fa.fecha_factura) <= '$f_final' AND fa.fk_id_tipo_pago = 3 AND fa.grupo = '$grupo'

		UNION ALL

		SELECT '1' tipo, '4' tipo_pago, SUM(fa.imp_total) total,SUM(fa.a_cuenta) cuenta,SUM(fa.resta) resta,COUNT(*) folios FROM so_factura fa
		WHERE DATE(fa.fecha_factura) >= '$f_inicio' AND DATE(fa.fecha_factura) <= '$f_final' AND fa.fk_id_tipo_pago = 4 AND fa.grupo = '$grupo'

		UNION ALL

		SELECT '1' tipo, '5' tipo_pago, SUM(fa.imp_total) total,SUM(fa.a_cuenta) cuenta,SUM(fa.resta) resta,COUNT(*) folios FROM so_factura fa
		WHERE DATE(fa.fecha_factura) >= '$f_inicio' AND DATE(fa.fecha_factura) <= '$f_final' AND fa.fk_id_tipo_pago = 5 AND fa.grupo = '$grupo'";


	$stmt = $conexion->prepare($query);
			$stmt->execute();
			$result = $stmt->get_result();
			if($result->num_rows === 0) exit('No hay documentos proximos');
			while($row = $result->fetch_assoc())
		    {
		    	$data[]= $row;
		    }
		    echo json_encode($data)
 ?>