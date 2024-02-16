<?php

session_start();

	include ("../controladores/conex.php");

  $id_usuario= $_SESSION['id_usuario'];

  

 

  $query = "
SELECT 
q.*
,qi.`desc_q_i`
,oq.`desc_origen`
,tq.`desc_tipo`
,CONCAT(cl.`nombre`,' ',cl.`a_paterno`,' ',cl.`a_materno`) paciente,
qe.`desc_estatus`,
CONCAT(me.`nombre`,' ',me.`a_paterno`,' ',me.`a_materno`) medico,
us.`iniciales`,
su.desc_corta
FROM ac_quejas q
LEFT OUTER JOIN kg_queja_incon qi ON (qi.id_q_i = q.fk_id_inconformidad)
LEFT OUTER JOIN kg_origen_queja oq ON(oq.`id_origen` = q.fk_id_origen)
LEFT OUTER JOIN kg_tipo_queja tq ON (tq.`id_tipo` = q.`fk_id_tipo_queja`)
LEFT OUTER JOIN so_clientes cl ON (cl.`id_cliente` = q.fk_id_paciente)
LEFT OUTER JOIN kg_queja_estatus qe ON (qe.`id_estatus` = q.`fk_id_estatus`)
LEFT OUTER JOIN so_medicos me ON (me.`id_medico` = q.`fk_id_medicos`)
LEFT OUTER JOIN se_usuarios us ON (us.`id_usuario` = q.`fk_id_usuario`)
LEFT OUTER JOIN kg_sucursales su ON (su.`id_sucursal` = q.`fk_id_sucursal`)
WHERE q.`estado` = 'A'
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

