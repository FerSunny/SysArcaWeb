<?php
session_start();
include("../../controladores/conex.php");

date_default_timezone_set('America/Mexico_City');

$id_usr=$_SESSION['nombre_completo'];
$fk_id_sucursal=$_SESSION['fk_id_sucursal_usr'];

$fk_id_empresa ="1";

$fn_pat_disk = $_POST['fn_pat_disk']; 
$fecha_test = $_POST['fn_ftest'];
$fk_id_factura = $_POST['fn_folio'];
$fn_estudio = $_POST['fn_estudio'];

//$fi_factualiza = $_POST['fn_factualiza'];

$fecha_proceso=date("y/m/d h:m:s");

//determina el tipo de busqueda de la factura y el estudio
if($fk_id_factura==0){
	$busca_factura='> 0';
}else{
	$busca_factura='= '.$fk_id_factura;
}

if($fn_estudio==1134){
	$busca_estudio='> 0';
}else{
	$busca_estudio='= '.$fn_estudio;
}


//busca estudio para extraer datos de la quimica clinica
$sql="	SELECT  
			fa.fk_id_empresa,fa.id_factura ,df.fk_id_estudio,p1.orden,p1.tipo,
			p1.concepto,p1.codigo_int2 as codigo_int,p1.valor_refe,p1.unidad_medida,p1.tamfue,
			p1.tipfue,p1.posini,fa.fecha_factura
		FROM so_factura fa, so_detalle_factura df, km_estudios es, cr_plantilla_1 p1,aca_patiente_info pa
		WHERE DATE(pa.pat_testingdate) = '$fecha_test'
		AND fa.id_factura  $busca_factura
		AND df.`fk_id_estudio` $busca_estudio
		AND es.origen = 'I'
		AND fa.estado_factura <> 5
		AND fa.id_factura = df.id_factura
		AND (df.fk_id_estudio = es.id_estudio AND es.estatus = 'A')
		AND es.fk_id_plantilla = 1
		AND df.fk_id_estudio = p1.fk_id_estudio AND p1.estado = 'A' AND p1.tipo = 'P' and p1.codigo_int <> ''
		AND es.per_paquete <> 'Si'
		AND fa.`id_factura` = pa.`pat_barcode`
		AND pa.`pat_rack` = '$fn_pat_disk'

		union

		SELECT 	fa.fk_id_empresa,fa.id_factura,es.id_estudio,p1.orden,p1.tipo,
			p1.concepto,p1.codigo_int2 as codigo_int ,p1.valor_refe,p1.unidad_medida,p1.tamfue,
			p1.tipfue,p1.posini,fa.fecha_factura
		FROM km_paquetes pa, km_estudios es,so_detalle_factura df, so_factura fa, cr_plantilla_1 p1,aca_patiente_info pat
		WHERE pa.`fk_id_estudio` = es.`id_estudio`
		AND df.`fk_id_estudio` = pa.`id_paquete`
		AND df.`id_factura` = fa.`id_factura`
		AND fa.estado_factura <> 5
		AND df.`fk_id_estudio` $busca_estudio
		AND es.origen = 'I'
		AND es.estatus = 'A'
		AND es.fk_id_plantilla = 1
		AND (es.`id_estudio` = p1.`fk_id_estudio` AND p1.`estado` = 'A' AND p1.`tipo` = 'P' AND p1.`concepto` <> '.' and p1.codigo_int <> '')
		AND fa.`id_factura` $busca_factura
		AND DATE(pat.pat_testingdate) = '$fecha_test'
		AND fa.`id_factura` = pat.`pat_barcode`
		AND pat.`pat_rack` = '$fn_pat_disk'
		";

 //echo $sql;
	
