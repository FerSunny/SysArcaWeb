<?php 

include ("../labora/controladores/conex.php");


$accion = $_GET['val'];


switch ($accion) {
	case '1': // municipios
			$id_empresa = $_POST['id_empresa'];
			Llenar_sucursales($conexion,$id_empresa);
		break;
	case '2': // localidades
			$id_municipio = $_POST['id_municipio'];
			$id_estado = $_POST['id_estado'];
			Llenar_localidades($conexion,$id_estado,$id_municipio);
		break;
	case '3':
			$id_localidad = $_POST['id_localidad'];
			Llenar_localidades($conexion,$id_localidad);
		break;
	
	default:
		# code...
		break;
}

function Llenar_sucursales($conexion,$id_empresa)
{
	$query = "SELECT id_sucursal,desc_sucursal FROM kg_sucursales WHERE estado = 'A' AND fk_id_empresa = $id_empresa order by 2";

	$result = $conexion->query($query);

	while ($row = mysqli_fetch_array($result)) 
	{
	  echo '<option value="'.$row['id_sucursal'].'">'.$row['desc_sucursal'].'</option>';
	}


}
function Llenar_localidades($conexion,$id_estado,$id_municipio)
{
	$query = "SELECT id_localidad,desc_localidad FROM ku_localidades WHERE estado = 'A' AND  id_estado = $id_estado AND fk_id_municipio = $id_municipio ORDER BY 2";

	$result = $conexion->query($query);

	while ($row = mysqli_fetch_array($result)) 
	{
	  echo '<option value="'.$row['id_localidad'].'">'.$row['desc_localidad'].'</option>';
	}

}

 ?>