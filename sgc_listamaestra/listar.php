<?php

	include ("../controladores/conex.php");

  
 
  $query = "
  SELECT
  lm.*,
  CONCAT(ti.`cve_tipo`,'-',mo.`cve_modulo`,'-',LPAD(lm.`consecutivo`,2,'0')) AS clave,
  gr.`desc_grupo`,
  ti.`desc_tipo`,
  mo.`desc_modulo`,
  td.desc_tipo_docu
  FROM 
  sgc_lista_maestra lm,
  sgc_grupos gr,
  sgc_tipos ti,
  sgc_modulos mo,
  sgc_documentos td
  WHERE lm.`fk_id_grupo` = gr.`id_grupo`
  AND lm.`fk_id_tipo` = ti.`id_tipo`
  AND lm.`fk_id_modulo` = mo.`id_modulo`
  and lm.`fk_id_docu` = td.id_tipo_docu
  AND lm.`estado` = 'A'
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
