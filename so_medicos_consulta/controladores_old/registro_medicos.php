<?php
session_start();
include("../../controladores/conex.php");

date_default_timezone_set('America/Mexico_City');

$empresa ="1";

$zona = $_POST['zona']; 
$fi_nombre = $_POST['fn_nombre'];
$fi_apaterno = $_POST['fn_apaterno'];
$fi_amaterno = $_POST['fn_amaterno'];
$fi_rfc = $_POST['fn_rfc'];
$fi_sexo = $_POST['fn_sexo'];
$especialidad = $_POST['especialidad'];
$Estado = $_POST['Estado'];
$Municipio = $_POST['Municipio'];
$Localidad = $_POST['Localidad'];
$fi_colonia = $_POST['fn_colonia'];
$fi_cp = $_POST['fn_cp'];
$fi_calle = $_POST['fn_calle'];
$fi_numero = $_POST['fn_numero'];
$fi_referencia = $_POST['fn_referencia'];
$fi_tfijo = $_POST['fn_tfijo'];
$fi_movil = $_POST['fn_movil'];
$fi_mail = $_POST['fn_mail'];
$fi_horario = $_POST['fn_horario'];
$fi_cbanco = $_POST['fn_cbanco'];
$adscrito = $_POST['adscrito'];
$fi_falta = $_POST['fn_falta'];
//$fi_factualiza = $_POST['fn_factualiza'];
$estado_reg = $_POST['estado_reg'];
$fi_factualiza=date("y/m/d :H:i:s");
$fn_sucursal = $_POST['fn_sucursal'];


$query= "INSERT INTO so_medicos (fk_id_empresa,fk_id_zona,nombre,a_paterno,a_materno,rfc, fk_id_sexo, fk_id_especialidad,fk_id_estado,fk_id_municipio,fk_id_localidad,colonia,cp,calle,numero_exterior,referencia,telefono_fijo,telefono_movil,Horario,cuenta_banco,adscrito,fecha_registro,fecha_actuaizacion,estado,e_mail,fk_id_sucursal) VALUES('$empresa','$zona','$fi_nombre','$fi_apaterno','$fi_amaterno','$fi_rfc','$fi_sexo', '$especialidad','$Estado','$Municipio','$Localidad','$fi_colonia','$fi_cp','$fi_calle','$fi_numero','$fi_referencia','$fi_tfijo','$fi_movil','$fi_horario','$fi_cbanco','$adscrito','$fi_falta','$fi_factualiza','$estado_reg','$fi_mail','$fn_sucursal')";

//echo $query;

$resultado = mysqli_query($conexion, $query);

if ($resultado) 
		{
			header("location: ../tabla_medicos.php");
			//echo "<script>location.href='../tabla_usuarios.php'</script>";
		}
		else 
		{
			echo "error en la ejecucion de la consulta. <br />";
      		die('Error de Conexión: ' . mysqli_connect_errno());
      		//die('Error de Conexión (INSERT): ' . mysqli_error());
		}

	if (mysqli_close($conexion))
		{
			echo "desconexion realizada. <br />";
		}
		else 
		{
			echo "error en la desconexión";
      		die('Error de Conexión: ' . mysqli_connect_errno());

		}
?>
