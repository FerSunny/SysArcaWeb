<?php
include("../../controladores/conex.php");

date_default_timezone_set('America/Mexico_City');

$id_menu=$_POST["idmenu"];
$nivel_menu=$_POST["nivel_menu"];
$fn_nombre=$_POST["fn_nombre"];
$fn_abreviado=$_POST["fn_abreviado"];
$fn_enlace=$_POST["fn_enlace"];

//$fn_factualiza=$_POST["fn_factualiza"];
$estado_reg=$_POST["estado_reg"];
$fn_factualiza=date("y/m/d H:i:s");

$query = "UPDATE  se_menus SET fk_id_nivel_menu ='$nivel_menu', titulo='$fn_nombre', titulo_corto = '$fn_abreviado',  enlace = '$fn_enlace', fecha_actualizacion = '$fn_factualiza', estado='$estado_reg' 
WHERE fk_id_empresa = 1 and  id_menu='$id_menu'";

//echo $query;

$resultado = mysqli_query($conexion, $query);

if ($resultado) {
			//echo "perfil almacenado. <br />";
			echo "<script>location.href='../tabla_menus.php'</script>";
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
