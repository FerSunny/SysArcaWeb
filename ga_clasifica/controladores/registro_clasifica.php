<?php
session_start();
include("../../controladores/conex.php");
$empresa ="1";

$edit1 = $_POST['edit1'];
$edit2 = $_POST['edit2'];
//$edit3 = $_POST['edit3'];
//$informacion=[];



$query = " INSERT INTO ga_clasifica(fk_id_empresa,desc_clasifica,estado) VALUES ('$empresa','$edit1','$edit2')";
//echo $query;
$resultado = mysqli_query($conexion, $query);

if ($resultado) {
			header("location: ../tabla_clasifica.php");
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
