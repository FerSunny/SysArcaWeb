<?php 


include ("../../controladores/conex.php");
$id_factura= $_POST['id_factura'];
$fk_id_estudio= $_POST['fk_id_estudio'];
$costo_maq = $_POST['costo_maq'];

$query ="UPDATE so_factura SET estado_factura = 5, imp_subtotal=(imp_subtotal-$costo_maq), imp_total=(imp_total-$costo_maq), resta=(resta-$costo_maq)
    WHERE id_factura  =$id_factura";
$result = $conexion -> query($query);

$query ="UPDATE so_detalle_factura SET estado_factura = 5 WHERE id_factura  ='$id_factura' AND fk_id_estudio = $fk_id_estudio";
$result = $conexion -> query($query);

if ($result) {
    
}else{
    $codigo = mysqli_errno($conexion); 
    echo $codigo;
}



$conexion->close();
?>