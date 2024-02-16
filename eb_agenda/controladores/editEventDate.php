<?php

// Conexion a la base de datos
include ("../../controladores/conex.php");

$id = $_POST['id'];
$title = $_POST['title'];
$notas = $_POST['notas'];
$start = $_POST['start'];
$start_t = $_POST['start-time'];
$end = $_POST['end'];
$end_t = $_POST['end-time'];
$color = $_POST['color-fecha'];
$estado = 'S';


if(isset($_POST['delete']))
{
	//echo "Viene LLeno";
	eliminar_evento($conexion,$id,$estado);
}else
{
	//echo "Viene Vacio";
	editar_evento($conexion,$id,$title,$notas,$start,$start_t,$end,$end_t,$color);
}


function editar_evento($conexion,$id,$title,$notas,$start,$start_t,$end,$end_t,$color)
{
	global $conexion;

		$stmt = $conexion->prepare("UPDATE eb_eventos SET
		title = ?,
		notas = ?,
		start = ?,
		start_time = ?,
		end = ?,
		end_time = ?,
		color = ?
		WHERE id_evento = ?");

		$stmt->bind_param('sssssssi',$title,$notas,$start,$start_t,$end,$end_t,$color,$id);
		$result = $stmt->execute();
		$stmt->close();

		if($result) 
		{
			echo 1;
		}else
		{
			$codigo = mysqli_errno($conexion); 
    		echo $codigo;
		}

}

function eliminar_evento($conexion,$id,$estado)
{

		global $conexion;


		$stmt = $conexion->prepare("UPDATE eb_eventos SET estado = ? WHERE id_evento = ?");

		$stmt->bind_param('si',$estado,$id);
		$result = $stmt->execute();
		$stmt->close();

		if($result) 
		{
			echo 2;
		}else
		{
			$codigo = mysqli_errno($conexion); 
    		echo $codigo;
		}

}


?>
