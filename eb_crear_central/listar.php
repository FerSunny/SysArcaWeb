<?php

    include ("../controladores/conex.php");

    session_start();
    $sucursal =$_SESSION['fk_id_sucursal'];
    $query ="SELECT 
pro.fk_id_empresa,
prv.id_proveedor,
pro.id_producto,
pro.cod_producto,
pro.producto,
pro.desc_producto,
prv.razon_social,
pro.costo_total costo_real,
CASE 
WHEN (SELECT COUNT(*) FROM eb_almacen_central WHERE fk_id_producto = pro.id_producto LIMIT 1) > 0 THEN 
(SELECT costo_producto FROM eb_almacen_central WHERE fk_id_producto = pro.id_producto LIMIT 1)
ELSE
'SIN INFORMACION'
END costo_almacen,
CASE 
WHEN (SELECT COUNT(*) FROM eb_almacen_central WHERE fk_id_producto = pro.id_producto LIMIT 1) > 0 THEN 
(SELECT MIN FROM eb_almacen_central WHERE fk_id_producto = pro.id_producto LIMIT 1)
ELSE
'NO HAY REGISTRO'
END minimo,
CASE 
WHEN (SELECT COUNT(*) FROM eb_almacen_central WHERE fk_id_producto = pro.id_producto LIMIT 1) > 0 THEN 
(SELECT MAX FROM eb_almacen_central WHERE fk_id_producto = pro.id_producto LIMIT 1)
ELSE
'NO HAY REGISTRO'
END maximo,
CASE 
WHEN (SELECT COUNT(*) FROM eb_almacen_central WHERE fk_id_producto = pro.id_producto LIMIT 1) > 0 THEN 
(SELECT existencias FROM eb_almacen_central WHERE fk_id_producto = pro.id_producto LIMIT 1)
ELSE
'NO HAY REGISTRO'
END existencias
FROM eb_productos pro
LEFT OUTER JOIN  kg_sucursales suc ON (suc.id_sucursal = pro.fk_id_sucursal )
LEFT OUTER JOIN eb_proveedores prv ON (prv.id_proveedor = pro.fk_id_proveedor )
where pro.estado ='A'";
    
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
