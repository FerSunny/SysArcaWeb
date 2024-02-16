<?php 


include ("../../controladores/conex.php");
$id_producto= $_POST['id_producto'];

$query ="UPDATE me_metas SET estado = 'S' WHERE id_meta = $id_producto ";
$result = $conexion -> query($query);

if ($result) {
    
}else{
    $codigo = mysqli_errno($conexion); 
    echo $codigo;
}



$conexion->close();
?>