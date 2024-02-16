<?php
session_start();
date_default_timezone_set('America/Mexico_City');
$fk_id_sucursal=$_SESSION['fk_id_sucursal'];
$fk_id_perfil=$_SESSION['fk_id_perfil'];

require_once ("../config/db.php");
require_once ("../config/conexion.php");

	if($fk_id_perfil == '1')
	{
		$condicion = " > 0";
	}else
	{
		$condicion = " = ".$fk_id_sucursal;
	}


	$folio=$_GET['folio'];
	$busqueda=$_GET['busqueda'];
//echo $folio;
    if (is_numeric($folio))
      {
         $esnumero="si";
         //echo $nombre_usuario . " no es válido<br>";
         
      }else
      {
      	$esnumero="no";
      }



	if($busqueda == 'si')
	{
		if($esnumero=='si')
		{
			$and="AND so_factura.fk_id_sucursal$condicion AND so_factura.id_factura = ".$folio;
		}else
		{
			$and="AND so_factura.fk_id_sucursal> 0 AND CONCAT(so_clientes.nombre,' ',so_clientes.a_paterno,' ',so_clientes.a_materno) = '".$folio."'";
			
		}
	}else{
		$and="AND DATE(so_factura.fecha_factura) BETWEEN DATE_SUB(CURDATE(), INTERVAL 2 DAY) AND DATE_ADD(CURDATE(), INTERVAL 2 DAY)
			AND so_factura.fk_id_sucursal$condicion";
	}
//echo"<script>alert('La nota ha sido pagada')</script>";  
/*
	if($_GET['busqueda'] == 'si')
	{
		$and="AND so_factura.fk_id_sucursal$condicion AND so_factura.id_factura =". $folio;
	}else{
		$and="AND DATE(so_factura.fecha_factura) BETWEEN DATE_SUB(CURDATE(), INTERVAL 2 DAY) AND DATE_ADD(CURDATE(), INTERVAL 2 DAY)
			AND so_factura.fk_id_sucursal$condicion";
	}
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
				WHEN MONTH(CURDATE()) = MONTH(so_factura.fecha_factura) THEN
					'1'
				ELSE
					'0'
			END AS se_modifica
			FROM so_factura, so_clientes, se_usuarios,kg_sucursales
			WHERE so_factura.fk_id_cliente=so_clientes.id_cliente
			AND so_factura.fk_id_usuario=se_usuarios.id_usuario
			AND so_factura.estado_factura!=5
			AND kg_sucursales.id_sucursal = so_factura.fk_id_sucursal
			$and");
//echo $stmt;

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

/*				
					"9" => "<button  id='delete_factura'  type='button' class='btn btn-danger btn-sm' style='margin-left:10px;' disabled><span  class='fa fa-times fa-1x'></span></button>"
*/					
				);

    }
    	$results = array(
      "sEcho" => 1,
      "iTotalRecords" => count($data),
      "iTotalDisplayRecords" => count($data),
      "aaData" => $data);
    echo json_encode($results);
?>
