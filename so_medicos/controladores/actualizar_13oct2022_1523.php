<?php
include("../../controladores/conex.php");

date_default_timezone_set('America/Mexico_City');

$id_medico=$_POST["id_medico"];
$zona=$_POST["zona"];
$fn_nombre=$_POST["fn_nombre"];
$fn_apaterno=$_POST["fn_apaterno"];
$fn_amaterno=$_POST["fn_amaterno"];
$fn_rfc=$_POST["fn_rfc"];
$fn_sexo=$_POST["fn_sexo"];
$especialidad=$_POST["especialidad"];
// si viene vacia la zona
if($_POST["zona"] == '')
{
	$zona = 17;
}else
{
	$zona = $zona=$_POST["zona"];
}
if($_POST["Estado"] == '')
{
	$estado = 999;
}else
{
	$estado = $Estado_fed=$_POST["Estado"];
}
// si viene vacio municipio 
if($_POST["Municipio"] == '')
{
	$municipio = 999;
}else
{
	$municipio = $fn_Estado=$_POST["Municipio"];
}

//si viene vacio localidad
if($_POST["fn_Localidad"] == '')
{
	$localidad = 9999;
}else
{
	$localidad = $Localidad=$_POST["fn_Localidad"];
}
//$localidad = $_POST["fn_Localidad"];
$fn_colonia=$_POST["fn_colonia"];
$fn_cp=$_POST["fn_cp"];
$fn_calle=$_POST["fn_calle"];
$fn_numero=$_POST["fn_numero"];
$fn_referencia=$_POST["fn_referencia"];
$fn_tfijo=$_POST["fn_tfijo"];
$fn_movil=$_POST["fn_movil"];
$fn_mail=$_POST["fn_mail"];
$fn_horario=$_POST["fn_horario"];
$fn_cbanco=$_POST["fn_cbanco"];
$adscrito=$_POST["fn_ads"];
$fn_falta=$_POST["fn_falta"];
//$fn_factualiza=$_POST["fn_factualiza"];
//$estado_reg=$_POST["estado_reg"];
$fn_factualiza=date("yy/m/d H:i:s");


//$sucursal=$_POST["fn_sucursal"];
if($_POST["fn_sucursal"] == '')
{
	$fn_sucursal = 1;
}else
{
	$fn_sucursal = $fn_sucursal=$_POST["fn_sucursal"];
}
$fn_lat=$_POST["fn_lat"];
$fn_alt=0; // $_POST["fn_alt"];
$fn_lon=$_POST["fn_lon"];
$fn_tip=$_POST["fn_tipo_consul"];
$fn_obs=$_POST["fn_observaciones"];
$fn_med=$_POST["fn_med"];
$fn_lab=$_POST["fn_otro_lab"];
$fn_visitador = $_POST['fn_visitador'];
$tc = $_POST['tc'];
//if($_POST["fn_visitador"] == '')
//{
//	$fn_visitador = 0;
//}else
//{
//	$fn_visitador = $fn_visitador=$_POST["fn_visitador"];
//}
$fn_usu=$_POST["fn_usu"];
$activado=$_POST["fn_acti"];

$query = "UPDATE  so_medicos SET fk_id_zona ='$zona', nombre = '$fn_nombre', a_paterno = '$fn_apaterno', a_materno = '$fn_amaterno' , rfc = '$fn_rfc', fk_id_sexo='$fn_sexo', fk_id_especialidad = '$especialidad', fk_id_estado = '$estado', fk_id_municipio = '$municipio', fk_id_localidad = '$localidad', colonia='$fn_colonia', cp = '$fn_cp', calle='$fn_calle', numero_exterior='$fn_numero', referencia = '$fn_referencia', telefono_fijo = '$fn_tfijo', telefono_movil = '$fn_movil', horario='$fn_horario', cuenta_banco='$fn_cbanco', adscrito='$adscrito', fecha_registro='$fn_falta', fecha_actuaizacion = '$fn_factualiza', 
	
	e_mail='$fn_mail',fk_id_sucursal='$fn_sucursal', fk_id_usuario='$fn_visitador', longitud = '$fn_lon', altitud = '$fn_alt', latitud = '$fn_lat', tipo_consul='$fn_tip', observaciones='$fn_obs', medico='$fn_med' , otro_lab= '$fn_lab', usuario = '$fn_usu', activado = '$activado', fk_id_tipo_consultorio = $tc WHERE id_medico='$id_medico'";

//echo $query;

$result = $conexion->query($query);

//echo $query;
if ($result) {
	$bien = 1;
    echo $bien;

}else{
	$codigo = mysqli_errno($conexion); 
	echo $codigo;
}



$conexion->close();


 ?>
