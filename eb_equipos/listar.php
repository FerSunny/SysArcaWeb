<?php



	include ("../controladores/conex.php");



  

 

  $query = "
  SELECT 
  te.fk_id_empresa,
  te.id_equipo,
 te.numero_serie,
   te.clave_id,
  te.fk_id_sucursal,
  te.fk_id_servicio,
  te.fk_id_area,
  te.fk_id_gpo_conta,
  te.conse,
 te.descripcion,
  te.marca,
  te.modelo,
  te.valor_minimo,
  te.valor_maximo,
  te.valor_corre,
  date(te.fecha_alta) as fecha_alta,
  date(te.fecha_calibracion) as fecha_calibracion,
  date(te.fecha_ult_mto) as fecha_ult_mto,
  date(te.fecha_rece) as fecha_rece,
  date(te.fecha_marcha) as fecha_marcha,
  date(te.fecha_expira_g) as fecha_expira_g,
  te.dias_mto,
  te.escala,
  te.estado,
  te.fk_id_proveedor,
-- te.*,
 se.`desc_servicio`,
 ar.`desc_area`,
 gc.`desc_gpo_conta`,
 CONCAT(te.`clave_id`,'-',se.`desc_abreviada`,'-',ar.`clave`,'-',gc.`clave`,'-',te.`conse`) codigo,
 usuario,
 contra,
 pr.`razon_social`
FROM 
eb_equipos te,
km_servicios se,
km_areas ar,
km_gpo_conta gc,
eb_proveedores pr
WHERE te.`estado` = 'A'
AND te.`fk_id_servicio` = se.`id_servicio`
AND te.`fk_id_area` = ar.`id_area`
AND te.`fk_id_gpo_conta` = gc.`id_gpo_conta`
AND te.`fk_id_proveedor` = pr.`id_proveedor`
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

