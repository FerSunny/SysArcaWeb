<?php
include("../../controladores/conex.php");

date_default_timezone_set('America/Mexico_City');

$id_usuario=$_POST["idusuario"];
$fn_id_usr=$_POST["fn_id_usr"];
$fn_sucursal=$_POST["fn_sucursal"];
$fn_pass=$_POST["fn_pass"];
$fn_estado=$_POST["fn_estado"];
$fn_perfil=$_POST["fn_perfil"];
$fn_servicio=$_POST["fn_servicio"];
$fn_nombre=utf8_encode($_POST["fn_nombre"]);
$fn_apaterno=utf8_encode($_POST["fn_apaterno"]);
$fn_amaterno=utf8_encode($_POST["fn_amaterno"]);
$fn_iniciales=$_POST["fn_iniciales"];
$fn_tfijo=$_POST["fn_tfijo"];
$fn_tmovil=$_POST["fn_tmovil"];
$fn_direccion=utf8_encode($_POST["fn_direccion"]);
$fn_mail=$_POST["fn_mail"];
$fn_falta=$_POST["fn_falta"];
$fn_factualiza=date("y-m-d H:i:s");
$fn_entra=$_POST["fn_entra"];
$fn_salida=$_POST["fn_salida"];
$fn_entra_s=$_POST["fn_entra_s"];
$fn_salida_s=$_POST["fn_salida_s"];
$fn_entra_d=$_POST["fn_entra_d"];
$fn_salida_d=$_POST["fn_salida_d"];
$fn_entra_f=$_POST["fn_entra_f"];
$fn_salida_f=$_POST["fn_salida_f"];
$fn_user=$_POST["fn_user"];

$query = "UPDATE  se_usuarios SET id_usr='$fn_id_usr', fk_id_sucursal = '$fn_sucursal', pass = '$fn_pass', activo = '$fn_estado' , fk_id_perfil = '$fn_perfil', fk_id_servicio = '$fn_servicio', nombre='$fn_nombre',a_paterno='$fn_apaterno', a_materno = '$fn_amaterno', iniciales = '$fn_iniciales', telefono_fijo='$fn_tfijo',telefono_movil='$fn_tmovil',mail='$fn_mail', direccion='$fn_direccion',fecha_registro='$fn_falta', fecha_actualizacion='$fn_factualiza', entra='$fn_entra', salida='$fn_salida', entra_s='$fn_entra_s', salida_s='$fn_salida_s', entra_d='$fn_entra_d', salida_d='$fn_salida_d', entra_f='$fn_entra_f', salida_f='$fn_salida_f', usr_conex='$fn_user' WHERE fk_id_empresa = 1 and  id_usuario='$id_usuario'";

//echo $query;

$result = $conexion -> query($query);
if ($result) {
    echo "<script>location.href='../tabla_usuarios.php'</script>";
}else{
  $codigo = mysqli_errno($conexion); 
  echo $codigo;
}
$conexion->close();

?>

