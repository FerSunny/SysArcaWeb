<?php 





session_start();

include ("../../controladores/conex.php");

$id_usuario = $_SESSION['id_usuario'];


$codigo  = $_POST['codigo'];

$sucursal = $_POST['sucursal'];

$servicio = $_POST['servicio']; 

$medico = $_POST['medico']; 

$fecha = $_POST['fecha']; 

$hinicio = $_POST['hinicio']; 

$hfinal = $_POST['hfinal']; 

$subrrogado = $_POST['subrrogado'];



$query = "
UPDATE `ca_horarios`
SET `fk_id_empresa` = 1,

  `fk_id_sucursal` = $sucursal,
  `fk_id_servicio` = $servicio,
  `fk_id_medico` = $medico,
  `subrrogado` = '$subrrogado',
  `dia_atencion` = '$fecha',
  `hora_inicio` = '$hinicio',
  `hora_final` = '$hfinal',
  `fecha_modifica` = now(),

  `id_usuario` = $id_usuario
WHERE `id_horario` = $codigo
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





































































