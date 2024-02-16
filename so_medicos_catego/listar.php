<?php

session_start();

	include ("../controladores/conex.php");


  $fk_id_perfil=$_SESSION['fk_id_perfil'];
  

  
  
  if ($fk_id_perfil==1 || $fk_id_perfil==42 || $fk_id_perfil==14 || $fk_id_perfil==45 || $fk_id_perfil==33){
    $id_usuario = '> 0 OR me.fk_id_usuario IS NULL';
  }else
  {
    $id_usuario= ' = '.$_SESSION['id_usuario'];
  }
  

 

  $query = "
SELECT 
me.`id_medico`,
me.`nombre`,
me.`a_paterno`,
me.`a_materno`,
mc.*,
sn.`desc_boleana` AS meatiende,
ns.desc_boleana AS mispacientes
FROM so_medicos me
LEFT OUTER JOIN so_medicos_catego mc ON (mc.fk_id_medico = me.`id_medico` and mc.estado = 'A')
LEFT OUTER JOIN kg_si_no sn ON (sn.`id_boleana` = mc.`me_atiende`)
LEFT OUTER JOIN kg_si_no ns ON (ns.`id_boleana` = mc.`mis_pacientes`)
WHERE me.`estado` = 'A'
AND me.fk_id_usuario $id_usuario
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

