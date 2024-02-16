<?php

include("../controladores/conex.php");

session_start();
//$stmt = $conexion->prepare
$query=("SELECT  
  ts.id_sucursal,
  ts.desc_sucursal,
  ts.telefono,
  ts.telefono_2,
  ts.tel_movil,
  ts.hor_hab_ape,
  ts.hor_hab_cie,
  ts.hor_sab_ape,
  ts.hor_sab_cie,
  ts.hor_dom_ape,
  ts.hor_dom_cie,
  ts.fk_id_descuento,
  ts.skype,
  ts.mail,
  ts.fk_id_grupo, 
  ts.fk_estado,
  ts.fk_municipio,
  ts.fk_localidad,
  ts.cp,
  ts.colonia,
  ts.calle,
  ts.numero,
  ts.estado,
  ts.desc_corta,
ts.fk_id_usr,
ts.estado,
est.desc_estado,
mu.desc_municipio,
lo.desc_localidad,
de.`desc_descuento`,
CONCAT (us.nombre,' ' ,us.a_paterno,' ',us.a_materno) AS nombre ,
ts.`lunes`, ts.`martes`, ts.`miercoles`, ts.`jueves`, ts.`viernes`,
ts.`sabado`, ts.`domingo`,
  ts.estado,
  ts.`fk_pais`,
  gr.desc_grupo,
  pa.`nombre_pais`
  FROM kg_sucursales ts
LEFT OUTER JOIN kg_empresas es ON (es.id_empresa = ts.fk_id_empresa)
LEFT OUTER JOIN ku_estados est ON (est.id_estado = ts.fk_estado)
LEFT OUTER JOIN se_usuarios us ON (us.id_usuario = ts.fk_id_usr)
LEFT OUTER JOIN kg_descuentos de ON (de.`id_descuento` = ts.`fk_id_descuento`)
LEFT OUTER JOIN ku_municipios mu ON (ts.fk_estado = mu.fk_id_estado AND mu.id_municipio = ts.fk_municipio)
LEFT OUTER JOIN ku_localidades lo ON (lo.`id_estado` = ts.`fk_estado` AND ts.fk_municipio = lo.fk_id_municipio AND  lo.id_localidad = ts.fk_localidad)
LEFT OUTER JOIN ku_paises pa ON (pa.`id_pais` = ts.`fk_pais`)
LEFT OUTER JOIN kg_grupos gr ON (gr.id_grupo  = ts.fk_id_grupo)
WHERE ts.estado IN ('A')");

 // $stmt->bind_param('s',$estado);



 //$stmt->execute();
 //$result = $statement->fetcht();

  //Definiendo variables para ligarla



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