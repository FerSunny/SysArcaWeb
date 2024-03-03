<?php 


include ("../../controladores/conex.php");
$id= $_POST['id'];

$query ="UPDATE en_enc_directorio SET estado = 'S' WHERE fk_id = $id and tipo = 2";
$result = $conexion -> query($query);

if ($result) {
    
}else{
    $codigo = mysqli_errno($conexion); 
    echo $codigo;
}



$conexion->close();
?>