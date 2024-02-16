<?php

date_default_timezone_set('America/Mexico_City');
    /* Connect To Database*/
    
	require_once ("../db/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../db/conexion.php");//Contiene funcion que conecta a la base de datos

   // $sql="select id_perfil,iniciales,desc_perfil,costo from km_perfil where estado='A';";
    $sql="SELECT id_estudio AS id_perfil,iniciales,desc_estudio AS desc_perfil,costo FROM km_estudios WHERE estatus ='A' AND per_perfil = 'SI'";
    $resultado = mysqli_query($con, $sql);

    $arreglo["data"] = [];
    if ($resultado){
        while($data=mysqli_fetch_assoc($resultado)){
           
                $arreglo["data"][]=array_map("utf8_encode",$data);
        }
        mysqli_close($con);
        echo json_encode($arreglo);
    }else {
        mysqli_close($con);
        echo json_encode($arreglo);
    }
	
?>
