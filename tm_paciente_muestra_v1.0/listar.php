<?php

session_start();

	include ("../controladores/conex.php");

  $id_modulo=$_SESSION['id_modulo'];
  $fk_id_perfil=$_SESSION['fk_id_perfil'];
  $fk_id_sucursal=$_SESSION['fk_id_sucursal'];

  if ($fk_id_perfil==1 or $fk_id_perfil==13) 
    {
      $condicion=' > 0';
    }
    else
    {
      $condicion=' = '.$fk_id_sucursal;
    }
 // los pacientes que ya se les tomo muestra..
  $query = "
  SELECT a.* FROM 
  ( 

    SELECT   
    ag.fk_id_factura AS id_factura,
    ag.`fecha`,
    cl.`nombre`,
    cl.`a_paterno`,
    cl.a_materno,
    cl.anios AS edad,
    fa.diagnostico,
    se.`desc_sexo`,
    se.id_sexo,
    COUNT( DISTINCT ag.`fk_id_estudio`) AS numest,
    count(mu.muestras) AS nummue,
    COUNT(t.fk_id_factura) AS muetom,
    fa.datos_clinicos,
    cl.id_cliente,
    fa.medicamentos,
    ag.hora,
    cl.telefono_fijo,
    cl.mail
  FROM tm_agenda ag
    LEFT OUTER JOIN vw_estudios_muestras mu ON (mu.`id_estudio` = ag.`fk_id_estudio`)
    LEFT OUTER JOIN tm_tomas t ON (t.`fk_id_factura` = ag.`fk_id_factura` AND t.`fk_id_estudio` = ag.`fk_id_estudio` AND (t.`aplico` = 'S' or t.aplico = 'X') ),
    so_factura fa,
    so_clientes cl,
    so_sexo se,
    km_estudios es
  WHERE ag.fk_id_sucursal $condicion
  AND ag.fecha = DATE(CURDATE() )
  -- AND ag.fecha >= '2024-04-01'
  AND ag.`fk_id_factura` = fa.`id_factura`
  AND fa.`fk_id_cliente` = cl.id_cliente
  AND cl.`fk_id_sexo` = se.id_sexo
  AND ag.`fk_id_estudio` = es.`id_estudio`
  AND es.`cubiculo` = 'S'
  GROUP BY
    ag.fk_id_factura,
    ag.`fecha`,
    cl.`nombre`,
    cl.`a_paterno`,
    cl.a_materno,
    cl.anios ,
    fa.diagnostico,
    se.`desc_sexo`,
    se.id_sexo

  ) a
  WHERE a.muetom < a.nummue
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
