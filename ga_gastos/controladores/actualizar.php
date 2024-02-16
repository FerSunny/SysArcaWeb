<?php
include("../../controladores/conex.php");
$id_gasto=$_POST["idgasto"];
$fk_id_clasifica=$_POST["fn_clasifica"];
$fk_id_tipo=$_POST["fn_tipo"];
$gasto=$_POST["gasto"];
$estado=$_POST["estado"];


$query = " UPDATE  ga_gasto SET fk_id_empresa='1', desc_gasto='$gasto', estado='$estado',fk_id_clasifica='$fk_id_clasifica',fk_id_tipo_gasto='$fk_id_tipo'   where id_gasto='$id_gasto'";

//echo $query;

$resultado = mysqli_query($conexion, $query);

if ($resultado) {
			//echo "perfil almacenado. <br />";
			echo "<script>location.href='../tabla_gastos.php'</script>";
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
