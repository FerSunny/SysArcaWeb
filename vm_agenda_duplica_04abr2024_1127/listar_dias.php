<?php
    
    session_start();
	include ("../controladores/conex.php");

    $mesagendanum= $_SESSION['mesagendanum'];
    $anioagenda = $_SESSION['anioagenda'];
    $id_usuario = $_SESSION['id_usuario'];

	$query = "
SELECT us.`iniciales`, 
YEAR(ag.`fecha`) anioagenda,
MONTHNAME(ag.`fecha`) mesagenda,
DAY(ag.`fecha`) diagenda,
DAYNAME(ag.`fecha`) diagendanombre,
COUNT(*) AS medicos
FROM vm_agenda ag,
se_usuarios us
WHERE ag.`estado` = 'A'
AND ag.`fk_id_usuario` = us.`id_usuario`
AND YEAR(ag.`fecha`) = $anioagenda
AND MONTH(ag.`fecha`) = '$mesagendanum'
AND us.`id_usuario` = '$id_usuario'
GROUP BY 1,2,3,4,5
"
;
//echo $query;

	$resultado = mysqli_query($conexion, $query);

    if(!$resultado){
        die("Error-->".$query);

    }else{
        while($data=mysqli_fetch_assoc($resultado)){
            $arreglo["data"][]=$data;
        }
        echo json_encode($arreglo);
    }

    mysqli_free_result($resultado);
    mysqli_close($conexion);