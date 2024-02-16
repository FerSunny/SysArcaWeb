<?php
include("../../controladores/conex.php");


$idruta= $_POST["idruta"];
$fn_nombre= $_POST['fn_nombre']; // descripcion
$fn_sucursal = $_POST['fn_sucursal']; //estado
$fn_orden = $_POST['fn_orden'];

$query = "UPDATE  cr_plantilla_ruta SET fk_id_medico = $fn_nombre, fk_id_sucursal =$fn_sucursal, orden = $fn_orden where id_ruta = $idruta";
//echo $query;
$resultado = mysqli_query($conexion, $query);

if ($resultado) {
			//echo "perfil almacenado. <br />";
			echo "<script>location.href='../tabla_ruta.php'</script>";
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