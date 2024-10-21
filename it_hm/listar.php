<?php
    
    session_start();
	include ("../controladores/conex.php");

    $id_usuario= $_SESSION['id_usuario'];

	$query = "
SELECT
  a.*,
  us.`iniciales`,
  CASE
  WHEN a.estatus = 'C' THEN
  'Cargado'
  WHEN a.estatus = 'I' THEN
  'Interfazado' 
  WHEN a.estatus = 'E' THEN
  'Error'
  END AS desc_estatus
FROM `hm_ficheros` a
LEFT OUTER JOIN se_usuarios us ON (us.`id_usuario` = a.`fk_id_usuario`)
WHERE a.`estado` = 'A'
    "
    ;

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