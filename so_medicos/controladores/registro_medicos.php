<?php
session_start();
include("../../controladores/conex.php");

date_default_timezone_set('America/Mexico_City');

$empresa ="1";

$zona = $_POST['zona']; 
$fi_nombre = $_POST['fn_nombre'];
$fi_apaterno = $_POST['fn_apaterno'];
$fi_amaterno = $_POST['fn_amaterno'];
$fi_rfc = $_POST['fn_rfc'];
$fi_sexo = $_POST['fn_sexo'];
$especialidad = $_POST['especialidad'];
//$Estado = $_POST['Estado'];
//$Municipio = $_POST['Municipio'];
//$Localidad = $_POST['Localidad'];

if($_POST["Estado"] == '')
{
	$Estado = 999;
}else
{
	$Estado = $Estado_fed=$_POST["Estado"];
}
// si viene vacio municipio 
if($_POST["Municipio"] == '')
{
	$Municipio = 999;
}else
{
	$Municipio = $Municipio=$_POST["Municipio"];
}

//si viene vacio localidad
if($_POST["Localidad"] == '')
{
	$Localidad = 9999;
}else
{
	$Localidad = $Localidad=$_POST["Localidad"];
}

$fi_colonia = $_POST['fn_colonia'];
$fi_cp = $_POST['fn_cp'];
$fi_calle = $_POST['fn_calle'];
$fi_numero = $_POST['fn_numero'];
$fi_referencia = $_POST['fn_referencia'];
$fi_tfijo = $_POST['fn_tfijo'];
$fi_movil = $_POST['fn_movil'];
$fi_mail = $_POST['fn_mail'];
$fi_horario = $_POST['fn_horario'];
$fi_cbanco = $_POST['fn_cbanco'];
$adscrito = $_POST['fn_ads'];
$fi_falta = $_POST['fn_falta'];
//$fi_factualiza = $_POST['fn_factualiza'];
$estado_reg = 'A'; //$_POST['estado_reg'];
$fi_factualiza=date("y/m/d :H:i:s");
$fn_sucursal = $_POST['fn_sucursal'];
//$fn_ubi = $_POST['fn_ubi'];
$fn_lat=$_POST["fn_lat"];
$fn_alt=0; //$_POST["fn_alt"];
$fn_lon=$_POST["fn_lon"];
$fn_tip=$_POST["fn_tipo_consul"];
$fn_obs=$_POST["fn_observaciones"];
$fn_med=$_POST["fn_med"];
$fn_lab=$_POST["fn_otro_lab"];
$tc = $_POST['tc'];
//$fn_visitador = $_POST['fn_visitador'];
//si viene vacio localidad
if($_POST["fn_visitador"] == '')
{
	$fn_visitador = 0;
}else
{
	$fn_visitador = $fn_visitador=$_POST["fn_visitador"];
}
$fn_usu=$_POST["fn_usu"];
$hash = password_hash("1234", PASSWORD_DEFAULT);
$token = md5(uniqid(mt_rand(), false));
$activado=$_POST["fn_acti"];

$query= "INSERT INTO so_medicos (fk_id_empresa,fk_id_zona,nombre,a_paterno,a_materno,rfc, fk_id_sexo, fk_id_especialidad,fk_id_estado,fk_id_municipio,fk_id_localidad,colonia,cp,calle,numero_exterior,referencia,telefono_fijo,telefono_movil,Horario,cuenta_banco,adscrito,fecha_registro,fecha_actuaizacion,estado,e_mail,fk_id_sucursal, fk_id_usuario, latitud, longitud, altitud, tipo_consul, observaciones, medico, otro_lab, usuario, pass, token, activado,fk_id_tipo_consultorio) VALUES('$empresa','$zona','$fi_nombre','$fi_apaterno','$fi_amaterno','$fi_rfc','$fi_sexo', '$especialidad','$Estado','$Municipio','$Localidad','$fi_colonia','$fi_cp','$fi_calle','$fi_numero','$fi_referencia','$fi_tfijo','$fi_movil','$fi_horario','$fi_cbanco','$adscrito','$fi_falta','$fi_factualiza','$estado_reg','$fi_mail','$fn_sucursal', '$fn_visitador', '$fn_lat', '$fn_lon', '$fn_alt', '$fn_tip', '$fn_obs', '$fn_med', '$fn_lab', '$fn_usu','$hash', '$token', '$activado',$tc)";

// echo $query;

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
