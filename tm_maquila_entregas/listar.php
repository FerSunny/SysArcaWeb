<?php
session_start();


	include ("../controladores/conex.php");


  $fk_id_perfil=$_SESSION['fk_id_perfil'];
  $fk_id_sucursal=$_SESSION['fk_id_sucursal'];
  
  if($fk_id_perfil == 1 or $fk_id_perfil == 45){
    $suc = ' > 0';
  }else{
    $suc = '= '.$fk_id_sucursal;
  }

 

  $query = "
  SELECT 
  s.desc_corta,
  DATE(t.fecha_toma) AS fecha_toma,
  e.`descripcion`,
  t.fk_id_equipo,
  t.aceptado_ia,
  t.fk_id_sucursal,
  COUNT(DISTINCT t.fk_id_medio) AS cantidad_medios,
  COUNT(*) AS cantidad
  FROM 
  tm_tomas t
  LEFT OUTER JOIN eb_equipos e ON (e.id_equipo = t.fk_id_equipo)

  LEFT OUTER JOIN kg_sucursales s ON (s.id_sucursal = t.`fk_id_sucursal`)
  WHERE DATE(t.fecha_toma) >= '2023-10-01'
  AND aceptado_ia IN (1,2)
  GROUP BY 1,2,3,4,5,6
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

