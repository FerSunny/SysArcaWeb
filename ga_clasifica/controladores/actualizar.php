<?php
include("../../controladores/conex.php");
$id_us=$_POST["idclasifica"];
$edit1=$_POST["edit1"];
$edit2=$_POST["edit2"];


$query = " UPDATE  ga_clasifica SET fk_id_empresa='1', desc_clasifica='$edit1', estado='$edit2' where id_clasifica='$id_us'";

$resultado = mysqli_query($conexion, $query);

if ($resultado) {
			//echo "perfil almacenado. <br />";
			echo "<script>location.href='../tabla_clasifica.php'</script>";
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
