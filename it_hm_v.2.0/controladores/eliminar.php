<?php 


include ("../../controladores/conex.php");
$id_producto= $_POST['id_producto'];

$query ="UPDATE hm_recepcion_nx_550 SET estado = 'S' WHERE id = $id_producto ";
$result = $conexion -> query($query);

if ($result) {
    
}else{
    $codigo = mysqli_errno($conexion); 
    echo $codigo;
}



$conexion->close();
?>