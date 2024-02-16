<?php


date_default_timezone_set('America/Mexico_City');

include("../../controladores/conex.php");

$fk_id_perfil = $_SESSION['fk_id_perfil'];



$sql_max="select t.*  FROM so_turnos t
where date(t.fecha) = CURDATE() ORDER BY turno";

  if ($result = mysqli_query($con, $sql_max)) {
    while($row = $result->fetch_assoc())
    {
        $fk_id_sucursal=$row['fk_id_sucursal'];
        $turno=$row['turno'];

        $query="INSERT INTO so_turnos_time
                    (k_id_empresa,
                     id_tiempo,
                     fk_id_sucursal,
                     turno,
                     time)
        VALUES (1,
                0,
                '$fk_id_sucursal',
                '$turno',
                0)";

        $resultado = mysqli_query($conexion, $query);


    }
  }


?>