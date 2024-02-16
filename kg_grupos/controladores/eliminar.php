<?php 


include ("../../controladores/conex.php");
$id_grupo= $_POST['id_grupo'];


$query ="UPDATE  kg_grupos  SET estado = 'S' WHERE id_grupo = $id_grupo";
$result = $conexion -> query($query);

if ($result) {
    echo 1;
}else{
	$codigo = mysqli_errno($conexion); 
	echo $codigo;
}



$conexion->close();
?>