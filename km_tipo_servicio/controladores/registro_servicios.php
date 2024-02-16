<?php
session_start();
include("../../controladores/conex.php");
$empresa ="1";
$fn_servicio = $_POST['fn_servicio']; // estado civil

$fn_estado = $_POST['fn_estado']; // estado


$query = "
INSERT INTO km_tipo_servicio
            (fk_id_empresa,
             id_tipo_servicio,
             desc_tipo_servicio,
             estado)
VALUES (1,
        0,
        '$fn_servicio',
        'A');
";

$resultado = mysqli_query($conexion, $query);

if ($resultado) {
			header("location: ../tabla_servicios.php");
			//echo "<script>location.href='../tabla_usuarios.php'</script>";
		}
		else {
			echo "error en la ejecucion de la consulta. <br />";
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
