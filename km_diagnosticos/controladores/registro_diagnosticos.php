<?php
session_start();
include("../../controladores/conex.php");
$empresa ="1";
$fn_diagnostico = $_POST['fn_diagnostico']; // estado civil
$fn_abreviada = $_POST['fn_abreviada'];
$fn_estado = $_POST['fn_estado']; // estado


$query = "INSERT INTO km_diagnosticos(fk_id_empresa,desc_diagnostico,desc_abreviada,estado) VALUES ('$empresa','$fn_diagnostico','$fn_abreviada','$fn_estado')";

$resultado = mysqli_query($conexion, $query);

if ($resultado) {
			header("location: ../tabla_diagnosticos.php");
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
