<?php
include "../../controladores/conex.php";
$fk_id_sucursal = $_POST['fk_id_sucursal'];
$idsolicitud = $_POST['idsolicitud'];
$idproducto = $_POST['idproducto'];
$idproveedor = $_POST['idproveedor'];
$cantidad = $_POST['cantidad'];
$costo = $_POST['costo'];

$stmt = $conexion->prepare("SELECT id_central FROM eb_almacen_central WHERE fk_id_producto = ?");

        $stmt->bind_param("i", $idproducto);
        $stmt->execute();
        $stmt->store_result();
        $num = $stmt->num_rows;
        $stmt->close();

    if($num > 0)
    {
        //echo "EDitando".$num;
        almacen_update($conexion,$fk_id_sucursal ,$idproducto,$cantidad,$idsolicitud);
    }else
    {
        //echo "Insertando: ".$num;
        almacen_insert($conexion,$fk_id_sucursal,$idproducto,$idproveedor,$cantidad,$idsolicitud,$costo);
    }


function almacen_update($conexion,$fk_id_sucursal,$idproducto,$cantidad,$idsolicitud)
{

    date_default_timezone_set('America/Mexico_City');
    $fecha = date("Y-m-d H:i:s");

    $stmt = $conexion->prepare("UPDATE eb_almacen_central SET existencias = existencias + ?, fecha_actualizacion = ?
              WHERE fk_id_sucursal = ?
              AND fk_id_producto = ?");

    $stmt->bind_param('isii', $cantidad,$fecha, $fk_id_sucursal, $idproducto);
                
    if($stmt->execute())
    {
        cambiar_estatus($idsolicitud);
    }else
    {
        echo 0;
    }

}
//,$fk_id_sucursal,$idproducto,$idproveedor,$cantidad,$idsolicitud,$costo
function almacen_insert($conexion,$fk_id_sucursal,$idproducto,$idproveedor,$cantidad,$idsolicitud,$costo)
{
    //include "../../controladores/conex.php";
    date_default_timezone_set('America/Mexico_City');
    $fecha = date("Y-m-d H:i:s");
    $empresa = 1;
    $min = 0;
    $max = 0;
    $estado = 'A';
    
    $stmt = $conexion->prepare("INSERT INTO eb_almacen_central (
    fk_id_empresa,
    fk_id_sucursal,
    fk_id_producto,
    fk_id_proveedor,
    costo_producto,
    existencias,
    min,
    max,
    fecha_actualizacion,
    estado) VALUES (?,?,?,?,?,?,?,?,?,?)");
    
    
    $stmt->bind_param('iiiidiiiss',$empresa,$fk_id_sucursal,$idproducto,$idproveedor,$costo,$cantidad,$min,$max,$fecha,$estado);
    if($stmt->execute())
    {
        cambiar_estatus($idsolicitud);
    }else
    {
        echo 0;
    }
}

function cambiar_estatus($idsolicitud)
{
    include "../../controladores/conex.php";
    $estatus = 'I';
    $llego = 'S';
    $stmt = $conexion->prepare("UPDATE eb_solicitudes SET estatus = ?,llego = ? WHERE id_solicitud = ?");

    $stmt->bind_param('ssi', $estatus,$llego,$idsolicitud);
                
    if($stmt->execute())
    {
        echo 1;
    }else
    {
        $codigo = mysqli_errno($conexion); 
        echo $codigo;
    }


}

?>