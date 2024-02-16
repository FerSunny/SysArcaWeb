<?php
session_start();
include("../../controladores/conex.php");
$empresa ="1";

$edit1 = $_POST['edit1'];
$edit2 = $_POST['edit2'];
$edit3 = $_POST['edit3'];
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


$query = " INSERT INTO kg_comisiones(fk_empresa,desc_comision,porcentaje,estado) VALUES ('$empresa','$edit1','$edit3','$edit2')";
$resultado = mysqli_query($conexion, $query);

if ($resultado) {
			header("location: ../tabla_comisiones.php");
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
?>
