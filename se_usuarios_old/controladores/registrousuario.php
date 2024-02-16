<?php
session_start();
include("../../controladores/conex.php");
$empresa ="1";
$id_usr = $_POST['e2'];
$fk_sucursal = $_POST['e3'];
$pass = $_POST['e4'];
$activo = $_POST['e5'];
$fk_perfil = $_POST['e6'];
$nombre = $_POST['e7'];
$a_paterno = $_POST['e8'];
$a_materno = $_POST['e9'];
$telefono_fijo = $_POST['e10'];
$telefono_movil = $_POST['e11'];
$direccion = $_POST['e12'];
$email = $_POST['e13'];
//$informacion=[];

/*
echo $empresa;
echo $id_usr;
echo $fk_sucursal;
echo $pass;
echo $activo;
echo $fk_perfil;
echo $nombre;
echo $a_paterno;
echo $a_materno;
echo $telefono_fijo;
echo $telefono_movil;
echo $direccion;
echo $email;
*/
$nuevo_usuario="SELECT id_usr from se_usuarios where id_usr='$id_usr'";
$resultado = mysqli_query($conexion, $nuevo_usuario);
if(mysqli_fetch_array($resultado)>0){
	echo '<script> alert(" El usuario ya Existe")</script>';
	echo "<script>location.href='../tabla_usuarios.php'</script>";
}else {
	$query = "INSERT INTO se_usuarios VALUES ('$empresa','$id_usr','$fk_sucursal','$pass','$activo','$fk_perfil','$nombre','$a_paterno','$a_materno','$telefono_fijo','$telefono_movil','$direccion','$email')";
	$resultado = mysqli_query($conexion, $query);

	if ($resultado) {
				//echo "perfil almacenado. <br />";
				header("location: ../tabla_usuarios.php");
				//echo "<script>location.href='../tabla_usuarios.php'</script>";
			}
			else {
				echo "error en la ejecución de la consulta. <br />";
	      die('Error de Conexión: ' . mysqli_connect_errno());
			}

			if (mysqli_close($conexion)){
				echo "desconexion realizada. <br />";
			}
			else {
				echo "error en la desconexión";

	      die('Error de Conexión: ' . mysqli_connect_errno());

			}
}


?>
