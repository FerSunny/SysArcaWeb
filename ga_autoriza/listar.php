  <?php

session_start();
	include ("../controladores/conex.php");

  $id_modulo=$_SESSION['id_modulo'];
  $fk_id_perfil=$_SESSION['fk_id_perfil'];
  $fk_id_sucursal=$_SESSION['fk_id_sucursal'];

	$query = "
  SELECT re.id_registro,  
  su.desc_sucursal,
  re.fecha_mov,
  tg.desc_tipo_gasto,
  cl.desc_clasifica,
  ga.desc_gasto,
  be.nombre,
  re.nota,
  re.importe
FROM ga_registro re,
  kg_sucursales su,
  ga_gasto ga,
  ga_beneficiarios be,
  ga_clasifica cl,
  ga_tipo_gasto tg
WHERE re.fk_id_sucursal=su.id_sucursal 
AND re.fk_id_gasto=ga.id_gasto
AND re.fk_id_beneficiario= be.id_beneficiario
AND ga.fk_id_clasifica = cl.id_clasifica
AND ga.fk_id_tipo_gasto = tg.id_tipo_gasto
AND re.estado = 'E'
AND DATE(re.fecha_mov)= DATE(NOW())";

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
