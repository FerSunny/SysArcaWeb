<?php
session_start();
include("../../controladores/conex.php");

date_default_timezone_set('America/Mexico_City');

$empresa ="1";
 
$fi_nombre = $_POST['fn_nombre'];
$fi_modulo = $_POST['fn_modulo'];
$fi_lectura = $_POST['fn_lectura'];
$fi_escritura = $_POST['fn_escritura'];
$fi_borra = $_POST['fn_borra'];
$fi_actualiza = $_POST['fn_actualiza'];
$fi_falta = $_POST['fn_falta'];
//$fi_factualiza = $_POST['fn_factualiza'];
$estado_reg = $_POST['estado_reg'];
$fi_factualiza=date("y/m/d :H:i:s");


$query= "INSERT INTO se_perfiles (fk_id_empresa,id_perfil,desc_perfil,fk_id_modulo,per_lectura,per_escritura,per_borrar,per_actualizar,fecha_registro,fecha_actualizacion,estado) VALUES('$empresa','0','$fi_nombre','$fi_modulo','$fi_lectura','$fi_escritura','$fi_borra', '$fi_actualiza','$fi_falta','$fi_factualiza','$estado_reg')";

//echo $query;

$resultado = mysqli_query($conexion, $query);

if ($resultado) 
		{
			header("location: ../tabla_perfiles.php");
			//echo "<script>location.href='../tabla_usuarios.php'</script>";
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
