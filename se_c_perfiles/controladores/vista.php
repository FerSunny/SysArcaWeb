<?php 

include "../../controladores/conex.php";

class Vista
{

	
	function VistaMenu($perfil)
	{
		global $conexion;
		$query = "SELECT n1.id,n1.fk_id_perfil,sm.id_menu,sm.titulo,sm.enlace,sm.fk_id_nivel_menu,
				CASE 
				WHEN sm.enlace IS NULL OR sm.enlace = '' OR sm.enlace = '#' THEN 
				'S'
				ELSE
				'L'
				END link FROM se_per_menu n1 
				LEFT OUTER JOIN se_menus sm ON (sm.id_menu = n1.fk_id_menu)
				WHERE n1.fk_id_perfil = ? AND n1.estado = 'A'";

		$stmt = $conexion->prepare($query);
		$stmt->bind_param("i", $perfil);

		if($stmt->execute())
		{
			$option = "";
			$result = $stmt->get_result();
			$rows = $result->num_rows;
			$stmt->close();

			if($rows > 0)
			{
				$option .="<ul class = 'list-group'>";
				while ($row = $result->fetch_assoc()) 
				{
					if($row['link'] == "L")
					{
						$option .="<li class = 'list-group-item list-group-item-danger'>";
						$option .= "<i class='fas fa-link'></i> &nbsp;&nbsp;";
					}else
					{
						$option .="<li class = 'list-group-item list-group-item-danger'>";
						$option .= "";
					}
						$option .= $row['titulo']. "&nbsp;&nbsp; <i class='fas fa-times' style='color: red;cursor: pointer;' onclick='DeleteMenu(".$row["id"].",".$row['fk_id_perfil'].")'></i>";

					if($row['link'] == "L")
					{
						$cant = self::Barr($row['id_menu'],$row['fk_id_perfil']);

						if($cant > 0)
						{
						}else
						{
							$option .= "&nbsp;&nbsp; <i class='fas fa-bars' style='color: green;cursor: pointer; font-weight:900;' onclick='AddBarra(".$row["id_menu"].",".$row['fk_id_perfil'].")'></i>";
						}
					}else
					{

					}
						$option .= "<ul class = 'list-group'>";
							$option .= self::VistaSubMenu($row['id'],$perfil);
						$option .= "</ul>";
					$option .= "</li>";
				}
				$option .="</ul>";

				return $option;
			}else
			{
				return "Sin datos";
			}
		}else
		{
			$codigo = mysqli_errno($conexion);
  			echo $codigo;
		}
		
	}


	function VistaSubMenu($id,$perfil)
	{
		global $conexion;
		$query = "SELECT n2.idsubmenu,n2.fk_id_perfil,sm.id_menu,sm.titulo,sm.enlace,sm.fk_id_nivel_menu,
					CASE 
					WHEN sm.enlace IS NULL OR sm.enlace = '' OR sm.enlace = '#' THEN 
					'S'
					ELSE
					'L'
					END link
					FROM se_per_submenu n2
					LEFT OUTER JOIN se_menus sm ON (sm.id_menu = n2.fk_id_menu)
					WHERE n2.fk_id_perfil = ? AND n2.idmenu = ? AND n2.estado = 'A'";
		$stmt = $conexion->prepare($query);
		$stmt->bind_param("ii", $perfil, $id);
		$stmt->execute();
		$result = $stmt->get_result();
		$rows = $result->num_rows;
		$option = "";
		while ($row = $result->fetch_assoc()) 
		{
			if($rows > 0)
			{
				if($row['link'] == "L")
				{
					$option .= "<li class = 'list-group-item list-group-item-warning'>";
					$option .= "<i class='fas fa-link'></i> &nbsp;&nbsp;";
				}else
				{
					$option .= "<li class = 'list-group-item list-group-item-warning'>";
					$option .= "";
				}
					$option .= $row['titulo']. "&nbsp;&nbsp; <i class='fas fa-times' style='color: red;cursor: pointer; font-size:1em;' onclick='DeleteSubMenu(".$row["idsubmenu"].",".$row['fk_id_perfil'].")'></i>";

				if($row['link'] == "L")
				{
					$cant = self::Barr($row['id_menu'],$row['fk_id_perfil']);

					if($cant > 0)
					{
					}else
					{
						$option .= "&nbsp;&nbsp; <i class='fas fa-bars' style='color: green;cursor: pointer; font-weight:900;' onclick='AddBarra(".$row["id_menu"].",".$row['fk_id_perfil'].")'></i>";
					}
				}else
				{

				}

					$option .= "<ul class = 'list-group'>";
						$option .= self::VisSubSubMenu($row['idsubmenu'],$perfil);
					$option .= "</ul>";
				$option .= "</li>";
			}else
			{
				$option = "";
			}
			

		}
		return $option;
	}


