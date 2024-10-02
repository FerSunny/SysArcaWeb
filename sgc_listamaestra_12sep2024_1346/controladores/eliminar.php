<?php 


include ("../../controladores/conex.php");
$id_doc= $_POST['id_doc'];

$query ="UPDATE sgc_lista_maestra SET estado = 'S' WHERE id_doc = $id_doc ";
$result = $conexion -> query($query);

if ($result) {
    
}else{
    $codigo = mysqli_errno($conexion); 
    echo $codigo;
}



$conexion->close();
?>