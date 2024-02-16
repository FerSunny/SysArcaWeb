<?php
include("../../controladores/conex.php");

date_default_timezone_set('America/Mexico_City');

$id_cliente=$_POST["idcliente"];
$fn_rfc=$_POST["fn_rfc"];
$fn_nombre=$_POST["fn_nombre"];
$fn_apaterno=$_POST["fn_apaterno"];
$fn_amaterno=$_POST["fn_amaterno"];

$fn_anios=$_POST["fn_anios"];
$fn_meses=$_POST["fn_meses"];
$fn_dias=$_POST["fn_dias"];

$fn_fk_id_sexo=$_POST["fn_sexo"];
$fn_fk_id_estado_civil=$_POST["fn_estado_civil"];
$fn_fk_id_ocupacion=$_POST["fn_ocupacion"];

$fn_tfijo=$_POST["fn_tfijo"];
$fn_movil=$_POST["fn_movil"];
$fn_mail=$_POST["fn_mail"];

$fn_Estado=$_POST["fn_Estado_fed"];
$fn_Municipio=$_POST["fn_municipio"];
$fn_Localidad=$_POST["fn_Localidad"];
$fn_colonia=$_POST["fn_colonia"];
$fn_cp=$_POST["fn_cp"];
$fn_calle=$_POST["fn_calle"];
$fn_numero=$_POST["fn_numero"];

$fn_falta=$_POST["fn_falta"];
//$fn_factualiza=$_POST["fn_factualiza"];
$estado_reg=$_POST["estado_reg"];
$fn_factualiza=date("y/m/d :H:i:s");

$query = "UPDATE  so_clientes SET rfc ='$fn_rfc', nombre = '$fn_nombre', a_paterno = '$fn_apaterno', a_materno = '$fn_amaterno' , anios = '$fn_anios', meses = '$fn_meses',dias = '$fn_dias',  fk_id_sexo = '$fn_fk_id_sexo', fk_id_estado_civil = '$fn_fk_id_estado_civil',fk_id_ocupacion = '$fn_fk_id_ocupacion', telefono_fijo = '$fn_tfijo', telefono_movil = '$fn_movil', mail = '$fn_mail', fk_id_estado = '$fn_Estado', fk_id_municipio = '$fn_Municipio', fk_id_localidad = '$fn_Localidad', colonia='$fn_colonia', cp = '$fn_cp', calle='$fn_calle', numero_exterior='$fn_numero', fecha_registro='$fn_falta', fecha_actualizacion = '$fn_factualiza', activo='$estado_reg' WHERE fk_id_empresa = 1 and  id_cliente='$id_cliente'";

//echo $query;

$resultado = mysqli_query($conexion, $query);

if ($resultado) {
			//echo "perfil almacenado. <br />";
			echo "<script>location.href='../tabla_clientes.php'</script>";
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
