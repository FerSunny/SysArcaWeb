<?php

	include ("../controladores/conex.php");

	$query = "SELECT  fk_empresa,
                      id_promocion,
                      desc_promocion,
                      porcentaje,
                      fecha_inicio,
                      fecha_final,
                      lunes,
                      martes,
                      miercoles,
                      jueves,
                      viernes,
                      sabado,
                      domingo,
                      tuly,
                      tuly2,
                      greg ,
                      xochi ,
                      sant,
                      pablo ,
                      pedro ,
                      teco ,
                      tete ,
					  tla,
					  mil,
                      pr.estado
   from kg_promociones pr
   where pr.estado in ('A')";
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
