<?php

	include ("../controladores/conex.php");

	$query = "SELECT m.id_modulo,m.desc_modulo,m.abreviado,m.estado,m.fecha_registro,m.fecha_actualizacion FROM se_modulos m WHERE m.estado = 'A'";

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
