<?php 


include ("../../controladores/conex.php");
$id_evento = $_POST['id_evento'];

$query ="UPDATE so_agenda SET estado = 'S' WHERE id_evento = $id_evento ";
$result = $conexion -> query($query);

if ($result) {
    
}else{
    $codigo = mysqli_errno($conexion); 
    echo $codigo;
}



$conexion->close();
?>