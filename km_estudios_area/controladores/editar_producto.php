<?php 


session_start();
include ("../../controladores/conex.php");

$sucursal =$_SESSION['fk_id_sucursal'];
$usuario =$_SESSION['id_usuario'];

$codigo = $_POST['codigo'];
$area  = $_POST['area'];

$stmt_pro=
"
select ar.* from km_areas ar where id_area = $area
";
if ($result_pro = mysqli_query($conexion, $stmt_pro)) {
  while($row_pro = $result_pro->fetch_assoc())
  {
      $clave=$row_pro['clave'];
  }
}

     
$query ="
UPDATE km_estudios_area
SET  fk_id_clave_area = '$clave',
  fecha_update = NOW(),
  fk_id_usuario = '$usuario'
WHERE  id_estudio_area = '$codigo';
";

//echo $query;

$result = $conexion -> query($query);
if ($result) {
	echo 1;
   
}else{
  $codigo = mysqli_errno($conexion); 
  echo $codigo;
}
$conexion->close();

?>