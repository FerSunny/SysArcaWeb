<?php

session_start();

	include ("../controladores/conex.php");

    $id_usuario= $_SESSION['id_usuario'];

    $fk_id_perfil= $_SESSION['fk_id_perfil'];

    
    if($fk_id_perfil == 42 or $fk_id_perfil == 1){
        $usuario = '>= 0';

    }else{
        $usuario = ' = '.$id_usuario;
    }

 

  $query = "
SELECT 
us.`iniciales`, 
MONTHNAME(ag.`fecha`) mesagenda,
MONTH(ag.`fecha`) mesagendanum,
us.id_usuario,
year(ag.fecha) anioagenda,

COUNT(*) AS medicos
FROM vm_agenda ag,
se_usuarios us
WHERE ag.`estado` = 'A'
AND ag.`fk_id_usuario` = us.`id_usuario`
AND ag.fk_id_usuario $usuario
GROUP BY 1,2,3,4,5

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

