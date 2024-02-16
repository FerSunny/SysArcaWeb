<?php
include("../../controladores/conex.php");

date_default_timezone_set('America/Mexico_City');

$id_registro=$_POST["idregistro"];
$fk_id_gasto=$_POST["gasto"];
$importe=$_POST["fn_importe"];
$nota=$_POST["fn_nota"];
$estado=$_POST["estado"];
$beneficia=$_POST["beneficia"];
$fn_compro=$_POST["fn_compro"];

$query = "UPDATE  ga_registro SET fk_id_gasto ='$fk_id_gasto', importe = '$importe', nota = '$nota', estado = '$estado' ,fk_id_beneficiario='$beneficia',num_comprobante='$fn_compro' WHERE fk_id_empresa = 1 and  id_registro='$id_registro'";

//echo $query;

$resultado = mysqli_query($conexion, $query);

if ($resultado) {
			//echo "perfil almacenado. <br />";
			echo "<script>location.href='../tabla_registro.php'</script>";
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
