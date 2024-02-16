<?php 

session_start();

include ("../../controladores/conex.php");




$cliente=$_SESSION['cliente_ser'];

$sucursal_ori = $_SESSION['fk_id_sucursal'];
$id_usuario =  $_SESSION['id_usuario'];


$estudio=$_POST['estudio'];
$sucursal=$_POST['sucursal'];
$codigo  = $_POST['codigo'];
$hora = $_POST['hora']; 
$medico = $_POST['medico'];
$tiempo = $_POST['tiempo'];



$query = "
UPDATE ci_eventos
SET 


  `fk_id_sucursal_env` = $sucursal_ori,
  `fk_id_sucursal_rec` = $sucursal,
  `fk_id_usuario` = $id_usuario,

  
  `fk_id_paciente` = $cliente,
  `fk_id_medico` = $medico,
  `fk_id_estudio` = $estudio,
  tiempo = $tiempo,
  estado = 'D'

WHERE `id_evento` = $codigo;
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





































































