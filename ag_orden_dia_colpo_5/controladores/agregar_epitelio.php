<?php 



session_start();

include ("../../controladores/conex.php");


$codigo  = $_POST['codigo'];

$epitelio = $_POST['epitelio'];


$query ="
INSERT INTO km_epitelio
            (fk_id_empresa,
             id_epitelio,
             desc_epitelio,
             estado)
VALUES (1,
        0,
        '$epitelio',
        'A')
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

