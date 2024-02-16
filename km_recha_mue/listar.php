<?php



	include ("../controladores/conex.php");



  

 

  $query = "SELECT r.*,
    a.`desc_area`
FROM kg_rechazos r
LEFT OUTER JOIN km_areas a ON (a.`id_area` = r.`fk_id_area`)
WHERE r.estado = 'A'";





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

