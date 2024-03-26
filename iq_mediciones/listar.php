<?php



	include ("../controladores/conex.php");


  $query = "
  SELECT
  te.*,
  eq.`descripcion`,
  ar.`desc_area`,
  t.`incertidumbre_1`,
  t.`correccion_1`,
  t.`temp_refere_1`,
  t.`valor_medido_1`,
  
  t.`incertidumbre_2`,
  t.`correccion_2`,
  t.`temp_refere_2`,
  t.`valor_medido_2`,
  
  t.`incertidumbre_3`,
  t.`correccion_3`,
  t.`temp_refere_3`,
  t.`valor_medido_3`
  
  FROM 
  iq_mediciones te,
  eb_equipos eq,
  vw_termos t,
  km_areas ar
  WHERE te.`estado` = 'A'
  AND te.`fk_id_equipo` = eq.`id_equipo`
  AND eq.`fk_id_area` = ar.`id_area`
  AND te.`fk_id_equipo` = t.`fk_id_equipo`
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

