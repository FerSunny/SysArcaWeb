<?php 



session_start();

include ("../../controladores/conex.php");

$sucursal = $_SESSION['fk_id_sucursal'];
$id_usuario= $_SESSION['id_usuario'];




$fk_id_equipo = $_POST['fk_id_equipo'];
$temperatura = $_POST['temperatura']; 



$query ="
INSERT INTO  iq_mediciones 
            ( fk_id_empresa ,
              fk_id_sucursal ,
              id_temperatura ,
              fk_id_equipo ,
              temperatura ,
              valor_correccion ,
              valor_corregido ,
              fecha_registro ,
              fk_id_usuario ,
              estado )
VALUES (1,
        '$sucursal',
        0,
        '$fk_id_equipo',
        '$temperatura',
        0,
        '$temperatura',
        NOW(),
        '$id_usuario',
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

