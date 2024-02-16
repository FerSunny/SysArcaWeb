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

$origen="Sucursal";
$fn_factualiza=date("y/m/d H:i:s");
$query ="INSERT INTO en_encuesta
(res_preg_3,res_preg_2,res_preg_1,fk_id_sucursal,fk_id_empresa,comentario,id_encuesta,fechaHoy,origen)VALUES
 ('$res_preg_1','$res_preg_2','$res_preg_3','$fk_id_sucursal','$fk_id_empresa','$comentario','$id_encuesta','$fn_factualiza','$origen')";

echo $query;

$result = $conexion -> query($query);
if ($result) {
  echo'<script type="text/javascript">
  alert("Encuesta guardada");
  window.location.href="/sysarcaweb_1.0/xx_menu_unico/menu_principal";
  </script>';
 
     
}else{
  $fk_id_sucursal = mysqli_errno($conexion); 
  echo $fk_id_sucursal;
 
}
$conexion->close();


?>