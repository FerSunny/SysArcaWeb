<?php

	include ("../controladores/conex.php");

  
$query = "SELECT
  id_departamento,
  desc_sucursal,
  desc_departamento,
  descripcion,
  responsable,
  fk_sucursal
FROM eb_departamento dp
LEFT OUTER JOIN kg_sucursales s ON (s.id_sucursal = dp.fk_sucursal)
WHERE dp.estado='A'";


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
