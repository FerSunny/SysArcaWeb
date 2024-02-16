<?php 


session_start();


include ("../../controladores/conex.php");
$id_usuario = $_SESSION['id_usuario'];

$id_producto= $_POST['id_producto'];



$query ="UPDATE ca_horarios SET estado = 'S',
fecha_baja = now(),
id_usuario   = $id_usuario
WHERE id_horario = $id_producto ";
//echo $query;
$result = $conexion -> query($query);



if ($result) {

    

}else{

    $codigo = mysqli_errno($conexion); 

    echo $codigo;

}







$conexion->close();

?>