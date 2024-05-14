<?php

	include ("../controladores/conex.php");
    session_start();
    $id_doc= $_SESSION['id_doc'];
 
  $query = "
  SELECT 
  lf.*,
  CASE
  WHEN lf.estatus = 'C' THEN
  'Carga Inicial'
  WHEN lf.estatus = 'D' THEN
  'Descargado'
  END estado,
  us.`iniciales`,
  u.iniciales AS ini_usu_est
  FROM 
  sgc_lista_ficheros lf
  LEFT OUTER JOIN se_usuarios u ON (u.id_usuario = lf.fk_id_usuario_estatus),
  se_usuarios us
  WHERE lf.`estado` = 'A'
  AND lf.fk_id_doc = $id_doc
  AND lf.`fk_id_usuario` = us.`id_usuario`
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
