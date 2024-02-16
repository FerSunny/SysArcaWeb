<?php

  session_start();

	include ("../controladores/conex.php");

  $id_modulo=$_SESSION['id_modulo'];
  $fk_id_perfil=$_SESSION['fk_id_perfil'];
  $fk_id_sucursal=$_SESSION['fk_id_sucursal'];

/*
  if ($fk_id_perfil==1 ) 
    {
      $condicion=' > 0';
    }
    else
    {
      $condicion=' = '.$fk_id_sucursal;
    }

*/

	$query = "
        SELECT
          re.id_registro,
          re.fk_id_gasto,
          re.fk_id_sucursal,
          su.desc_sucursal,
          ga.fk_id_clasifica,
          cl.desc_clasifica,
          ga.fk_id_tipo_gasto,
          tg.desc_tipo_gasto,
          ga.id_gasto,
          ga.desc_gasto,
          re.importe,
          re.fecha_mov,
          re.nota,
          re.estado,
          '$fk_id_perfil' as perfil,
          CASE
            WHEN re.estado = 'A' THEN
              'Aprobado'
            WHEN re.estado = 'E' THEN
              'En espera'
          END AS desc_estado,
          re.num_comprobante,
          re.fk_id_beneficiario
        FROM ga_registro_arca re,
            ga_gasto ga,
            ga_tipo_gasto tg,
            ga_clasifica cl,
            kg_sucursales su
        WHERE re.fk_id_gasto = ga.id_gasto
          AND ga.fk_id_tipo_gasto = tg.id_tipo_gasto
          AND ga.fk_id_clasifica = cl.id_clasifica
          AND re.fk_id_sucursal = su.id_sucursal
          AND re.estado IN ('A','E')
          AND DATE(re.fecha_mov) BETWEEN DATE_SUB(CURDATE(), INTERVAL 15 DAY) AND CURDATE()
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
