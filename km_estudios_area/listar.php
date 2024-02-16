<?php

include ("../controladores/conex.php");
session_start();
$sucursal =$_SESSION['fk_id_sucursal'];
$perfil =$_SESSION['fk_id_perfil'];

if($perfil == 1){
    $suc = '> 0';
}else{
    $suc = ' = '.$sucursal;
}
  
$query = "
SELECT
es.`id_estudio`,
es.`desc_estudio`,
es.`fk_id_estudio_ori`,
CASE
WHEN es.fk_id_estudio_ori IS NULL THEN
0
ELSE
1
END AS origen,
(SELECT COUNT(*) FROM km_estudios_area WHERE fk_id_estudio = es.id_estudio) areas
FROM km_estudios es
WHERE es.estatus = 'A'
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
