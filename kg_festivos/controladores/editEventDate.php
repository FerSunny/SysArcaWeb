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
$user_af = 0;//$_POST['user_af'];
$dia_f = $_POST['dia_f'];


if(isset($_POST['delete']))
{
	//echo "Viene LLeno";
	eliminar_evento($conexion,$id,$estado);
}else
{
	//echo "Viene Vacio";
	editar_evento($conexion,$id,$title,$notas,$start,$start_t,$end,$end_t,$color,$user_af,$dia_f);
}


function editar_evento($conexion,$id,$title,$notas,$start,$start_t,$end,$end_t,$color,$user_af,$dia_f)
{
	global $conexion;

		$stmt = $conexion->prepare("UPDATE kg_festivos SET
		title = ?,
		notas = ?,
		start = ?,
		start_time = ?,
		end = ?,
		end_time = ?,
		color = ?,
		afecta_usuario = ?,
		dia_festivo = ?
		WHERE id_festivo= ?");

		$stmt->bind_param('sssssssiii',$title,$notas,$start,$start_t,$end,$end_t,$color,$user_af,$dia_f,$id);
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


		$stmt = $conexion->prepare("UPDATE kg_festivos SET estado = ? WHERE id_festivo = ?");

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
