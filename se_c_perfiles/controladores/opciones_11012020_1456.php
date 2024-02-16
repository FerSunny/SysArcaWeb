<?php 
session_start();
include "../../controladores/conex.php";

/**
 * 
 */
class Opciones
{
	function Menu($menu1,$menu2,$menu3)
	{
		global $conexion,$perfil;
		$count = 0;
		$empresa = 1;
		$estado = 'A';
		$filas = count($menu1);

		$query = "SELECT COUNT(*) cont FROM se_per_menu WHERE fk_id_menu = ? AND fk_id_perfil = ?";
		$stmt = $conexion->prepare($query);
		$stmt->bind_param("ii",$menu1[0], $perfil);
		$stmt->execute();
		$stmt->bind_result($cont);
		$stmt->fetch();
		$stmt->close();
		if($cont > 0)
		{
			$query = "SELECT id FROM se_per_menu WHERE fk_id_menu = ? AND fk_id_perfil = ?";
			$stmt = $conexion->prepare($query);
			$stmt->bind_param("ii", $menu1[0], $perfil);
			$stmt->execute();
			$stmt->bind_result($id);
			$stmt->fetch();
			$stmt->close();
			return $this->SubMenu($menu2,$id,$menu3);
		}else
		{
			$query = "INSERT INTO se_per_menu (fk_id_empresa,fk_id_perfil,fk_id_menu,estado) VALUES (?,?,?,?)";
			$stmt = $conexion->prepare($query);
			$stmt->bind_param("iiis",$empresa,$perfil,$menu1[0],$estado);
			$stmt->execute();
			$last_id = $conexion->insert_id;
			$stmt->close();
			return $this->SubMenu($menu2,$last_id,$menu3);
		}
			
		
	}

	function SubMenu($menu2,$last_id,$menu3)
	{
		global $conexion,$perfil;
		$count = 0;
		$empresa = 1;
		$estado = 'A';

		$query = "SELECT COUNT(*) cont FROM se_per_submenu WHERE fk_id_menu = ? AND fk_id_perfil = ? AND idmenu = ?";
		$stmt = $conexion->prepare($query);
		$stmt->bind_param("iii",$menu2[0], $perfil, $last_id);
		$stmt->execute();
		$stmt->bind_result($cont);
		$stmt->fetch();
		$stmt->close();
		
		if($cont > 0)
		{
			$query = "SELECT idsubmenu FROM se_per_submenu WHERE fk_id_menu = ? AND fk_id_perfil = ? AND idmenu = ?";
			$stmt = $conexion->prepare($query);
			$stmt->bind_param("iii",$menu2[0], $perfil, $last_id);
			$stmt->execute();
			$stmt->bind_result($idsubmenu);
			$stmt->fetch();
			$stmt->close();

			if($menu3 == 1)
			{
				return "ok";
			}else
			{
				return $this->SubSubMenu($menu3,$idsubmenu);
			}
			
			
		}else
		{
			$query = "INSERT INTO se_per_submenu (fk_id_empresa,fk_id_perfil,fk_id_menu,idmenu,estado) VALUES (?,?,?,?,?)";
			$stmt = $conexion->prepare($query);
			$stmt->bind_param("iiiis",$empresa,$perfil,$menu2[0],$last_id,$estado);
			$stmt->execute();
			$last_id = $conexion->insert_id;

		
			if($menu3 == 1)
			{
				return "ok";
			}else
			{
				return $this->SubSubMenu($menu3,$last_id);
			}
			
		}
		
	}

	function SubSubMenu($menu3,$last_id)
	{
		global $conexion,$perfil;
		$count = 0;
		$empresa = 1;
		$estado = 'A';
		$filas = count($menu3);

		$query = "SELECT COUNT(*) cont FROM se_per_subsubmenu WHERE fk_id_menu = ? AND fk_id_perfil = ? AND idsubmenu = ?";
		$stmt = $conexion->prepare($query);
		$stmt->bind_param("iii",$menu3[0], $perfil, $last_id);
		$stmt->execute();
		$stmt->bind_result($cont);
		$stmt->fetch();
		$stmt->close();


		if($count > 0)
		{
			return "ok";
		}else
		{
			$query = "INSERT INTO se_per_subsubmenu (fk_id_empresa,fk_id_perfil,fk_id_menu,idsubmenu,estado) VALUES (?,?,?,?,?)";
			$stmt = $conexion->prepare($query);
			$stmt->bind_param("iiiis",$empresa,$perfil,$menu3[0],$last_id,$estado);
			$stmt->execute();
			return "ok";
		}
		

	}

}




$ejecutar = new Opciones();

switch ($_GET['val']) {
	case '1':
		# code...
		break;
	case '2':
			$perfil = $_POST['perfil'];
			$menu1=$_POST['menu1'];
			$menu2=$_POST['menu2'];

			if(isset($_POST['menu3']))
			{
				$menu3 = $_POST['menu3'];
			}else
			{
				$menu3 = 1;
			}
			echo $ejecutar->Menu($menu1, $menu2, $menu3);
		break;
	default:
		# code...
		break;
}





 ?>