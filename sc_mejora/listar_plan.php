<?php
    session_start();
	include ("../controladores/conex.php");
    $id_mejora=$_SESSION['id_mejora'];

  $query = "
    SELECT 
    a.*,
    CONCAT(u.`nombre`,' ',u.`a_paterno`,' ',u.`a_materno`) AS responsable
    FROM sc_mejora_plan a
    LEFT OUTER JOIN se_usuarios u ON (u.`id_usuario` = a.`fk_id_usuario_res`)
    WHERE a.`estado` = 'A'
    and a.`fk_id_mejora` = $id_mejora
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

