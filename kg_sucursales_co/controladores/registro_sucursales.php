<?php
session_start();
include("../../controladores/conex.php");
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

//$fn_labora = $_POST['fn_labora'];

$fn_do = $_POST['fn_do'];
$fn_lu = $_POST['fn_lu'];
$fn_ma = $_POST['fn_ma'];
$fn_mi = $_POST['fn_mi'];
$fn_ju = $_POST['fn_ju'];
$fn_vi = $_POST['fn_vi'];
$fn_sab = $_POST['fn_sab'];
$fn_grupo = $_POST['fn_grupo'];

$query = "INSERT INTO kg_sucursales(fk_id_empresa,desc_sucursal,fk_id_usr,telefono,telefono_2,tel_movil,hor_hab_ape,hor_hab_cie,hor_sab_ape,hor_sab_cie,hor_dom_ape,hor_dom_cie,

fk_id_descuento,skype,mail,fk_pais,fk_estado,fk_municipio,fk_localidad,cp,
colonia,
calle,numero,estado,desc_corta,lunes,martes,miercoles,jueves,viernes,sabado,domingo,fk_id_grupo) VALUES (1,'$fn_desc','$fn_usuario','$fn_telefono','$fn_tel','$fn_celular', '$fn_ha', '$fn_hc', '$fn_sa', '$fn_sc', '$fn_da', '$fn_dc', 

 '$fn_descuento', '$fn_skype','$fn_mail', '$fn_fk_pais', '$fn_est', '$fn_municipio', '$fn_localidad', '$fn_cp', 
'$fn_colonia',
'$fn_calle','$fn_numero','$fn_estado','$fn_corta','$fn_do', '$fn_lu', '$fn_ma', '$fn_mi', '$fn_ju', '$fn_vi', '$fn_sab', '$fn_grupo')";

$result = $conexion -> query($query);
if ($result) {
	echo 1;
   
}else{
  $codigo = mysqli_errno($conexion); 
  echo $codigo;
}
$conexion->close();
?>