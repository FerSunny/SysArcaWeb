<?php 



session_start();

include ("../../controladores/conex.php");

$sucursal = $_SESSION['fk_id_sucursal'];





$codigo  = $_POST['codigo'];

$descripcion = $_POST['descripcion'];

//$vminimo = $_POST['vminimo']; 

//$vmaximo = $_POST['vmaximo']; 

$servicio = $_POST['servicio']; 

$area = $_POST['area']; 

$gpo_conta = $_POST['gpo_conta']; 
$serie = $_POST['serie']; 

$marca = $_POST['marca']; 
$modelo = $_POST['modelo']; 
//$fcalibra = $_POST['fcalibra']; 
//$fultimo = $_POST['fultimo']; 
//$vcorrige = $_POST['vcorrige']; 
//$dmto = $_POST['dmto']; 
$sucursal = $_POST['sucursal']; 
$fecha_alta = $_POST['fecha_alta'];
$proveedor = $_POST['proveedor']; 
$fecha_marcha = $_POST['fecha_marcha']; 
$fecha_expira_g = $_POST['fecha_expira_g']; 
$proveedor = $_POST['proveedor']; 

$usuario = $_POST['usuario'];
$pass = $_POST['pass'];


$ultimo='0';
// obtenemos el ultimo movimiento
$sql_max="select max(conse) as ultimo FROM eb_equipos
WHERE fk_id_sucursal = $sucursal AND fk_id_servicio = $servicio AND estado = 'A'";
//echo $sql_max;
if ($result_max = mysqli_query($conexion, $sql_max)) {
  while($row = $result_max->fetch_assoc())
  {
      $ultimo=$row['ultimo'];
  }
}

//echo 'Ulti9mo='.$ultimo;

  if ($ultimo == 0 or $ultimo == null ){
    $ultimo= 1;
  }else{
    $ultimo=$ultimo+1;
  }

//echo 'Ultimo++ = '.$ultimo;


$query ="
INSERT INTO eb_equipos
            (fk_id_empresa,
             id_equipo,
             numero_serie,
             clave_id,
             fk_id_sucursal,
             fk_id_servicio,
             fk_id_area,
             fk_id_gpo_conta,
             conse,
             descripcion,
             marca,
             modelo,

             fecha_alta,
             estado,
             usuario,
             contra,
             fecha_rece,
             fecha_marcha,
             fecha_expira_g,
             fk_id_proveedor)
VALUES (1,
        0,
        '$serie',
        'EQU', 
        $sucursal,
        $servicio,
        $area,
        $gpo_conta,
        $ultimo,
        '$descripcion',
        '$marca',
        '$modelo',

        NOW(),

        'A',
        '$usuario',
        '$pass',
        '$fecha_alta',
        '$fecha_marcha',
        '$fecha_expira_g',
        $proveedor);
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

