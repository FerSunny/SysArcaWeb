<?php 





session_start();

include ("../../controladores/conex.php");







$pro = $_POST['pro'];

$codigo  = $_POST['codigo'];

$medio =$_POST['medio'];

$equipo = $_POST['equipo']; 


$query = "UPDATE tm_tomas
SET
 fk_id_medio = '$medio',
 fk_id_equipo = '$equipo',
 aceptado_ia = 1
WHERE id_toma = '$codigo'";


$result = $conexion -> query($query);

if ($result) {

    // obtenemos los valores de la mustrs
    $stm_select="select fk_id_sucursal,fk_id_factura,fk_id_estudio FROM tm_tomas
    WHERE id_toma =".$codigo;
    //echo $stm_select;
    if ($result = mysqli_query($conexion, $stm_select)) {
      while($row = $result->fetch_assoc())
      {
          $fk_id_sucursal=$row['fk_id_sucursal'];
          $fk_id_factura=$row['fk_id_factura'];
          $fk_id_estudio=$row['fk_id_estudio'];
          //echo $veces;

      }
    }else{
      $fk_id_sucursal=0;
      $fk_id_factura=0;
      $fk_id_estudio=0;      
    }



    $stmt_insert =
    "
    INSERT INTO tm_ia
    (fk_id_empresa,
    id_ia,
    fk_id_sucursal,
    fk_id_factura,
    fk_id_estudio,
    fk_id_medio,
    fk_id_equipo,
    estado)
    values (1,
    0,
    $fk_id_sucursal,
    $fk_id_factura,
    $fk_id_estudio,
    $medio,
    $equipo,
    'A')
    ";
    $execute_stmt_insert = mysqli_query($conexion,$stmt_insert);
    echo 1;

}else{

  $codigo = mysqli_errno($conexion); 

  echo $codigo;

}

$conexion->close();



?>





































































