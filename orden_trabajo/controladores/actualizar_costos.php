<?php
include("../../controladores/conex.php");
date_default_timezone_set('America/Mexico_City');


$fecha=date("d/m/Y H:i:s");
$hora=date("H:i:s");
$id=$_POST["iddetalle"];
$desc=$_POST["desc"];
$comision=$_POST["comision"];
$importe=$_POST['importe'];
$cuenta=$_POST['cuenta'];
$total = $_POST["total"];
$resta=$_POST["resta"];



$query = "UPDATE  so_cabezal SET imp_subtotal='$importe', porc_descuento='$desc', porc_incremento='$desc', imp_total='$total', a_cuenta='$cuenta',resta='$resta',afecta_comision='$comision' where id_solicitud='$id' ";
//echo $query;

$resultado = mysqli_query($conexion, $query);

if ($resultado) {
			echo "<script>location.href='../modificacion_orden.php'</script>";
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
