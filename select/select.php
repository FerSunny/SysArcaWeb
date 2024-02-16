<?php 

include ("../labora/controladores/conex.php");

$accion = $_GET['val'];


switch ($accion) {
	case '1':
			$id_area = $_POST['id_area'];
			Llenar_consultorios($conexion,$id_area);
		break;
	case '2':
			$id_area = $_POST['id_area'];
			Llenar_medicos($conexion,$id_area);
		break;
		
	default:
		# code...
		break;
}


function Llenar_consultorios($conexion,$id_area)
{
	$query = "SELECT id_consultorio,clave_consultorio FROM ce_consultorios WHERE estado = 'A' AND fk_id_area = $id_area";

	$result = $conexion->query($query);

	while ($row = mysqli_fetch_array($result)) 
	{
	  echo '<option value="'.$row['id_consultorio'].'">'.$row['clave_consultorio'].'</option>';
	}


}

function Llenar_medicos($conexion,$id_area)
{
	$query = "SELECT id_medico,concat(nombre,' ',a_paterno,' ',a_materno) as nombre FROM so_medicos WHERE estado = 'A' AND fk_id_area = $id_area";

	$result = $conexion->query($query);

	while ($row = mysqli_fetch_array($result)) 
	{
	  echo '<option value="'.$row['id_medico'].'">'.$row['nombre'].'</option>';
	}

}

 ?>