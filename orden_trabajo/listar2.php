<?php

    include ("../controladores/conex.php");
    $query = "SELECT c.*,s.desc_sexo,ec.desc_estado_civil FROM so_clientes c 
    LEFT OUTER JOIN so_sexo s ON (s.fk_id_empresa= 1 AND s.id_sexo = c.fk_id_sexo)
    LEFT OUTER JOIN kg_estado_civil ec ON (ec.fk_id_empresa=1 AND ec.id_estado_civil = c.fk_id_estado_civil)
     WHERE c.activo = 'A'";
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
