<?php
    
    session_start();
	include ("../controladores/conex.php");

    $id_queja= $_SESSION['id_queja'];

	$query = "SELECT 
q.`id_imagen`,
q.`fk_id_queja`,
CONCAT(me.`nombre`,' ',me.`a_paterno`,' ',me.`a_materno`) medico,
q.ruta,
q.nombre,
q.fecha_registro
FROM ac_quejas_img q
LEFT OUTER JOIN ac_quejas e ON (e.`id_queja` = q.`fk_id_queja`)
LEFT OUTER JOIN so_medicos me ON (me.`id_medico` = e.`fk_id_medicos`)
WHERE q.`estado` = 'A' 
  AND q.fk_id_queja = ".$id_queja;

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