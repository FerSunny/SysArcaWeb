<?php 
date_default_timezone_set('America/Chihuahua');
session_start();
include ("../../controladores/conex.php");
$nombre = $_SESSION['nombre'];
$sucursal = $_SESSION['fk_id_sucursal'];

$id_factura=$_POST['id_factura'];
$studio=$_POST['id_estudio'];
$id_muestra=$_POST['id_muestra'];
$control=$_POST['control'];
$fecha_toma=date("y/m/d H:i:s");

//echo 'id_factura='.$id_factura;

$existe=0;

$q_revisa="
select count(*) existe from tm_tomas 
where fk_id_sucursal = $sucursal
and fk_id_factura = $id_factura
and fk_id_estudio = $studio
and fk_id_muestra = $id_muestra
and control = $control
";

//echo $q_revisa;

if ($result1 = mysqli_query($conexion, $q_revisa)) {
  while($row1 = $result1->fetch_assoc())
  {
      $existe=$row1['existe'];
  }
}

//echo $existe;

if($existe == 0){
  $query ="INSERT INTO tm_tomas
              (id_toma,fk_id_sucursal,fk_id_usuario,fk_id_factura,fk_id_estudio,fk_id_muestra,fecha_toma,aplico,control)
              VALUES (0,$sucursal,'$nombre','$id_factura','$studio','$id_muestra',now(),'S',$control)";

  //echo $query;

  $result = $conexion -> query($query);
  if ($result) {
    echo 1;
    
  }else{
    $codigo = mysqli_errno($conexion); 
    echo $codigo.$quey;
  }
}else{
  echo 1062;
}

$conexion->close();


?>
