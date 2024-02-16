<?php
session_start();
include("../../controladores/conex.php");

date_default_timezone_set('America/Mexico_City');

$fk_id_sucursal=$_SESSION['fk_id_sucursal'];
$empresa ="1";
$clave_arca="0";
 
$fk_id_giro = $_POST['fn_giro'];
$fn_nombre =  utf8_encode($_POST['fn_nombre']);
$fn_estado = $_POST['fn_estado'];
$fn_perfil = $_POST['fn_perfil'];
$fn_tfijo = $_POST['fn_tfijo'];
$fn_tmovil = $_POST['fn_tmovil'];
$fn_direccion = utf8_encode($_POST['fn_direccion']);
$fn_mail = $_POST['fn_mail'];
$fn_falta = $_POST['fn_falta'];
$fn_factualiza=date("y/m/d :H:i:s");
$fn_estado = $_POST['fn_estado'];



$query= "INSERT INTO ga_beneficiarios (fk_id_empresa,id_beneficiario,clave_arca,fk_id_sucursal,fk_id_giro,nombre,telefono_fijo,telefono_movil,direccion,mail,fecha_registro,fecha_actualizacion,estado) VALUES('$empresa','0','$clave_arca','$fk_id_sucursal','$fk_id_giro','$fn_nombre','$fn_tfijo','$fn_tmovil','$fn_direccion','$fn_mail','$fn_falta','$fn_factualiza','$fn_estado')";

//echo $query;

$resultado = mysqli_query($conexion, $query);

if ($resultado) 
		{
			header("location: ../tabla_beneficia.php");
		}
		else 
		{
			echo "error en la ejecucion de la consulta. <br />";
      		die('Error de Conexion: ' . mysqli_connect_errno());
      		//die('Error de Conexión (INSERT): ' . mysqli_error());
		}

	if (mysqli_close($conexion))
		{
			echo "desconexion realizada. <br />";
		}
		else 
		{
			echo "error en la desconexión";
      		die('Error de Conexión: ' . mysqli_connect_errno());

		}
?>
