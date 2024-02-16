<?php

    include ("../controladores/conex.php");
    $query = "SELECT f.*,k.desc_estudio FROM so_detalle f
INNER JOIN km_estudios k ON(k.id_estudio = f.fk_id_estudio)";
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