$num_estudios=0;
if ($result = mysqli_query($conexion, $sql)) {
  while($row = $result->fetch_assoc())
{ // inicio de while

  	$id_factura=$row['id_factura'];
  	$codigo_int=$row['codigo_int'];

	$fk_id_empresa =	$row['fk_id_empresa'];
	$id_factura =	$row['id_factura'];
	$fk_id_estudio =	$row['fk_id_estudio'];
	$orden =	$row['orden'];
	$tipo =	$row['tipo'];
	$concepto =	$row['concepto'];
	$verificado = '';
	$valor_refe =	$row['valor_refe'];
	$unidad_medida = $row['unidad_medida'];
	$tamfue =	$row['tamfue'];
	$tip_fue =	$row['tipfue'];
	$posini =	$row['posini'];

	$num_estudios=1;
	$existe_resulta = 0;

	// URE *** Formula  ***
		if($row['codigo_int'] == 'URE'){
			$valor_regresa=busca_tester($fecha_test, $id_factura ,'BUN');
			if ($valor_regresa > 0.0) {
				$v_valor = round(($valor_regresa*2.14),1);
			}else{
				$resu = insert_log($fk_id_sucursal, $fk_id_empresa,$id_factura,$busca_estudio,'BUN');
				$v_valor = $valor_regresa;
			}

	// LDL COLESTEROL
		}elseif ($row['codigo_int'] == 'LDL-CAL') {
			$valor_regresa=busca_tester($fecha_test, $id_factura ,'COL');
			if ($valor_regresa > 0.0) {
				$valor_regresa_hdlc=busca_tester($fecha_test, $id_factura ,'HDL-C');
				if($valor_regresa_hdlc > 0.0){
					$valor_regresa_tg=busca_tester($fecha_test, $id_factura ,'TG2');
					if($valor_regresa_tg > 0.0){
						$v_valor = round($valor_regresa-$valor_regresa_hdlc-($valor_regresa_tg/5),1);
					}
					$resu = insert_log($fk_id_sucursal, $fk_id_empresa,$id_factura,$busca_estudio,'TG2');
					$v_valor = $valor_regresa;
				}
				$resu = insert_log($fk_id_sucursal, $fk_id_empresa,$id_factura,$busca_estudio,'HDL-C');
				$v_valor = $valor_regresa_tg;
			}	
			$resu = insert_log($fk_id_sucursal, $fk_id_empresa,$id_factura,$busca_estudio,'COL');
			$v_valor = $valor_regresa_hdlc;
		
	// RIESGO INDICE ETEROGENICO
		}elseif ($row['codigo_int'] == 'I/A') {
			$valor_regresa=busca_tester($fecha_test, $id_factura ,'COL');
			if ($valor_regresa > 0.0) {
				$valor_regresa_hdlc=busca_tester($fecha_test, $id_factura ,'HDL-C');
				if($valor_regresa_hdlc > 0.0){
					$v_valor = round(($valor_regresa/$valor_regresa_hdlc),1);
				}
				$resu = insert_log($fk_id_sucursal, $fk_id_empresa,$id_factura,$busca_estudio,'HDL-C');
				$v_valor = $valor_regresa_tg;
			}	
			$resu = insert_log($fk_id_sucursal, $fk_id_empresa,$id_factura,$busca_estudio,'COL');
			$v_valor = $valor_regresa_hdlc;

	
	// VLDL
		}elseif ($row['codigo_int'] == 'VLDL') {
			$valor_regresa=busca_tester($fecha_test, $id_factura ,'TG2');
			if ($valor_regresa > 0.0) {
				$v_valor = round(($valor_regresa/5),1);
			}else{
				$resu = insert_log($fk_id_sucursal, $fk_id_empresa,$id_factura,$busca_estudio,'TG2');
				$v_valor = $valor_regresa;
			}
	
	// LDLC= COL -(TG÷5)-HDL-C
		}elseif ($row['codigo_int'] == 'LDLC') {
			$valor_regresa=busca_tester($fecha_test, $id_factura ,'COL');
			if ($valor_regresa > 0.0) {
				$valor_COL = $valor_regresa;
				$valor_regresa=busca_tester($fecha_test, $id_factura ,'TG2');
				if ($valor_regresa > 0.0) {
					$valor_TG = $valor_regresa/5;
					$valor_regresa=busca_tester($fecha_test, $id_factura ,'HDL-C');
					if ($valor_regresa > 0.0) {
						$valor_HDLC = $valor_regresa;
						$v_valor=$valor_COL-$valor_TG-$valor_HDLC;
					}else{
						$resu = insert_log($fk_id_sucursal, $fk_id_empresa,$id_factura,$busca_estudio,'HDL-C');
						$v_valor = $valor_regresa;
					}
				}else{
					$resu = insert_log($fk_id_sucursal, $fk_id_empresa,$id_factura,$busca_estudio,'TG2');
					$v_valor = $valor_regresa;
				}
			}else{
				$resu = insert_log($fk_id_sucursal, $fk_id_empresa,$id_factura,$busca_estudio,'COL');
				$v_valor = $valor_regresa;
			}

	// LDL= COL - (HDL-C) - (TG2÷5)
			// coregido 09ene2023 by JPM se corrigio la formula.
		}elseif ($row['codigo_int'] == 'LDL') {
			$valor_regresa=busca_tester($fecha_test, $id_factura ,'COL');
			if ($valor_regresa > 0.0) {
				$valor_COL = $valor_regresa;
				$valor_regresa=busca_tester($fecha_test, $id_factura ,'TG2');
				if ($valor_regresa > 0.0) {
					$valor_TG = $valor_regresa/5;
					$valor_regresa=busca_tester($fecha_test, $id_factura ,'HDL-C');
					if ($valor_regresa > 0.0) {
						$valor_HDLC = $valor_regresa;
						$v_valor=$valor_COL - $valor_HDLC - $valor_TG ;
					}else{
						$resu = insert_log($fk_id_sucursal, $fk_id_empresa,$id_factura,$busca_estudio,'HDL-C');
						$v_valor = $valor_regresa;
					}
				}else{
					$resu = insert_log($fk_id_sucursal, $fk_id_empresa,$id_factura,$busca_estudio,'TG2');
					$v_valor = $valor_regresa;
				}
			}else{
				$resu = insert_log($fk_id_sucursal, $fk_id_empresa,$id_factura,$busca_estudio,'COL');
				$v_valor = $valor_regresa;
			}


	// IA = COL / (HDl-C)
		}elseif ($row['codigo_int'] == 'IA') {
			$valor_regresa=busca_tester($fecha_test, $id_factura ,'COL');
			if ($valor_regresa > 0.0) {
				$v_valor_col = $valor_regresa;
				$valor_regresa=busca_tester($fecha_test, $id_factura ,'HDL-C');
				if ($valor_regresa > 0.0) {
					$v_valor_hdlc = $valor_regresa;
					$v_valor = $v_valor_col/$v_valor_hdlc;
				}else{
					$resu = insert_log($fk_id_sucursal, $fk_id_empresa,$id_factura,$busca_estudio,'HDL-C');
					$v_valor = $valor_regresa;
				}	
			}else{
				$resu = insert_log($fk_id_sucursal, $fk_id_empresa,$id_factura,$busca_estudio,'COL');
				$v_valor = $valor_regresa;
			}


	// BI
		}elseif ($row['codigo_int'] == 'BI') {
			$valor_regresa=busca_tester($fecha_test, $id_factura ,'BT');
			if ($valor_regresa > 0.0) {
				$v_valor_bt = $valor_regresa;
				$valor_regresa=busca_tester($fecha_test, $id_factura ,'BD');
				if ($valor_regresa > 0.0) {
					$v_valor_bd = $valor_regresa;
					$v_valor = round($v_valor_bt-$v_valor_bd,2);
				}else{
					$resu = insert_log($fk_id_sucursal, $fk_id_empresa,$id_factura,$busca_estudio,'BD');
					$v_valor = $valor_regresa;
				}	
			}else{
				$resu = insert_log($fk_id_sucursal, $fk_id_empresa,$id_factura,$busca_estudio,'BT');
				$v_valor = $valor_regresa;
			}


	//GLOB 		
		}elseif ($row['codigo_int'] == 'GLOB') {
			$valor_regresa=busca_tester($fecha_test, $id_factura ,'PT');
			if ($valor_regresa > 0.0) {
				$v_valor_pt = $valor_regresa;
				$valor_regresa=busca_tester($fecha_test, $id_factura ,'ALB');
				if ($valor_regresa > 0.0) {
					$v_valor_ALB = $valor_regresa;
					$v_valor = $v_valor_pt-$v_valor_ALB;
				}else{
					$resu = insert_log($fk_id_sucursal, $fk_id_empresa,$id_factura,$busca_estudio,'ALB');
					$v_valor = $valor_regresa;
				}	
			}else{
				$resu = insert_log($fk_id_sucursal, $fk_id_empresa,$id_factura,$busca_estudio,'PT');
				$v_valor = $valor_regresa;
			}

	//GAP Sodio - CO2 - CLORO ---  NA-CO2-CI
		}elseif ($row['codigo_int'] == 'GAP') {
			$valor_regresa=busca_tester($fecha_test, $id_factura ,'Na');
			if ($valor_regresa > 0.0) {
				$v_valor_Na = $valor_regresa;
	// formula para Co2
				$valor_regresa=busca_tester($fecha_test, $id_factura ,'CO2');
				if ($valor_regresa > 0.0) {
					$v_valor_CO2 = $valor_regresa;
					$valor_regresa=busca_tester($fecha_test, $id_factura ,'Cl');
					if ($valor_regresa > 0.0) {
						$v_valor_Cl = $valor_regresa;
						//$v_valor_globf = $v_valor_pt-$v_valor_ALB;
						$v_valor = round(($v_valor_Na-$v_valor_CO2-$v_valor_Cl),1);
					}else{
						$resu = insert_log($fk_id_sucursal, $fk_id_empresa,$id_factura,$busca_estudio,'ALB');
						$v_valor= $valor_regresa;
					}	
				}else{
					$resu = insert_log($fk_id_sucursal, $fk_id_empresa,$id_factura,$busca_estudio,'PT');
					$v_valor = $valor_regresa;
				}

			}else{
				$resu = insert_log($fk_id_sucursal, $fk_id_empresa,$id_factura,$busca_estudio,'ALB');
				$v_valor = $valor_regresa;
			}			
			
			

	//RELA A/G
		}elseif ($row['codigo_int'] == 'RELA A/G') {
			$valor_regresa=busca_tester($fecha_test, $id_factura ,'ALB');
			if ($valor_regresa > 0.0) {
				$v_valor_ALB1 = $valor_regresa;
	// formula para GLOB
				$valor_regresa=busca_tester($fecha_test, $id_factura ,'PT');
				if ($valor_regresa > 0.0) {
					$v_valor_pt = $valor_regresa;
					$valor_regresa=busca_tester($fecha_test, $id_factura ,'ALB');
					if ($valor_regresa > 0.0) {
						$v_valor_ALB = $valor_regresa;
						$v_valor_globf = $v_valor_pt-$v_valor_ALB;
						$v_valor = round(($v_valor_ALB1/$v_valor_globf),2);
					}else{
						$resu = insert_log($fk_id_sucursal, $fk_id_empresa,$id_factura,$busca_estudio,'ALB');
						$v_valor= $valor_regresa;
					}	
				}else{
					$resu = insert_log($fk_id_sucursal, $fk_id_empresa,$id_factura,$busca_estudio,'PT');
					$v_valor = $valor_regresa;
				}

			}else{
				$resu = insert_log($fk_id_sucursal, $fk_id_empresa,$id_factura,$busca_estudio,'ALB');
				$v_valor = $valor_regresa;
			}


	// VALORES que no son formulas
		}ELSE{	
					$valor_regresa=busca_tester($fecha_test, $id_factura ,$codigo_int);
					if ($valor_regresa ==0) {
						$resu = insert_log($fk_id_sucursal, $fk_id_empresa,$id_factura,$busca_estudio,$codigo_int);
					}
						
					$v_valor = $valor_regresa;
		} 

	// valida que no existe valores ya transferidos
		$fecha_test_1=date("y/m/d h:m:s");
		$q_verifica="SELECT count(*) as cuantos
		FROM cr_plantilla_1_re p1
		WHERE p1.fk_id_factura = $id_factura
		AND p1.fk_id_estudio = $fk_id_estudio
		AND p1.concepto = '$concepto'";
		$r_verifica = mysqli_query($conexion, $q_verifica);
		if($row_veri = mysqli_fetch_array($r_verifica))
			{
			if($row_veri['cuantos'] == 0 ){
//				
				if ($v_valor > 0.0 or $codigo_int == 'LANS') {
					$q_insert="	INSERT INTO cr_plantilla_1_re
								 	    (fk_id_empresa,fk_id_factura,fk_id_estudio, orden, tipo, concepto, valor,
									     verificado, valor_refe, unidad_medida, tamfue, tipfue, posini, observaciones,
									     num_imp,fecha_registro, fecha_impresion, validado, origen)
									VALUES (
										'$fk_id_empresa','$id_factura','$fk_id_estudio','$orden','$tipo','$concepto','$v_valor',
										'$verificado','$valor_refe','$unidad_medida','$tamfue','$tip_fue','$posini',NULL,0, 
										'$fecha_test_1',null,0, 'I')";

					$resultado = mysqli_query($conexion, $q_insert);
					if ($resultado) 
						{
							$estado_proceso = "insert cr_pkantilla_1_re";
						}
						else 
						{
							$estado_proceso='Not insert cr_pkantilla_1_re_i';
						}
					}
//					
			}else{

					$estado_proceso='exist cr_pkantilla_1_re_i';												
				}
			}
  	} 
// fin del while
  	
	if ($num_estudios > 0) {
		$estado_proceso = "Proceso: FecNot=".$fecha_test.' - FecTest='.$fecha_test.' Fol='.$busca_factura.' - Est='.$busca_estudio.' NumMues='.$num_estudios;
	}else{
		$estado_proceso = "No existen notas: FecNot=".$fecha_test.' - FecTest='.$fecha_test.' Fol='.$busca_factura.' - Est='.$busca_estudio.' QRY='.str_replace("'", "-",$sql);   //trim($sql);
	}
	
}else{

	$estado_proceso = "Error al ejecutar consulta para extraer notas (no hubo notas para procesar) ".$sql;
}

