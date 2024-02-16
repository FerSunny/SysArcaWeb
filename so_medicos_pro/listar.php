<?php



	include ("../controladores/conex.php");



  

 

  $query = "
SELECT m.* ,
    CASE
        WHEN me.`id_medico` IS NULL THEN
            'No'
        ELSE
            'Si'
    END AS localizado
FROM so_medicos_pro m
LEFT OUTER JOIN so_medicos me ON (me.`id_medico` = m.`fk_id_medico`)
WHERE m.`estado` = 'A'
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

