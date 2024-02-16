<?php 



session_start();

include ("../../controladores/conex.php");

$sucursal = $_SESSION['fk_id_sucursal'];
$id_usuario = $_SESSION['id_usuario'];






$nota = $_POST['nota'];

$costo = $_POST['costo']; 

$gasto = $_POST['gasto']; 

$cajero = $_POST['cajero']; 

//$fecha = $_POST['fecha']; 


$query ="
INSERT INTO `ga_ingreso`
            (`fk_id_empresa`,
             `id_ingreso`,
             `fk_id_sucursal`,
             `fk_id_usuario_caj`,
             `fecha_mov`,
             `fk_id_gasto`,
             `importe`,
             `tipo_entrega`,
             `fk_id_usuario_reg`,
             `nota`,
             `estado`)
VALUES (1,
        0,
        $sucursal,
        $cajero,
        now(),
        $gasto,
        $costo,
        'Efectivo',
        $id_usuario,
        '$nota',
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

