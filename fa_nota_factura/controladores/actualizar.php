<?php
session_start();
include("../../controladores/conex.php");

date_default_timezone_set('America/Mexico_City');
$id_usuario=$_SESSION['id_usuario'];

$fn_numero_factura=$_POST["fn_numero_factura"];
$fn_nota=$_POST["fn_nota"];
$fn_fecha_factura=$_POST["fn_fecha_factura"];
$fn_sucursal=$_POST["fn_sucursal"];
$fn_grupo=$_POST["fn_grupo"];



$query = "
UPDATE  so_factura 
SET 
numero_factura='$fn_numero_factura',
fecha_factura_sat = '$fn_fecha_factura',
fk_id_usuario_factura =  '$id_usuario',
grupo = '$fn_grupo',
fk_id_sucursal_sat = '$fn_sucursal'
WHERE  id_factura='$fn_nota'
";

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
