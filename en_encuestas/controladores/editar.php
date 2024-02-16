<?php 





session_start();

include ("../../controladores/conex.php");


$fk_id_sucursal = $_SESSION['fk_id_sucursal']; 
$id_usuario = $_SESSION['id_usuario']; 




$pro = $_POST['pro'];

$codigo  = $_POST['codigo'];

$encuestado =$_POST['encu'];

$respu = $_POST['respu']; 

$comenta = $_POST['comenta'];

$query = "
INSERT INTO en_respuestas
            (fk_id_empresa,
             id_respuesta,
             fk_id_sucursal,
             id_px_medico,
             fk_id_pregunta,
             fk_id_respuesta,
             fk_id_usuario,
             fecha,
             estado)
VALUES (1,
        0,
        $fk_id_sucursal,
        $encuestado,
        $codigo,
        $respu,
        $id_usuario,
        now(),
        'A');
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





































































