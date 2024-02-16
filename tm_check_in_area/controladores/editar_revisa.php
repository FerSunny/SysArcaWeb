<?php 

session_start();

include ("../../controladores/conex.php");

$usuario = $_SESSION['id_usuario'];



$codigo  = $_POST['codigo'];

$observa =$_POST['observa'];
$motivo = $_POST['motivo']; 
$si_paciente = 0; //$_POST['si_paciente'];
$si_medico = 0; //$_POST['si_medico']; 
$si_sucursal = $_POST['si_sucursal']; 
$email_medico = 0; //$_POST['email_medico']; 
$email_paciente = 0;// $_POST['email_paciente'];
$email_sucursal = $_POST['email_sucursal'];




$query = "UPDATE tm_tomas
SET
 fk_id_rechazo_area = '$motivo',
 observa_rechazo_area = '$observa',
 fecha_rechazo_area = now(),
 emailpaciente = '$si_paciente',
 emailmedico = '$si_medico',
 emailsucursal = '$si_sucursal',
 check_in_area = 2,
 fk_id_usuario_rechazo_area = $usuario

WHERE id_toma = '$codigo'
";





$result = $conexion -> query($query);

if ($result) {

    echo 1;

}else{

  $codigo = mysqli_errno($conexion); 
  //echo $query;
  echo $codigo.$query;

}

$conexion->close();



?>





































































