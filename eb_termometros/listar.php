<?php



	include ("../controladores/conex.php");



  

 

  $query = "
SELECT te.*,
 se.`desc_servicio`,
 ar.`desc_area`,
 gc.`desc_gpo_conta`,
 CONCAT(te.`clave_id`,'-',se.`desc_abreviada`,'-',ar.`clave`,'-',gc.`clave`,'-',te.`conse`) codigo
FROM 
eb_termometros te,
km_servicios se,
km_areas ar,
km_gpo_conta gc
WHERE te.`estado` = 'A'
AND te.`fk_id_servicio` = se.`id_servicio`
AND te.`fk_id_area` = ar.`id_area`
AND te.`fk_id_gpo_conta` = gc.`id_gpo_conta`
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

