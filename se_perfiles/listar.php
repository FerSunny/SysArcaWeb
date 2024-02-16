<?php

	include ("../controladores/conex.php");

	$query = "SELECT p.id_perfil,
                     p.desc_perfil, 
                     m.desc_modulo,
                     p.fk_id_modulo,
                     p.per_lectura,
                     p.per_escritura,
                     p.per_borrar,
                     p.per_actualizar,
                     p.fecha_registro,
                     p.fecha_actualizacion,
                     p.estado
                      
                FROM se_perfiles p
LEFT OUTER JOIN se_modulos m ON (m.fk_empresa = p.fk_id_empresa AND m.id_modulo = p.fk_id_modulo)
WHERE p.estado = 'A'";


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
