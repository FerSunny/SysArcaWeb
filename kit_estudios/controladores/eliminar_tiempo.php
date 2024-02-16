<?php 


include ("../../controladores/conex.php");
$id_tiempo= $_POST['id_tiempo'];

$query ="UPDATE km_tiempo_estudio SET estado = 'S' WHERE id_tiempo = ".$id_tiempo ;

$result = $conexion -> query($query);

if ($result) {
    
}else{
    $codigo = mysqli_errno($conexion); 
    echo $codigo;
}



$conexion->close();
?>