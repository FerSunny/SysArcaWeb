<?php 
date_default_timezone_set('America/Mexico_City');
include "../../controladores/conex.php";
include "query.php";
session_start();
$id = $_POST['id'];
$sucursal = $_SESSION['fk_id_sucursal'];
$usuario = $_SESSION['id_usuario'];
$fecha=date("Y-m-d H:i:s");
$grupo = 'A';
class Acciones extends Query
{
	function Agregar()
	{
		global $conexion,$id,$sucursal,$usuario,$fecha,$grupo;
		$total = $_POST['total'];
		$a_cuenta = $_POST['a_cuenta'];
		$entrega = $_POST['entrega'];
		$tipo_pago = $_POST['tipo_pago'];
		$resta = $total-$a_cuenta;

		//Buscar Factura CE
		$query = "SELECT * FROM ce_factura WHERE id_factura = ?";
		$stmt = $conexion->prepare($query);
		$stmt->bind_param("i",$id);
		$stmt->execute();
		$result = $stmt->get_result();

		while ($row = $result->fetch_assoc())
		{
			$fk_id_sucursal = $row['fk_id_sucursal'];
			$fk_id_cliente = $row['fk_id_cliente'];
			$fk_id_medico = $row['fk_id_medico'];
			$diagnostico = $row['diagnostico'];
			$empresa = 1;
			$comision = 1;
			$porc_descuento=0;
			$porc_incremento=0;
			$estado_factura=2;
			$origen=1;
			$concilia=2;
		}


		$query = "INSERT INTO so_factura_prueba (
				  fk_id_empresa,
				  fk_id_sucursal,
				  fecha_factura,
				  fk_id_cliente,
				  fk_id_medico,
				  fk_id_usuario,
				  afecta_comision,
				  fk_id_tipo_pago,
				  imp_subtotal,
				  porc_descuento,
				  porc_incremento,
				  imp_total,
				  a_cuenta,
				  resta,
				  fecha_entrega,
				  diagnostico,
				  estado_factura,
				  origen,
				  estado_concilia,
				  grupo
				)
				VALUES
				  (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

		$stmt = $conexion->prepare($query);
		$stmt->bind_param("iisiiiiiddddddssiiis",$empresa,$fk_id_sucursal,$fecha,$fk_id_cliente,$fk_id_medico,$usuario,$comision,$tipo_pago,$total,$porc_descuento,$porc_incremento,$total,$a_cuenta,$resta,$entrega,$diagnostico,$estado_factura,$origen,$concilia,$grupo);
		if($stmt->execute())
		{
			$last_id = $conexion->insert_id;
			$stmt->close();


			$query = "SELECT 
					fk_id_empresa, id_factura, numero_factura, fk_id_estudio, cantidad, precio_venta
					FROM ce_detalle_factura
					WHERE id_factura = $id";
			$stmt = $conexion->prepare($query);
			if($stmt->execute())
			{
				$result = $stmt->get_result();
				while ($row = $result->fetch_assoc())
				{
					$query = "INSERT INTO so_detalle_factura_prueba (fk_id_empresa, id_factura, numero_factura, fk_id_estudio, cantidad, precio_venta) VALUES(?,?,?,?,?,?)";
					$stmt = $conexion->prepare($query);
					$stmt->bind_param("iiiiid",$row['fk_id_empresa'],$last_id,$last_id,$row['fk_id_estudio'],$row['cantidad'],$row['precio_venta']);
					$stmt->execute();
				}
				
				return $this->Terminar($last_id,$id);
			}else
			{
				$codigo = mysqli_errno($conexion);
  				return $codigo;
			}
			
			//Devolvemos el array pasado a JSON como objeto
			//return json_encode($datos, JSON_FORCE_OBJECT);
		}else
		{
			$codigo = mysqli_errno($conexion);
  			return $codigo;
		}		
	}

	function Eliminar()
	{
		global $conexion,$id,$usuario,$usuario;

		$query = "UPDATE ce_factura SET status = 'S' WHERE id_factura = ?";
		$stmt = $conexion->prepare($query);
		$stmt->bind_param("i",$id);

		if($stmt->execute())
		{
			$datos = array(
			  'eliminar' => '1'
			  );
			//return json_encode($datos, JSON_FORCE_OBJECT);
			return $datos;
		}else
		{
			$codigo = mysqli_errno($conexion);
  			return $codigo;
		}
		
	}

	function Terminar($last_id,$id)
	{
		global $conexion,$id,$usuario,$usuario;

		$query = "UPDATE ce_factura SET status = 'A' WHERE id_factura = ?";
		$stmt = $conexion->prepare($query);
		$stmt->bind_param("i",$id);

		if($stmt->execute())
		{
			$datos = array(
			  'id' => $last_id,
			  'ok' => '1'
			 );
			return $datos;
		}else
		{

			$codigo = mysqli_errno($conexion);
  			return $codigo;
		}
		
	}
}

$ejecutar = new Acciones();

if(isset($_POST['delete']))
{
	header('Content-Type: application/json');
    $datos = $ejecutar->Eliminar();
    echo json_encode($datos, JSON_FORCE_OBJECT);
}else
{
	header('Content-Type: application/json');
    $datos = $ejecutar->Agregar();
    echo json_encode($datos, JSON_FORCE_OBJECT);
}

 ?>