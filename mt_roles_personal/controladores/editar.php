<?php 





session_start();

include ("../../controladores/conex.php");


$codigo  = $_POST['codigo'];

$sucursal = $_POST['sucursal'];


$query = "UPDATE se_usuarios

SET

 fk_id_sucursal = '$sucursal'

WHERE id_usuario = '$codigo'
";





$result = $conexion -> query($query);

if ($result) {

    echo 1;

}else{

  $codigo = mysqli_errno($conexion); 

  echo $codigo;

}

$conexion->close();



?>





































































