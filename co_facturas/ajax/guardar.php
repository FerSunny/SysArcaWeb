<?php 
include ("../../controladores/conex.php");
date_default_timezone_set('America/Mexico_City');
$id_usuario = $_SESSION['id_usuario'];
$folio = $_POST['folio'];
$fecha = date("Y-m-d H:i:s");
$estado = 'A';
$val = $_GET['val'];

$ejecutar = new Guardar();
switch ($val) {
	case '1':
					$result = $ejecutar->Efectivo();
					echo $result;
		break;
	case '2':
					$result = $ejecutar->Banco();
					echo $result;
		break;
	default:
		echo "Error";
		break;
}

/**
 * 
 */
class Guardar 
{
	function Efectivo()
	{
		global $conexion,$id_usuario, $folio, $fecha, $estado, $val;
		$sql = "SELECT * FROM so_folios_efectivo";
		$stmt = $conexion->prepare($sql);
		$stmt->execute();
		$result = $stmt->get_result();
		$stmt->close();
		$count = 0;
	    while ($row = $result->fetch_assoc())
	    {
	    	$query="INSERT INTO so_folios (
					  fk_id_usuario,
					  folio_factura,
					  fk_id_sucursal,
					  fk_id_factura,
					  importe,
					  fecha_inicio,
					  fecha_final,
					  fecha_registro,
					  estado
					) VALUES (?,?,?,?,?,?,?,?,?)";


				$stmt = $conexion->prepare($query);
				$stmt->bind_param("isiidssss",$id_usuario,$folio,$row['fk_id_empresa'],$row['fk_id_facturas'],$row['importe'],$row['fecha_inicio'],$row['fecha_final'],$fecha,$estado);
				
				if($stmt->execute())
				{
					$count +=1;
				}else
				{
					$codigo = mysqli_errno($conexion); 
	    		echo "Error MySQL #".$codigo;
				}

	    }

	    sleep(5);
	    return '<div class="row ">
	         			<div class="col-sm-12 col-md-12 col-lg-12  d-flex justify-content-center">Los Folios se han guardado existosamente.
	         			</div> 
	      			</div>
	      			<div class="row ">
	         			<div class="col-sm-12 col-md-12 col-lg-12  d-flex justify-content-center">
	         				<button type="button" class="btn btn-success" id="btn-continuar" onclick="finish(1)">Terminar</button>
	         			</div> 
	      			</div>';
	}

	function Banco()
	{
		global $conexion,$id_usuario, $folio, $fecha, $estado, $val;
		$sql = "SELECT * FROM so_folios_banco";
		$stmt = $conexion->prepare($sql);
		$stmt->execute();
		$result = $stmt->get_result();
		$stmt->close();
		$count = 0;
	    while ($row = $result->fetch_assoc())
	    {
	    	$query="INSERT INTO so_folios (
					  fk_id_usuario,
					  folio_factura,
					  fk_id_sucursal,
					  fk_id_factura,
					  importe,
					  fecha_inicio,
					  fecha_final,
					  fecha_registro,
					  estado
					) VALUES (?,?,?,?,?,?,?,?,?)";


				$stmt = $conexion->prepare($query);
				$stmt->bind_param("isiidssss",$id_usuario,$folio,$row['fk_id_empresa'],$row['fk_id_facturas'],$row['importe'],$row['fecha_inicio'],$row['fecha_final'],$fecha,$estado);
				
				if($stmt->execute())
				{
					$count +=1;
				}else
				{
					$codigo = mysqli_errno($conexion); 
	    		echo "Error MySQL #".$codigo;
				}

	    }

	    sleep(5);
	    return '<div class="row ">
	         			<div class="col-sm-12 col-md-12 col-lg-12  d-flex justify-content-center">Los Folios se han guardado existosamente.
	         			</div> 
	      			</div>
	      			<div class="row ">
	         			<div class="col-sm-12 col-md-12 col-lg-12  d-flex justify-content-center">
	         				<button type="button" class="btn btn-success" id="btn-continuar" onclick="finish(2)">Terminar</button>
	         			</div> 
	      			</div>';
	}
}
	
 ?>