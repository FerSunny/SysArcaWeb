<?php 
include "../../controladores/conex.php";
/**
 * 
 */
class Barra
{
	function NewBarra($id,$perfil)
	{
		global $conexion;


		$query = "SELECT COUNT(*) cant FROM se_per_barra WHERE fk_id_perfil = ?";
		$stmt = $conexion->prepare($query);
		$stmt->bind_param("i", $perfil);
		$stmt->execute();
		$stmt->bind_result($cant);
		$stmt->fetch();
		$stmt->close();

		if($cant == 5)
		{
			return "Solo puede registrar 5 opciones";
		}else
		{
			$query = "SELECT COUNT(*) cant FROM se_per_barra WHERE fk_id_perfil = ? AND fk_id_menu = ?";
			$stmt = $conexion->prepare($query);
			$stmt->bind_param("ii", $perfil,$id);
			$stmt->execute();
			$stmt->bind_result($cant);
			$stmt->fetch();
			$stmt->close();

			$estado = 'A';
			$empresa = 1;
			if($cant > 0)
			{
				return "La opcion ya esta registrada";
			}else
			{
				$query = "INSERT INTO se_per_barra (fk_id_empresa,fk_id_perfil, fk_id_menu, estado) VALUES(?,?,?,?)";
				$stmt = $conexion->prepare($query);
				$stmt->bind_param("iiis",$empresa,$perfil,$id,$estado);

				if($stmt->execute())
				{
					return "Opcion agregada correctamente";
				}else
				{
					$codigo = mysqli_errno($conexion);
			  		return "Error en MySQL #".$codigo;
				}
			}
		}
		
	}
}



echo Barra::NewBarra($_POST['id'],$_POST['perfil']);



 ?>