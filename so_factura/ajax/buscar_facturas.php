<?php
session_start();
date_default_timezone_set('America/Mexico_City');
$fk_id_sucursal=$_SESSION['fk_id_sucursal'];
$fk_id_perfil=$_SESSION['fk_id_perfil'];
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos

	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';

//echo 'sucursal'.$fk_id_sucursal;

	//Lista todas las facturas
	if($action == 'ajax'){
		if($fk_id_perfil=='1' or $fk_id_perfil=='45' or $fk_id_perfil=='33' or $fk_id_perfil=='46'){
			$condicion=" > 0";
		}else{
			$condicion="=".$fk_id_sucursal;
		}

		  $sTable = "so_factura, so_clientes, se_usuarios";
		  $sWhere = "";
		  $sWhere.=" select id_factura,WHERE so_factura.fk_id_cliente=so_clientes.id_cliente and so_factura.fk_id_usuario=se_usuarios.id_usuario and so_factura.estado_factura!=5";

			$sql="select  id_factura,numero_factura,fecha_factura,so_clientes.nombre,so_clientes.a_paterno,so_clientes.a_materno,so_factura.diagnostico,so_clientes.telefono_fijo,so_factura.estado_factura,so_factura.imp_total,so_clientes.anios as mail,bang_update from so_factura, so_clientes, se_usuarios  WHERE so_factura.fk_id_cliente=so_clientes.id_cliente and so_factura.fk_id_usuario=se_usuarios.id_usuario and so_factura.estado_factura!=5 
                and DATE_SUB(CURDATE(), INTERVAL 90 DAY) <= DATE(so_factura.fecha_factura) 
			    and so_factura.fk_id_sucursal".$condicion;
			
			$resultado = mysqli_query($con, $sql);


			$arreglo["data"] = [];
			if ($resultado){
				while($data=mysqli_fetch_assoc($resultado)){
						//$arreglo["data"][]=array_map("utf8_encode",$data);
					    $arreglo["data"][]=$data;
				}
				mysqli_close($con);
				echo json_encode($arreglo);
			}else {
				mysqli_close($con);
				echo json_encode($arreglo);
			}
	}
?>
