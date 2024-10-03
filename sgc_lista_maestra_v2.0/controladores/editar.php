<?php 





session_start();

include ("../../controladores/conex.php");






$codigo  = $_POST['codigo'];

$desc_numeral_1 = $_POST['desc_numeral_1'];


$query = "
update sgc_indice_uno
set 

  desc_numeral_1 = '$desc_numeral_1'
where `id_numeral_1` = $codigo;

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





































































