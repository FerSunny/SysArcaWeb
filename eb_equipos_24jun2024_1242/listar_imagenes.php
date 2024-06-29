<?php
    
    session_start();
	include ("../controladores/conex.php");

    $id_equipo= $_SESSION['id_equipo'];
    //$studio= $_SESSION['studio'];
$a=$id_equipo;
	$query = "
    SELECT 
    ie.*,
    eq.descripcion
    FROM eb_equipos_img ie
    LEFT OUTER JOIN eb_equipos eq ON (eq.id_equipo = '$a')
    WHERE ie.estado = 'A'
    AND ie.fk_id_equipo= '$id_equipo'
  "
  ;
//echo $query;

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