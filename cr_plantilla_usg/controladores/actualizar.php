<?php
include("../../controladores/conex.php");

//date_default_timezone_set('America/Mexico_City');
//header("Content-Type: text/html;charset=utf-8");

$id_plantilla=$_POST["fn_id_plantilla"];
$fn_nombre = $_POST['fn_nombre'];
$fn_medico =$_POST['fn_medico'];
$fn_estudio = $_POST['fn_estudio'];
$fn_titulo_desc = $_POST['fn_titulo_desc'];
$fn_descripcion = $_POST['fn_descripcion'];
/*
$fn_titulo_conc = $_POST['fn_titulo_conc'];
$fn_conclusion = $_POST['fn_conclusion'];
$fn_titulo_obse = $_POST['fn_titulo_obse'];
$fn_observaciones = $_POST['fn_observaciones'];
$fn_posini = 0;
$fn_tamfue = 0;
$fn_tipfue = 0;
*/
$fn_estado = $_POST['fn_estado'];
$fn_firma = $_POST['fn_firma'];

$query = "UPDATE  cr_plantilla_usg SET nombre_plantilla = '$fn_nombre',fk_id_medico='$fn_medico',fk_id_estudio = '$fn_estudio',titulo_desc='$fn_titulo_desc' ,descripcion = '$fn_descripcion' , estado='$fn_estado',firma='$fn_firma' WHERE fk_id_empresa = 1 and  id_plantilla='$id_plantilla'";

//echo $query;

$resultado = mysqli_query($conexion, $query);

if ($resultado) {
			//echo "perfil almacenado. <br />";
			echo "<script>location.href='../tabla_plantilla_usg.php'</script>";
		}
		else {
			echo $query;
			echo "error en la ejecución de la consulta. <br />";
      		die('Error de Conexión: ' . mysqli_connect_errno());
      		echo $query;
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
