<?php

	include ("../controladores/conex.php");
    session_start();

    $sucursal =$_SESSION['fk_id_sucursal'];
  
 
  $query = "SELECT id_uso, clave_uso, desc_uso, estado FROM kg_usos WHERE estado='A' ";



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
