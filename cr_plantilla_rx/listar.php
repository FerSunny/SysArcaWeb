<?php
  session_start();
	include ("../controladores/conex.php");
  $perfil = $_SESSION['fk_id_perfil'];
  $usuarios = $_SESSION['id_usuario'];
  $fk_id_sucursal = $_SESSION['fk_id_sucursal'];
  header("Content-Type: text/html;charset=utf-8");

  if( $perfil == 1 or $perfil == 11 or $perfil == 45 or $perfil == 46 or $perfil == 33)
  {
    $condicion = " fk_id_medico > 0";
  }else
  {

    if($perfil == 38){
      $condicion = "p1.fk_id_sucursal = ".$fk_id_sucursal;
    }
    else{
      $condicion = "fk_id_medico = ".$usuarios;
    }
    
  }

  $query = "SELECT
  $perfil perfil,
  p1.fk_id_empresa,
  p1.fk_id_medico,
  p1.id_plantilla,
  p1.nombre_plantilla,
  p1.fk_id_estudio,
  p1.titulo_desc,
  p1.descripcion,
  concat(substr(p1.descripcion,1,75),'... ') as desc_corta,
  p1.estado,
  p1.firma,
  es.desc_estudio,
  CONCAT(us.nombre,' ',us.a_paterno,' ',us.a_materno) AS nom_usuario
FROM cr_plantilla_rx p1
LEFT OUTER JOIN km_estudios es ON (es.id_estudio = p1.fk_id_estudio)
LEFT OUTER JOIN se_usuarios us ON (us.id_usuario = p1.fk_id_medico)

WHERE p1.estado = 'A' AND $condicion

ORDER BY us.nombre,us.a_paterno,us.a_materno,p1.fk_id_estudio,p1.nombre_plantilla";

//echo $query;

	$resultado = mysqli_query($conexion, $query);

    if(!$resultado){
        die("Error =>".$query);

    }else{
        while($data=mysqli_fetch_assoc($resultado)){
            $arreglo["data"][]=$data;
        }
        echo json_encode($arreglo);
    }

    mysqli_free_result($resultado);
    mysqli_close($conexion);
