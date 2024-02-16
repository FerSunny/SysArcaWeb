<?php

session_start();

	include ("../controladores/conex.php");

  $id_usuario= $_SESSION['id_usuario'];

  $fk_id_servicio= $_SESSION['fk_id_servicio'];
  $fk_id_sucursal= $_SESSION['fk_id_sucursal'];

 

  $query = "
SELECT 
q.*
,qi.`desc_q_i`
,oq.`desc_origen`
,tq.`desc_tipo`
,CONCAT(cl.`nombre`,' ',cl.`a_paterno`,' ',cl.`a_materno`) paciente,
qe.`desc_estatus`,
CONCAT(me.`nombre`,' ',me.`a_paterno`,' ',me.`a_materno`) medico,
se.desc_servicio,
CONCAT(us.`nombre`,' ',us.`a_paterno`,' ',us.`a_materno`) usuario
FROM ac_quejas q
,kg_queja_incon qi
,kg_origen_queja oq 
,kg_tipo_queja tq
,so_clientes cl
,kg_queja_estatus qe
,so_medicos me
,km_servicios se
,se_usuarios us
WHERE q.`estado` = 'A'
AND qi.id_q_i = q.fk_id_inconformidad
AND oq.`id_origen` = q.`fk_id_origen`
AND tq.`id_tipo` = q.`fk_id_tipo_queja`
AND cl.`id_cliente` = q.fk_id_paciente
AND qe.`id_estatus` = q.`fk_id_estatus`
AND me.`id_medico` = q.`fk_id_medicos`
AND q.`fk_id_servicio` = se.id_servicio
AND q.`fk_id_procede` = 1
AND q.`fk_id_servicio` = $fk_id_servicio
AND q.`fk_id_sucursal_asigna` =  $fk_id_sucursal
AND q.`fk_id_estatus` in (3,5)
AND q.fk_id_usuario = us.id_usuario
";

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

