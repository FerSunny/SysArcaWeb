<?php

session_start();

	include ("../controladores/conex.php");


    $sucursal=$_SESSION['sucursal_ser'];
    //$fk_id_tipo_estudio=$_SESSION['servicio'];
    
    /*
    $cliente=$_SESSION['cliente_ser'];
  
    $query1 = "
    SELECT fk_id_tipo_estudio
    FROM km_estudios 
    WHERE id_estudio = $estudio
    AND estatus = 'A'
    ";
    $result1 = $conexion -> query($query1);
    $row1 = mysqli_fetch_array($result1);
    $fk_id_tipo_estudio = $row1['fk_id_tipo_estudio'];
    */




  $query = "SELECT ev.*, 
  su.`desc_sucursal`,
  CONCAT(cl.`nombre`,' ',cl.`a_paterno`,' ',cl.`a_materno`) paciente,
  es.`desc_estudio`,
  te.`nombre_tipo_estudio`
  FROM ci_eventos ev
  LEFT OUTER JOIN kg_sucursales su ON (su.`id_sucursal` = ev.`fk_id_sucursal_rec`)
  LEFT OUTER JOIN so_clientes cl ON(cl.`id_cliente` = ev.`fk_id_paciente`)
  LEFT OUTER JOIN km_estudios es ON (es.`id_estudio` = ev.`fk_id_estudio`)
  LEFT OUTER JOIN km_tipo_estudio te ON (te.`id_tipo_estudio` = ev.`fk_id_tipo_estudio`)
  WHERE  ev.estado IN ('D','R')
  AND ev.`fecha` >= CURDATE()";

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