	function VisSubSubMenu($id,$perfil)
	{
		global $conexion;
		$query = "SELECT n3.idsubsubmenu,n3.fk_id_perfil,sm.id_menu,sm.titulo,sm.enlace,sm.fk_id_nivel_menu,
					CASE 
					WHEN sm.enlace IS NULL OR sm.enlace = '' OR sm.enlace = '#' THEN 
					'S'
					ELSE
					'L'
					END link
					FROM se_per_subsubmenu n3
					LEFT OUTER JOIN se_menus sm ON (sm.id_menu = n3.fk_id_menu)
					WHERE n3.fk_id_perfil = ? AND n3.idsubmenu = ? AND n3.estado = 'A'";
		$stmt = $conexion->prepare($query);
		$stmt->bind_param("ii", $perfil, $id);
		$stmt->execute();
		$result = $stmt->get_result();
		$rows = $result->num_rows;
		$option = "";
		while ($row = $result->fetch_assoc()) 
		{
			if($rows > 0)
			{
				if($row['link'] == "L")
				{
					$option .= "<li class = 'list-group-item list-group-item-info'>";
					$option .= "<i class='fas fa-link'></i> &nbsp;&nbsp;";
				}else
				{
					$option .= "<li class = 'list-group-item list-group-item-info'>";
					$option .= "";
				}
				//$option .= "<li class = 'list-group-item list-group-item-info'>";
					$option .= $row['titulo']. "&nbsp;&nbsp; <i class='fas fa-times' style='color: red;cursor: pointer;' onclick='DeleteSubSubMenu(".$row["idsubsubmenu"].",".$row['fk_id_perfil'].")'></i>";

				if($row['link'] == "L")
				{
					$cant = self::Barr($row['id_menu'],$row['fk_id_perfil']);

					if($cant > 0)
					{
					}else
					{
						$option .= "&nbsp;&nbsp; <i class='fas fa-bars' style='color: green;cursor: pointer; font-weight:900;' onclick='AddBarra(".$row["id_menu"].",".$row['fk_id_perfil'].")'></i>";
					}
					
				}else
				{

				}

				$option .= "</li>";
			}else
			{
				$option = "";
			}
			//<i class="fas fa-ban"></i>

		}
		return $option;
	}



	function Barr($id,$perfil)
	{
		global $conexion;
			$query = "SELECT COUNT(*) cant FROM se_per_barra WHERE fk_id_perfil = ? AND fk_id_menu = ? AND estado = 'A'";
			$stmt = $conexion->prepare($query);
			$stmt->bind_param("ii", $perfil,$id);
			$stmt->execute();
			$stmt->bind_result($cant);
			$stmt->fetch();
			$stmt->close();

			return $cant;
	}

	function Barra($perfil)
	{
		global $conexion;

		$query = "SELECT pb.id,pb.fk_id_menu,pb.fk_id_perfil,m.titulo,m.enlace FROM se_per_barra pb
					LEFT OUTER JOIN se_menus m ON (m.id_menu = pb.fk_id_menu)
					WHERE fk_id_perfil = ? AND pb.estado = 'A'";
		$stmt = $conexion->prepare($query);
		$stmt->bind_param("i",$perfil);
		$stmt->execute();
		$result = $stmt->get_result();

		$option = "";
		$option .= "<li>";
			$option .= "<a href='../xx_menu_unico/menu_principal'>";
				$option .= "Inicio";
			$option .= "</a>";
		$option .= "</li>";
		while ($row = $result->fetch_assoc())
		{
			$option .= "<li>";
				$option .= "<a href='".$row['enlace']."'>";
					$option .= $row['titulo'];
				$option .= "</a>";
				$option .= "&nbsp;&nbsp; <i class='fas fa-times' style='color: red;cursor: pointer;' onclick='DeleteBarra(".$row['id'].",".$row['fk_id_perfil'].")'></i>";
			$option .= "</li>";
		}
		return $option;
	}
}


$val = $_GET['val'];

switch ($val) {
	case '1':
		echo Vista::VistaMenu($_POST['perfil']);
		break;
	case '2':
		echo Vista::Barra($_POST['perfil']);
		break;
	default:
		# code...
		break;
}




 ?>