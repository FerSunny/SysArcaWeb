<?php
include("../../controladores/conex.php");
$id_us=$_POST["idusuario"];
$edit1=$_POST['edit1'];
$edit2=$_POST["edit2"];
$edit3=$_POST["edit3"];
$edit4 = $_POST["edit4"];
$edit5=$_POST["edit5"];


$query = " UPDATE  km_muestras SET fk_empresa='1', desc_muestra='$edit2', recoleccion='$edit3', cantidad='$edit4', estado='$edit5' where id_muestra='$id_us'";

$resultado = mysqli_query($conexion, $query);

if ($resultado) {
			echo "<script>location.href='../tabla_muestras.php'</script>";
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
