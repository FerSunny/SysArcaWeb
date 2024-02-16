<?php 



session_start();

include ("../../controladores/conex.php");

$sucursal = $_SESSION['fk_id_sucursal'];
$id_usuario = $_SESSION['id_usuario'];




//$codigo  = $_POST['codigo'];

$situacion = $_POST['situacion'];

$origen = $_POST['origen']; 

$area = $_POST['area']; 

$causas = $_POST['causas']; 

$objetivo = $_POST['objetivo']; 

$doc = $_POST['doc']; 

$cual = $_POST['cual'];



$query ="
INSERT INTO sc_mejora_pro
            (fk_id_empresa,
             id_mejora,
             estatus,
             situacion,
             origen,
             fk_id_area,
             causas,
             objetivo,
             fk_id_boleana,
             cual,
             fk_id_usuario,
             fecha_registro,
             fk_id_sucursal,
             estado)
VALUES (1,
        0,
        'C',
        '$situacion',
        '$origen',
        '$area',
        '$causas',
        '$objetivo',
        '$doc',
        '$cual',
        $id_usuario,
        $sucursal,
        NOW(),
        'A');
";



$result = $conexion -> query($query);

if ($result) {

    echo 1;

   

}else{

  $codigo = mysqli_errno($conexion); 

  echo $codigo.$query;

}

$conexion->close();



?>

