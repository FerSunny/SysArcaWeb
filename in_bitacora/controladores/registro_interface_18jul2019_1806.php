<?php
session_start();
include("../../controladores/conex.php");

date_default_timezone_set('America/Mexico_City');

$id_usr=$_SESSION['nombre_completo'];
$fk_id_sucursal=$_SESSION['fk_id_sucursal_usr'];

$fk_id_empresa ="1";

$fecha_nota = $_POST['fn_fregistro']; 
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
			fa.fk_id_empresa,
			fa.id_factura ,
			df.fk_id_estudio,
			p1.orden,
			p1.tipo,
			p1.concepto,
			p1.codigo_int,
			p1.valor_refe,
			p1.unidad_medida,
			p1.tamfue,
			p1.tipfue,
			p1.posini,
			fa.fecha_factura
		FROM so_factura fa, so_detalle_factura df, km_estudios es, cr_plantilla_1 p1
		WHERE DATE(fecha_factura) = '$fecha_nota'
		AND fa.id_factura  $busca_factura
		AND df.`fk_id_estudio` $busca_estudio
		AND es.origen = 'I'
		AND fa.estado_factura <> 5
		AND fa.id_factura = df.id_factura
		AND (df.fk_id_estudio = es.id_estudio AND es.estatus = 'A')
		AND es.fk_id_plantilla = 1
		AND df.fk_id_estudio = p1.fk_id_estudio AND p1.estado = 'A' AND p1.tipo = 'P'
		AND es.per_paquete <> 'Si'
		union
		SELECT 	fa.fk_id_empresa,
			fa.id_factura,
			es.id_estudio,
			p1.orden,
			p1.tipo,
			p1.concepto,
			p1.codigo_int,
			p1.valor_refe,
			p1.unidad_medida,
			p1.tamfue,
			p1.tipfue,
			p1.posini,
			fa.fecha_factura
		FROM km_paquetes pa, km_estudios es,so_detalle_factura df, so_factura fa, cr_plantilla_1 p1
		WHERE pa.`fk_id_estudio` = es.`id_estudio`
		AND df.`fk_id_estudio` = pa.`id_paquete`
		AND df.`id_factura` = fa.`id_factura`
		AND fa.estado_factura <> 5
		AND df.`fk_id_estudio` $busca_estudio
		AND es.origen = 'I'
		AND es.estatus = 'A'
		AND es.fk_id_plantilla = 1
		AND (es.`id_estudio` = p1.`fk_id_estudio` AND p1.`estado` = 'A' AND p1.`tipo` = 'P' AND p1.`concepto` <> '.')
		AND fa.`id_factura` $busca_factura
		AND DATE(fecha_factura) = '$fecha_nota'
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

// UREA *** Formula  ***
	if($row['codigo_int'] == 'URE'){
				$q_urea="SELECT cast(te.testresult as decimal(8,1)) as testresult
				FROM dr_patient pa, dr_test_app te
				WHERE DATE(pa.Pat_Testing_Date) = '$fecha_test'
				AND  pa.Pat_Testing_Date = te.TestDate
				AND pa.pat_caseno = $id_factura
				AND pa.pat_disk = te.disk 
				AND  pa.Pat_Position = te.Position 
				AND pa.pat_testno = te.testno
				AND te.testname = 'BUN'";

				$r_urea = mysqli_query($conexion, $q_urea);
				if($row_urea = mysqli_fetch_array($r_urea))
				  {
				  	$existe_resulta = 1;
				  	$v_valor = $row_urea['testresult']*2.14;
				  }else{
				  	$v_valor='0';
				  	$seek_tester='No localizo: '.'BUN';

				  	$q=str_replace("'", "-",$q_urea);
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
							        '$seek_tester',
							        '$q',
							        '$fecha'
							        )
						";
					$res = mysqli_query($conexion, $q_i);
				  }
				
// VLDL
	}elseif ($row['codigo_int'] == 'VLDL') {
				$q_urea=" SELECT cast(te.testresult as decimal(8,1)) as testresult
				FROM dr_patient pa, dr_test_app te
				WHERE DATE(pa.Pat_Testing_Date) = '$fecha_test'
				AND  pa.Pat_Testing_Date = te.TestDate
				AND pa.pat_caseno = $id_factura
				AND pa.pat_disk = te.disk 
				AND  pa.Pat_Position = te.Position 
				AND pa.pat_testno = te.testno
				AND te.testname = 'TG'";

				$r_urea = mysqli_query($conexion, $q_urea);
				if($row_urea = mysqli_fetch_array($r_urea))
				  {
				  	$existe_resulta = 1;
				  	$v_valor = $row_urea['testresult']/5;
				  }else{
				  	$v_valor='0';
				  	$seek_tester='No localizo: '.'TG';

				  	$q=str_replace("'", "-",$q_urea);
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
							        '$seek_tester',
							        '$q',
							        '$fecha'
							        )
						";
					$res = mysqli_query($conexion, $q_i);
				  }

