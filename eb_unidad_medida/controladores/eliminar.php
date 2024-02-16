<?php 


include ("../../controladores/conex.php");
$id_unidad= $_POST['id_unidad'];

$query ="UPDATE eb_unidad_medida SET estado = 'S' WHERE id_unidad = $id_unidad ";
$result = $conexion -> query($query);

if ($result) {
    
}else{
    $codigo = mysqli_errno($conexion); 
    echo $codigo;
}



$conexion->close();
?>