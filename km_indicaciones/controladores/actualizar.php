<?php
include("../../controladores/conex.php");
$id_us=$_POST["idusuario"];
$edit1=$_POST["edit1"];
$edit2=$_POST["edit2"];


$query = " UPDATE  km_indicaciones SET fk_empresa='1', desc_indicaciones='$edit1', activo='$edit2' where id_indicaciones='$id_us'";

$resultado = mysqli_query($conexion, $query);

if ($resultado) {
			//echo "perfil almacenado. <br />";
			echo "<script>location.href='../tabla_indicaciones.php'</script>";
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
