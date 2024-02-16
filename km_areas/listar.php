<?php



	include ("../controladores/conex.php");



  

 

  $query = "SELECT a.*,
    s.`desc_servicio`
FROM km_areas a
LEFT OUTER JOIN km_servicios s ON (s.`id_servicio` = a.`fk_id_servicio`)
WHERE a.`estado` = 'A'
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

