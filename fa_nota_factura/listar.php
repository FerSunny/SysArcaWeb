<?php

	include ("../controladores/conex.php");

	$query = "
    SELECT  fa.id_factura AS nota,
    DATE_FORMAT(fa.fecha_factura, '%d-%m-%Y') AS fecha,
    fa.imp_total AS importe,
    CONCAT(cl.nombre, ' ',cl.`a_materno`,' ',cl.`a_materno`,' ') AS nombre, 
    fa.numero_factura,
    fa.fecha_factura_sat,
    us.id_usr,
    fa.grupo,
    fa.fk_id_sucursal_sat,
    gr.`desc_grupo`,
    su.`desc_corta`,
    ss.`desc_corta` AS desc_corta_ss
    FROM so_factura fa
    LEFT OUTER JOIN so_clientes cl ON (cl.id_cliente = fa.fk_id_cliente)
    LEFT OUTER JOIN se_usuarios us ON (us.id_usuario = fa.fk_id_usuario_factura)
    LEFT OUTER JOIN kg_grupos gr ON (gr.`id_grupo` = fa.`grupo`)
    LEFT OUTER JOIN kg_sucursales su ON (su.`id_sucursal` = fa.`fk_id_sucursal`)
    LEFT OUTER JOIN kg_sucursales ss ON (ss.`id_sucursal` = fa.`fk_id_sucursal_sat`)
    -- WHERE date(fa.fecha_factura) >= '2019-05-01' AND date(fa.fecha_factura) <= '2019-08-31'
    WHERE DATE(fa.fecha_factura) >= DATE_SUB(NOW(), INTERVAL 240 DAY)
    AND fa.fk_id_sucursal > 0
";
//echo $query;
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
