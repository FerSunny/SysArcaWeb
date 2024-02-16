<?php



	include ("../controladores/conex.php");



  

 

  $query = "
  SELECT pu.*,
ni.`desc_nivel`
FROM no_puestos pu
LEFT OUTER JOIN no_niveles ni ON (ni.`id_nivel` = pu.`fk_id_nivel`)
WHERE pu.`estado` = 'A'
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

