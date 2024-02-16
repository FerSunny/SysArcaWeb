<?php 


include ("../../controladores/conex.php");
$id_agenda= $_POST['id_agenda'];

$query ="UPDATE tm_agenda SET estado = 'S' WHERE id_agenda = $id_agenda ";
$result = $conexion -> query($query);

if ($result) {
    
}else{
    $codigo = mysqli_errno($conexion); 
    echo $codigo;
}



$conexion->close();
?>