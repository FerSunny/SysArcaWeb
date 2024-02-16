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
		echo "<script>location.href='../xx_menu/menu.php'</script>";
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