<?php

  session_start();

	include ("../controladores/conex.php");
  /*
  $id_modulo=$_SESSION['id_modulo'];
  $fk_id_perfil=$_SESSION['fk_id_perfil'];
  $fk_id_sucursal=$_SESSION['fk_id_sucursal'];
  */  
  $id_usuario= $_SESSION['id_usuario'];
  $studio= $_SESSION['studio'];
//echo $usuario;
  $query="
    SELECT  us.id_plantilla,
      us.nombre_plantilla,
      us.titulo_desc,
      SUBSTR(us.descripcion,1,40) desc_corta,
      us.descripcion
    FROM cr_plantilla_colpo us
    WHERE us.estado = 'A'
    AND us.fk_id_estudio = ".$studio." 
    AND us.fk_id_medico = ".$id_usuario;

//echo $query;

//echo '<script> alert("No hay agenda para este dia")</script>';

	$resultado = mysqli_query($conexion, $query);

    if(!$resultado){
        die("Error");
        echo '<script> alert("No hay agenda para este dia")</script>';
        echo "<script>location.href='../ag_orden_dia_colpo/tabla_agenda.php'</script>";

    }else{
        while($data=mysqli_fetch_assoc($resultado)){
            $arreglo["data"][]=$data;
        }
        echo json_encode($arreglo);
    }

    mysqli_free_result($resultado);
    mysqli_close($conexion);
