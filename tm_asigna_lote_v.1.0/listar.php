<?php

session_start();

	include ("../controladores/conex.php");


  $id_modulo=$_SESSION['id_modulo'];
  $fk_id_perfil=$_SESSION['fk_id_perfil'];
  $fk_id_sucursal=$_SESSION['fk_id_sucursal'];
  

 

  $query = "
    SELECT     su.desc_corta AS sucursal,
    tm.`fk_id_factura`,
    cl.`anios`,
    CONCAT(cl.`nombre`,' ',cl.`a_paterno`,' ',cl.`a_materno`) AS nombre,
    SUBSTR(es.`iniciales`,1,25) AS iniciales,
    SUBSTR(mu.`recoleccion`,1,225) AS recoleccion,
    fa.`diagnostico`,
    DATE(fa.`fecha_entrega`) AS fecha_entrega,
    CASE
        WHEN fa.`email_medico` = 0 AND fa.email_paciente = 0 THEN
            'VE'
        WHEN fa.`email_medico` = 0 AND fa.email_paciente <> 0 THEN
            'MP'   
        WHEN fa.`email_medico` <> 0 AND fa.email_paciente = 0 THEN
            'MM'   
        ELSE
            'DE'
    END AS via,
    tm.fk_id_usuario,
    tm.lote,
    tm.id_toma
        
FROM so_factura fa, so_clientes cl, km_estudios es, km_muestras mu, kg_sucursales su, tm_tomas tm

 WHERE fa.fk_id_sucursal >0
AND DATE(tm.fecha_toma) >=  CURDATE()
AND tm.`fk_id_factura` = fa.`id_factura`
AND fa.`fk_id_cliente` = cl.`id_cliente`
AND tm.`fk_id_estudio` = es.`id_estudio`
AND tm.`fk_id_muestra` = mu.`id_muestra`
AND fa.fk_id_sucursal = su.id_sucursal
AND tm.aplico = 'S'
--  AND tm.lote is null
and tm.fk_id_sucursal = ".$fk_id_sucursal."
order by tm.id_toma, tm.fk_id_factura
  ";

// echo $query;



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

