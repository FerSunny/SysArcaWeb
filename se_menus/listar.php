<?php

	include ("../controladores/conex.php");

	$query = "SELECT me.`id_menu`,
    mn.`desc_nivel_menu`,
    me.`titulo`,
    me.`titulo_corto`,
    me.`enlace`,
    me.fecha_actualizacion,
    me.fk_id_nivel_menu,
    mn.id_nivel_menu
 FROM se_menus me, se_menu_nivel mn
 WHERE me.fk_id_nivel_menu = mn.id_nivel_menu
 AND me.estado = 'A'";

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
