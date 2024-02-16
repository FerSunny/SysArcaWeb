<?php 



session_start();

include ("../../controladores/conex.php");


$codigo  = $_POST['codigo'];

$borde = $_POST['borde'];


$query ="
INSERT INTO km_bordes
            (fk_id_empresa,
             id_borde,
             desc_borde,
             estado)
VALUES (1,
        0,
        '$borde',
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

