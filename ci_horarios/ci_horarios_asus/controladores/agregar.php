<?php 



session_start();

include ("../../controladores/conex.php");

//$sucursal = $_SESSION['fk_id_sucursal'];
$id_usuario = $_SESSION['id_usuario'];




//$codigo  = $_POST['codigo'];

$sucursal = $_POST['sucursal'];

$servicio = $_POST['servicio']; 

$medico = $_POST['medico']; 

$fecha = $_POST['fecha']; 

$hinicio = $_POST['hinicio']; 

$hfinal = $_POST['hfinal']; 

$subrrogado = $_POST['subrrogado'];









$query ="
INSERT INTO `ca_horarios`
            (`fk_id_empresa`,
             `fk_id_sucursal`,
             `fk_id_servicio`,
             `fk_id_medico`,
             `subrrogado`,
             `dia_atencion`,
             `hora_inicio`,
             `hora_final`,
             `fecha_alta`,
             `fecha_modifica`,
             `fecha_baja`,
             `id_usuario`,
             `estado`)
VALUES (1,
        $sucursal,
        $servicio,
        $medico,
        '$subrrogado',
        '$fecha',
        '$hinicio',
        '$hfinal',
        now(),
        NULL,
        NULL,
        '$id_usuario',
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

