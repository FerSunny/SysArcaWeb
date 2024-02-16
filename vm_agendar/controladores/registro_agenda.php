<?php
session_start();
include("../../controladores/conex.php");
$id_usuario = $_SESSION['id_usuario'];
date_default_timezone_set('America/Mexico_City');

$empresa ="1";

$fk_id_medico = $_POST['fn_medico'];
$fecha = $_POST['fn_fecha'];
$hora = $_POST['fn_hora'];
$planeado = $_POST['fn_planeado'];


//$fi_factualiza = $_POST['fn_factualiza'];
$estado = $_POST['estado'];
$fi_factualiza=date("y/m/d :H:i:s");

$existe=0;
// Validamos si existe ya ese medico para ese dia

$sql="
SELECT count(*) AS existe FROM vm_agenda va
WHERE va.estado = 'A' 
and va.fk_id_usuario = $id_usuario
and va.`fk_id_medico` = ".$fk_id_medico."
and va.fecha = '".$fecha."'";

$resultado = mysqli_query($conexion, $sql);

if($row = mysqli_fetch_array($resultado))
{
  $existe=$row['existe'];
}

if ($existe == 0){
        $query= "
        INSERT INTO `vm_agenda`
                (`fk_id_empresa`,
                `id_agenda`,
                `fk_id_usuario`,
                `fk_id_medico`,
                `fecha`,
                `hora`,
                `estado`,
                planeado)
        VALUES ('$empresa',
                0,
                '$id_usuario',
                '$fk_id_medico',
                '$fecha',
                '$hora',
                '$estado',
                '$planeado')
        ";

        $result = $conexion -> query($query);
        if($result){
                echo 1;
        }
        else{
                $codigo = mysqli_errno($conexion);
                echo $codigo;
        }

        $conexion->close();
}else{
        echo 999;       
}

?>
