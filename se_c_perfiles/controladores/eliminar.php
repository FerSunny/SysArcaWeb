<?php 

include "../../controladores/conex.php";

class Eliminar
{
	function Menu($id)
	{
		global $conexion;

		$query = "SELECT idsubmenu FROM se_per_submenu WHERE idmenu = ?";
		$stmt = $conexion->prepare($query);
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$stmt->bind_result($idsubmenu);
		$stmt->fetch();
		$stmt->close();

		$query = "UPDATE se_per_subsubmenu SET estado = 'S' WHERE idsubsubmenu = ?";
		$stmt = $conexion->prepare($query);
		$stmt->bind_param("i", $idsubmenu);

		if($stmt->execute())
		{
			$stmt->close();

			$query = "UPDATE se_per_submenu SET estado = 'S' WHERE idsubmenu = ?";
			$stmt = $conexion->prepare($query);
			$stmt->bind_param("i", $id);

			if($stmt->execute())
			{
				$stmt->close();

				$query = "UPDATE se_per_menu SET estado = 'S' WHERE id = ?";
				$stmt = $conexion->prepare($query);
				$stmt->bind_param("i", $id);

				if($stmt->execute())
				{
					return true;
				}else
				{
					$codigo = mysqli_errno($conexion);
		  			return $codigo;
				}
			}else
			{
				$codigo = mysqli_errno($conexion);
	  			return $codigo;
			}

		}else
		{
			$codigo = mysqli_errno($conexion);
  			return $codigo;
		}

	}

	function SubMenu($id)
	{
		global $conexion;

		$query = "UPDATE se_per_subsubmenu SET estado = 'S' WHERE idsubsubmenu = ?";
		$stmt = $conexion->prepare($query);
		$stmt->bind_param("i", $id);

		if($stmt->execute())
		{
			$query = "UPDATE se_per_submenu SET estado = 'S' WHERE idsubmenu = ?";
			$stmt = $conexion->prepare($query);
			$stmt->bind_param("i", $id);

			if($stmt->execute())
			{
				return true;
			}else
			{
				$codigo = mysqli_errno($conexion);
	  			return $codigo;
			}

		}else
		{
			$codigo = mysqli_errno($conexion);
  			return $codigo;
		}
	}

	function SubSubMenu($id)
	{
		global $conexion;
		$query = "UPDATE se_per_subsubmenu SET estado = 'S' WHERE idsubsubmenu = ?";
		$stmt = $conexion->prepare($query);
		$stmt->bind_param("i", $id);

		if($stmt->execute())
		{
			return true;
		}else
		{
			$codigo = mysqli_errno($conexion);
  			return $codigo;
		}
	}

	function Barra($id)
	{
		global $conexion;
		$query = "UPDATE se_per_barra SET estado = 'S' WHERE id = ?";
		$stmt = $conexion->prepare($query);
		$stmt->bind_param("i", $id);

		if($stmt->execute())
		{
			return true;
		}else
		{
			$codigo = mysqli_errno($conexion);
  			return $codigo;
		}
	}
}


switch ($_GET['val']) {
	case '1':
			echo Eliminar::Menu($_POST['id']);
		break;
	case '2':
			echo Eliminar::SubMenu($_POST['id']);
		break;
	case '3':
			echo Eliminar::SubSubMenu($_POST['id']);
		break;
	case '4':
			echo Eliminar::Barra($_POST['id']);
		break;
	default:
		# code...
		break;
}

 ?>