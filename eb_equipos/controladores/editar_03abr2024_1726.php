<?php 





session_start();

include ("../../controladores/conex.php");







$pro = $_POST['pro'];

$codigo  = $_POST['codigo'];


$dc  = $_POST['dc'];

$codigo  = $_POST['codigo'];

$sucursal = $_POST['sucursal']; 
$servicio = $_POST['servicio']; 
$area = $_POST['area']; 
$gpo_conta = $_POST['gpo_conta']; 

$descripcion = $_POST['descripcion'];
$serie = $_POST['serie']; 
$marca = $_POST['marca']; 
$modelo = $_POST['modelo']; 

$fecha_alta = $_POST['fecha_alta'];
$fecha_marcha = $_POST['fecha_marcha']; 
$fecha_expira_g = $_POST['fecha_expira_g'];

$proveedor = $_POST['proveedor']; 

$usuario = $_POST['usuario'];
$pass = $_POST['pass'];


$query = "
UPDATE eb_equipos
SET 
  fk_id_sucursal = $sucursal,
  fk_id_servicio = $servicio,
  fk_id_area = $area,
  fk_id_gpo_conta = $gpo_conta,

  descripcion = '$descripcion',
  numero_serie = '$serie',
  marca = '$marca',
  modelo = '$modelo',

  fecha_rece = '$fecha_alta',
  fecha_marcha = '$fecha_marcha',
  fecha_expira_g = '$fecha_expira_g',

  fk_id_proveedor = $proveedor,

  usuario = '$usuario',
  contra = '$pass'
WHERE id_equipo = $codigo
";
echo "qury update:".$query;
$result = $conexion -> query($query);

if ($result) {

    echo 1;

}else{

  $codigo = mysqli_errno($conexion); 

  echo $codigo;

}

$conexion->close();



?>





































































