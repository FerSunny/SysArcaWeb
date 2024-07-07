<?php

  session_start();

	include ("../controladores/conex.php");
  /*
  $id_modulo=$_SESSION['id_modulo'];
  $fk_id_perfil=$_SESSION['fk_id_perfil'];
  $fk_id_sucursal=$_SESSION['fk_id_sucursal'];
  */  
  $id_usuario= $_SESSION['id_usuario'];
  $studio= $_SESSION['studio'];
//echo $usuario;
  $query="
    SELECT  
    us.id_plantilla,
    CASE
    WHEN us.fk_id_estudio = 99999 THEN
    es.desc_estudio
    ELSE
    us.nombre_plantilla
    END nombre_plantilla,
    CASE
    WHEN us.fk_id_estudio = 99999 THEN
    es.desc_estudio
    ELSE
    us.titulo_desc
    END AS titulo_desc,
    SUBSTR(us.descripcion,1,40) desc_corta,
    us.descripcion
    FROM cr_plantilla_usg us
    LEFT OUTER JOIN km_estudios es  ON (es.id_estudio = ".$studio.")
    WHERE us.estado = 'A'
    AND us.fk_id_estudio = ".$studio." 
    OR us.fk_id_estudio = 99999
    -- AND us.fk_id_medico = ".$id_usuario;

// echo $query;

//echo '<script> alert("No hay agenda para este dia")</script>';

	$resultado = mysqli_query($conexion, $query);

    if(!$resultado){
        die("Error");
        echo '<script> alert("No hay agenda para este dia")</script>';
       echo "<script>location.href='../ag_orden_dia_usg/tabla_agenda.php'</script>";

    }else{
        while($data=mysqli_fetch_assoc($resultado)){
            $arreglo["data"][]=$data;
        }
        echo json_encode($arreglo);
    }

    mysqli_free_result($resultado);
    mysqli_close($conexion);
