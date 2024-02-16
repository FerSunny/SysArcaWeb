<?php
include("../../controladores/conex.php");
$idsucursal = $_POST["id_sucursal"];
//$fn_empresa = $_POST["fn_empresa"];
$fn_desc = $_POST['fn_desc'];
$fn_usuario = $_POST['fn_usuario'];
$fn_telefono = $_POST['fn_telefono'];
$fn_tel = $_POST['fn_tel'];
$fn_celular = $_POST['fn_celular'];
$fn_ha = $_POST['fn_ha'];
$fn_hc = $_POST['fn_hc'];
$fn_sa = $_POST['fn_sa'];
$fn_sc = $_POST['fn_sc'];
$fn_da = $_POST['fn_da'];
$fn_dc = $_POST['fn_dc'];
//$fn_fa = $_POST['fn_fa'];
//$fn_fc = $_POST['fn_fc'];
$fn_descuento = $_POST['fn_descuento'];
$fn_skype = $_POST['fn_skype'];
$fn_mail = $_POST['fn_mail'];
$fn_fk_pais = $_POST['fn_fk_pais'];
$fn_est = $_POST['fn_est'];
$fn_municipio = $_POST['fn_municipio'];
$fn_localidad = $_POST['fn_localidad'];
$fn_cp = $_POST['fn_cp'];
$fn_colonia = $_POST['fn_colonia'];
$fn_calle = $_POST['fn_calle'];
$fn_numero = $_POST['fn_numero'];
$fn_estado = $_POST['fn_estado'];
$fn_corta = $_POST['fn_corta'];


$fn_do = $_POST['fn_do'];
$fn_lu = $_POST['fn_lu'];
$fn_ma = $_POST['fn_ma'];
$fn_mi = $_POST['fn_mi'];
$fn_ju = $_POST['fn_ju'];
$fn_vi = $_POST['fn_vi'];
$fn_sab = $_POST['fn_sab'];
$fn_grupo = $_POST['fn_grupo'];

$query = "UPDATE  kg_sucursales SET desc_sucursal = '$fn_desc', fk_id_usr = '$fn_usuario',
telefono = '$fn_telefono' , telefono_2 = '$fn_tel' , tel_movil = '$fn_celular' , hor_hab_ape = '$fn_ha', hor_hab_cie = '$fn_hc' , hor_sab_ape = '$fn_sa' , hor_sab_cie = '$fn_sc' , hor_dom_ape = '$fn_da', hor_dom_cie = '$fn_dc', 

fk_id_descuento = '$fn_descuento', skype = '$fn_skype', mail = '$fn_mail', fk_pais = '$fn_fk_pais', fk_estado = '$fn_est', fk_municipio = '$fn_municipio', fk_localidad = '$fn_localidad',cp = '$fn_cp',
 colonia = '$fn_colonia', 
 calle = '$fn_calle',numero = '$fn_numero' ,estado = '$fn_estado',desc_corta = '$fn_corta' , 

 domingo = '$fn_do', lunes = '$fn_lu', martes = '$fn_ma', miercoles = '$fn_mi', jueves = '$fn_ju', viernes = '$fn_vi', sabado = '$fn_sab', fk_id_grupo = '$fn_grupo'

   WHERE id_sucursal= '$idsucursal'";
//echo $query;

//$resultado = mysqli_query($conexion, $query);

$result = $conexion->query($query);

//echo $query;
if ($result) {
	$bien = 1;
    echo $bien;

}else{
	$codigo = mysqli_errno($conexion); 
	echo $codigo;
}



$conexion->close();


 ?>
