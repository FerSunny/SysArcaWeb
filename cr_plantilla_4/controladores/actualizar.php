<?php
include("../../controladores/conex.php");

date_default_timezone_set('America/Mexico_City');

$id_valor=$_POST["idvalor"];
$fn_orden=$_POST["fn_orden"];
$fn_estudio=$_POST["fn_estudio"];
$fn_tipo=$_POST["fn_tipo"];
$fn_concepto=$_POST["fn_concepto"];
$fn_posini=$_POST["fn_posini"];
$fn_tipfue=$_POST["fn_tipfue"];
$fn_tamfue=$_POST["fn_tamfue"];
$fn_estado=utf8_encode($_POST["fn_estado"]);

$query = "UPDATE  cr_plantilla_4 SET orden='$fn_orden', fk_id_estudio = '$fn_estudio', tipo = '$fn_tipo', concepto = '$fn_concepto' ,estado = '$fn_estado',posini = '$fn_posini', tipfue='$fn_tipfue',tamfue='$fn_tamfue' WHERE fk_id_empresa = 1 and  id_valor='$id_valor'";

//echo $query;

$resultado = mysqli_query($conexion, $query);

if ($resultado) {
			//echo "perfil almacenado. <br />";
			echo "<script>location.href='../tabla_plantilla_4.php'</script>";
		}
		else {
			echo $query;
			echo "error en la ejecución de la consulta. <br />";
      		die('Error de Conexión: ' . mysqli_connect_errno());
      		
		}

		if (mysqli_close($conexion)){
			echo "desconexion realizada. <br />";
		}
		else {
			echo "error en la desconexión";
      		die('Error de Conexión: ' . mysqli_connect_errno());
      		echo $query;
		}


 ?>