// graba en bitacora
$query= "INSERT INTO in_bitacora
            (fk_id_empresa,
             fk_id_sucursal,
             id_interface,
             fk_id_usuario,
             fecha_registro,
             fecha_proceso,
             fk_id_factura,
             fk_id_estudio,
             estado_proceso,
             origen)
VALUES ('$fk_id_empresa',
        '$fk_id_sucursal',
        0,
        '$id_usr',
        '$fecha_test',
        '$fecha_test_1',
        '$fk_id_factura',
        '$fn_estudio',
        '$estado_proceso',
      	'1');";

//echo $query;

$resultado = mysqli_query($conexion, $query);
if ($resultado){
			
		}
		else 
		{
			$estado_proceso = "Error al ejecutar INSERT para guardar bitacora ".$query;
		}

header("location: ../tabla_interface.php");	







// ********  funcion para guaradar el log.  ***********

function insert_log($fk_id_sucursal, $fk_id_empresa ,$id_factura,$busca_estudio,$codigo_int)
{
	include("../../controladores/conex.php");
	date_default_timezone_set('America/Mexico_City');

	$fecha=date("y/m/d h:m:s");
	$q_i="	INSERT INTO in_log
			            (fk_id_empresa,
			             fk_id_sucursal,
			             fk_id_factura,
			             fk_id_estudio,
			             valor_no_loca,
			             query_busca,
			             hora_proceso)
				VALUES ('$fk_id_empresa',
				        '$fk_id_sucursal',
				        '$id_factura',
				        '$busca_estudio',
				        '$codigo_int',
				        '',
				        '$fecha'
				        )
						";
	$res = mysqli_query($conexion, $q_i);
}


// ********  funcion para buscar los valores en DR_TESTER  ***********

function busca_tester($fecha_test, $id_factura , $codigo_int)
{
	include("../../controladores/conex.php");
	date_default_timezone_set('America/Mexico_City');

	$q_busca="SELECT 
	case 
		when te.tes_testname in ('CREA','BT','BD','K') then
			round(te.tes_result,2)
		when te.tes_testname in ('GLU','COL','TG2','HDL-C') then
			FORMAT(ROUND(te.tes_result,0),1)
		else
			cast(te.tes_result as decimal(8,1))
	end  as testresult
	FROM aca_patiente_info pa, aca_test_app_all te
	WHERE DATE(pa.pat_testingdate) = '$fecha_test'
	AND  pa.pat_testingdate = te.tes_date
	AND pa.pat_barcode = $id_factura
	AND pa.pat_barcode = te.pat_barcode 
	AND te.tes_testname = '$codigo_int' ";
//echo $q_busca;
	$r_busca = mysqli_query($conexion, $q_busca);
	if($row_busca = mysqli_fetch_array($r_busca))
	  {
	  	$v_valor = $row_busca['testresult'];
	  }else{
	  	$v_valor=0;
	  }
	return $v_valor;
}

?>
