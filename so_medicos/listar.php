<?php
  session_start();
	include ("../controladores/conex.php");


  $fk_id_perfil=$_SESSION['fk_id_perfil'];
  

  
  
  if ($fk_id_perfil==1 || $fk_id_perfil==42 || $fk_id_perfil==14 || $fk_id_perfil==45 || $fk_id_perfil==33){
	$id_usuario = '> 0 OR m.fk_id_usuario IS NULL';
  }else
  {
	$id_usuario= ' = '.$_SESSION['id_usuario'];
  }
  
  
	$query = "SELECT distinct ".$fk_id_perfil." as id_pefil,
m.id_medico, 
m.fk_id_zona, m.`fk_id_sucursal`,
m.nombre, 
m.a_paterno, 
m.a_materno, 
m.rfc, 
m.fk_id_sexo, 
m.fk_id_especialidad, 
m.fk_id_estado, 
m.`fk_id_municipio`,
m.fk_id_localidad, 
m.colonia, 
m.cp, m.`activado`, m.`pass`, m.`token`, m.`usuario`,
m.calle, 
m.numero_exterior, 
m.referencia, 
m.telefono_fijo, 
m.telefono_movil, 
m.horario, 
m.cuenta_banco, 
m.adscrito, 
m.fecha_registro, 
m.fecha_actuaizacion, 
m.e_mail, m.estado, 
z.desc_zona,
e.desc_especialidad,
s.desc_sexo,
su.desc_sucursal,
k.desc_estado,
mu.desc_municipio,
lo.desc_localidad, m.fk_id_usuario, m.`otro_lab`,
0 as latitud,
0 as longitud,
0 as altitud,
m.`medico`, m.`tipo_consul`, m.`observaciones`,

CASE
        WHEN m1.`fk_id_medico` IS NOT NULL THEN
            CONCAT(m1.fecha_registro,m1.latitud,',',m1.longitud)
        ELSE
            CONCAT(m2.fecha_registro,m2.latitud,',',m2.longitud)
END AS gps,
m.categoria,
td.*,
m.fk_id_tipo_consultorio

FROM so_medicos m 
LEFT OUTER JOIN kg_zonas z ON (z.id_zona = m.fk_id_zona) 
LEFT OUTER JOIN km_especialidades e ON (e.id_especialidad = m.fk_id_especialidad)
LEFT OUTER JOIN so_sexo s ON (s.id_sexo = m.fk_id_sexo)
LEFT OUTER JOIN kg_sucursales su ON (su.id_sucursal = m.fk_id_sucursal)
LEFT OUTER JOIN ku_estados k ON (k.id_estado = m.fk_id_estado)
LEFT OUTER JOIN ku_municipios mu ON (m.fk_id_estado = mu.fk_id_estado AND mu.id_municipio = m.fk_id_municipio)
LEFT OUTER JOIN ku_localidades lo ON (lo.`id_estado` = m.`fk_id_estado` AND m.fk_id_municipio = lo.fk_id_municipio AND  lo.id_localidad = m.fk_id_localidad)
LEFT OUTER JOIN se_usuarios u ON(u.id_usuario = m.fk_id_usuario)
LEFT OUTER JOIN vw_gps_medico gm ON (gm.fk_id_medico = m.`id_medico`)
LEFT OUTER JOIN ce_vmedicos m1 ON (gm.fk_id_medico = m1.fk_id_medico AND gm.fecha_registro = m1.fecha_registro)
LEFT OUTER JOIN gps_medico m2 ON (gm.fk_id_medico = m2.fk_id_medico AND gm.fecha_registro = m2.fecha_registro)
LEFT OUTER JOIN kg_tipo_consultorio td ON (td.id_tipo_consultorio = m.fk_id_tipo_consultorio)
WHERE m.estado = 'A'
AND m.fk_id_usuario  ".$id_usuario;

/*SELECT m.id_medico, m.fk_id_zona, m.nombre, m.a_paterno, m.a_materno, m.rfc, m.fk_id_sexo, m.fk_id_especialidad, m.fk_id_estado, m.fk_id_municipio, m.fk_id_localidad, m.colonia, m.cp, m.calle, m.numero_exterior, m.referencia, m.telefono_fijo, m.telefono_movil, m.horario, m.cuenta_banco, m.adscrito, m.fecha_registro, m.fecha_actuaizacion, m.e_mail, m.estado, z.desc_zona,e.desc_especialidad,s.desc_sexo,k.desc_estado,u.desc_municipio,desc_localidad,su.desc_sucursal,fk_id_sucursal FROM so_medicos m 
    LEFT OUTER JOIN kg_zonas z ON (z.id_zona = m.fk_id_zona) 
    LEFT OUTER JOIN km_especialidades e ON (e.id_especialidad = m.fk_id_especialidad)
    LEFT OUTER JOIN so_sexo s ON (s.id_sexo = m.fk_id_sexo)
    LEFT OUTER JOIN ku_estados k ON (k.id_estado = m.fk_id_estado)
    LEFT OUTER JOIN ku_municipios u ON (u.id_municipio = m.fk_id_municipio)
    LEFT OUTER JOIN ku_localidades l ON (l.id_localidad = m.fk_id_localidad)
    LEFT OUTER JOIN kg_sucursales su ON (su.id_sucursal = m.fk_id_sucursal)
     WHERE m.estado = 'A'*/
     
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
