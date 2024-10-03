<?php
session_start();
	include ("../controladores/conex.php");
    $id_usuario=$_SESSION['id_usuario'];
    $id_numeral_1=$_SESSION['id_numeral_1'];

  
 
  $query = 
  "
    select
    ".$id_usuario." as id_usuario,   
    a.*,
    b.`desc_numeral_1`
    FROM 
    sgc_indice_dos a
    LEFT OUTER JOIN sgc_indice_uno b ON (b.`id_numeral_1` = a.`fk_id_numeral_1`)
    WHERE a.estado = 'A'
    AND a.fk_id_numeral_1 = $id_numeral_1
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
