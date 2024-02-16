<?php

session_start();

include("../../controladores/conex.php");

date_default_timezone_set('America/Mexico_City');

$empresa ="1";



$id_usuario=$_SESSION['id_usuario'];

$fk_id_medico= $_SESSION['fk_id_medico'];



$edovisita = $_POST['fn_edovisita'];

$participa = $_POST['fn_participa'];

$publicidad = $_POST['fn_publicidad'];



$ordenes_i = $_POST['fn_ordenes_i'];

$ordenes_f = $_POST['fn_ordenes_f'];



$mail = $_POST['fn_mail'];

$ce = $_POST['fn_ce'];

$quejas = $_POST['fn_quejas'];

$sugiere = $_POST['fn_sugiere'];

$observaciones = $_POST['fn_observaciones'];

$falta = $_POST['fn_falta'];

$halta = $_POST['fn_halta']; 

$factualiza = date("yy/m/d H:i:s");

$estado = $_POST['estado_reg'];

// se obtiene la firma





 //echo $sql_firma;



$query = "INSERT INTO vm_hoja_visita

            (fk_id_empresa,

             id_hoja,

             fk_id_medico,

             fk_id_estado_visita,

             participaciones,

             publicidad,

             ordenes_fi,

             ordenes_ff,

             quejas,

             sugerencias,

             observaciones,

              mail_resultados,

              consulta_externa,

              fecha_visita,

              hora_visita,

		  fecha_actualiza,

              estado)

 VALUES ('$empresa',0,'$fk_id_medico','$edovisita','$participa','$publicidad', '$ordenes_i', '$ordenes_f',

 '$quejas','$sugiere','$observaciones','$mail','$ce','$falta','$halta','$factualiza','$estado')";



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

