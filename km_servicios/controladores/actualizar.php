<?php
include("../../controladores/conex.php");
$idservicio=$_POST["idservicio"];
$fn_servicio=$_POST["fn_servicio"];
$fn_abreviada=$_POST["fn_abreviada"];
$fn_estado=$_POST["fn_estado"];
$servicio=$_POST["servicio"];

$query = " UPDATE  km_servicios SET fk_id_empresa='1', desc_servicio='$fn_servicio', 
desc_abreviada='$fn_abreviada',
estado='$fn_estado' ,
fk_id_tipo_servicio = '$servicio'
where id_servicio='$idservicio'";

$resultado = mysqli_query($conexion, $query);

if ($resultado) {
			//echo "perfil almacenado. <br />";
			echo "<script>location.href='../tabla_servicios.php'</script>";
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
