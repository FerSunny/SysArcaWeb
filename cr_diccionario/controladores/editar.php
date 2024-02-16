<?php 

session_start();
include ("../../controladores/conex.php");


$codigo  = $_POST['codigo'];

$estudio = $_POST['id_estudio']; 
$edadinicial = $_POST['edadi']; 
$edadfinal = $_POST['edadf']; 
$genero = $_POST['genero']; 
$valorinicial = $_POST['rangoi'];
$valorfinal = $_POST['rangof'];

$id_plantilla = $_POST['id_plantilla'];


$qexiste = mysqli_query($conexion,"SELECT * FROM cr_diccionario WHERE fk_id_concepto = $codigo  AND estado ='A' ");
$nr     = mysqli_num_rows($qexiste);  
if($nr > 0){
$query = "UPDATE cr_diccionario
SET 
  fk_id_sexo = $genero,
  edad_inicial = $edadinicial,
  edad_final = $edadfinal,
  rango_inicial = $valorinicial,
  rango_final = $valorfinal
WHERE fk_id_concepto = $codigo;
";
}else{
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
    $codigo,
    $genero,
    $edadinicial,
    $edadfinal,
    $valorinicial,
    $valorfinal,
    'A'
    )
    ";
}



$result = $conexion -> query($query);

if ($result) {
    // *** actualizamos el concepto en la plantilla
    switch ($id_plantilla) {
      case '1':
        $q_upd = "UPDATE cr_plantilla_1
        SET 
          id_concepto = $codigo
        WHERE concat(fk_id_estudio,'.',id_valor) = $codigo;
        ";
        break;
      case '2':
        $q_upd = "UPDATE cr_plantilla_2
        SET 
          id_concepto = $codigo
        WHERE concat(fk_id_estudio,'.',id_valor) = $codigo;
        ";
        break;
      default:
        // code...
        break;
    }
    $result_upd = $conexion -> query($q_upd);
    echo 1;

}else{

  $codigo = mysqli_errno($conexion); 

  echo $codigo;

}

$conexion->close();



?>





































































