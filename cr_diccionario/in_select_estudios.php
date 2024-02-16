<?php 
session_start();
include ("../controladores/conex.php");
$empresa = $_SESSION['s_empresa'];

$accion = $_GET['val'];


switch ($accion) {
	case '1': // colegiaturas
			$id_estudio = $_POST['id_estudio'];
			Llenar_colegiatura($conexion,$id_estudio,$empresa);
		break;
	case '2': // localidades
			$id_municipio = $_POST['id_municipio'];
			$id_estado = $_POST['id_estado'];
			Llenar_localidades($conexion_sid,$id_estado,$id_municipio);
		break;
	case '3':
			$id_localidad = $_POST['id_localidad'];
			Llenar_localidades($conexion_sid,$id_localidad);
		break;
	
	default:
		# code...
		break;
}

function Llenar_colegiatura($conexion,$id_estudio,$empresa)
{
	$query = "
	SELECT a.`id_valor`, a.`concepto` 
	FROM cr_plantilla_1 a
	WHERE A.`estado` = 'A'
	AND a.`tipo` = 'P'
	AND a.`concepto` <> '.'
	AND a.`fk_id_estudio` = $id_estudio
	";

	$result = $conexion->query($query);

	while ($row = mysqli_fetch_array($result)) 
	{
	  echo '<option value="'.$row['id_valor'].'">'.$row['concepto'].'</option>';
	}


}
function Llenar_localidades($conexion_sid,$id_estado,$id_municipio)
{
	$query = "SELECT id_localidad,desc_localidad FROM co_localidades WHERE estado = 'A' AND  id_estado = $id_estado AND fk_id_municipio = $id_municipio ORDER BY 2";

	$result = $conexion_sid->query($query);

	while ($row = mysqli_fetch_array($result)) 
	{
	  echo '<option value="'.$row['id_localidad'].'">'.$row['desc_localidad'].'</option>';
	}

}

 ?>