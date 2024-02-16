<?php
include("../../controladores/conex.php");
date_default_timezone_set('America/Mexico_City');


$fecha=date("d/m/Y H:i:s");
$hora=date("H:i:s");
$id=$_POST["idcliente"];
$fe=$_POST["fe"];
$he=$_POST["he"];
$medico=$_POST['medico'];
$obs=$_POST['obs'];
$diag = $_POST["diag"];
$origen=$_POST["origen"];
$estado=$_POST['estado'];



$query = "UPDATE  so_cabezal SET fk_id_medico='$medico', fecha_entrega='$fe', hora_entrega='$he', observaciones='$obs', diagnostico='$diag',estado='$estado',origen='$origen' where id_solicitud='$id' ";
//echo $query;

$resultado = mysqli_query($conexion, $query);

if ($resultado) {
			echo "<script>location.href='../modificacion_orden.php'</script>";
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
