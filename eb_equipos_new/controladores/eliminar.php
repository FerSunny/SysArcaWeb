<?php 





include ("../../controladores/conex.php");

$id_producto= $_POST['id_producto'];



$query ="UPDATE eb_termometros SET estado = 'S' WHERE id_termometro = $id_producto ";

$result = $conexion -> query($query);



if ($result) {

    

}else{

    $codigo = mysqli_errno($conexion); 

    echo $codigo;

}







$conexion->close();

?>