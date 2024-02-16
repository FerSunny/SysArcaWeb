<?php 





session_start();

include ("../../controladores/conex.php");







$pro = $_POST['pro'];

$codigo  = $_POST['codigo'];


$dc  = $_POST['dc'];

$descripcion = $_POST['descripcion'];

$vminimo = $_POST['vminimo']; 

$vmaximo = $_POST['vmaximo']; 

$servicio = $_POST['servicio']; 

$area = $_POST['area']; 

$gpo_conta = $_POST['gpo_conta']; 

$conse = $_POST['conse']; 

$serie = $_POST['serie']; 
$dmto = $_POST['dmto']; 

$ultimo='0';


$marca = $_POST['marca']; 
$modelo = $_POST['modelo']; 
$fcalibra = $_POST['fcalibra']; 
//$fultimo = $_POST['fultimo']; 
$vcorrige = $_POST['vcorrige']; 
$dmto = $_POST['dmto']; 
$sucursal = $_POST['sucursal']; 
$fultimo = $_POST['fultimo'];

$usuario = $_POST['usuario'];
$pass = $_POST['pass'];

/*
$sql_exi="select conse FROM eb_termometros
where clave_id = 'EQU' 
AND fk_id_servicio = $servicio 
AND fk_id_area = $area 
AND fk_id_gpo_conta = $gpo_conta 
AND conse = $conse 
AND estado = 'A'
";
//echo $sql_exi;

if ($result_exi = mysqli_query($conexion, $sql_exi)) {
  while($row_exi = $result_exi->fetch_assoc())
  {
    //echo 'existe';
      $ultimo=$row_exi['conse'];
  }
}else{
  $ultimo='0';
  $sql_max="select max(conse) as ultimo FROM eb_termometros
  where clave_id = 'TER' AND fk_id_servicio = $servicio AND estado = 'A'";
  if ($result_max = mysqli_query($conexion, $sql_max)) {
    while($row = $result_max->fetch_assoc())
    {
        $ultimo=$row['ultimo'];
    }
  }
  if ($ultimo == 0 or $ultimo == null ){
    $ultimo= 1;
  }else{
    $ultimo=$ultimo+1;
  }
}
*/
//echo '---> '.$ultimo;


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
  fecha_calibracion = '$fcalibra',
  fecha_ult_mto = '$fultimo',
  valor_minimo= $vminimo,
  valor_maximo = $vmaximo,
  valor_corre = $vcorrige,
  dias_mto = $dmto,
  usuario = '$usuario',
  contra = '$pass'
WHERE id_equipo = $codigo
";

$result = $conexion -> query($query);

if ($result) {

    echo 1;

}else{

  $codigo = mysqli_errno($conexion); 

  echo $codigo;

}

$conexion->close();



?>





































































