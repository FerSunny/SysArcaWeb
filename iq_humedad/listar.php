<?php



	include ("../controladores/conex.php");



  

 

  $query = "
SELECT t.*,eq.* , 
CONCAT(eq.valor_minimo,' - ',eq.valor_maximo,' ',eq.escala) intervalo_aceptable,
a.`desc_area`,
CONCAT(eq.`clave_id`,'-',se.`desc_abreviada`,'-',a.`clave`,'-',gc.`clave`,'-',eq.`conse`) codigo
FROM iq_humedad t,
eb_hidro eq,
km_areas a,
km_servicios se,
km_gpo_conta gc
WHERE t.estado = 'A'
AND eq.`id_hidro` = t.`fk_id_equipo`
AND a.`id_area` = eq.`fk_id_area`
AND eq.`fk_id_servicio` = se.`id_servicio`
AND eq.`fk_id_gpo_conta` = gc.`id_gpo_conta`
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

