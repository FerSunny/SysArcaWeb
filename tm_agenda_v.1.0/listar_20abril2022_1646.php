<?php
session_start();
	include ("../controladores/conex.php");

  $id_modulo=$_SESSION['id_modulo'];
  $fk_id_perfil=$_SESSION['fk_id_perfil'];
  $fk_id_sucursal=$_SESSION['fk_id_sucursal'];
  $usuario=$_SESSION['nombre'];
  $id_usuario=$_SESSION['id_usuario'];
  
    if ($fk_id_perfil==1 or $fk_id_perfil==13 ) 
    {
      $condicion=' > 0';
    }
    else
    {
      //if($fk_id_perfil==9){
      //  $condicion=" IN (SELECT ru.fk_id_sucursal FROM cr_plantilla_ruta ru WHERE fk_id_medico = ".$id_usuario.")";
      //}else{
        $condicion=' = '.$fk_id_sucursal; 
     // }
    }

    $query1 = "
    SELECT ' ".$fk_id_perfil."' AS perfil,
    fa.`id_factura`,
    fa.`fecha_factura`,
    fa.`fecha_entrega`,
    fa.`fk_id_sucursal`,
    su.`desc_corta` AS sucursal,
    CONCAT(cl.nombre,' ',cl.`a_paterno`, ' ',cl.a_materno) AS paciente,
    es.`id_estudio`,
    es.`iniciales` AS estudio,
    em.`control`,
    CONCAT(em.`control`,'-',em.`desc_muestra`) AS desc_muestra,
    ag.*
    
  FROM 	tm_agenda ag,
    so_factura fa,
    kg_sucursales su,
    so_clientes cl,
    km_estudios es ,
    vw_estudios_muestras_deta em
    
  WHERE ag.`fecha` = CURDATE()
  AND ag.`fk_id_factura` = fa.`id_factura`
  AND fa.`fk_id_sucursal` = su.`id_sucursal`
  AND fa.`fk_id_cliente` = cl.`id_cliente`
  AND ag.`fk_id_estudio` = es.`id_estudio`
  AND (ag.`fk_id_estudio` = em.`id_estudio` AND ag.`control` = em.`control`)
  AND NOT EXISTS (SELECT NULL FROM tm_tomas tm 
      WHERE tm.`fk_id_factura` = ag.`fk_id_factura`
      AND tm.`fk_id_estudio`= ag.`fk_id_estudio`	
      AND tm.`control` = em.`control`
      AND tm.aplico = 'S'
      )
  AND fa.fk_id_sucursal ".$condicion;


	$resultado = mysqli_query($conexion, $query1);

    if(!$resultado){
        die("Error".$query);

    }else{
        while($data=mysqli_fetch_assoc($resultado)){

            $arreglo["data"][]=$data;
        }
        echo json_encode($arreglo);
    }

    mysqli_free_result($resultado);
    mysqli_close($conexion);
