<?php
    session_start();
	include ("../controladores/conex.php");
    
    $fk_id_usuario= $_SESSION['fk_id_usuario'];
    $anio= $_SESSION['anio'];
    $mes= $_SESSION['mes'];

    $query = "
    SELECT 
    CONCAT(us.`nombre`,' ',us.`a_paterno`,' ',us.`a_materno`) AS vm,
  ag.`fecha`,
  SUBSTR(ag.hora,1,5) AS hora,
  CONCAT(me.`nombre`,' ',me.`a_paterno`,' ',me.`a_materno`) AS medico,
  ag.`planeado`,
  SUBSTR(hv.`hora_visita`,1,5) AS hora_visita,
  ev.`desc_visita`,
  hv.`participaciones`,
  hv.`publicidad`,
  hv.`ordenes_fi`,
  hv.`ordenes_ff`,
  hv.`quejas`,
  hv.`sugerencias`,
  hv.`observaciones`,
  hv.`mail_resultados`,
  me.`e_mail`
FROM vm_agenda ag
LEFT OUTER JOIN vm_hoja_visita hv ON (hv.`estado` = 'A' AND hv.`fk_id_medico` = ag.`fk_id_medico` AND hv.`fecha_visita` = ag.`fecha`)
LEFT OUTER JOIN kg_estado_visita ev ON (ev.`id_estado_visita` = hv.`fk_id_estado_visita`),
  se_usuarios us,
  so_medicos me
WHERE ag.`estado` = 'A'
AND ag.`fk_id_usuario` = us.`id_usuario`
AND ag.`fk_id_medico` = me.`id_medico`
AND ag.fk_id_usuario = ".$fk_id_usuario."
AND year(ag.fecha) = ".$anio."
AND MONTHNAME(ag.fecha) = '".$mes."'

union

SELECT 
  CONCAT(us.`nombre`,' ',us.`a_paterno`,' ',us.`a_materno`) AS vm,
  hv.`fecha_visita`  AS fecha,
  SUBSTR(hv.hora_visita,1,5) AS hora,
  CONCAT(me.`nombre`,' ',me.`a_paterno`,' ',me.`a_materno`) AS medico,
  'N' `planeado`,
  SUBSTR(hv.`hora_visita`,1,5) AS hora_visita,
  ev.`desc_visita`,
  hv.`participaciones`,
  hv.`publicidad`,
  hv.`ordenes_fi`,
  hv.`ordenes_ff`,
  hv.`quejas`,
  hv.`sugerencias`,
  hv.`observaciones`,
  hv.`mail_resultados`,
  me.`e_mail`
FROM vm_hoja_visita hv
LEFT OUTER JOIN kg_estado_visita ev ON (ev.`id_estado_visita` = hv.`fk_id_estado_visita`),
so_medicos me, se_usuarios us
WHERE teay(hv.`fecha_visita`) = ".$anio."
AND MONTHNAME(hv.`fecha_visita`) = '".$mes."'
AND hv.`fk_id_medico` = me.`id_medico`
AND me.`fk_id_usuario` = ".$fk_id_usuario."
AND hv.`estado` = 'A'
AND hv.`fk_id_medico` NOT IN (SELECT a.fk_id_medico FROM vm_agenda a WHERE a.`fecha` = hv.`fecha_visita`)
AND me.`fk_id_usuario` = us.`id_usuario`
;

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