// IA *** Formula ***
	}elseif ($row['codigo_int'] == 'IA') {
				$q_urea="SELECT cast(te.testresult as decimal(8,1)) as testresult
				FROM dr_patient pa, dr_test_app te
				WHERE DATE(pa.Pat_Testing_Date) = '$fecha_test'
				AND  pa.Pat_Testing_Date = te.TestDate
				AND pa.pat_caseno = $id_factura
				AND pa.pat_disk = te.disk 
				AND  pa.Pat_Position = te.Position 
				AND pa.pat_testno = te.testno
				AND te.testname = 'COL'";

				$r_urea = mysqli_query($conexion, $q_urea);
				if($row_urea = mysqli_fetch_array($r_urea))
				  {
				  	$existe_resulta = 1;
				  	$v_valor_col = $row_urea['testresult'];
				  }else{
				  	$v_valor_col='0';
				  	$seek_tester='No localizo: '.'COL';

				  	$q=str_replace("'", "-",$q_urea);
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
							        '$seek_tester',
							        '$q',
							        '$fecha'
							        )
						";
					$res = mysqli_query($conexion, $q_i);
				  }

				$q_urea="SELECT cast(te.testresult as decimal(8,1)) as testresult
				FROM dr_patient pa, dr_test_app te
				WHERE DATE(pa.Pat_Testing_Date) = '$fecha_test'
				AND  pa.Pat_Testing_Date = te.TestDate
				AND pa.pat_caseno = $id_factura
				AND pa.pat_disk = te.disk 
				AND  pa.Pat_Position = te.Position 
				AND pa.pat_testno = te.testno
				AND te.testname = 'HDLC'";

				$r_urea = mysqli_query($conexion, $q_urea);
				if($row_urea = mysqli_fetch_array($r_urea))
				  {
				  	$existe_resulta = 1;
				  	$v_valor = $v_valor_col/$row_urea['testresult'];
				  }else{
				  	$v_valor='0';
				  	$seek_tester='No localizo: '.'HDLC';

				  	$q=str_replace("'", "-",$q_urea);
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
							        '$seek_tester',
							        '$q',
							        '$fecha'
							        )
						";
					$res = mysqli_query($conexion, $q_i);

				  }

// BI  *** Formula ***
	}elseif ($row['codigo_int'] == 'BI') {
				$q_urea="SELECT cast(te.testresult as decimal(8,1)) as testresult
				FROM dr_patient pa, dr_test_app te
				WHERE DATE(pa.Pat_Testing_Date) = '$fecha_test'
				AND  pa.Pat_Testing_Date = te.TestDate
				AND pa.pat_caseno = $id_factura
				AND pa.pat_disk = te.disk 
				AND  pa.Pat_Position = te.Position 
				AND pa.pat_testno = te.testno
				AND te.testname = 'BT'";

				$r_urea = mysqli_query($conexion, $q_urea);
				if($row_urea = mysqli_fetch_array($r_urea))
				  {
				  	$existe_resulta = 1;
				  	$v_valor_bt = $row_urea['testresult'];
				  }else{
				  	$v_valor_bt='0';
				  	$seek_tester='No localizo: '.'BT';

				  	$q=str_replace("'", "-",$q_urea);
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
							        '$seek_tester',
							        '$q',
							        '$fecha'
							        )
						";
					$res = mysqli_query($conexion, $q_i);
				  }

				$q_urea="SELECT cast(te.testresult as decimal(8,1)) as testresult
				FROM dr_patient pa, dr_test_app te
				WHERE DATE(pa.Pat_Testing_Date) = '$fecha_test'
				AND  pa.Pat_Testing_Date = te.TestDate
				AND pa.pat_caseno = $id_factura
				AND pa.pat_disk = te.disk 
				AND  pa.Pat_Position = te.Position 
				AND pa.pat_testno = te.testno
				AND te.testname = 'BD'";

				$r_urea = mysqli_query($conexion, $q_urea);
				if($row_urea = mysqli_fetch_array($r_urea))
				  {
				  	$existe_resulta = 1;
				  	$v_valor = $v_valor_bt-$row_urea['testresult'];
				  }else{
				  	$v_valor='0';
				  	$seek_tester='No localizo: '.'BD';

				  	$q=str_replace("'", "-",$q_urea);
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
							        '$seek_tester',
							        '$q',
							        '$fecha'
							        )
						";
						//echo $q_i;
					$res = mysqli_query($conexion, $q_i);
				  }

