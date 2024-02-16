<?php

	include ("../controladores/conex.php");

  $query = "
  SELECT  s.`desc_sucursal`,
  u.id_usr,
  u.`id_usuario`,
  u.`fk_id_sucursal`,
  CONCAT(u.`nombre`,' ',u.`a_paterno`,' ',u.`a_materno`) AS usuario
FROM se_usuarios u
LEFT OUTER JOIN kg_sucursales s ON (s.`id_sucursal` = u.fk_id_sucursal)
WHERE u.activo = 'A'
AND u.`fk_id_perfil` = 11
";

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

