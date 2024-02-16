<?php
  session_start();
	include ("../controladores/conex.php");


  $fk_id_perfil=$_SESSION['fk_id_perfil'];
  

  
  
  if ($fk_id_perfil==1 || $fk_id_perfil==41 ){
	$id_usuario = '> 0 OR ag.fk_id_usuario IS NULL';
  }else
  {
	$id_usuario= ' = '.$_SESSION['id_usuario'];
  }
  
  
	$query = "
  SELECT ag.*, me.`nombre`, me.`a_paterno`, me.`a_materno`,
  hv.visitas,
  hv.primer_visita,
  hv.ultima_visita,
    us.iniciales,
    gps.veces_gps,
    gps.primer_gps,
    gps.ultimo_gps
    FROM vm_agenda ag
    LEFT OUTER JOIN (SELECT hv.`fk_id_medico`,
    COUNT(*) AS visitas,
    MIN(concat(hv.fecha_visita,'-',hv.hora_visita)) AS primer_visita,
    MAX(concat(hv.fecha_visita,' ',hv.hora_visita)) AS ultima_visita
   FROM vm_hoja_visita hv
   GROUP BY hv.`fk_id_medico`) hv ON (hv.`fk_id_medico` = ag.`fk_id_medico`)
   
   LEFT OUTER JOIN (SELECT gm.fk_id_medico,COUNT(*) AS veces_gps, 
  MIN(gm.`fecha_registro`) AS primer_gps, 
  MAX(gm.`fecha_registro`) AS ultimo_gps 
  FROM gps_medico gm
  GROUP BY gm.fk_id_medico) gps ON (gps.fk_id_medico = ag.`fk_id_medico`),
    so_medicos me,
    se_usuarios us
    WHERE ag.estado = 'A'
    AND ag.`fk_id_medico` = me.`id_medico`
    AND ag.fk_id_usuario = us.id_usuario
    AND ag.fk_id_usuario ".$id_usuario;
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
