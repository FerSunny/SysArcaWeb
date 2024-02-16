<?php 



session_start();

include ("../../controladores/conex.php");

$sucursal = $_SESSION['fk_id_sucursal'];





$codigo  = $_POST['codigo'];

$sucursal = $_POST['sucursal'];

$usuario = $_POST['usuario']; 




$query = "UPDATE se_usuarios

SET

 fk_id_sucursal = '$sucursal',

 fk_id_perfil = 11

WHERE id_usuario = '$usuario'";

$result = $conexion -> query($query);

if ($result) {

    echo 1;

}else{

  $codigo = mysqli_errno($conexion); 

  echo $codigo;

}

$conexion->close();



?>

