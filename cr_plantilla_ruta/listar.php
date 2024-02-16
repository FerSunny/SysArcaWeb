<?php

	include ("../controladores/conex.php");

	$query = "
SELECT ru.id_ruta,CONCAT(me.nombre,' ', me.a_paterno, ' ',me.a_materno) AS nombre,no.desc_sucursal,ru.fk_id_medico,ru.fk_id_sucursal,ru.orden FROM cr_plantilla_ruta ru
LEFT OUTER JOIN se_usuarios me ON (me.id_usuario = ru.fk_id_medico)
LEFT OUTER JOIN kg_sucursales no ON (no.id_sucursal = ru.fk_id_sucursal) WHERE ru.estado='A'";


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