<?php 



session_start();

include ("../../controladores/conex.php");

$sucursal = $_SESSION['fk_id_sucursal'];



$usuario = $_SESSION['id_usuario'];

$nombre = $_POST['nombre']; 
$apaterno = $_POST['apaterno'];
$amaterno = $_POST['amaterno'];
$observaciones = $_POST['observaciones'];







$query ="
INSERT INTO so_medicos_pro
            (fk_id_empresa,
             id_prospecto,
             nombre,
             a_paterno,
             a_materno,
             observaciones,
             fecha_registro,
             fk_id_medico,
             fk_id_usuario,
             estado)
VALUES (1,
        0,
        '$nombre',
        '$apaterno',
        '$amaterno',
        '$observaciones',
        now(),
        0,
        $usuario,
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

