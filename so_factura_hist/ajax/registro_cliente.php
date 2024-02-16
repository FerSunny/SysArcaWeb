<?php
	date_default_timezone_set('America/Mexico_City');
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
    require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
    
$data=json_decode($_POST['datas'],true);
$empresa ="1";

$fn_rfc = $data['fn_rfc'];
$fn_nombre = $data['fn_nombre'];
$fn_apaterno = $data['fn_apaterno'];
$fn_amaterno = $data['fn_amaterno'];

$fn_anios = $data['fn_anios'];
$fn_meses = $data['fn_meses'];
$fn_dias = $data['fn_dias'];

$fn_sexo = $data['fn_sexo'];
$fn_estado_civil = $data['fn_estado_civil'];
$fn_ocupacion = $data['fn_ocupacion'];

$fn_tfijo = $data['fn_tfijo'];
$fn_movil = $data['fn_movil'];
$fn_mail = $data['fn_mail'];

$fn_Estado = $data['fn_Estado'];
$fn_municipio = $data['fn_municipio'];
$fn_Localidad = $data['fn_Localidad'];
$fn_colonia = $data['fn_colonia'];
$fn_cp = $data['fn_cp'];
$fn_calle = $data['fn_calle'];
$fn_numero = $data['fn_numero'];


//$fi_factualiza = $_POST['fn_factualiza'];
$fn_factualiza=date("y/m/d :H:i:s");
$estado_reg = $data['estado_reg'];

//echo $fn_municipio;

$query = "INSERT INTO so_clientes(fk_id_empresa,id_cliente,rfc,nombre,a_paterno,a_materno,anios,meses,dias,fk_id_sexo,fk_id_estado_civil,fk_id_ocupacion,telefono_fijo,telefono_movil,mail,fk_id_estado,fk_id_municipio,fk_id_localidad,colonia,cp,calle,numero_exterior,fecha_registro,fecha_actualizacion,activo) VALUES('$empresa','0','$fn_rfc','$fn_nombre','$fn_apaterno','$fn_amaterno','$fn_anios','$fn_meses','$fn_dias','$fn_sexo','$fn_estado_civil','$fn_ocupacion','$fn_tfijo','$fn_movil','$fn_mail','$fn_Estado','$fn_municipio','$fn_Localidad','$fn_colonia','$fn_cp','$fn_calle','$fn_numero','$fn_factualiza','$fn_factualiza','$estado_reg')";

//echo $query;

$resultado = mysqli_query($con, $query);

if ($resultado) {
    header('Content-Type: application/json');
    //Guardamos los datos en un array
    $datos = array(
    'estado' => 'ok'
    );
    //Devolvemos el array pasado a JSON como objeto
    echo json_encode($datos, JSON_FORCE_OBJECT);
}else{
    echo 'error al guardar la factura';
}


?>
