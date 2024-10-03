<?php
session_start();
	include ("../controladores/conex.php");
    $id_usuario=$_SESSION['id_usuario'];

  
 
  $query = "
    select
    ".$id_usuario." as id_usuario,   
    a.*
     from sgc_indice_uno a
     where a.estado = 'A'
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
