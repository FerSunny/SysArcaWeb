<?php
include("../../controladores/conex.php");

date_default_timezone_set('America/Mexico_City');

$empresa ="1";
 
$fn_id_usr = $_POST['fn_id_usr'];
$fn_sucursal = $_POST['fn_sucursal'];
$fn_pass = $_POST['fn_pass'];
$fn_estado = $_POST['fn_estado'];
$fn_perfil = $_POST['fn_perfil'];
$fn_servicio = $_POST['fn_servicio'];
$fn_nombre =  utf8_encode($_POST['fn_nombre']);
$fn_apaterno = utf8_encode($_POST['fn_apaterno']);
//$fn_amaterno = $_POST['fn_amaterno'];
$fn_amaterno = utf8_encode($_POST['fn_amaterno']);
$fn_iniciales = $_POST['fn_iniciales'];
$fn_tfijo = $_POST['fn_tfijo'];
$fn_tmovil = $_POST['fn_tmovil'];
$fn_direccion = utf8_encode($_POST['fn_direccion']);
$fn_mail = $_POST['fn_mail'];
$fn_entra=$_POST['fn_entra'];
$fn_salida=$_POST['fn_salida'];
$fn_entra_s=$_POST['fn_entra_s'];
$fn_salida_s=$_POST['fn_salida_s'];
$fn_entra_d=$_POST['fn_entra_d'];
$fn_salida_d=$_POST['fn_salida_d'];
$fn_entra_f=$_POST['fn_entra_f'];
$fn_salida_f=$_POST['fn_salida_f'];
$fn_falta = $_POST['fn_falta'];
//$fi_factualiza = $_POST['fn_factualiza'];
$fn_estado = $_POST['fn_estado'];
$fn_factualiza=date("y-m-d H:i:s");
$fn_user = $_POST['fn_user'];


$query= "INSERT 
INTO se_usuarios (fk_id_empresa,id_usr,fk_id_sucursal,pass,activo,fk_id_perfil,fk_id_servicio,nombre,a_paterno,a_materno,iniciales,telefono_fijo,telefono_movil,direccion,mail, entra, salida, entra_s, salida_s, entra_d, salida_d, entra_f, salida_f, fecha_registro,fecha_actualizacion, usr_conex,pass_conex) VALUES('$empresa','$fn_id_usr','$fn_sucursal','$fn_pass','$fn_estado','$fn_perfil','$fn_servicio','$fn_nombre','$fn_apaterno','$fn_amaterno','$fn_iniciales','$fn_tfijo','$fn_tmovil','$fn_direccion','$fn_mail', '$fn_entra', '$fn_salida', '$fn_entra_s', '$fn_salida_s', '$fn_entra_d', '$fn_salida_d', '$fn_entra_f', '$fn_salida_f', '$fn_falta','$fn_factualiza', '$fn_user','0')";

//echo $query;


$resultado = mysqli_query($conexion, $query);

if ($resultado) 
		{
			header("location: ../tabla_usuarios.php");
			//echo "<script>location.href='../tabla_usuarios.php'</script>";
		}
		else 
		{
			$codigo = mysqli_errno($conexion);
  			echo $codigo;
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
