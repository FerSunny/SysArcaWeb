<?php 



session_start();

include ("../../controladores/conex.php");


$codigo  = $_POST['codigo'];

$colpo = $_POST['colpo'];


$query ="
INSERT INTO km_colpo
            (fk_id_empresa,
             id_colpo,
             desc_colpo,
             estado)
VALUES (1,
        0,
        '$colpo',
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

