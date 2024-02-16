<?php

	include ("../controladores/conex.php");

	$query = "SELECT
  id_beneficiario,
  clave_arca,
  fk_id_sucursal,
  fk_id_giro,
  nombre,
  telefono_fijo,
  telefono_movil,
  be.direccion,
  be.mail,
  fecha_registro,
  fecha_actualizacion,
  be.estado,
  gi.desc_giro,
  su.desc_sucursal
FROM ga_beneficiarios be,
     ga_giros gi,
     kg_sucursales su
WHERE be.fk_id_giro = gi.id_giro
AND be.`fk_id_sucursal` = su.id_sucursal
AND be.estado = 'A'";


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
