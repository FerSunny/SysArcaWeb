<?php
include("../../controladores/conex.php");
$id_us=$_POST["idestado_civil"];
$edit1=$_POST["edit1"];
$edit2=$_POST["edit2"];

$query = " UPDATE  kg_estado_civil SET fk_id_empresa='1', desc_estado_civil='$edit1',estado='$edit2' where id_estado_civil='$id_us'";

$resultado = mysqli_query($conexion, $query);

if ($resultado) {
			//echo "perfil almacenado. <br />";
			echo "<script>location.href='../tabla_estado_civil.php'</script>";
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
