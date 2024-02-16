<?php
include("../../controladores/conex.php");
$iddosis = $_POST["id_dosis"];
$fn_dosis= $_POST["fn_dosis"];
$fn_estado = $_POST["fn_estado"];

$query = " UPDATE  km_dosis SET  desc_dosificacion = '$fn_dosis', estado = '$fn_estado' where id_dosis = '$iddosis'";

$resultado = mysqli_query($conexion, $query);

if ($resultado) {
			//echo "perfil almacenado. <br />";
			echo "<script>location.href='../tabla_dosis.php'</script>";
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
