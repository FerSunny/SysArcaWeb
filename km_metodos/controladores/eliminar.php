<?php 





include ("../../controladores/conex.php");

$id_metodo= $_POST['id_metodo'];



$query ="UPDATE km_metodos SET estado = 'S' WHERE id_metodo = $id_metodo ";

$result = $conexion -> query($query);



if ($result) {

    

}else{

    $codigo = mysqli_errno($conexion); 

    echo $codigo;

}







$conexion->close();

?>