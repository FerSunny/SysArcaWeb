<?php
date_default_timezone_set('America/Chihuahua');
include("../../controladores/conex.php");
$fn_id_factura=$_POST["fn_id_factura"];
$fn_fk_id_estudio=$_POST["fn_fk_id_estudio"];


$query = " UPDATE  cr_plantilla_tomo_rad_re SET estado='S' where fk_id_factura ='$fn_id_factura' and fk_id_estudio = '$fn_fk_id_estudio' ";

$resultado = mysqli_query($conexion, $query);

if ($resultado) {
			//echo "perfil almacenado. <br />";
			echo "<script>location.href='../tabla_agenda.php'</script>";
		}
		else {
			echo "error en la ejecución de la consulta. <br />";
			echo $query;
      die('Error de Conexión: ' . mysqli_connect_errno());
		}

		if (mysqli_close($conexion)){
			echo "desconexion realizada. <br />";
		}
		else {
			echo "error en la desconexión";

      die('Error de Conexión: ' . mysqli_connect_errno());

		}