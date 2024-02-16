<?php
session_start();
include("../../controladores/conex.php");

date_default_timezone_set('America/Mexico_City');

$id_beneficiario=$_POST["idbeneficiario"];
$fk_id_sucursal=$_SESSION['fk_id_sucursal'];
$fn_giro=$_POST["fn_giro"];
$fn_nombre=utf8_encode($_POST["fn_nombre"]);
$fn_tfijo=$_POST["fn_tfijo"];
$fn_tmovil=$_POST["fn_tmovil"];
$fn_direccion=utf8_encode($_POST["fn_direccion"]);
$fn_mail=$_POST["fn_mail"];
$fn_falta=$_POST["fn_falta"];
$fn_factualiza=date("y/m/d :H:i:s");
$fn_estado=$_POST["fn_estado"];

$query = "UPDATE  ga_beneficiarios SET fk_id_sucursal = '$fk_id_sucursal', fk_id_giro = '$fn_giro', nombre='$fn_nombre', telefono_fijo='$fn_tfijo',telefono_movil='$fn_tmovil',mail='$fn_mail',direccion='$fn_direccion',fecha_registro='$fn_falta',fecha_actualizacion='$fn_factualiza',estado = '$fn_estado' WHERE fk_id_empresa = 1 and  id_beneficiario='$id_beneficiario'";

//echo $query;

$resultado = mysqli_query($conexion, $query);

if ($resultado) {
			//echo "perfil almacenado. <br />";
			echo "<script>location.href='../tabla_beneficia.php'</script>";
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
