<?php

	include ("../controladores/conex.php");

	$query = "
    SELECT  fa.id_factura AS nota,
    DATE_FORMAT(fa.fecha_factura, '%d-%m-%Y') AS fecha,
    fa.imp_total AS importe,
    CONCAT(cl.nombre, ' ',cl.`a_materno`,' ',cl.`a_materno`,' ') AS nombre, 
    fa.numero_factura,
    fa.fecha_factura_sat,
    us.id_usr
FROM so_factura fa
LEFT OUTER JOIN so_clientes cl ON (cl.id_cliente = fa.fk_id_cliente)
LEFT OUTER JOIN se_usuarios us ON (us.id_usuario = fa.fk_id_usuario_factura)
-- WHERE date(fa.fecha_factura) >= '2019-05-01' AND date(fa.fecha_factura) <= '2019-08-31'
WHERE DATE(fa.fecha_factura) >= DATE_SUB(NOW(), INTERVAL 300 DAY)
";

//(year(fa.fecha_factura) = year(CURDATE()))
	$resultado = mysqli_query($conexion, $query);

    if(!$resultado){
        die("Error");

    }else{
        while($data=mysqli_fetch_assoc($resultado)){
            $arreglo["data"][]=$data;
        }
        echo json_encode($arreglo);
    }

    mysqli_free_result($resultado);
    mysqli_close($conexion);
