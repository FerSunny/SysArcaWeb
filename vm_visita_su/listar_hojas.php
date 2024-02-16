<?php

    

    session_start();

	include ("../controladores/conex.php");



    $fk_id_medico= $_SESSION['fk_id_medico'];



	$query = "

SELECT hv.*,
        mc.*,
        CONCAT(us.`nombre`,' ',us.`a_paterno`,' ',us.`a_materno`) vm,
        ev.`desc_visita`
FROM vm_hoja_visita_sup hv
LEFT OUTER JOIN vw_medicoscategoria mc ON (mc.id_medico = hv.fk_id_medico)
LEFT OUTER JOIN se_usuarios us ON (us.`id_usuario` = hv.`fk_id_usuario_vm`)
LEFT OUTER JOIN kg_estado_visita ev ON (ev.`id_estado_visita` = hv.`fk_id_estado_visita`)

WHERE  hv.estado = 'A'

AND hv.fk_id_medico = ".$fk_id_medico;



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