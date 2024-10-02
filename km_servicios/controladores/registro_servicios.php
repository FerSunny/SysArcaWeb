<?php
session_start();
include("../../controladores/conex.php");
$empresa ="1";
$fn_servicio = $_POST['fn_servicio']; // estado civil
$fn_abreviada = $_POST['fn_abreviada'];
$fn_estado = $_POST['fn_estado']; // estado
$servicio = $_POST['servicio']; // estado


$query = "INSERT INTO km_servicios(fk_id_empresa,desc_servicio,desc_abreviada,fk_id_tipo_servicio,estado) 
VALUES ('$empresa','$fn_servicio','$fn_abreviada','$servicio','$fn_estado')";
//echo $query;
$resultado = mysqli_query($conexion, $query);

if ($resultado) {
			header("location: ../tabla_servicios.php");
			//echo "<script>location.href='../tabla_usuarios.php'</script>";
		}
		else {
			echo "error en la ejecucion de la consulta. <br />";
      		die('Error de Conexión: ' . mysqli_connect_errno());
		}

		if (mysqli_close($conexion)){
			echo "desconexion realizada. <br />";
		}
		else {
			echo "error en la desconexión";

      die('Error de Conexión: ' . mysqli_connect_errno());

		}
?>
