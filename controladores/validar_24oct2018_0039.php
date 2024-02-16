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

		$fk_id_sucursal=$row['fk_id_sucursal'];
		$fecha_inicio=date("y/m/d :H:i:s");

		//$ip=$_SERVER['SERVER_ADDR'];
		$ip_publica=$_SERVER['REMOTE_ADDR'];
		$navegador=getenv('HTTP_USER_AGENT');

		//$ip=$_SERVER[‘HTTP_CLIENT_IP’];

		$insert="INSERT INTO au_session (fk_id_sucursal,fk_id_usuario,ip_publica,nombre_pc,fecha_inicio,fecha_fin,navegador) VALUES('$fk_id_sucursal','$usuario','$ip_publica','0',NOW(),NOW(),'$navegador')";

//echo $insert;

		$resultado = mysqli_query($conexion, $insert);

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
//			elseif ($row['fk_id_perfil']==14) 
//			{
//				echo "<script>location.href='../xx_menu/menu_14.php'</script>";
//			}
			elseif ($row['fk_id_perfil']==6) 
			{
				echo "<script>location.href='../xx_menu/menu_6.php'</script>";
			}
			elseif ($row['fk_id_perfil']==9) 
			{
				echo "<script>location.href='../xx_menu/menu_9.php'</script>";
			}
			elseif ($row['fk_id_perfil']==14) 
			{
				echo "<script>location.href='../xx_menu/menu_00.php'</script>";
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