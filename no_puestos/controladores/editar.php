<?php 





session_start();

include ("../../controladores/conex.php");







$pro = $_POST['pro'];

$codigo  = $_POST['codigo'];

$puesto_c = $_POST['puesto_c'];

$puesto_l = $_POST['puesto_l']; 

$smi = $_POST['smi']; 

$nivel = $_POST['nivel']; 



$query = "
UPDATE no_puestos
SET 
  codigo = '$codigo',
  fk_id_nivel = '$nivel',
  desc_puesto = '$puesto_c',
  desc_puesto_larga = '$puesto_l',
  sdo_mes_integrado = $smi,
  fecha_actualiza = now()
WHERE id_puesto = $pro
";

//echo $query;



$result = $conexion -> query($query);

if ($result) {

    echo 1;

}else{

  $codigo = mysqli_errno($conexion); 

  echo $codigo;

}

$conexion->close();



?>





































































