<?php 



session_start();

include ("../../controladores/conex.php");

$sucursal = $_SESSION['fk_id_sucursal'];





$anio  = $_POST['anio'];
$mes   = $_POST['mes'];

$importe = $_POST['importe'];

$notas = $_POST['notas']; 

$sucursal = $_POST['sucursal']; 







$query ="
INSERT INTO me_metas
            (fk_id_empresa,
             id_meta,
             fk_id_sucursal,
             anio,
             fk_id_mes,
             notas,
             importe,
             estado)
VALUES (1,
        0,
        $sucursal,
        $anio,
        $mes,
        $notas,
        $importe,
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

