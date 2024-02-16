<?php 



session_start();

include ("../../controladores/conex.php");


$codigo  = $_POST['codigo'];

$zona = $_POST['zona'];


$query ="
INSERT INTO km_zona
            (fk_id_empresa,
             id_zona,
             desc_zona,
             estado)
VALUES (1,
        0,
        '$zona',
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

