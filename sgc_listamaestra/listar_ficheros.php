<?php

	include ("../controladores/conex.php");

  
 
  $query = "
  SELECT 
  lf.*,
  lm.`desc_doc`,
  CASE lf.`doc_status`
  WHEN 'D' THEN
  'Disponible'
  WHEN 'E' THEN
  'Descargado'
  END AS estado_doc
  FROM 
  sgc_lista_ficheros lf,
  sgc_lista_maestra lm
  WHERE lf.`estado` = 'A'
  AND lf.`fk_id_doc` = lm.`fk_id_docu`
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
