<?php
date_default_timezone_set('America/Mexico_City');

  include ("../controladores/conex.php");
  session_start();
   $fk_id_perfil=$_SESSION['fk_id_perfil'];
   $fk_id_sucursal=$_SESSION['fk_id_sucursal'];

    $fecha_hoy = date('Y-m-d');
    $nuevafecha = strtotime ( '-30 day' , strtotime ( $fecha_hoy  ) ) ;
    $fecha_anterior = date ( 'Y-m-d' , $nuevafecha );
  if ($fk_id_perfil==1) 
    {
      $condicion=' > 0';
      
    }
    else
    {
      $condicion=' = '.$fk_id_sucursal;
    }
  
 
  $query = "SELECT
ds.id_detalle,
'Tulyehualco' empresa,
suc.desc_sucursal,
CONCAT(us.nombre,' ',us.a_paterno,' ',us.a_materno) usuario,
ds.importe_total,
ds.fecha_registro
FROM eb_detalle_solicitud ds
LEFT OUTER JOIN kg_sucursales suc ON (suc.id_sucursal = ds.fk_id_sucursal)
LEFT OUTER JOIN se_usuarios us ON (us.id_usuario = ds.fk_id_usuario)";
  //AND fa.fk_id_sucursal".$condicion

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
