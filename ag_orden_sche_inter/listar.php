<?php

session_start();

	include ("../controladores/conex.php");



  $fk_id_perfil=$_SESSION['fk_id_perfil'];
  $fk_id_sucursal=$_SESSION['fk_id_sucursal'];

  
    if ($fk_id_perfil==1 or $fk_id_perfil==13 or $fk_id_perfil==45 or $fk_id_perfil==46 ) 
    {
      $condicion=' > 0';
    }
    else
    {

        $condicion=' = '.$fk_id_sucursal; 

    }
 
  $query =
    "SELECT em.`id_sucursal`, 
em.`desc_corta`,
em.`desc_sucursal` ,
CONCAT(us.`nombre`, ' ',us.`a_paterno`,' ',us.`a_materno`) AS nombre,
CASE 
WHEN z.fk_id_usuario IS NULL THEN 
    0
ELSE
    z.fk_id_usuario
END AS fk_id_usuario,
fecha,
id_agenda
FROM ag_interpreta_rx z
LEFT OUTER JOIN kg_sucursales em ON (z.`fk_id_sucursal` = em.id_sucursal AND z.estado = 'A')
LEFT OUTER JOIN se_usuarios us ON (us.`id_usuario` = z.`fk_id_usuario`)
WHERE z.`estado` = 'A'
and z.fk_id_sucursal ".$condicion
;


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

