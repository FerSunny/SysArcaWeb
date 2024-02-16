<?php

	include ("../controladores/conex.php");


  $query = "SELECT
  fa.fk_id_sucursal,
  su.desc_sucursal,
  fa.`id_factura`,
  DATE(`fecha_factura`) AS fechafactura,
  DATEDIFF(CURDATE(), DATE(`fecha_factura`)) AS dias_vence,
  CONCAT(cl.nombre,' ',cl.`a_paterno`,' ',cl.`a_materno`) AS nombrecliente,
  `imp_total`,
  `a_cuenta`,
  `resta`
FROM so_factura fa
LEFT OUTER JOIN kg_sucursales su ON (su.id_sucursal = fa.fk_id_sucursal)
LEFT OUTER JOIN so_clientes cl ON (cl.id_cliente = fa.fk_id_cliente)
WHERE fa.`resta` > 0
AND DATE_SUB(CURDATE(), INTERVAL 120 DAY) <= DATE(fa.fecha_factura)";


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
