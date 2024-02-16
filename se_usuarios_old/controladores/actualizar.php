<?php
include("../../controladores/conex.php");
$id_us=$_POST["idusuario"];
$edit1=$_POST["edit1"];
$edit2=$_POST["edit2"];
$edit3 = $_POST["edit3"];
$edit4=$_POST["edit4"];
$edit5 =$_POST["edit5"];
$edit6=$_POST["edit6"];
$edit7=$_POST["edit7"];
$edit8=$_POST["edit8"];
$edit9=$_POST["edit9"];
$edit10=$_POST["edit10"];
$edit11=$_POST["edit11"];

$query = " UPDATE  se_usuarios SET fk_empresa='1', id_usr='$edit1', pass='$edit3', activo='$edit4',
activo='$edit4',nombre='$edit5', a_paterno='$edit6',a_materno='$edit7',telefono_fijo='$edit8',
telefono_movil='$edit9',direccion='$edit10',mail='$edit11' where id_usr='$id_us'";

$resultado = mysqli_query($conexion, $query);

if ($resultado) {
			//echo "perfil almacenado. <br />";
			echo "<script>location.href='../tabla_usuarios.php'</script>";
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
