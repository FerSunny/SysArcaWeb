<?php
include("../../controladores/conex.php");
/*$id_us=$_POST["idusuario"];
//$edit1=$_POST["edit1"];
$edit2 = $_POST  ["edit2"];
$edit3 = $_POST["edit3"];
$edit4 = $_POST  ["edit4"];
$edit5 = $_POST ["edit5"];
$edit6 = $_POST  ["edit6"];
$edit7 = $_POST  ["edit7"];
$edit8 = $_POST  ["edit8"];
$edit9 = $_POST  ["edit9"];
$edit10 = $_POST ["edit10"];
$edit11 = $_POST ["edit11"];
$edit12 = $_POST ["edit12"];
$edit13 = $_POST ["edit13"];
$edit14 = $_POST ["edit14"];
$edit15 = $_POST ["edit15"];*/

$d1=$_POST['fhe'];

echo $d1;
/*
$query = " UPDATE  km_estudios SET fk_empresa='1',iniciales='$edit2', desc_estudio='$edit3',
fk_id_tipo_estudio='$edit4', urgente='$edit5', tiempo_entrega='$edit6',fk_id_comision='$edit7',observaciones='$edit8',
per_perfil='$edit9',costo='$edit10',fk_id_descuento='$edit11',fk_id_promosion='$edit12',
fk_id_indicaciones='$edit13',fk_id_muestra='$edit14' ,estatus='$edit15' where id_estudio='$id_us'";

$resultado = mysqli_query($conexion, $query);

if ($resultado) {
		echo "<script>location.href='../km_estudios_t'</script>";
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
*/

 ?>