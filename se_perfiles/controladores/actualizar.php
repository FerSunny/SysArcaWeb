<?php
include("../../controladores/conex.php");

date_default_timezone_set('America/Mexico_City');

$id_perfil=$_POST["idperfil"];
$fn_nombre=$_POST["fn_nombre"];
$fn_modulo=$_POST["fn_modulo"];
$fn_lectura=$_POST["fn_lectura"];
$fn_escritura=$_POST["fn_escritura"];
$fn_borra=$_POST["fn_borra"];
$fn_actualizar=$_POST["fn_actualizar"];
$fn_falta=$_POST["fn_falta"];
//$fn_factualiza=$_POST["fn_factualiza"];
$estado_reg=$_POST["estado_reg"];
$fn_factualiza=date("y/m/d :H:i:s");

$query = "UPDATE  se_perfiles SET desc_perfil='$fn_nombre', fk_id_modulo = '$fn_modulo', per_lectura = '$fn_lectura', per_escritura = '$fn_escritura' , per_borrar = '$fn_borra', per_actualizar='$fn_actualizar',fecha_registro='$fn_falta', fecha_actualizacion = '$fn_factualiza', estado='$estado_reg' WHERE fk_id_empresa = 1 and  id_perfil='$id_perfil'";

//echo $query;

$resultado = mysqli_query($conexion, $query);

if ($resultado) {
			//echo "perfil almacenado. <br />";
			echo "<script>location.href='../tabla_perfiles.php'</script>";
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
