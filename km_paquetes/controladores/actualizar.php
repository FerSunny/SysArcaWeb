<?php
include("../../controladores/conex.php");

date_default_timezone_set('America/Mexico_City');

$id_valor=$_POST["idpaquete"];
//$fn_id_usr=$_POST["fn_id_usr"];
$fn_paquete=$_POST["fn_paquete"];
$fn_estudio=$_POST["fn_estudio"];
$fn_estado=$_POST["fn_estado"];
$fn_falta=$_POST["fn_falta"];
$fn_factualiza=date("y/m/d :H:i:s");

$query = "UPDATE  km_paquetes SET id_paquete='$fn_paquete',fk_id_estudio='$fn_estudio',estado='$fn_estado',fecha_registro='$fn_falta',fecha_actualizacion='$fn_factualiza' WHERE fk_id_empresa = 1 and  id_valor='$id_valor'";

//echo $query;

$resultado = mysqli_query($conexion, $query);

if ($resultado) {
			//echo "perfil almacenado. <br />";
			echo "<script>location.href='../tabla_paquetes.php'</script>";
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
