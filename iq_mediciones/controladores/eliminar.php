<?php 


include ("../../controladores/conex.php");
$id_temperatura= $_POST['id_temperatura'];

$query ="UPDATE iq_mediciones SET estado = 'S' WHERE id_temperatura = $id_temperatura ";
$result = $conexion -> query($query);

if ($result) {
    
}else{
    $codigo = mysqli_errno($conexion); 
    echo $codigo;
}



$conexion->close();
?>