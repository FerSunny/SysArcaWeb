<?php 
session_start();
include ("../../controladores/conex.php");
$fk_id_estudio_ori =$_SESSION['fk_id_estudio_ori'];
$usuario =$_SESSION['id_usuario'];


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
INSERT INTO `km_estudios_area`
            (`fk_id_estudio`,
             `fk_id_clave_area`,
             `fecha_registro`,
             `fecha_update`,
             `fk_id_usuario`,
             `estado`)
VALUES ('$fk_id_estudio_ori',
        '$clave',
        NOW(),
        NOW(),
        '$usuario',
        'A');
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

/*
$query ="INSERT INTO eb_departamento
            (fk_id_empresa,fk_id_sucursal,desc_departamento,descripcion,responsable,fk_sucursal)
VALUES (1,'$sucursal','$depto','$descrip','$respon','$suc')";

$result = $conexion -> query($query);
if ($result) {
	echo 1;
   
}else{
  $codigo = mysqli_errno($conexion); 
  echo $codigo;
}
$conexion->close();
*/
?>
