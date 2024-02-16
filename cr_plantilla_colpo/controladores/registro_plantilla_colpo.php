<?php
session_start();
include("../../controladores/conex.php");

date_default_timezone_set('America/Mexico_City');

header("Content-Type: text/html;charset=utf-8");


$empresa ="1";
 

$fn_nombre = $_POST['fn_nombre'];
$fn_medico =$_POST['fn_medico'];
$fn_estudio = $_POST['fn_estudio'];

$fn_titulo_desc = $_POST['fn_titulo_desc'];
$fn_descripcion = $_POST['fn_descripcion'];
//$fn_titulo_conc = $_POST['fn_titulo_conc'];
//$fn_conclusion =  $_POST['fn_conclusion'];
//$fn_titulo_obse = $_POST['fn_titulo_obse'];
//$fn_observaciones = $_POST['fn_observaciones'];
//$fn_posini = 0;
//$fn_tamfue = 0;
//$fn_tipfue = 0;
$fn_estado = $_POST['fn_estado'];
$fn_firma = $_POST['fn_firma'];


$query= "INSERT INTO cr_plantilla_colpo (fk_id_empresa,fk_id_medico,id_plantilla, nombre_plantilla,fk_id_estudio,titulo_desc,descripcion,firma,estado) VALUES('$empresa','$fn_medico','0','$fn_nombre','$fn_estudio','$fn_titulo_desc','$fn_descripcion','$fn_firma','$fn_estado')";

//echo $query;

$resultado = mysqli_query($conexion, $query);

if ($resultado) 
		{
			header("location: ../tabla_plantilla_colpo.php");
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
