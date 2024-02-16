<?php

  session_start();

	include ("../controladores/conex.php");
  date_default_timezone_set('America/Mexico_City');

  $fk_id_perfil=$_SESSION['fk_id_perfil'];
  

  
  
  if ($fk_id_perfil==1 or $fk_id_perfil==45 or $fk_id_perfil==42){
	$id_usuario = '> 0';
  }else
  {
	$id_usuario= ' = '.$_SESSION['id_usuario'];
  }
  



	$query = "
SELECT z.`id_zona`,
    z.`desc_zona`,
    us.`iniciales`,
    us.`id_usuario`,
    COUNT(me.`id_medico`) medicos
FROM kg_zonas z
LEFT OUTER JOIN so_medicos me ON (me.`fk_id_zona` = z.`id_zona` AND me.`estado` = 'A')
LEFT OUTER JOIN se_usuarios us ON (us.`id_usuario` = z.`fk_id_usuario`)
WHERE z.`estado` = 'A'
AND z.`fk_id_usuario` $id_usuario
GROUP BY 1,2,3,4
  ";

//echo $query;

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
