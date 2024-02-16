<?php
session_start();
include("../../controladores/conex.php");
$empresa ="1";

$fn_tipo_concepto = $_POST['fn_tipo_concepto'];
$gasto = $_POST['gasto'];
$estado = $_POST['estado'];
$tipo = $_POST['fn_tipo'];
$clasifica = $_POST['fn_clasifica'];
//$edit3 = $_POST['edit3'];
//$informacion=[];



$query = " INSERT 
INTO ga_gasto(fk_id_empresa,fk_id_tipo_concepto,fk_id_clasifica,fk_id_tipo_gasto, desc_gasto,estado) VALUES ('$empresa','$fn_tipo_concepto','$clasifica','$tipo','$gasto','$estado')";
//echo $query;
$resultado = mysqli_query($conexion, $query);

if ($resultado) {
			header("location: ../tabla_gastos.php");
			//echo "<script>location.href='../tabla_usuarios.php'</script>";
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
