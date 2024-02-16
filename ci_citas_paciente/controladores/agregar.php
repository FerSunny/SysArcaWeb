<?php 



session_start();

include ("../../controladores/conex.php");

$sucursal = $_SESSION['fk_id_sucursal'];
$id_usuario =  $_SESSION['id_usuario'];





$codigo  = $_POST['codigo'];
$dia = $_POST['dia'];
$servicio = $_POST['servicio']; 

$_SESSION['servicio'] = $servicio;



// obtenemos los horarios (por ahora sin el tipo de estudio)
$termino=0;
$sql_max="
SELECT t.* FROM ci_tiempo t
WHERE t.`estado` = 'A'
"
;
// echo $sql_max;

if ($result_max = mysqli_query($conexion, $sql_max)) {
  while($row_max = $result_max->fetch_assoc())
  {

      $hora=$row_max['hora'];
      $query ="
      INSERT INTO ci_eventos
      (fk_id_empresa,
      id_evento,
      fk_id_tipo_estudio,
      fk_id_sucursal_env,
      fk_id_sucursal_rec,
      fk_id_usuario,
      fecha,
      hora,
      fk_id_paciente,
      fk_id_medico,
      fk_id_estudio,
      estado)
    
      VALUES (
      1,
      0,
      $servicio,
      0,
      0,
      $id_usuario,
      '$dia',
      '$hora',
      0,
      0,
      0,
      'D')
      ";
    
      // P = Pendiente de llegada del paciente
      
      $result = $conexion -> query($query);
      if ($result) {
          $termino = 1;
      }else{
        $codigo = mysqli_errno($conexion); 
        $termino =  $codigo;
        break;
      }


  }
  echo $termino;
}
$conexion->close();
?>

