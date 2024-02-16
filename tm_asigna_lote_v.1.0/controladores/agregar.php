<?php 



session_start();

include ("../../controladores/conex.php");

$sucursal = $_SESSION['fk_id_sucursal'];

$lote = $_SESSION['lote'];
$lote_max = $_SESSION['lote_max'];






$query ="
update tm_tomas set lote = '$lote',ultimo_lote = '$lote_max' where fk_id_sucursal = $sucursal and date(fecha_toma) = curdate()
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

