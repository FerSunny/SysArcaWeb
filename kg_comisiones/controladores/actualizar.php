<?php
include("../../controladores/conex.php");
$id_us=$_POST["idcomision"];
$edit1=$_POST["edit1"];
$edit2=$_POST["edit2"];
$edit3=$_POST['edit3'];


$query = " UPDATE  kg_comisiones SET fk_empresa='1', desc_comision='$edit1',porcentaje='$edit3', estado='$edit2' where id_comision='$id_us'";

$resultado = mysqli_query($conexion, $query);

if ($resultado) {
			//echo "perfil almacenado. <br />";
			echo "<script>location.href='../tabla_comisiones.php'</script>";
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
