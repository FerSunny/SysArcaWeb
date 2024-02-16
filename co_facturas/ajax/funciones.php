<?php
require '../controladores/conex.php';

/**
 *
 */
class Tipo
{

	public function __construct()
	{
		# code...
	}

	public function inicio($query)
	{
		global $conexion;
			$stmt = $conexion->prepare($query);
			$stmt->execute();
			$result = $stmt->get_result();
			if($result->num_rows === 0) exit('No hay documentos proximos');
			$data = array();
			while($row = $result->fetch_assoc())
		    {
		    	if($row['tipo_pago'] == 1){$tipo_pago = "Efectivo";}else
		    	if($row['tipo_pago'] == 2){$tipo_pago = "Cheque";}else
		    	if($row['tipo_pago'] == 3){$tipo_pago = "Transferencia Bancaria";}
		    	if($row['tipo_pago'] == 4){$tipo_pago = "Tarjeta de Debito";}else
		    	if($row['tipo_pago'] == 5){$tipo_pago = "Tarjeta de Credito";}
		    	 $data[] = array(
		          "0" => $row['tipo'],
		          "1" => $tipo_pago,
		          "2" => $row['tipo'],
		          "3" => $row['tipo'],
		          "4" => "<button class='btn btn-info btn-md'><i class='fas fa-eye'></button>",
		          "5" => "<button type='button' class='btn btn-danger btn-md' onclick='validar()' style='background-color: #DF0101 !important;'><i class='fas fa-file-pdf'></i></button>"

		        );

		    }

		    return $data;
	}

	public function ingresos($query,$f_inicio,$f_final,$grupo)
	{
			global $conexion;
			$stmt = $conexion->prepare($query);
			$stmt->execute();
			$result = $stmt->get_result();
			if($result->num_rows === 0) exit('No hay documentos proximos');
			$data = array();
			while($row = $result->fetch_assoc())
		    {
		    	if($row['tipo_pago'] == 1){$tipo_pago = "Efectivo";}else
		    	if($row['tipo_pago'] == 2){$tipo_pago = "Cheque";}else
		    	if($row['tipo_pago'] == 3){$tipo_pago = "Transferencia Bancaria";}
		    	if($row['tipo_pago'] == 4){$tipo_pago = "Tarjeta de Debito";}else
		    	if($row['tipo_pago'] == 5){$tipo_pago = "Tarjeta de Credito";}
		    	else{$tipo = "No existe";}
		    	$data[] = array(
		          "0" => ($row['tipo'] == 1)? "Ingresos" : "No existe",
		          "1" => $tipo_pago,
		          "2" => $row['folios'],
		          "3" => '$ '.$row['total'],
		          "4" => "<button class='btn btn-info btn-md' onclick='ingresos(".$row['tipo'].",".$row['tipo_pago'].")'><i class='fas fa-eye'></button>",
		          "5" => "<button type='button' class='btn btn-danger btn-md' onclick=imprimir_ingresos(".$row['tipo'].",".$row['tipo_pago'].",'".$f_inicio."','".$f_final."','".$grupo."') style='background-color: #DF0101 !important;'><i class='fas fa-file-pdf'></i></button>"

		        );

		    }

		    return $data;
	}

