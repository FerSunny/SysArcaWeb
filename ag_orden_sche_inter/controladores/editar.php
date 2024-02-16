<?php 





session_start();

include ("../../controladores/conex.php");









$codigo  = $_POST['pro'];



$sucursal = $_POST['sucursal']; 

$medico = $_POST['medico'];

$fecha = $_POST['fecha']; 



$query = "UPDATE ag_interpreta_rx

SET



 fk_id_sucursal = '$sucursal',

 fk_id_usuario = '$medico',

 fecha = '$fecha'

WHERE id_agenda = '$codigo'";





$result = $conexion -> query($query);

if ($result) {

    echo 1;

}else{

  $codigo = mysqli_errno($conexion); 

  echo $codigo;

}

$conexion->close();



?>





































































