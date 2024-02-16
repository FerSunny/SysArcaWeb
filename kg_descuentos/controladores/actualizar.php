<?php
include("../../controladores/conex.php");
$id_descuento=$_POST["iddescuento"];
$edit1=$_POST["edit1"];
$edit2=$_POST["edit2"];
$edit3=$_POST["edit3"];

$query = " UPDATE  kg_descuentos SET fk_empresa='1', desc_descuento='$edit1', por_desc='$edit2', estado='$edit3' where id_descuento='$id_descuento'";

$resultado = mysqli_query($conexion, $query);

if ($resultado) {
			//echo "perfil almacenado. <br />";
			echo "<script>location.href='../tabla_descuentos.php'</script>";
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
