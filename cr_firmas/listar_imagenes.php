<?php
    
    session_start();
	include ("../controladores/conex.php");

    $numero_factura= $_SESSION['numero_factura'];
    $studio= $_SESSION['studio'];

	$query = "
        SELECT f.*,
            se.`desc_servicio`,
            ar.`desc_area`,
            CONCAT(us.nombre,' ',us.`a_paterno`,' ',us.`a_materno`) AS usuario
        FROM cr_firmas f
        LEFT OUTER JOIN km_servicios se ON (se.`id_servicio` = f.`fk_id_servicio`)
        LEFT OUTER JOIN km_areas ar ON (ar.`id_area` = f.fk_id_area)
        LEFT OUTER JOIN se_usuarios us ON (us.`id_usuario` = f.`fk_id_usuario`)
        WHERE f.`estado` = 'A'
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