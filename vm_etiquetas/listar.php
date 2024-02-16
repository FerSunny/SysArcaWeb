<?php

    session_start();

	include ("../controladores/conex.php");
    $id_usuario= $_SESSION['id_usuario'];

  $query = "
    SELECT m.`id_medico`,
        CONCAT(m.`nombre`,' ',m.`a_paterno`,' ',m.`a_materno`) AS nombre,
        MIN(e.`folio_inicio`) AS folioinicio,
        MAX(e.folio_final) AS foliofinal,
        MAX(e.fecha_impresion) AS fechaemision,
        SUM(e.num_ocupadas) AS ocupadas
    FROM so_medicos m
    LEFT OUTER JOIN so_medicos_etq e ON (e.fk_id_medico = m.`id_medico` AND e.estado = 'A')
    WHERE m.`estado` = 'A'
    AND m.`fk_id_usuario` = $id_usuario
    GROUP BY 1,2
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

