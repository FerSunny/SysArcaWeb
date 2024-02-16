<?php

session_start();

	include ("../controladores/conex.php");


$id_equipo=$_SESSION['id_equipo'];
$id_manto=$_SESSION['id_manto'];  

  $query = "
  SELECT 
  a.*,
  CONCAT(b.nombre,' ',b.a_paterno,' ',b.a_materno) AS usuario_aut,
  c.producto
  FROM 
  eb_piezas a,
  se_usuarios b,
  eb_productos c
  WHERE a.estado = 'A'
  AND a.fk_id_equipo = $id_equipo
  AND a.fk_id_manto = $id_manto
  AND a.fk_id_usuario_aut = b.id_usuario
  AND a.fk_id_producto = c.id_producto
  ";

//echo $query;



	$resultado = mysqli_query($conexion, $query);



    if(!$resultado){

        die("Error");



    }else{

        while($data=mysqli_fetch_assoc($resultado)){

            $arreglo["data"][]=$data;

        }

        echo json_encode($arreglo);

    }



    mysqli_free_result($resultado);

    mysqli_close($conexion);

