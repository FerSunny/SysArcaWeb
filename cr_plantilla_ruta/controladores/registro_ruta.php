<?php
session_start();
include("../../controladores/conex.php");
$empresa ="1";
$fn_nombre= $_POST['fn_nombre']; // descripcion
$fn_sucursal = $_POST['fn_sucursal']; //estado
$fn_orden = $_POST['fn_orden'];

$query = "INSERT INTO cr_plantilla_ruta(fk_id_empresa,fk_id_medico,fk_id_sucursal,orden,estado) VALUES (1,$fn_nombre,$fn_sucursal, $fn_orden,'A')";


$resultado = mysqli_query($conexion, $query);

if ($resultado) {
			header("location: ../tabla_ruta.php");
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
