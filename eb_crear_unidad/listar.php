<?php



    include ("../controladores/conex.php");



    session_start();

    $sucursal =$_SESSION['fk_id_sucursal'];

    $query = "SELECT

ac.fk_id_proveedor,

ac.fk_id_producto,

pro.cod_producto,

pro.desc_producto,

pro.producto,

prs.razon_social,

CASE 

WHEN (SELECT min(ac.min) FROM eb_almacen_unidades ac WHERE fk_id_producto = pro.id_producto and ac.estado = 'A' and ac.fk_id_sucursal = $sucursal) >= 0 THEN

(SELECT min(ac.min) FROM eb_almacen_unidades ac WHERE fk_id_producto = pro.id_producto and ac.estado = 'A' and ac.fk_id_sucursal = $sucursal)

ELSE

'No'

END AS minimo,

CASE 

WHEN (SELECT max(ac.max) FROM eb_almacen_unidades ac WHERE fk_id_producto = pro.id_producto and ac.estado = 'A' and ac.fk_id_sucursal = $sucursal) >= 0 THEN

(SELECT max(ac.max) FROM eb_almacen_unidades ac WHERE fk_id_producto = pro.id_producto and ac.estado = 'A' and ac.fk_id_sucursal = $sucursal)

ELSE

'No'

END AS maximo,

ac.costo_producto,

CASE 

WHEN (SELECT distinct ac.existencias FROM eb_almacen_unidades ac WHERE fk_id_producto = pro.id_producto and ac.estado = 'A' and ac.fk_id_sucursal = $sucursal) THEN

(SELECT distinct ac.existencias FROM eb_almacen_unidades ac WHERE fk_id_producto = pro.id_producto and ac.estado = 'A' and ac.fk_id_sucursal = $sucursal)

ELSE

'No'

END AS existencias

FROM eb_almacen_central ac

LEFT OUTER JOIN eb_productos pro ON (pro.id_producto = ac.fk_id_producto)

LEFT OUTER JOIN eb_proveedores prs ON (prs.id_proveedor = ac.fk_id_proveedor)

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

