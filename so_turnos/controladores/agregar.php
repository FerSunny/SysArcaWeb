<?php 



session_start();

include ("../../controladores/conex.php");

$sucursal = $_SESSION['fk_id_sucursal'];





$caja  = $_POST['caja'];

$sql_max="select max(turno) as turno FROM so_turnos
where fk_id_sucursal=".$sucursal." and DATE(fecha)= CURDATE()";
// echo $sql_max;


  if ($result = mysqli_query($conexion, $sql_max)) {
    while($row = $result->fetch_assoc())
    {
        $turno=$row['turno']+1;
    }
  }




$query ="
INSERT INTO so_turnos
            (fk_id_empresa,
             id_turno,
             fk_id_sucursal,
             fecha,
             caja,
             turno,
             estado)
VALUES (1,
        0,
        $sucursal,
        NOW(),
        $caja,
        $turno,
        'A');
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

