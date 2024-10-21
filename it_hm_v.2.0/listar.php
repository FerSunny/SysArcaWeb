<?php

	include ("../controladores/conex.php");

  
 
  $query = "
        SELECT
        id,
        nickname,
        instrument_id,
        date_v,
        time_v,
        adapter,
        position_v,
        sample_no,
        reception_date,
        wbctotales,
        rbctotales,
        hgb,
        hct,
        mcv,
        mchpg,
        mchcgdl,
        plt,
        rdwsd,
        rdwcv,
        mpv,
        neutabs,
        lymphabs,
        monoabs,
        eoabs,
        basoabs,
        neutporc,
        lymphporc,
        monoporc,
        eoporc,
        basoporc,
        igabs,
        igporc
        FROM hm_recepcion_nx_550
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
