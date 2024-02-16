<?php 



session_start();

include ("../../controladores/conex.php");

$sucursal = $_SESSION['fk_id_sucursal'];







$clave = $_POST['clave'];

$desc = $_POST['desc']; 

$area = $_POST['area']; 

$query ="INSERT INTO kg_rechazos
            (fk_id_empresa,
             id_rechazo,
             clave,
             desc_rechazo,
             fk_id_area,
             estado)
VALUES (1,
        0,
        '$clave',
        '$desc',
        $area,
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

