<?php
include("../../controladores/conex.php");

date_default_timezone_set('America/Mexico_City');

$id_modulo=$_POST["idmodulo"];
$fn_nombre=$_POST["fn_nombre"];
$fn_abreviado=$_POST["fn_abreviado"];
$fn_falta=$_POST["fn_falta"];
//$fn_factualiza=$_POST["fn_factualiza"];
$estado_reg=$_POST["estado_reg"];
$fn_factualiza=date("y/m/d :H:i:s");

$query = "UPDATE  se_modulos SET desc_modulo ='$fn_nombre', abreviado = '$fn_abreviado', fecha_registro='$fn_falta', fecha_actualizacion = '$fn_factualiza', estado='$estado_reg' WHERE fk_empresa = 1 and  id_modulo='$id_modulo'";

//echo $query;

$resultado = mysqli_query($conexion, $query);

if ($resultado) {
			//echo "perfil almacenado. <br />";
			echo "<script>location.href='../tabla_modulos.php'</script>";
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
