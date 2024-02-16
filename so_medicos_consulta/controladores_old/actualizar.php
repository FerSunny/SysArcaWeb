<?php
include("../../controladores/conex.php");

date_default_timezone_set('America/Mexico_City');

$id_medico=$_POST["idmedico"];
$zona=$_POST["zona"];
$fn_nombre=$_POST["fn_nombre"];
$fn_apaterno=$_POST["fn_apaterno"];
$fn_amaterno=$_POST["fn_amaterno"];
$fn_rfc=$_POST["fn_rfc"];
$fn_sexo=$_POST["fn_sexo"];
$especialidad=$_POST["especialidad"];
$Estado_fed=$_POST["Estado_fed"];
$Municipio=$_POST["Municipio"];
$Localidad=$_POST["Localidad"];
$fn_colonia=$_POST["fn_colonia"];
$fn_cp=$_POST["fn_cp"];
$fn_calle=$_POST["fn_calle"];
$fn_numero=$_POST["fn_numero"];
$fn_referencia=$_POST["fn_referencia"];
$fn_tfijo=$_POST["fn_tfijo"];
$fn_movil=$_POST["fn_movil"];
$fn_mail=$_POST["fn_mail"];
$fn_horario=$_POST["fn_horario"];
$fn_cbanco=$_POST["fn_cbanco"];
$adscrito=$_POST["adscrito"];
$fn_falta=$_POST["fn_falta"];
//$fn_factualiza=$_POST["fn_factualiza"];
$estado_reg=$_POST["estado_reg"];
$fn_factualiza=date("y/m/d :H:i:s");
$fn_sucursal=$_POST["fn_sucursal"];

$query = "UPDATE  so_medicos SET fk_id_zona ='$zona', nombre = '$fn_nombre', a_paterno = '$fn_apaterno', a_materno = '$fn_amaterno' , rfc = '$fn_rfc', fk_id_sexo='$fn_sexo', fk_id_especialidad = '$especialidad', fk_id_estado = '$Estado_fed', fk_id_municipio = '$Municipio', fk_id_localidad = '$Localidad', colonia='$fn_colonia', cp = '$fn_cp', calle='$fn_calle', numero_exterior='$fn_numero', referencia = '$fn_referencia', telefono_fijo = '$fn_tfijo', telefono_movil = '$fn_movil', horario='$fn_horario', cuenta_banco='$fn_cbanco', adscrito='$adscrito', fecha_registro='$fn_falta', fecha_actuaizacion = '$fn_factualiza', estado='$estado_reg',e_mail='$fn_mail',fk_id_sucursal='$fn_sucursal' WHERE fk_id_empresa = 1 and  id_medico='$id_medico'";

echo $query;

$resultado = mysqli_query($conexion, $query);

if ($resultado) {
			//echo "perfil almacenado. <br />";
			echo "<script>location.href='../tabla_medicos.php'</script>";
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
