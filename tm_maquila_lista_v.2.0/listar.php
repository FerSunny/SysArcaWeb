<?php
  session_start();
  include ("../controladores/conex.php");


  $fk_id_perfil=$_SESSION['fk_id_perfil'];
  $fk_id_sucursal=$_SESSION['fk_id_sucursal'];

  $id_usuario=$_SESSION['id_usuario'];
  
    if ($fk_id_perfil==1 or $fk_id_perfil==13 or $fk_id_perfil==45 or $fk_id_perfil==46) 
    {
      $condicion=' > 0';
    }
    else
    {
      //if($fk_id_perfil==9){
      //  $condicion=" IN (SELECT ru.fk_id_sucursal FROM cr_plantilla_ruta ru WHERE fk_id_medico = ".$id_usuario.")";
      //}else{
        $condicion=' = '.$fk_id_sucursal; 
     // }
    }
 
  $query = "
SELECT 
a.`fk_id_sucursal`,
su.`desc_corta`,
a.`lote`,
COUNT(*) muestras
 FROM `tm_tomas` a
 LEFT OUTER JOIN kg_sucursales su ON (su.`id_sucursal` = a.`fk_id_sucursal`)
WHERE DATE(a.`fecha_toma`) = curdate()
AND a.`lote` IS NOT NULL
AND a.`aplico` = 'S'
and a.fk_id_sucursal $condicion
group by 1,2,3
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
