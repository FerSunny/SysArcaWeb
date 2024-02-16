<?php 
session_start();
include ("../../controladores/conex.php");
$id_usuario=$_SESSION['id_usuario'];

$id_factura=$_POST['id_factura'];
$id_estudio=$_POST['id_estudio'];
$grupo = $_POST['grupo'];
$tabla='';

if ($grupo=='1') {
	$tabla='cr_plantilla_1_re';
	$notificacion = entregar($tabla, $id_factura, $id_estudio,$conexion,$id_usuario);

	echo $notificacion;

}elseif ($grupo=='2') {
	$tabla='cr_plantilla_2_re';
	$notificacion = entregar($tabla, $id_factura, $id_estudio,$conexion,$id_usuario);

	echo $notificacion;
}elseif ($grupo=='3') {
	$tabla='cr_plantilla_cvo_re';
	$notificacion = entregar($tabla, $id_factura, $id_estudio,$conexion,$id_usuario);

	echo $notificacion;
}elseif ($grupo=='5') {
	$tabla='cr_plantilla_ekg_re';
	$notificacion = entregar($tabla, $id_factura, $id_estudio,$conexion,$id_usuario);

	echo $notificacion;
}elseif ($grupo=='6') {
	$tabla='cr_plantilla_rx_re';
	$notificacion = entregar($tabla, $id_factura, $id_estudio,$conexion,$id_usuario);

	echo $notificacion;
}elseif ($grupo=='7') {
	$tabla='cr_plantilla_usg_re';
	$notificacion = entregar($tabla, $id_factura, $id_estudio,$conexion,$id_usuario);

	echo $notificacion;
}elseif ($grupo=='4') {
	$tabla='cr_plantilla_4_re';
	$notificacion = entregar($tabla, $id_factura, $id_estudio,$conexion,$id_usuario);

	echo $notificacion;
}elseif ($grupo=='8') {
	$tabla='cr_plantilla_tom_re';
	$notificacion = entregar($tabla, $id_factura, $id_estudio,$conexion,$id_usuario);

	echo $notificacion;
}else{
	echo 'La plantilla no existe';
}

function entregar($tabla, $id_factura, $id_estudio,$conexion,$id_usuario){

	$query ="UPDATE $tabla SET fecha_hora_entregada = Now(), fk_id_usuario = '$id_usuario' WHERE fk_id_factura = '$id_factura' AND fk_id_estudio = '$id_estudio'";

//echo "aqui-->".$query;

	$result = $conexion -> query($query);

	if ($result) {
	    return 1;
	}else{
		$codigo = mysqli_errno($conexion); 
		//echo $query;
	    return $codigo;
	}

	$conexion->close();
}

?>
