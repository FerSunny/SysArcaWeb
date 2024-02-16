<?php 


include ("../../controladores/conex.php");
$id_producto= $_POST['id_producto'];

$query ="UPDATE km_insumos_estudio SET estado = 'S' WHERE id_insumo_estudio = ".$id_producto ;

$result = $conexion -> query($query);

if ($result) {
    
}else{
    $codigo = mysqli_errno($conexion); 
    echo $codigo;
}



$conexion->close();
?>