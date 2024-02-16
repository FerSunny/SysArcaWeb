<?php 



session_start();

include ("../../controladores/conex.php");

$sucursal = $_SESSION['fk_id_sucursal'];





$codigo  = $_POST['codigo'];

$descripcion = $_POST['descripcion'];

$vminimo = $_POST['vminimo']; 

$vmaximo = $_POST['vmaximo']; 

$servicio = $_POST['servicio']; 

$area = $_POST['area']; 

$gpo_conta = $_POST['gpo_conta']; 
$serie = $_POST['serie']; 

$ultimo='0';
// obtenemos el ultimo movimiento
$sql_max="select max(conse) as ultimo FROM eb_termometros
where clave_id = 'TER' AND fk_id_servicio = $servicio AND estado = 'A'";
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
INSERT INTO eb_termometros
            (fk_id_empresa,
             id_termometro,
             numero_serie,
             clave_id,
             fk_id_servicio,
             fk_id_area,
             fk_id_gpo_conta,
             conse,
             descripcion,
             valor_minimo,
             valor_maximo,
             fecha_alta,
             estado)
VALUES (1,
        0,
        '$serie',
        'TER', 
        $servicio,
        $area,
        $gpo_conta,
        $ultimo,
        '$descripcion',
        $vminimo,
        $vmaximo,
        NOW(),
        'A');
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

