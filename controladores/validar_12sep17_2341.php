<?php

include("conex.php");
$usuario = $_POST['usua'];
$pass = $_POST['contra'];

$query = "SELECT * FROM se_usuarios where id_usr= '" . $usuario . "' ";
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

  		if($row['fk_id_perfil']==1)
  			{
				echo "<script>location.href='../xx_menu/menu.php'</script>";
			}
			elseif ($row['fk_id_perfil']==8) 
			{
				echo "<script>location.href='../xx_menu/menu_8.php'</script>";
			}
			elseif ($row['fk_id_perfil']==11) 
			{
				echo "<script>location.href='../xx_menu/menu_11.php'</script>";
			}
			elseif ($row['fk_id_perfil']==12) 
			{
				echo "<script>location.href='../xx_menu/menu_12.php'</script>";
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