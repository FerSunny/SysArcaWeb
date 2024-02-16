    <?php
    session_start();                                                              

	include ("../controladores/conex.php");

    $id_usuario = $_SESSION['id_usuario'];
    $fk_id_perfil=$_SESSION['fk_id_perfil'];
	
    if($fk_id_perfil == 1 || $fk_id_perfil == 42){
        $condicion = ' > 0';
    }else{
        $condicion = ' = '.$id_usuario;
    }

    $query = "
     SELECT  distinct 
    YEAR(gp.`fecha_registro`) AS anio,
    MONTHNAME(gp.`fecha_registro`) AS mes,
    DAY(gp.`fecha_registro`) AS dia,
    DAYNAME(gp.`fecha_registro`) AS dianame,
      CONCAT(us.`nombre`,' ',us.`a_paterno`,' ',us.`a_materno`) nombre,
     date(gp.fecha_registro) as fecha_registro,
      me.fk_id_usuario
    FROM vw_gps_medico gp,
    so_medicos me,
    se_usuarios us
    WHERE gp.`fk_id_medico` = me.`id_medico`
    AND me.fk_id_usuario = us.id_usuario
    AND me.fk_id_usuario ".$condicion."
    order by 1,2,3,4
";
//echo $query;

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
