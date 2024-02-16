<?php

    session_start();

	include ("../controladores/conex.php");
    $id_usuario= $_SESSION['id_usuario'];

  $query = "
    SELECT  DISTINCT
        us.`iniciales`,
        us.id_usuario,
        YEAR(ag.fecha) AS anio,
        MONTH(ag.`fecha`) AS mesnum,
        MONTHNAME(ag.fecha) AS mes,
        DAY(ag.fecha) AS dia
        
    FROM vm_agenda ag
    LEFT OUTER JOIN se_usuarios us ON (us.`id_usuario` = ag.`fk_id_usuario`)
    WHERE ag.`estado` = 'A'
    AND ag.`fecha` >= '2022-01-01'
  ";





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

