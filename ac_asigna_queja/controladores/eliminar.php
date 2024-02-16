<?php 





include ("../../controladores/conex.php");

$id_queja= $_POST['id_queja'];



$query ="UPDATE ac_quejas SET estado = 'S' WHERE id_queja = $id_queja";

$result = $conexion -> query($query);



if ($result) {

    

}else{

    $codigo = mysqli_errno($conexion); 

    echo $codigo;

}







$conexion->close();

?>