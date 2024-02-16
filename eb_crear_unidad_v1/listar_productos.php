<?php

include ("../controladores/conex.php");
session_start();
$id_detalle =$_SESSION['id_detalle'];
$sucursal =$_SESSION['fk_id_sucursal'];
  
$query = "
SELECT
DISTINCT
so.id_solicitud,
so.fk_id_detalle,
so.`fk_id_producto`,
pr.`cod_producto`,
pr.`desc_producto`,
IFNULL(au.`existencias`,0) AS existencias,
so.`cantidad`

FROM 
eb_solicitudes so,
eb_productos pr
LEFT OUTER JOIN eb_almacen_unidades au ON (au.`fk_id_producto` = pr.`id_producto` AND au.`fk_id_sucursal` = $sucursal)
WHERE so.`estado` = 'A'
AND so.estatus = 'L'
AND so.`fk_id_producto` =pr.`id_producto`
AND so.`fk_id_detalle` = $id_detalle
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
