<?php
include("../../controladores/conex.php");

date_default_timezone_set('America/Mexico_City');

$fn_id_plantilla=$_POST["fn_id_plantilla"];
$fn_descripcion=$_POST["fn_descripcion"];
$numero_factura= $_SESSION['numero_factura'];



$query = "UPDATE  cr_plantilla_ekg SET orden='$fn_orden', fk_id_estudio = '$fn_estudio', tipo = '$fn_tipo', concepto = '$fn_concepto' , valor_referencia = '$fn_valor_referencia', estado = '$fn_estado' WHERE fk_id_empresa = 1 and  id_valor='$id_valor'";

//echo $query;

$resultado = mysqli_query($conexion, $query);

if ($resultado) {
			//echo "perfil almacenado. <br />";
			echo "<script>location.href='../tabla_plantilla_ekg.php'</script>";
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
