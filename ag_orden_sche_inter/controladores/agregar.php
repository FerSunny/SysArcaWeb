<?php 



session_start();

include ("../../controladores/conex.php");

$sucursal = $_SESSION['fk_id_sucursal'];





//$codigo  = $_POST['codigo'];

$sucursal = $_POST['sucursal'];

$medico = $_POST['medico']; 

$fecha = $_POST['fecha']; 

$query ="INSERT INTO ag_interpreta_rx

            (`fk_id_empresa`,
             `id_agenda`,
             `fk_id_sucursal`,
             `fk_id_usuario`,
             fecha,
             `estado`)

VALUES (1,0,'$sucursal','$medico','$fecha','A')";



$result = $conexion -> query($query);

if ($result) {

    echo 1;

   

}else{

  $codigo = mysqli_errno($conexion); 

  echo $codigo.'-->'.$query;

}

$conexion->close();



?>

