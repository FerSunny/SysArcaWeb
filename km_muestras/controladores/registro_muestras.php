<?php
session_start();
include("../../controladores/conex.php");
$empresa ="1";
$edit2 = $_POST['edit2'];
$edit3 = $_POST['edit3'];
$edit4 = $_POST['edit4'];
$edit5 = $_POST['edit5'];


$query = " INSERT INTO km_muestras(fk_empresa,desc_muestra,recoleccion,cantidad,estado) VALUES ('$empresa','$edit2','$edit3','$edit4','$edit5')";
$resultado = mysqli_query($conexion, $query);

if ($resultado) {
			//echo "perfil almacenado. <br />";
			header("location: ../tabla_muestras.php");
			//echo "<script>location.href='../tabla_usuarios.php'</script>";
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
