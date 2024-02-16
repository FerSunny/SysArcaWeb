<?php
include("../../controladores/conex.php");
$iddiagnostico = $_POST["id_diagnostico"];
$fn_diagnostico = $_POST["fn_diagnostico"];
$fn_abreviada = $_POST["fn_abreviada"];
$fn_estado = $_POST["fn_estado"];

$query = " UPDATE  km_diagnosticos SET desc_diagnostico = '$fn_diagnostico', desc_abreviada = '$fn_abreviada', estado = '$fn_estado' where id_diagnostico = '$iddiagnostico'";

$resultado = mysqli_query($conexion, $query);

if ($resultado) {
			//echo "perfil almacenado. <br />";
			echo "<script>location.href='../tabla_diagnosticos.php'</script>";
		}
		else {
			echo "error en la ejecución de la consulta. <br />";
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
