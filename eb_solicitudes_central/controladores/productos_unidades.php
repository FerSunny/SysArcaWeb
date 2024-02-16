<?php
include "../../controladores/conex.php";

$fk_id_sucursal = $_POST['fk_id_sucursal'];
$idsolicitud = $_POST['idsolicitud'];
$idproducto = $_POST['idproducto'];
$idproveedor = $_POST['idproveedor'];
$cantidad = $_POST['cantidad'];

$query = "SELECT COUNT(fk_id_producto) fk_id_producto FROM eb_almacen_unidades WHERE fk_id_producto = $idproducto";
$result = $conexion -> query($query);
$row = mysqli_fetch_array($result);

$almacen = $row['fk_id_producto'];

    if($almacen > 0)
    {
        almacen_update($conexion,$fk_id_sucursal ,$idproducto,$cantidad,$idsolicitud);
    }else
    {
        almacen_insert($conexion,$fk_id_sucursal ,$idproducto,$idproveedor,$cantidad,$idsolicitud);
    }


function almacen_update($conexion,$fk_id_sucursal,$idproducto,$cantidad,$idsolicitud)
{
    $query = "UPDATE eb_almacen_unidades SET existencias = existencias + $cantidad, fecha_actualizacion = NOW()
              WHERE fk_id_sucursal = $fk_id_sucursal
              AND fk_id_producto = $idproducto";
    $result = $conexion -> query($query);

    if($result)
    {
        cambiar_estatus($conexion,$idsolicitud);
    }else
    {
        echo 0;
    }
}


function almacen_insert($conexion,$fk_id_sucursal,$idproducto,$idproveedor,$cantidad,$idsolicitud)
{
    $query = "INSERT INTO eb_almacen_unidades (                                                         fk_id_empresa,fk_id_sucursal,fk_id_producto,fk_id_proveedor,existencias,min,max,fecha_actualizacion,estado)
            VALUES (1,$fk_id_sucursal,$idproducto,$idproveedor,$cantidad,5,100,NOW(),'A')";
        $result = $conexion -> query($query);
    
    if($result)
    {
        cambiar_estatus($conexion,$idsolicitud);
    }else
    {
        echo 0;
    }
}

function cambiar_estatus($conexion,$idsolicitud)
{
    $query = "UPDATE eb_solicitudes SET estatus = 'I' WHERE id_solicitud = $idsolicitud";
    $result = $conexion-> query($query);
    echo 1;

}

        /**/
$conexion->close();
?>