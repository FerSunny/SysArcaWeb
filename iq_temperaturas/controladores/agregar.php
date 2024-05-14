<?php 



session_start();

include ("../../controladores/conex.php");

$sucursal = $_SESSION['fk_id_sucursal'];
$id_usuario = $_SESSION['id_usuario'];



$temperatura = $_POST['temperatura'];

//$valor_c = $_POST['valor_c']; 

$equipo = $_POST['equipo']; 

$fecha = $_POST['fecha']; 






$query ="
INSERT INTO iq_temperaturas
            (fk_id_empresa,
             id_temperatura,
             fk_id_equipo,
             temperatura,
             valor_correccion,
             valor_corregido,
             fecha_registro,
             fk_id_usuario,
             estado)
VALUES (1,
        0,
        '$equipo',
        $temperatura,
        0,
        0,
        now(),
        $id_usuario,
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

