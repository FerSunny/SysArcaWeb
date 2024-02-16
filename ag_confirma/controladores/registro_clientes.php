<?php
session_start();
include("../../controladores/conex.php");

date_default_timezone_set('America/Mexico_City');

$empresa ="1";

$fn_rfc = $_POST['fn_rfc'];

$fn_nombre = $_POST['fn_nombre'];
//$fn_nombre = htmlentities($fn_nombre1, ENT_QUOTES,'UTF-8');


$fn_apaterno =  $_POST['fn_apaterno'];
//$fn_apaterno = htmlentities($fn_apaterno1, ENT_QUOTES,'UTF-8');


$fn_amaterno = $_POST['fn_amaterno'];
//$fn_amaterno = htmlentities($fn_amaterno1, ENT_QUOTES,'UTF-8');


$fn_anios = $_POST['fn_anios'];
$fn_meses = $_POST['fn_meses'];
$fn_dias = $_POST['fn_dias'];

$fn_sexo = $_POST['fn_sexo'];
$fn_estado_civil = $_POST['fn_estado_civil'];
$fn_ocupacion = $_POST['fn_ocupacion'];

$fn_tfijo = $_POST['fn_tfijo'];
$fn_movil = $_POST['fn_movil'];
$fn_mail = $_POST['fn_mail'];

$fn_Estado = $_POST['fn_Estado'];
$fn_municipio = $_POST['fn_municipio'];
$fn_Localidad = $_POST['fn_Localidad'];
$fn_colonia = $_POST['fn_colonia'];
$fn_cp = $_POST['fn_cp'];
$fn_calle = $_POST['fn_calle'];
$fn_numero = $_POST['fn_numero'];

$fn_falta = $_POST['fn_falta'];
//$fi_factualiza = $_POST['fn_factualiza'];
$fn_factualiza=date("y/m/d :H:i:s");
$estado_reg = $_POST['estado_reg'];

//echo $fn_municipio;

$query = "INSERT INTO so_clientes(fk_id_empresa,id_cliente,rfc,nombre,a_paterno,a_materno,anios,meses,dias,fk_id_sexo,fk_id_estado_civil,fk_id_ocupacion,telefono_fijo,telefono_movil,mail,fk_id_estado,fk_id_municipio,fk_id_localidad,colonia,cp,calle,numero_exterior,fecha_registro,fecha_actualizacion,activo) VALUES('$empresa','0','$fn_rfc','$fn_nombre','$fn_apaterno','$fn_amaterno','$fn_anios','$fn_meses','$fn_dias','$fn_sexo','$fn_estado_civil','$fn_ocupacion','$fn_tfijo','$fn_movil','$fn_mail','$fn_Estado','$fn_municipio','$fn_Localidad','$fn_colonia','$fn_cp','$fn_calle','$fn_numero','$fn_falta','$fn_factualiza','$estado_reg')";

//echo $query;

$resultado = mysqli_query($conexion, $query);

if ($resultado) {
			header("location: ../tabla_clientes.php");
			//echo "<script>location.href='../tabla_usuarios.php'</script>";
		}
		else {
			echo "error en la ejecucion del Insert a clientes, valor:. <br />";
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
?>
