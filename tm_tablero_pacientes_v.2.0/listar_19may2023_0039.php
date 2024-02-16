<?php

session_start();

	include ("../controladores/conex.php");

  $id_modulo=$_SESSION['id_modulo'];
  $fk_id_perfil=$_SESSION['fk_id_perfil'];
  $fk_id_sucursal=$_SESSION['fk_id_sucursal'];

  if ($fk_id_perfil==1 or $fk_id_perfil==13) 
    {
      $condicion=' > 0';
    }
    else
    {
      $condicion=' = '.$fk_id_sucursal;
    }
 // los pacientes que ya se les tomo muestra..
  $query = "
SELECT 
fa. id_factura ,
CONCAT(cl. nombre ,' ',cl. a_paterno ) AS paciente,
TIME_FORMAT(fa. fecha_factura ,'%H:%i') AS hora,
fa. turno_num ,
us. iniciales ,
es. desc_estudio ,
-- es. fk_id_plantilla ,
TIME_FORMAT(t. fecha_toma ,'%H:%i') AS hora_toma,
usm. iniciales  as flebo,
TIMEDIFF(TIME(t. fecha_toma ),TIME(fa. fecha_factura )) AS tiempo2
FROM
so_factura fa,
so_clientes cl,
se_usuarios us,
km_estudios es,
so_detalle_factura df
LEFT OUTER JOIN tm_tomas t ON (t. fk_id_factura  = df. id_factura  AND t.fk_id_estudio = df. fk_id_estudio )
LEFT OUTER JOIN se_usuarios usm ON (usm. id_usr  = t. fk_id_usuario  COLLATE 'utf8_general_ci') 
WHERE fa. estado_factura  <> 5
AND DATE(fa. fecha_factura ) = CURDATE()
AND fa. fk_id_sucursal  = 1
AND fa. fk_id_cliente  = cl. id_cliente 
AND fa. fk_id_usuario  = us. id_usuario 
AND fa. id_factura  = df. id_factura 
AND df. fk_id_estudio  = es. id_estudio 
AND es. fk_id_plantilla  = 1

";

//echo $query;
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
