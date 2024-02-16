<?php

session_start();

include("../../controladores/conex.php");

date_default_timezone_set('America/Mexico_City');

$empresa ="1";



$id_usuario=$_SESSION['id_usuario'];

$fk_id_medico= $_SESSION['fk_id_medico'];



$constante = $_POST['constante'];
$agradable = $_POST['agradable'];
$informacion = $_POST['informacion'];
$tiempo = $_POST['tiempo'];

$categoria = $_POST['categoria'];
$observaciones = $_POST['observaciones'];
$edovisita = $_POST['edovisita'];
$participaciones = $_POST['participaciones'];
$vm = $_POST['vm'];

// se obtiene la firma





 //echo $sql_firma;



$query = "INSERT INTO `vm_hoja_visita_sup`
            (`fk_id_empresa`,
             `id_hoja_visita_sup`,
             `fk_id_usuario_vm`,
             `fk_id_medico`,
             `fk_id_estado_visita`,
             `visita_mensual`,
             `visita_agrado`,
             `satisfecho_informacion`,
             `tiempo_forma`,
             `motivo_categoria`,
             `fecha_supervisa`,
             `participaciones`,
             `fk_id_usuario`,
             `observaciones`,
             `estado`)
VALUES (1,
        0,
        $vm,
        $fk_id_medico,
        $edovisita,
        '$constante',
        '$agradable',
        '$informacion',
        '$tiempo',
        '$categoria',
        now(),
        '$participaciones',
        $id_usuario,
        '$observaciones',
        'A')";



//echo $query;



//$resultado = mysqli_query($conexion, $query);



$result = $conexion -> query($query);

if($result){

	echo 1;

}

else{

	$codigo = mysqli_errno($conexion);

	echo $codigo;

}

$conexion->close();



?>

