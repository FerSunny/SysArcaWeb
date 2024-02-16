<?php 





session_start();

include ("../../controladores/conex.php");



$codigo  = $_POST['codigo'];
$sucursal = $_POST['sucursal'];
$usuario = $_POST['usuario']; 
$fecha = $_POST['fecha']; 
$importe = $_POST['importe']; 
$beneficiario = $_POST['beneficiario']; 



$query = "UPDATE ga_registro

SET





 fk_id_sucursal = '$sucursal',

 fk_id_usuario = '$usuario',

 fk_id_beneficiario = '$beneficiario',

 fecha_mov = '$fecha',

 importe = '$importe'

WHERE id_registro = '$codigo'";





$result = $conexion -> query($query);

if ($result) {

    echo 1;

}else{

  $codigo = mysqli_errno($conexion); 

  echo $codigo;

}

$conexion->close();



?>





































































