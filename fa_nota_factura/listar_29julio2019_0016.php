<?php

	include ("../controladores/conex.php");

	$query = "SELECT  fa.id_factura AS nota,DATE_FORMAT(fa.fecha_factura, '%d-%m-%Y') AS fecha,fa.imp_total AS importe,CONCAT(cl.nombre, ' ',cl.`a_materno`,' ',cl.`a_materno`,' ') AS nombre, fa.numero_factura
FROM so_factura fa
LEFT OUTER JOIN so_clientes cl ON (cl.id_cliente = fa.fk_id_cliente)
WHERE DATE(fa.fecha_factura) > '2019-03-01' AND DATE(fa.fecha_factura) < '2019-04-30'";
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
