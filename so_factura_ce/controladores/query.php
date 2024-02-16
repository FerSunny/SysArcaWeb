<?php 

/**
 * 
 */
class Query
{
	function QueryAdd()
	{
		$query = "INSERT INTO so_factura (
				  fk_id_empresa,
				  fk_id_sucursal,
				  fecha_factura,
				  fk_id_cliente,
				  fk_id_medico,
				  fk_id_usuario,
				  diagnostico
				)
				VALUES
				  (?,?,?,?,?,?,?)";

		return $query;

	}
}


 ?>