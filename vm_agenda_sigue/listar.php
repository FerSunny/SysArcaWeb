                                                                  <?php

	include ("../controladores/conex.php");

	$query = "
    SELECT  DISTINCT
	ag.fk_id_usuario,
	CONCAT(us.nombre,' ',us.`a_paterno`,' ',us.`a_materno`) AS nombre,
	YEAR(ag.`fecha`) AS anio,
	MONTHNAME(ag.`fecha`) AS mes
 FROM vm_agenda ag, se_usuarios us
WHERE ag.estado = 'A'
AND ag.`fk_id_usuario` = us.`id_usuario`
AND us.`fk_id_perfil` = 12
";
//LEFT OUTER JOIN km_muestras m ON (m.id_muestra = e.fk_id_muestra) where estatus in ('A','S')";
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
