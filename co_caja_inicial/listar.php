<?php



	include ("../controladores/conex.php");



  

 

  $query = "
  SELECT 
  re.id_registro,
  su.`desc_corta`,
  us.`iniciales`,
  re.`fecha_mov`,
  re.`importe`,
  CASE
  WHEN re.fecha_mov = CURDATE() THEN
  'A'
  ELSE
  'C'
  END AS cerrada,
  re.fk_id_sucursal,
  re.fk_id_usuario,
  re.fk_id_beneficiario
  FROM ga_registro re
  LEFT OUTER JOIN ga_gasto ga ON (ga.`id_gasto` = re.`fk_id_gasto`)
  LEFT OUTER JOIN kg_sucursales su ON (su.`id_sucursal` = re.`fk_id_sucursal`)
  LEFT OUTER JOIN se_usuarios us ON (us.`id_usuario` = re.`fk_id_usuario`)
  WHERE re.`fk_id_gasto` = 3
  AND re.`fecha_mov` >= CURDATE()-14
  AND re.estado = 'A'
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

