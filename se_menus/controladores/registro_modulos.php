<?php
session_start();
include("../../controladores/conex.php");

date_default_timezone_set('America/Mexico_City');

$empresa ="1";

$nivel_menu = $_POST['nivel_menu'];
$fi_nombre = $_POST['fn_nombre'];
$fi_abreviado = $_POST['fn_abreviado'];
$fi_enlace = $_POST['fn_enlace'];
$fi_falta = $_POST['fn_falta'];
//$fi_factualiza = $_POST['fn_factualiza'];
$estado_reg = $_POST['estado_reg'];
$fi_factualiza=date("y/m/d H:i:s");


$query= "INSERT INTO se_menus (fk_id_empresa, id_menu, fk_id_nivel_menu, titulo, titulo_corto, enlace, fecha_registro, fecha_actualizacion, estado) VALUES('$empresa','0','$nivel_menu','$fi_nombre','$fi_abreviado','$fi_enlace','$fi_falta','$fi_factualiza','$estado_reg')";

//$query;

$resultado = mysqli_query($conexion, $query);

if ($resultado) 
		{
			header("location: ../tabla_menus.php");
			//echo "<script>location.href='../tabla_usuarios.php'</script>";
		}
		else 
		{
			echo "error en la ejecucion de la consulta. <br />";
      		die('Error de Conexion (insert modulos): ' . mysqli_connect_errno());
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
