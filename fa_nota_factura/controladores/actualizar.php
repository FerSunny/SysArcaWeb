<?php
include("../../controladores/conex.php");

date_default_timezone_set('America/Mexico_City');


$fn_numero_factura=$_POST["fn_numero_factura"];
$fn_nota=$_POST["fn_nota"];



$query = "UPDATE  so_factura SET numero_factura='$fn_numero_factura' WHERE  id_factura='$fn_nota'";

//echo $query;

$resultado = mysqli_query($conexion, $query);

if ($resultado) {
			//echo "perfil almacenado. <br />";
			echo "<script>location.href='../tabla_notafac.php'</script>";
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
