<?php 



session_start();

include ("../../controladores/conex.php");


$codigo  = $_POST['codigo'];

$cervix = $_POST['cervix'];


$query ="
INSERT INTO km_cervix
            (fk_id_empresa,
             id_cervix,
             desc_cervix,
             estado)
VALUES (1,
        0,
        '$cervix',
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

