<?php



	include ("../controladores/conex.php");



  

 

  $query = "SELECT me.* FROM km_metodos me
    WHERE   me.estado='A'";





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

