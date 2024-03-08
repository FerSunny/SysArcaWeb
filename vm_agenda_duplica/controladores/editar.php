<?php 





session_start();

include ("../../controladores/conex.php");

$anio = $_POST['anio']; //estado
$mes = $_POST['mes'];
$dia = $_POST['dia'];
$fecha = $_POST['fecha'];
//$hora = $_POST['hora'];

$id_usuario = $_SESSION['id_usuario'];
//echo 'entro a editar.php';
// Eliminamos los medicos del dia

$stmt_delete =
"
DELETE FROM vm_agenda
WHERE estado = 'A'
AND fk_id_usuario = $id_usuario
AND YEAR(fecha) = $anio
AND MONTHNAME(`fecha`) = '$mes'
AND DAY(fecha) = $dia
"
;

//echo 'borra'.$stmt_delete;

$execute_query_delete = mysqli_query($conexion,$stmt_delete);


// obtenemos los medicos del dia 
$sql_max="
SELECT ag.*
FROM vm_agenda ag
WHERE ag.`estado` = 'A'
AND ag.`fk_id_usuario` = $id_usuario
AND YEAR(ag.`fecha`) = $anio
AND MONTHNAME(ag.`fecha`) = '$mes'
AND DAY(ag.`fecha`) = $dia
"
//echo "sql_mx:".$sql_max;


  $veces='0';
  if ($result1 = mysqli_query($conexion, $sql_max)) {
    while($row = $result1->fetch_assoc())
    {

        $fk_id_medico = $row['fk_id_medico'];
        $hora = $row['hora'];

        $stm_insert="
        INSERT INTO vm_agenda
                    (fk_id_empresa,
                     id_agenda,
                     fk_id_usuario,
                     fk_id_medico,
                     fecha,
                     hora,
                     estado,
                     planeado)
        VALUES (1,
                0,
                $id_usuario,
                $fk_id_medico,
                '$fecha',
                '$hora',
                'A',
                'S')
        ";
        $result = $conexion -> query($stm_insert);
        if ($result) {
            $estatus= 1;
        }else{
          $codigo = mysqli_errno($conexion); 
          $estatus = $codigo;
        }
  }
}

echo $estatus;


$conexion->close();

?>