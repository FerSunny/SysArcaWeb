<?php
date_default_timezone_set('America/Chihuahua');
include("../../controladores/conex.php");
$fn_id_factura=$_POST["fn_id_factura"];
$fn_fk_id_estudio=$_POST["fn_fk_id_estudio"];

$fn_titulo_desc=$_POST["fn_titulo_desc"];
$fn_descripcion=$_POST["fn_descripcion"];


$fn_t_allazgos = $_POST['fn_t_allazgos'];
$fn_d_allazgos = $_POST['fn_d_allazgos'];

$fn_t_diagnostico = $_POST['fn_t_diagnostico'];
$fn_d_disgnostico = $_POST['fn_d_disgnostico'];

$fn_t_comenta = $_POST['fn_t_comenta'];
$fn_d_comenta = $_POST['fn_d_comenta'];



$query = " UPDATE  cr_plantilla_rx_rad_re SET titulo_desc='$fn_titulo_desc', descripcion='$fn_descripcion', t_otros_allazgos='$fn_t_allazgos', d_otros_allazgos = '$fn_d_allazgos', t_diagnostico='$fn_t_diagnostico',d_diagnostico='$fn_d_disgnostico',t_comentarios='$fn_t_comenta',d_comentarios='$fn_d_comenta'
where fk_id_factura ='$fn_id_factura' and fk_id_estudio = '$fn_fk_id_estudio' ";

$resultado = mysqli_query($conexion, $query);

if ($resultado) {
			//echo "perfil almacenado. <br />";
			echo "<script>location.href='../tabla_agenda.php'</script>";
		}
		else {
			echo "error en la ejecución de la consulta. <br />";
			echo $query;
      die('Error de Conexión: ' . mysqli_connect_errno());
		}

		if (mysqli_close($conexion)){
			echo "desconexion realizada. <br />";
		}
		else {
			echo "error en la desconexión";

      die('Error de Conexión: ' . mysqli_connect_errno());

		}