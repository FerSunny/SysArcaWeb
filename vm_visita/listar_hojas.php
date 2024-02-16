<?php
    
    session_start();
	include ("../controladores/conex.php");

    $fk_id_medico= $_SESSION['fk_id_medico'];

	$query = "
SELECT hv.*,
	ev.`desc_visita`
FROM vm_hoja_visita hv, kg_estado_visita ev
WHERE hv.`fk_id_estado_visita` = ev.`id_estado_visita`
and hv.estado = 'A'
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