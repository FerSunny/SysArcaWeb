<?php 


include ("../../controladores/conex.php");
$id_toma= $_POST['id_toma'];

$query ="UPDATE tm_tomas SET lote = null WHERE id_toma = $id_toma";
$result = $conexion -> query($query);

if ($result) {
    
}else{
    $codigo = mysqli_errno($conexion); 
    echo $codigo;
}



$conexion->close();
?>