<?php 


include ("../../controladores/conex.php");
$id_producto= $_POST['id_producto'];

$query ="UPDATE ag_ekg SET estado = 'S' WHERE fk_id_factura = $id_producto ";
$result = $conexion -> query($query);

if ($result) {
    
}else{
    $codigo = mysqli_errno($conexion); 
    echo $codigo;
}



$conexion->close();
?>