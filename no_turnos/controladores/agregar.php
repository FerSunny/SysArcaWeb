<?php 



session_start();

include ("../../controladores/conex.php");

$sucursal = $_SESSION['fk_id_sucursal'];





$codigo  = $_POST['codigo'];

$turno = $_POST['turno'];
 



$query ="
INSERT INTO no_turnos
            (fk_id_empresa,
             id_turno,
             codigo,
             desc_turno,
             fecha_registro,
             fecha_actualiza,
             estado)
VALUES (1,
        0,
        '$codigo',
        '$turno',
        now(),
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

