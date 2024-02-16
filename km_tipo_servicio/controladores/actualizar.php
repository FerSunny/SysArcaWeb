<?php
include("../../controladores/conex.php");
$idservicio=$_POST["idservicio"];
$fn_servicio=$_POST["servicio"];
$fn_estado=$_POST["fn_estado"];

$query = "
UPDATE km_tipo_servicio
SET 
  desc_tipo_servicio = '$fn_servicio',
  estado = '$fn_estado'
WHERE id_tipo_servicio = $idservicio;
";

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
