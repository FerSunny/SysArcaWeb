<?php

	include ("../controladores/conex.php");
    session_start();
    $id_doc= $_SESSION['id_doc'];
    $id_usuario=$_SESSION['id_usuario']; 

    $id_numeral_1=$_SESSION['id_numeral_1']; 
    $id_numeral_2=$_SESSION['id_numeral_2']; 
 
  $query = "
  SELECT ".$id_usuario." as id_usuario,
  lf.*,
  CASE
  WHEN lf.estatus = 'O' THEN
  'Disponible'
  WHEN lf.estatus = 'D' THEN
  'Descargado'
  WHEN lf.estatus = 'A' THEN
  'Obsoleto'
  WHEN lf.estatus = 'E' THEN
  'Version Desactualizada'
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
  AND lf.fk_id_numeral_1 = $id_numeral_1
  AND lf.fk_id_numeral_2 = $id_numeral_2
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
