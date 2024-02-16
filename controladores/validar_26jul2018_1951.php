<?php

include("conex.php");
$usuario = $_POST['usua'];
$pass = $_POST['contra'];

//$query = "SELECT * FROM se_usuarios where id_usr= '" . $usuario . "' ";
$query = "SELECT us.*,
	pe.desc_perfil,
	mo.desc_modulo,
	mo.id_modulo
FROM se_usuarios us
LEFT OUTER JOIN se_perfiles pe ON (pe.id_perfil = us.fk_id_perfil)
LEFT OUTER JOIN se_modulos mo ON (mo.id_modulo = pe.fk_id_modulo) where us.activo = 'A' and id_usr= '" . $usuario . "' ";

$resultado = mysqli_query($conexion, $query);

if($row = mysqli_fetch_array($resultado))
{
	if($row['pass'] == $pass)
	{
		//header("Location: menu.php");
		//echo '<script> alert("Bienvenido")</script>';
		session_start();
  		$_SESSION['ingreso']='YES';
  		$_SESSION['nombre']=$usuario;

  		$_SESSION['fk_id_sucursal']=$row['fk_id_sucursal'];
		$_SESSION['nombre_completo']=$row['nombre'] .' '. $row['a_paterno'] . ' '. $row['a_materno'];
		$_SESSION['fk_id_perfil']=$row['fk_id_perfil'];
		$_SESSION['id_modulo']=$row['id_modulo'];
		$_SESSION['desc_perfil']=$row['desc_perfil'];
		$_SESSION['id_usuario']=$row['id_usuario'];

  		if($row['fk_id_perfil']==1)
  			{
				echo "<script>location.href='../xx_menu/menu.php'</script>";
			}
			elseif ($row['fk_id_perfil']==8) 
			{
				echo "<script>location.href='../xx_menu/menu_8.php'</script>";
			}
			elseif ($row['fk_id_perfil']==4) 
			{
				echo "<script>location.href='../xx_menu/menu_4.php'</script>";
			}			
			elseif ($row['fk_id_perfil']==11) 
			{
				echo "<script>location.href='../xx_menu/menu_11.php'</script>";
			}
			elseif ($row['fk_id_perfil']==12) 
			{
				echo "<script>location.href='../xx_menu/menu_12.php'</script>";
			}
			elseif ($row['fk_id_perfil']==13) 
			{
				echo "<script>location.href='../xx_menu/menu_13.php'</script>";
			}
			
			elseif ($row['fk_id_perfil']==14) 
			{
				echo "<script>location.href='../xx_menu/menu_14.php'</script>";
			}
			elseif ($row['fk_id_perfil']==7) 
			{
				echo "<script>location.href='../xx_menu/menu_14.php'</script>";
			}
			elseif ($row['fk_id_perfil']==9) 
			{
				echo "<script>location.href='../xx_menu/menu_9.php'</script>";
			}
			else
			{
				echo '<script> alert("Perfil no asignado")</script>';
				echo "<script>location.href='../index.html'</script>";
			}
	}
	else
	{
		echo '<script> alert("Contraseña incorrecta")</script>';
		echo "<script>location.href='../index.html'</script>";
	}
}
else
{
		echo '<script> alert("usuario incorrecto")</script>';
		echo "<script>location.href='../index.html'</script>";
}

?>