	public function egresos($query,$f_inicio,$f_final)
	{
		global $conexion;
		$stmt = $conexion->prepare($query);
		$stmt->execute();
		$result = $stmt->get_result();
		if($result->num_rows === 0) exit('No hay documentos proximos');
		$data = array();
		while($row = $result->fetch_assoc())
	    {
	    	if($row['tipo_pago'] == 1){$tipo_pago = "Efectivo";}else
	    	if($row['tipo_pago'] == 2){$tipo_pago = "Cheque";}else
	    	if($row['tipo_pago'] == 3){$tipo_pago = "Transferencia Bancaria";}
	    	if($row['tipo_pago'] == 4){$tipo_pago = "Tarjeta de Debito";}else
	    	if($row['tipo_pago'] == 5){$tipo_pago = "Tarjeta de Credito";}
	    	else{$tipo = "No existe";}
	    	$data[] = array(
	          "0" => ($row['tipo'] == 2)? "Egresos" : "No existe",
	          "1" => $tipo_pago,
	          "2" => $row['movimientos'],
	          "3" => '$ '.$row['total'],
	          "4" => "<button class='btn btn-info btn-md' onclick='egresos(".$row['tipo'].",".$row['tipo_pago'].")'><i class='fas fa-eye'></button>",
	          "5" => "<button type='button' class='btn btn-danger btn-md' onclick=imprimir_egresos(".$row['tipo'].",".$row['tipo_pago'].",'".$f_inicio."','".$f_final."') style='background-color: #DF0101 !important;'><i class='fas fa-file-pdf'></i></button>"

	        );

	    }

	    return $data;
	}

	public function facturas($query,$f_inicio,$f_final,$grupo)
	{
		global $conexion;
		$stmt = $conexion->prepare($query);
		$stmt->execute();
		$result = $stmt->get_result();
		if($result->num_rows === 0) exit('No hay documentos proximos');
		$data = array();
		while($row = $result->fetch_assoc())
	    {
	    	if($row['tipo_pago'] == 1){$tipo_pago = "Efectivo";}else
		    	if($row['tipo_pago'] == 2){$tipo_pago = "Cheque";}else
		    	if($row['tipo_pago'] == 3){$tipo_pago = "Transferencia Bancaria";}
		    	if($row['tipo_pago'] == 4){$tipo_pago = "Tarjeta de Debito";}else
		    	if($row['tipo_pago'] == 5){$tipo_pago = "Tarjeta de Credito";}
		    	else{$tipo = "No existe";}
	    	 $data[] = array(
		          "0" => ($row['tipo'] == 3)? "Facturas" : "No existe",
		          "1" => $tipo_pago,
		          "2" => $row['folios'],
		          "3" => '$ '.$row['total'],
		          "4" => "<button class='btn btn-info btn-md' onclick='facturas(".$row['tipo'].",".$row['tipo_pago'].")'><i class='fas fa-eye'></button>",
		          "5" => "<button type='button' class='btn btn-danger btn-md' onclick=imprimir_facturas(".$row['tipo'].",".$row['tipo_pago'].",'".$f_inicio."','".$f_final."','".$grupo."') style='background-color: #DF0101 !important;'><i class='fas fa-file-pdf'></i></button>"

	        );

	    }

	    return $data;
	}

	public function detalles_ingresos($query)
	{
		global $conexion;
		$stmt = $conexion->prepare("SET lc_time_names = 'es_ES'");
		$stmt->execute();
		$stmt = $conexion->prepare($query);
		$stmt->execute();
		$result = $stmt->get_result();
		if($result->num_rows === 0) exit('No hay documentos proximos');
		$data = array();
		while($row = $result->fetch_assoc())
	    {
	    	$data[] = $row;

	    }

	    return $data;
	}

	public function detalles_egresos($query)
	{
		global $conexion;
		$stmt = $conexion->prepare("SET lc_time_names = 'es_ES'");
		$stmt->execute();
		$stmt = $conexion->prepare($query);
		$stmt->execute();
		$result = $stmt->get_result();
		if($result->num_rows === 0) exit('No hay documentos proximos');
		$data = array();
		while($row = $result->fetch_assoc())
	    {
	    	$data[] = $row;

	    }

	    return $data;
	}


	public function detalles_facturas($query)
	{
		global $conexion;
		$stmt = $conexion->prepare("SET lc_time_names = 'es_ES'");
		$stmt->execute();
		$stmt = $conexion->prepare($query);
		$stmt->execute();
		$result = $stmt->get_result();
		if($result->num_rows === 0) exit('No hay documentos proximos');
		$data = array();
		while($row = $result->fetch_assoc())
	    {
	    	$data[] = $row;

	    }

	    return $data;
	}

}



 ?>