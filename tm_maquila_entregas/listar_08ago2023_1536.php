<?php



	include ("../controladores/conex.php");



  

 

  $query = "
  SELECT 
  s.desc_corta,
  t.lote,
  ld.id_lote,
  ld.hora_llegada,
  ld.hora_salida,
  ld.tem_ref,
  ld.tem_amb,
  ld.tem_con,
  ld.t_d,
  ld.t_r,
  ld.t_m,
  ld.t_a,
  ld.t_sec_sue,
  ld.t_sec_pla,
  ld.fro_san,
  ld.fro_eod,
  ld.fro_cul,
  ld.fro_cult,
  ld.ego_uro,
  ld.heces,
  ld.bx_o_fco_esteril,
  ld.ecg_traz,
  ld.pap,
  ld.med_stu,
  ld.med_liq,
  COUNT(*) as muestras
  FROM 
  tm_tomas t
  LEFT OUTER JOIN tm_lote_detalle ld ON (ld.lote = t.lote),
  kg_sucursales s
  WHERE DATE(t.fecha_toma) = CURDATE()-1
  AND t.fk_id_sucursal = s.id_sucursal
  GROUP BY
  s.desc_corta,
  t.lote,
  ld.id_lote,
  ld.lote,
  ld.hora_llegada,
  ld.hora_salida,
  ld.tem_ref,
  ld.tem_amb,
  ld.tem_con,
  ld.t_d,
  ld.t_r,
  ld.t_m,
  ld.t_a,
  ld.t_sec_sue,
  ld.t_sec_pla,
  ld.fro_san,
  ld.fro_eod,
  ld.fro_cul,
  ld.fro_cult,
  ld.ego_uro,
  ld.heces,
  ld.bx_o_fco_esteril,
  ld.ecg_traz,
  ld.pap,
  ld.med_stu,
  ld.med_liq
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

