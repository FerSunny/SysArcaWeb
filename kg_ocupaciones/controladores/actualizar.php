<?php
include("../../controladores/conex.php");
$id_ocupacion=$_POST["idocupacion"];
$edit1=$_POST["edit1"];
$edit2=$_POST["edit2"];

$query = " UPDATE  kg_ocupaciones SET fk_id_empresa='1', desc_ocupacion='$edit1',estado='$edit2' where id_ocupacion='$id_ocupacion'";

$resultado = mysqli_query($conexion, $query);

if ($resultado) {
			//echo "perfil almacenado. <br />";
			echo "<script>location.href='../tabla_ocupaciones.php'</script>";
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
