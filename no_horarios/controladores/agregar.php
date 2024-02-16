<?php 



session_start();

include ("../../controladores/conex.php");

$sucursal = $_SESSION['fk_id_sucursal'];





$codigo  = $_POST['codigo'];

$horario = $_POST['horario'];
 



$query ="

INSERT INTO no_horarios
            (fk_id_empresa,
             id_horario,
             codigo,
             desc_horario,
             fecha_registro,
             fecha_actualiza,
             estado)
VALUES (1,
        0,
        '$codigo',
        '$horario',
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

