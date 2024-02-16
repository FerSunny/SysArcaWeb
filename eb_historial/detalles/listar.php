<?php

    include ("../../controladores/conex.php");

  $id_detalle = $_GET['val'];
 
  $query = "SELECT 
DISTINCT 
'Tulyehualco' empresa,
suc.desc_sucursal,
CONCAT(us.nombre,' ',us.a_paterno,' ',us.a_materno) usuario,
pro.cod_producto,
pro.producto,
pro.desc_producto,
prs.razon_social,
so.cantidad,
so.costo_pza,
so.importe_total,
so.fecha_registro
FROM eb_solicitudes so
LEFT OUTER JOIN eb_productos pro ON (pro.id_producto = so.fk_id_producto)
LEFT OUTER JOIN eb_proveedores prs ON (prs.id_proveedor = so.fk_id_proveedor)
LEFT OUTER JOIN kg_sucursales suc ON (suc.id_sucursal = so.fk_id_sucursal)
LEFT OUTER JOIN se_usuarios us ON (us.id_usuario = so.fk_id_usuario)
WHERE so.estado = 'A'
and fk_id_detalle = $id_detalle";


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


