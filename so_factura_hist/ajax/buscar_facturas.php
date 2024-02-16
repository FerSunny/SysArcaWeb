<?php
session_start();
date_default_timezone_set('America/Mexico_City');
$fk_id_sucursal=$_SESSION['fk_id_sucursal'];
$fk_id_perfil=$_SESSION['fk_id_perfil'];
//$fk_id_sucursal='1';
//$fk_id_perfil='1';

require_once ("../config/db.php");
require_once ("../config/conexion.php");

	if($fk_id_perfil == '1' || $fk_id_perfil == '12' || $fk_id_perfil == '33' || $fk_id_perfil == '45' || $fk_id_perfil == '46')
	{
		$sucursal = " > 0";
	}else
	{
		$sucursal = " = ".$fk_id_sucursal;
	}


	$folio=$_GET['folio'];
	$nombre=$_GET['nombre'];
	/*
	$paterno=$_GET['paterno'];
	$materno=$_GET['materno'];
	*/

//$folio=12;
//$nombre='j';

//echo $folio;

	$and="AND so_factura.fk_id_sucursal ".$sucursal.
	//" AND so_factura.id_factura like '".$folio."%'"." AND so_clientes.nombre like '%".$nombre."%'"." AND so_clientes.a_paterno like '%".$paterno."%'"." AND so_clientes.a_materno like '%".$materno."%'" ;
	" AND so_factura.id_factura like '".$folio."%'"." AND concat(so_clientes.nombre,' ',so_clientes.a_paterno) like '%".$nombre."%'"; //." AND so_clientes.a_paterno like '%".$paterno."%'"." AND so_clientes.a_materno like '%".$materno."%'" ;



	//echo $and;
/*
$and="AND DATE(so_factura.fecha_factura) BETWEEN DATE_SUB(CURDATE(), INTERVAL 3 DAY) AND DATE_ADD(CURDATE(), INTERVAL 3 DAY)
			AND so_factura.fk_id_sucursal".$condicion;
*/
/*
$revisa="SELECT
so_factura.id_factura,
so_factura.numero_factura,
so_factura.fecha_factura,
so_clientes.nombre,
so_clientes.a_paterno,
so_clientes.a_materno,
so_factura.diagnostico,
so_clientes.telefono_fijo,
so_factura.estado_factura,
so_factura.imp_total,
so_clientes.mail,
so_clientes.anios,
kg_sucursales.desc_corta,
CASE
	WHEN MONTH(so_factura.fecha_factura) BETWEEN  month(DATE_SUB(CURDATE(), INTERVAL 3 MONTH)) AND MONTH(CURDATE()) THEN
		'1'
	ELSE
		'0'
END AS se_modifica
FROM so_factura, so_clientes, se_usuarios,kg_sucursales
WHERE so_factura.fk_id_cliente=so_clientes.id_cliente
AND so_factura.fk_id_usuario=se_usuarios.id_usuario
AND so_factura.estado_factura!=5
AND kg_sucursales.id_sucursal = so_factura.fk_id_sucursal
$and"." limit 50";

echo $revisa;
*/

$stmt = $con->prepare("SELECT
			so_factura.id_factura,
			so_factura.numero_factura,
			so_factura.fecha_factura,
			so_clientes.nombre,
			so_clientes.a_paterno,
			so_clientes.a_materno,
			so_factura.diagnostico,
			so_clientes.telefono_fijo,
			so_factura.estado_factura,
			so_factura.imp_total,
			so_clientes.mail,
			so_clientes.anios,
			kg_sucursales.desc_corta,
			CASE
				WHEN MONTH(so_factura.fecha_factura) BETWEEN  month(DATE_SUB(CURDATE(), INTERVAL 3 MONTH)) AND MONTH(CURDATE()) THEN
					'1'
				ELSE
					'0'
			END AS se_modifica
			FROM so_factura, so_clientes, se_usuarios,kg_sucursales
			WHERE so_factura.fk_id_cliente=so_clientes.id_cliente
			AND so_factura.fk_id_usuario=se_usuarios.id_usuario
			AND so_factura.estado_factura!=5
			AND kg_sucursales.id_sucursal = so_factura.fk_id_sucursal
			$and"." limit 10");

//echo 'busca: '.$stmt;

	$stmt->execute();
	$result = $stmt->get_result();
	if($result->num_rows === 0) exit('No hay informacion');

	while($row = $result->fetch_assoc())
    {
			if($row['estado_factura'] == 1){$estado = "<span class='label label-info'>Elaborada</span>";}else
			if($row['estado_factura'] == 2){$estado = "<span class='label label-primary'>Terminada</span>";}else
			if($row['estado_factura'] == 3){$estado = "<span class='label label-success'>Entregada</span>";}else
			if($row['estado_factura'] == 4){$estado = "<span class='label label-warning'>Impresa</span>";}else
			if($row['estado_factura'] == 5){$estado = "<span class='label label-danger'>Eliminada</span>";}
			else {
				$estado =  "No existe";
			}
		 
    	  $data[] = array(
    	  			"0" => $row['desc_corta'],
					"1" => $row['id_factura'],
					"2" => $row['numero_factura'],
					"3" => $row['fecha_factura'],
					"4" => $row['nombre'].' '.$row['a_paterno'].' '.$row['a_materno'],
					"5" => $row['diagnostico'],
					"6" => $row['telefono_fijo'],
					"7" => $estado,
					"8" => $row['imp_total'],
					"9" => "<button type='button' class='btn btn-info btn-sm' onclick=update(".$row['estado_factura'].",". $row['id_factura'].",". $row['se_modifica'].",'".$row['telefono_fijo']."','".$row['anios']."')><span  class='fa fa-pencil fa-1x'></span></button>",

					"10" => "<a href='../so_factura/reports/factura.php?numero_factura=".$row['id_factura']."' target='_blank'>PDF</a>"

				
				);

    }
    	$results = array(
      "sEcho" => 1,
      "iTotalRecords" => count($data),
      "iTotalDisplayRecords" => count($data),
      "aaData" => $data);
	echo json_encode($results);
	
?>
