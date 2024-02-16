<?php 





session_start();

include ("../../controladores/conex.php");









$codigo  = $_POST['codigo'];



$desc_corta = $_POST['desc_corta']; 

$desc_larga = $_POST['desc_larga'];

$query = "
UPDATE km_metodos
SET 
  
  desc_metodo = '$desc_larga',
  desc_corta = '$desc_corta'
WHERE id_metodo = '$codigo'
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





































































