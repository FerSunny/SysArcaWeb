<?php

session_start();

	include ("../controladores/conex.php");

  $fk_id_perfil=$_SESSION['fk_id_perfil'];
  $fk_id_sucursal=$_SESSION['fk_id_sucursal'];

    $sucursal= $_SESSION['sucursal'];
    $anio= $_SESSION['anio'];
    $mes= $_SESSION['mes'];

/*
    if ($fk_id_perfil==1 or $fk_id_perfil==45 or $fk_id_perfil==46) 
    {
       $sucursal = "> 0"; 
    }ELSE{
        $sucursal = " = ".$fk_id_sucursal;
    }
*/
 

  $query = "
    SELECT h.* ,
        s.`desc_sucursal`,
        se.`desc_servicio`,
        CONCAT(u.`nombre`,' ',u.`a_paterno`,' ',u.`a_materno`) AS nombre
    FROM ca_horarios h
    LEFT OUTER JOIN kg_sucursales s ON (s.`id_sucursal` = h.`fk_id_sucursal`)
    LEFT OUTER JOIN km_servicios se ON (se.`id_servicio` = h.`fk_id_servicio`)
    LEFT OUTER JOIN se_usuarios u ON (u.`id_usuario` = h.`fk_id_medico`)
    WHERE h.`estado` = 'A'
    AND h.fk_id_sucursal = $sucursal
    AND year(h.dia_atencion) = $anio
    AND month(h.dia_atencion) = $mes
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

