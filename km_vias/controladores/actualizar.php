<?php
include("../../controladores/conex.php");
$idvia = $_POST["id_via"];
$fn_descripcion = $_POST["fn_descripcion"];
$fn_estado = $_POST["fn_estado"];

$query = " UPDATE  km_via SET  desc_via = '$fn_descripcion', estado = '$fn_estado' where id_via = '$idvia'";

$resultado = mysqli_query($conexion, $query);

if ($resultado) {
			//echo "perfil almacenado. <br />";
			echo "<script>location.href='../tabla_via.php'</script>";
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
