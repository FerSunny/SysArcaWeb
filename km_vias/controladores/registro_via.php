<?php
session_start();
include("../../controladores/conex.php");
$empresa ="1";
 // estado civil
$fn_descripcion = $_POST['fn_descripcion'];
$fn_estado = $_POST['fn_estado']; // estado


$query = "INSERT INTO km_via(fk_id_empresa,desc_via,estado) VALUES ('$empresa','$fn_descripcion','$fn_estado')";

$resultado = mysqli_query($conexion, $query);

if ($resultado) {
			header("location: ../tabla_via.php");
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
