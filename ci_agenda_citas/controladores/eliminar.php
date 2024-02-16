<?php 





include ("../../controladores/conex.php");

$id_evento= $_POST['id_producto'];



$query = "
UPDATE ci_eventos
SET 


  `fk_id_sucursal_env` = 0,
  `fk_id_sucursal_rec` = 0,
  `fk_id_usuario` = 0,


  `fk_id_paciente` = 0,
  `fk_id_medico` = 0,
  `fk_id_estudio` = 0,
  tiempo = 0,
  estado = 'D'

WHERE `id_evento` = $id_evento;
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