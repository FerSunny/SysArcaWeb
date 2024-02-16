<?php 



session_start();

include ("../../controladores/conex.php");

$sucursal = $_SESSION['fk_id_sucursal'];



$estudio = $_POST['estudio']; 
$concepto = $_POST['concepto'];
$edadinicial = $_POST['edadi']; 
$edadfinal = $_POST['edadf']; 
$genero = $_POST['genero']; 
$valorinicial = $_POST['rangoi'];
$valorfinal = $_POST['rangof'];

$fk_id_concepto = $estudio.'.'.$concepto;

$correcto=0;
$bien=0;
$queryestudio = mysqli_query($conexion,"SELECT * FROM km_estudios  WHERE id_estudio = $estudio  AND estatus ='A' ");
$nr     = mysqli_num_rows($queryestudio);  
if($nr > 0){
  $km_estudios = mysqli_fetch_array($queryestudio);
  $id_plantilla = $km_estudios['fk_id_plantilla'];
  switch ($id_plantilla) {
    case '1':
      $qplantilla = mysqli_query($conexion,"SELECT * FROM cr_plantilla_1  
                                          WHERE fk_id_estudio = $estudio  
                                          AND id_valor = $concepto 
                                          AND estado ='A' ");
      $nrp     = mysqli_num_rows($qplantilla);  
      if($nrp > 0){
        $correcto=1;
      }else{
        $correcto=9;
      }
      break;
    case '2':
      $qplantilla = mysqli_query($conexion,"SELECT * FROM cr_plantilla_2  
                                          WHERE fk_id_estudio = $estudio  
                                          AND id_valor = $concepto 
                                          AND estado ='A' ");
      $nrp     = mysqli_num_rows($qplantilla);  
      if($nrp > 0){
        $correcto=1;

      }else{
        $correcto=9;
      }
      break;
    default:
      // code...
      break;
  }
}

  if($correcto == 1){
    $query = "
    INSERT INTO `cr_diccionario`
    (`fk_id_empresa`,
     `id_diccionario`,
     `fk_id_estudio`,
     `fk_id_concepto`,
     `fk_id_sexo`,
     `edad_inicial`,
     `edad_final`,
     `rango_inicial`,
     `rango_final`,
     `estado`)
    VALUES (
      1,
      0,
      $estudio,
      $fk_id_concepto,
      $genero,
      $edadinicial,
      $edadfinal,
      $valorinicial,
      $valorfinal,
      'A'
      )
    ";
    $result = $conexion -> query($query);
    if ($result) {
        echo 1;
    }else{
      $codigo = mysqli_errno($conexion); 
      echo $codigo;
    }
  }else{
    echo 9;
  }







$conexion->close();



?>

