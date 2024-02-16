<?php 



session_start();

include ("../../controladores/conex.php");

$sucursal = $_SESSION['fk_id_sucursal'];







$clave = $_POST['clave'];

$desc = $_POST['desc']; 

$servicio = $_POST['servicio']; 

$query ="INSERT INTO km_areas
            (fk_id_empresa,
             id_area,
             clave,
             desc_area,
             fk_id_servicio,
             estado)
VALUES (1,
        0,
        '$clave',
        '$desc',
        $servicio,
        'A')
";

$result = $conexion -> query($query);

if ($result) {

    echo 1;

}else{
  //echo $query;
  $codigo = mysqli_errno($conexion); 

  echo $codigo;

}

$conexion->close();



?>

