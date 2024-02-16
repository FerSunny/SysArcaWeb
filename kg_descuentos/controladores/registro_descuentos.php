<?php
session_start();
include("../../controladores/conex.php");
$empresa ="1";

$edit1 = $_POST['edit1']; // descripcion
$edit2 = $_POST['edit2']; // porcentaje
$edit3 = $_POST['edit3']; //estado

$query = "INSERT INTO kg_descuentos(fk_empresa,desc_descuento,por_desc,fk_perfil_sucusal,estado) VALUES ('$empresa','$edit1','$edit2','0','$edit3')";


$resultado = mysqli_query($conexion, $query);

if ($resultado) {
			header("location: ../tabla_descuentos.php");
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
