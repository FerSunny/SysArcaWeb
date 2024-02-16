<?php
    date_default_timezone_set('America/Mexico_City');
    include ("../controladores/conex.php");
session_start();

    $query = "SELECT  ks.`desc_sucursal`,YEAR(sf.`fecha_factura`) AS p_anio,MONTHNAME(sf.`fecha_factura`) AS p_mes,
     
    SUM(CASE 
    WHEN tp.id_tipo_pago =  1 THEN
        (sf.`imp_total`) 
    ELSE
         (0)
    END ) AS pago_efectivo,
    
    SUM(CASE 
    WHEN tp.id_tipo_pago !=  1 THEN
        (sf.`imp_total`) 
    ELSE
         (0)
    END ) AS pago_tarjeta,
    
    SUM(sf.`imp_total`) AS imp_total
FROM so_factura sf
LEFT OUTER JOIN kg_tipo_pago tp ON (tp.`id_tipo_pago` = sf.fk_id_tipo_pago)
LEFT OUTER JOIN `kg_sucursales` ks ON (ks.`id_sucursal` = sf.`fk_id_sucursal`)
-- WHERE YEAR(sf.`fecha_factura`)<= DATE_SUB(curdate(),INTERVAL 1 year)
WHERE DATE(sf.fecha_factura) BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 YEAR) AND DATE_ADD(CURDATE(), INTERVAL 1 YEAR)
AND estado_factura != '5'
GROUP BY ks.`desc_sucursal`,YEAR(sf.`fecha_factura`),MONTHNAME(sf.`fecha_factura`)
    ";

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


        //primero es listar.php para hacer 
        //conexion con la bd y muestre los datos que iran en la tabla_pago_mensual_sucursal.php
        //luego va tabla_pagomensual.js para que llene todos los datos 
        //entonces ira tabla_pago_mensual.php que es el que se mostrara al usuario
        
