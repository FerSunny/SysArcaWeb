<?php
session_start();
include("../../controladores/conex.php");

//date_default_timezone_set('America/Mexico_City');

$empresa ="1";
 
$fn_id_valor = $_POST['fn_id_valor'];
$fn_orden = $_POST['fn_orden'];
$fn_estudio = $_POST['fn_estudio'];
$fn_tipo = $_POST['fn_tipo'];
$fn_concepto = $_POST['fn_concepto'];
$fn_posini = $_POST['fn_posini'];
$fn_tamfue = $_POST['fn_tamfue'];
$fn_tipfue = $_POST['fn_tipfue'];
//$fn_sensibilidad =  utf8_encode($_POST['fn_sensibilidad']);
$fn_estado = $_POST['fn_estado'];


$query= "INSERT INTO cr_plantilla_cvo (fk_id_empresa,id_valor,orden,fk_id_estudio,tipo,concepto,posini,tamfue,tipfue,estado) VALUES('$empresa','0','$fn_orden','$fn_estudio','$fn_tipo','$fn_concepto','$fn_posini','$fn_tamfue','$fn_tipfue','$fn_estado')";

//echo $query;

$resultado = mysqli_query($conexion, $query);

if ($resultado) 
		{
			header("location: ../tabla_plantilla_cvo.php");
			//echo "<script>location.href='../tabla_usuarios.php'</script>";
		}
		else 
		{
			echo $query;
			echo "error en la ejecucion de la consulta. <br />";
      		die('Error de Conexion: ' . mysqli_connect_errno());
      		echo $query;
      		//die('Error de Conexión (INSERT): ' . mysqli_error());
		}

	if (mysqli_close($conexion))
		{
			echo "desconexion realizada. <br />";
		}
		else 
		{
			echo "error en la desconexión";
      		die('Error de Conexión: ' . mysqli_connect_errno());
      		echo $query;

		}
?>
