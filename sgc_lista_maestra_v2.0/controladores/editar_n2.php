<?php 





session_start();

include ("../../controladores/conex.php");
$fk_id_numeral_1=$_SESSION['id_numeral_1'];





$codigo  = $_POST['codigo'];

$desc_numeral_2 = $_POST['desc_numeral_2'];


$query = "
UPDATE sgc_indice_dos
SET
  

  desc_numeral_2 = '$desc_numeral_2'
WHERE `id_numeral_2` = '$codigo'
    AND `fk_id_numeral_1` = '$fk_id_numeral_1'
   

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





































































