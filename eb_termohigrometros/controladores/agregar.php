<?php 



session_start();

include ("../../controladores/conex.php");

$sucursal = $_SESSION['fk_id_sucursal'];


$fk_id_equipo       = $_POST['fk_id_equipo'];
$fecha_calibracion  = $_POST['fecha_calibracion'];
$duracion           = $_POST['duracion']; 

$temp_calibra       = $_POST['temp_calibra']; 
$humedad            = $_POST['humedad']; 
$exactitud          = $_POST['exactitud']; 

$fk_id_proveedor    = $_POST['fk_id_proveedor']; 

$temp_refere_1      = $_POST['temp_refere_1']; 
$valor_medido_1     = $_POST['valor_medido_1'];
$correccion_1       = $_POST['correccion_1'];
$incertidumbre_1    = $_POST['incertidumbre_1'];

$temp_refere_2      = $_POST['temp_refere_2']; 
$valor_medido_2     = $_POST['valor_medido_2'];
$correccion_2       = $_POST['correccion_2'];
$incertidumbre_2    = $_POST['incertidumbre_2'];

$temp_refere_3      = $_POST['temp_refere_3']; 
$valor_medido_3     = $_POST['valor_medido_3'];
$correccion_3       = $_POST['correccion_3'];
$incertidumbre_3    = $_POST['incertidumbre_3'];


$query ="
INSERT INTO  eb_termohigrometros 
            ( fk_id_empresa ,
              id_termohigrometros ,
              fk_id_equipo ,
              fecha_calibracion ,
              duracion ,
              temp_calibra ,
              humedad ,
              exactitud ,
              fk_id_proveedor ,
              temp_refere_1 ,
              valor_medido_1 ,
              correccion_1 ,
              incertidumbre_1 ,
              temp_refere_2 ,
              valor_medido_2 ,
              correccion_2 ,
              incertidumbre_2 ,
              temp_refere_3 ,
              valor_medido_3 ,
              correccion_3 ,
              incertidumbre_3 ,
              estado )
VALUES (1,
        0,
        '$fk_id_equipo',
        '$fecha_calibracion',
        '$duracion',
        '$temp_calibra',
        '$humedad',
        '$exactitud',
        '$fk_id_proveedor',
        '$temp_refere_1',
        '$valor_medido_1',
        '$correccion_1',
        '$incertidumbre_1',
        '$temp_refere_2',
        '$valor_medido_2',
        '$correccion_2',
        '$incertidumbre_2',
        '$temp_refere_3',
        '$valor_medido_3',
        '$correccion_3',
        '$incertidumbre_3',
        'A')
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

