<?php
include("../../controladores/conex.php");
$id_us=$_POST["idusuario"];
//$edit1=$_POST["edit1"];
$estudio_orig=$_POST['estudio_orig'];
$edit2 = $_POST  ["edit2"];
$edit3 = $_POST["edit3"];
$edit4 = $_POST  ["edit4"];
$edit5 = $_POST ["edit5"];
$edit6 = $_POST  ["edit6"];
$edit7 = $_POST  ["edit7"];
$edit8 = $_POST  ["edit8"];
$edit9 = $_POST  ["edit9"];
$es_paq = $_POST  ["es_paq"];
$edit10 = $_POST ["edit10"];
$edit11 = $_POST ["edit11"];
$edit12 = $_POST ["edit12"];
$edit13 = $_POST ["edit13"];
$edit14 = $_POST ["edit14"];
$edit14_1 = $_POST ["edit14_1"];
$edit14_2 = $_POST ["edit14_2"];
$edit14_3 = $_POST ["edit14_3"];
$edit14_4 = $_POST ["edit14_4"];
$edit15 = $_POST ["edit15"];
$edit16 = $_POST ["edit16"];
$edit17 = $_POST ["edit17"];
$maquila = $_POST ["maquila"];

$tipo_plantilla = $_POST ["tipo_plantilla"];


$query = " UPDATE  km_estudios SET fk_empresa='1',iniciales='$edit2', desc_estudio='$edit3',
fk_id_tipo_estudio='$edit4', urgente='$edit5', tiempo_entrega='$edit6',fk_id_comision='$edit7',observaciones='$edit8',per_paquete='$es_paq',fk_id_plantilla='$tipo_plantilla',
per_perfil='$edit9',costo='$edit10',fk_id_descuento='$edit11',fk_id_promosion='$edit12',
fk_id_indicaciones='$edit13',fk_id_muestra='$edit14',fk_id_muestra_1='$edit14_1',fk_id_muestra_2='$edit14_2',fk_id_muestra_3='$edit14_3',fk_id_muestra_4='$edit14_4',origen='$edit16',estatus='$edit15', cubiculo='$edit17',maquila='$maquila',fk_id_estudio_ori='$estudio_orig',fk_id_estudio_ori='$estudio_orig' where id_estudio='$id_us'";

$resultado = mysqli_query($conexion, $query);

if ($resultado) {
		echo "<script>location.href='../km_estudios_t.php'</script>";
		}
		else {
			echo "error en la ejecucion de la consulta. <br />";
      die('Error de Conexion: ' . mysqli_connect_errno());
		}

		if (mysqli_close($conexion)){
			echo "desconexion realizada. <br />";
		}
		else {
			echo "error en la desconexion";

      die('Error de Conexión: ' . mysqli_connect_errno());

		}


 ?>
