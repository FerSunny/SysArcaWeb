<?php
session_start();
include("../../controladores/conex.php");
$empresa ="1";

$edit1 = $_POST['edit1']; // ocupacion
$edit2 = $_POST['edit2']; // estado


$query = "INSERT INTO kg_ocupaciones(fk_id_empresa,desc_ocupacion,estado) VALUES ('$empresa','$edit1','$edit2')";

$resultado = mysqli_query($conexion, $query);

if ($resultado) {
			header("location: ../tabla_ocupaciones.php");
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
