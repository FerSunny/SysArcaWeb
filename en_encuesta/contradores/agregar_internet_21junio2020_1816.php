<?php
   
date_default_timezone_set('America/Mexico_City');
session_start();
include ("../../controladores/conex.php");
$res_preg_1  = $_POST['res_preg_1'];
$res_preg_2 = $_POST['res_preg_2'];
$res_preg_3 = $_POST['res_preg_3']; 
$fk_id_sucursal = $_SESSION['fk_id_sucursal'];  
$fk_id_empresa = 1; 
$comentario = $_POST['comentario']; 
$id_encuesta = 0;
$origen="Internet";
/*
if (getenv('HTTP_CLIENT_IP')){
  $ip_usuario= getenv('HTTP_CLIENT_IP');
}elseif('HTTP_X_FORWARDED_FOR'){
  $ip_usuario =getenv('HTTP_X_FORWARDED_FOR');
}elseif('HTTP_X_FORWARDED'){
  $ip_usuario =getenv('HTTP_X_FORWARDED');
}elseif('HTTP_FORWARDED_FOR'){
  $ip_usuario =getenv('HTTP_FORWARDED_FOR');
}elseif ('HTTP_FORWARDED') {
   $ip_usuario= getenv('HTTP_FORWARDED');
}else{
  $ip_usuario=$_SERVER['REMOTE_ADDR'];

}
*/
//echo 'suursal: '.$fk_id_sucursal;

$exec = exec("hostname");
$hostname = trim($exec);
$ip_usuario = gethostbyname($hostname);
//echo "tu ip".$ip_usuario;
$fn_factualiza=date("y/m/d H:i:s");

$query ="INSERT INTO en_encuesta
(res_preg_3,res_preg_2,res_preg_1,fk_id_sucursal,fk_id_empresa,comentario,id_encuesta,fechaHoy,origen,ip_usuario)VALUES
 ('$res_preg_1','$res_preg_2','$res_preg_3','$fk_id_sucursal','$fk_id_empresa','$comentario','$id_encuesta','$fn_factualiza','$origen','$ip_usuario')";

//echo $query;

$result = $conexion -> query($query);
if ($result) {
  echo'<script type="text/javascript">
  alert("GRACIAS POR TUS RESPUESTAS ");
  window.location.href="/index.php";
  </script>';

     
}else{
  $fk_id_sucursal = mysqli_errno($conexion); 
  echo $fk_id_sucursal;
 
}
$conexion->close();


?>