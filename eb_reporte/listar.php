<?php

	include ("../controladores/conex.php");

    session_start();
    $sucursal =$_SESSION['fk_id_sucursal'];
    $perfil =$_SESSION['fk_id_perfil'];

    if($perfil == 1){
        $suc = '> 0';
    }else{
        $suc = ' = '.$sucursal;
    }
 
  $query = 
  "
    SELECT 
      re.fk_id_empresa,
      re.id_reporte,
      re.desc_reporte,
      re.fk_id_sucursal,
      re.fk_id_usuario,
      re.fk_id_equipo,
      re.desc_equipo,
      date(re.fecha_reporte) as fecha_reporte,
      re.prioridad,
      re.fecha_atencion,
      re.fecha_termino,
      re.estatus,
      re.estado,
    su.`desc_corta`,
    eq.`descripcion`
    FROM eb_reportes re
    LEFT OUTER JOIN kg_sucursales su ON (su.`id_sucursal` = re.`fk_id_sucursal`)
    LEFT OUTER JOIN eb_equipos eq ON (eq.`id_equipo` = re.fk_id_equipo)
    WHERE re.estado = 'A'
    AND re.fk_id_sucursal $suc
";

	$resultado = mysqli_query($conexion, $query);

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
