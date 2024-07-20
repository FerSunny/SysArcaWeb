<?php
    
    session_start();
	include ("../controladores/conex.php");

    $numero_factura= $_SESSION['numero_factura'];
    $studio= $_SESSION['studio'];

	$query = "SELECT  ui.id_imagen,
    ui.fk_id_factura,
    es.desc_estudio,
    ui.nombre,
    ui.ruta,
    CONCAT(cl.`nombre`,' ',cl.`a_paterno`,' ',cl.`a_materno`) AS paciente
FROM cr_plantilla_usg_img ui,
km_estudios es,
so_factura fa,
so_clientes cl
WHERE ui.estado= 'A'
  AND ui.fk_id_estudio = es.id_estudio
  AND ui.fk_id_factura=fa.id_factura
  AND fa.`fk_id_cliente`=cl.`id_cliente`
  AND ui.fk_id_estudio = ".$studio." 
  AND ui.fk_id_factura = ".$numero_factura;

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