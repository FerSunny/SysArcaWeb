<?php



	include ("../controladores/conex.php");



  

 

  $query = "SELECT 
  pr.`id_pregunta`,
  pr.`pregunta` 
  FROM en_preguntas pr
  WHERE pr.`fk_id_grupo` = 2
  AND pr.`estado` = 'A'";





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

