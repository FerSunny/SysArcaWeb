<?php
session_start();
include("../../controladores/conex.php");

date_default_timezone_set('America/Mexico_City');

$empresa ="1";
 
$fn_id_paquete = $_POST['fn_id_paquete'];
$fn_paquete = $_POST['fn_paquete'];
$fn_estudio = $_POST['fn_estudio'];
$fn_estado = $_POST['fn_estado'];
$fn_perfil = $_POST['fn_perfil'];

$fn_falta = $_POST['fn_falta'];

$fn_estado = $_POST['fn_estado'];
$fn_factualiza=date("y/m/d :H:i:s");


$query= "INSERT INTO km_paquetes (fk_id_empresa,id_valor,id_paquete,fk_id_estudio,estado,fecha_registro,fecha_actualizacion) 
VALUES
('$empresa','0','$fn_paquete','$fn_estudio','$fn_estado',now(),'$fn_factualiza')";

//echo $query;

$resultado = mysqli_query($conexion, $query);

if ($resultado) 
		{
			header("location: ../tabla_paquetes.php");
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
