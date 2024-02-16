<?php
session_start();


	include ("../controladores/conex.php");

  $id_usuario=$_SESSION['id_usuario'];
  $clave=$_SESSION['clave'];
  $fecha=$_SESSION['fecha'];

  $query = "
  SELECT 
  tm.`id_toma`,
  su.`desc_corta`,
  fa.`id_factura`,
  CONCAT(cl.`nombre`,' ',cl.`a_paterno`,' ',cl.`a_materno`) AS paciente,
  es.`iniciales` AS estudio,
  tm.`fecha_toma`,
  mu.`desc_muestra`,
  CASE
  WHEN (tm.check_in_area = 1 AND tm.fk_id_rechazo_area = 0) OR check_in_area IS NULL THEN
  'Pendiente'
  WHEN tm.check_in_area = 2 AND tm.fk_id_rechazo_area IS NULL THEN
  'Aceptada'
  WHEN tm.check_in_area IN(1,2) AND tm.fk_id_rechazo_area > 0 THEN
  CONCAT('Rechazada por: ',' ',re.desc_rechazo)
  END AS estatus,
  tm.check_in_area,
  tm.fk_id_rechazo_area,
  su.mail
  FROM 
  tm_tomas tm
  LEFT OUTER JOIN km_muestras mu ON (mu.`id_muestra` = tm.`fk_id_muestra`)
  LEFT OUTER JOIN kg_rechazos re ON (re.id_rechazo = tm.fk_id_rechazo_area) ,
  so_factura fa,
  kg_sucursales su,
  so_clientes cl,
  km_estudios es,
  km_estudios_area ar
  WHERE DATE(tm.`fecha_toma`) = '$fecha' -- CURDATE()
  AND tm.`check_in` = 1
  AND tm.`fk_id_factura` = fa.`id_factura`
  AND fa.`fk_id_sucursal` = su.`id_sucursal`
  AND fa.`fk_id_cliente` = cl.`id_cliente`
  AND tm.`fk_id_estudio` = es.`id_estudio`
  AND tm.fk_id_estudio = ar.fk_id_estudio
  AND ar.fk_id_clave_area = '$clave'
";

//echo $query;



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

