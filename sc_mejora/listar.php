<?php



	include ("../controladores/conex.php");


  $query = "
  SELECT 
  m.id_mejora,
  CASE
  WHEN m.estatus = 'C' THEN
  'Creada'
  WHEN m.estatus = 'R' THEN
  'Rechazada'
  WHEN m.estatus = 'A' THEN
  'Aceptada'
  WHEN m.estatus = 'T' THEN
  'Creada'
  END AS desc_estatus,
  m.estatus,
  m.situacion,
  m.origen,
  m.fk_id_area,
  m.causas,
  m.objetivo,
  m.fk_id_boleana,
  m.cual,
  m.fk_id_usuario,
  m.fecha_registro,
  a.desc_area
FROM sc_mejora_pro m
LEFT OUTER JOIN km_areas a ON (a.`id_area` = m.`fk_id_area`)
WHERE m.`estado` = 'A'
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