//GLOB  *** Formula ***
	}elseif ($row['codigo_int'] == 'GLOB') {
				$q_urea="SELECT cast(te.testresult as decimal(8,1)) as testresult
				FROM dr_patient pa, dr_test_app te
				WHERE DATE(pa.Pat_Testing_Date) = '$fecha_test'
				AND  pa.Pat_Testing_Date = te.TestDate
				AND pa.pat_caseno = $id_factura
				AND pa.pat_disk = te.disk 
				AND  pa.Pat_Position = te.Position 
				AND pa.pat_testno = te.testno
				AND te.testname = 'PT'";

				$r_urea = mysqli_query($conexion, $q_urea);
				if($row_urea = mysqli_fetch_array($r_urea))
				  {
				  	$existe_resulta = 1;
				  	$v_valor_pt = $row_urea['testresult'];
				  }else{
				  	$v_valor_pt='0';
				  	$seek_tester='No localizo: '.'PT';

				  	$q=str_replace("'", "-",$q_urea);
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
							        '$seek_tester',
							        '$q',
							        '$fecha'
							        )
						";
					$res = mysqli_query($conexion, $q_i);


				  }

				$q_urea="SELECT cast(te.testresult as decimal(8,1)) as testresult
				FROM dr_patient pa, dr_test_app te
				WHERE DATE(pa.Pat_Testing_Date) = '$fecha_test'
				AND  pa.Pat_Testing_Date = te.TestDate
				AND pa.pat_caseno = $id_factura
				AND pa.pat_disk = te.disk 
				AND  pa.Pat_Position = te.Position 
				AND pa.pat_testno = te.testno
				AND te.testname = 'ALB'";

				$r_urea = mysqli_query($conexion, $q_urea);
				if($row_urea = mysqli_fetch_array($r_urea))
				  {
				  	$existe_resulta = 1;
				  	$v_valor = $v_valor_pt-$row_urea['testresult'];
				  	$glob=$v_valor;
				  }else{
				  	$v_valor='0';
				  	$seek_tester='No localizo: '.'ALB';

				  	$q=str_replace("'", "-",$q_urea);
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
							        '$seek_tester',
							        '$q',
							        '$fecha'
							        )
						";
					$res = mysqli_query($conexion, $q_i);

				  }

// RELA A/G 
	}elseif ($row['codigo_int'] == 'RELA A/G') {
				$q_urea="SELECT cast(te.testresult as decimal(8,1)) as testresult
				FROM dr_patient pa, dr_test_app te
				WHERE DATE(pa.Pat_Testing_Date) = '$fecha_test'
				AND  pa.Pat_Testing_Date = te.TestDate
				AND pa.pat_caseno = $id_factura
				AND pa.pat_disk = te.disk 
				AND  pa.Pat_Position = te.Position 
				AND pa.pat_testno = te.testno
				AND te.testname = 'ALB'";

				$r_urea = mysqli_query($conexion, $q_urea);
				if($row_urea = mysqli_fetch_array($r_urea))
				  {
				  	$existe_resulta = 1;
				  	$v_valor_alb = $row_urea['testresult'];
				  }else{
				  	$v_valor_alb='0';
				  	$seek_tester='No localizo: '.'ALB';

				  	$q=str_replace("'", "-",$q_urea);
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
							        '$seek_tester',
							        '$q',
							        '$fecha'
							        )
						";
					$res = mysqli_query($conexion, $q_i);

				  }

				$q_urea="SELECT cast(te.testresult as decimal(8,1)) as testresult
				FROM dr_patient pa, dr_test_app te
				WHERE DATE(pa.Pat_Testing_Date) = '$fecha_test'
				AND  pa.Pat_Testing_Date = te.TestDate
				AND pa.pat_caseno = $id_factura
				AND pa.pat_disk = te.disk 
				AND  pa.Pat_Position = te.Position 
				AND pa.pat_testno = te.testno
				AND te.testname = 'GLOB'";

				$r_urea = mysqli_query($conexion, $q_urea);
				if($row_urea = mysqli_fetch_array($r_urea))
				  {
				  	$existe_resulta = 1;
				  	$v_valor = $v_valor_alb/$row_urea['testresult'];
				  }else{
				  	$v_valor='0';
				  	$seek_tester='No localizo: '.'GLOB';

				  	$q=str_replace("'", "-",$q_urea);
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
							        '$seek_tester',
							        '$q',
							        '$fecha'
							        )
						";
					$res = mysqli_query($conexion, $q_i);

				  }

	}ELSE{
			$q_tester="SELECT cast(te.testresult as decimal(8,1)) as testresult FROM dr_patient pa, dr_test_app te
			WHERE DATE(pa.Pat_Testing_Date) = '$fecha_test'
			AND pa.pat_caseno = $id_factura
			AND  pa.Pat_Testing_Date = te.TestDate
			AND pa.pat_testno = te.testno
			
			AND pa.pat_disk = te.disk 
			AND  pa.Pat_Position = te.Position 
			
			AND te.testname = '$codigo_int'";

//echo $q_tester;
			$r_tester = mysqli_query($conexion, $q_tester);
			if($row_tester = mysqli_fetch_array($r_tester))
			  {
			  	$existe_resulta = 1;
			  	$v_valor = $row_tester['testresult'];
			  }else{
			  	$v_valor='0';
			  	$seek_tester='No localizo: '.trim($codigo_int);

			  	$q=str_replace("'", "-",$q_tester);
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
						        '$seek_tester',
						        '$q',
						        '$fecha'
						        )
					";
				$res = mysqli_query($conexion, $q_i);

			  }
	}

	$fecha_test_1=date("y/m/d H:i:s");
