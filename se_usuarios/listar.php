<?php

	include ("../controladores/conex.php");

	$query = "SELECT
  id_usuario,
  id_usr,
  fk_id_sucursal,
  pass,
  activo,
  fk_id_perfil,
  se.desc_servicio,
  nombre,
  a_paterno,
  a_materno,
  u.iniciales,
  telefono_fijo,
  telefono_movil,
  direccion,
  u.mail,
  u.entra,
  u.salida,
  u.entra_s,
  u.salida_s,
  u.entra_d,
  u.salida_d,
  u.entra_f,
  u.salida_f,
  s.desc_sucursal,
  p.desc_perfil,
  u.fecha_registro,
  u.fecha_actualizacion, u.`usr_conex`
FROM se_usuarios u
LEFT OUTER JOIN kg_sucursales s ON (s.id_sucursal = u.fk_id_sucursal)
LEFT OUTER JOIN se_perfiles p ON (p.id_perfil = u.fk_id_perfil)
LEFT OUTER JOIN km_servicios se ON (se.id_servicio = u.fk_id_servicio)";


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