// valida que no existe valores ya transferidos

				$q_verifica="SELECT count(*) as cuantos
				FROM cr_plantilla_1_re p1
				WHERE -- DATE(p1.`fecha_test`) = '$fecha_test_1'
				  p1.fk_id_factura = $id_factura
				AND p1.fk_id_estudio = $fk_id_estudio
				AND p1.concepto = '$concepto'";
//echo $q_verifica;
				$r_verifica = mysqli_query($conexion, $q_verifica);
				if($row_veri = mysqli_fetch_array($r_verifica))
				  {
				  	//if($row_veri['cuantos'] == 0 && $existe_resulta == 1){
				  	if($row_veri['cuantos'] == 0 ){
						$q_insert="	INSERT INTO cr_plantilla_1_re
							    (fk_id_empresa,
							     fk_id_factura,
							     fk_id_estudio,
							     orden,
							     tipo,
							     concepto,
							     valor,
							     verificado,
							     valor_refe,
							     unidad_medida,
							     tamfue,
							     tipfue,
							     posini,
							     observaciones,
							     num_imp,
							     fecha_registro,
							     fecha_impresion,
							     validado,
							     origen)
							VALUES (
								'$fk_id_empresa',
								'$id_factura',
								'$fk_id_estudio',
								'$orden',
								'$tipo',
								'$concepto',
								'$v_valor',
								'$verificado',
								'$valor_refe',
								'$unidad_medida',
								'$tamfue',
								'$tip_fue',
								'$posini',
								NULL,
								0, 
								'$fecha_test_1',
								null, 
								0, 
								'I')";
//echo $q_insert;
								$resultado = mysqli_query($conexion, $q_insert);
								if ($resultado) 
									{
										$estado_proceso = "Informacion ok: ".$fecha_test.'-'.$busca_factura.'-'.$busca_estudio;
									}
									else 
									{
									  	$v_valor='0';
									  	$seek_tester='Not insert cr_pkantilla_1_re_i';

									  	$q=$concepto;
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
												        '$fk_id_estudio',
												        '$seek_tester',
												        '$q',
												        '$fecha'
												        )
											";
										$res = mysqli_query($conexion, $q_i);
									}
					}else{

						$seek_tester='Informacion existente';

						$q=str_replace("'", "-",$q_verifica);
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
										'$fk_id_estudio',
										'$seek_tester',
										'$q',
										'$fecha'
										)
							";
						$res = mysqli_query($conexion, $q_i);												
					}
				}	
  } // fin del while
  
	if ($num_estudios > 0) {
		$estado_proceso = "Proceso: FecNot=".$fecha_nota.' - FecTest='.$fecha_test.' Fol='.$busca_factura.' - Est='.$busca_estudio.' NumMues='.$num_estudios;
	}else{
		$estado_proceso = "No existen notas: FecNot=".$fecha_nota.' - FecTest='.$fecha_test.' Fol='.$busca_factura.' - Est='.$busca_estudio.' QRY='.str_replace("'", "-",$sql);   //trim($sql);
	}
	
}else{

	$estado_proceso = "Error al ejecutar consulta para extraer notas ".$sql;
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
             estado_proceso)
VALUES ('$fk_id_empresa',
        '$fk_id_sucursal',
        0,
        '$id_usr',
        '$fecha_nota',
        '$fecha_test',
        '$fk_id_factura',
        '$fn_estudio',
        '$estado_proceso');";

//echo $query;

$resultado = mysqli_query($conexion, $query);
if ($resultado){
			
		}
		else 
		{
			$estado_proceso = "Error al ejecutar INSERT para guardar bitacora ".$query;
		}

header("location: ../tabla_interface.php");	

/*
if (mysqli_close($conexion))
	{
		echo "desconexion realizada. <br />";
	}
	else 
	{
		echo "error en la desconexión";
  		die('Error de Conexión: ' . mysqli_connect_errno());

	}
*/
?>
