<?php
require 'funciones.php';



Class Query extends Tipo
{

	public function __cosntruct()
	{
		# code...
	}


	public function query()
	{
		$query = "SELECT 'Todo' tipo, '2' tipo_pago, '3', '4' 		folios FROM so_factura fa
				WHERE DATE(fa.fecha_factura) >= '2019-07-15'";

		return $this->inicio($query);

	}

	public function query_ingresos($f_inicio,$f_final,$grupo)
	{


		$query = "SELECT '1' tipo,'1' tipo_pago, SUM(fa.imp_total) total,SUM(fa.a_cuenta) cuenta,SUM(fa.resta) resta,COUNT(*) folios FROM so_factura fa
		WHERE DATE(fa.fecha_factura) >= '$f_inicio' AND DATE(fa.fecha_factura) <= '$f_final' AND fa.fk_id_tipo_pago = 1 AND fa.grupo = '$grupo'

		UNION ALL

		SELECT '1' tipo, '2' tipo_pago, SUM(fa.imp_total) total,SUM(fa.a_cuenta) cuenta,SUM(fa.resta) resta,COUNT(*) folios FROM so_factura fa
		WHERE DATE(fa.fecha_factura) >= '$f_inicio' AND DATE(fa.fecha_factura) <= '$f_final' AND fa.fk_id_tipo_pago = 2 AND fa.grupo = '$grupo'

		UNION ALL

		SELECT '1' tipo, '3' tipo_pago, SUM(fa.imp_total) total,SUM(fa.a_cuenta) cuenta,SUM(fa.resta) resta,COUNT(*) folios FROM so_factura fa
		WHERE DATE(fa.fecha_factura) >= '$f_inicio' AND DATE(fa.fecha_factura) <= '$f_final' AND fa.fk_id_tipo_pago = 3 AND fa.grupo = '$grupo'

		UNION ALL

		SELECT '1' tipo, '4' tipo_pago, SUM(fa.imp_total) total,SUM(fa.a_cuenta) cuenta,SUM(fa.resta) resta,COUNT(*) folios FROM so_factura fa
		WHERE DATE(fa.fecha_factura) >= '$f_inicio' AND DATE(fa.fecha_factura) <= '$f_final' AND fa.fk_id_tipo_pago = 4 AND fa.grupo = '$grupo'

		UNION ALL

		SELECT '1' tipo, '5' tipo_pago, SUM(fa.imp_total) total,SUM(fa.a_cuenta) cuenta,SUM(fa.resta) resta,COUNT(*) folios FROM so_factura fa
		WHERE DATE(fa.fecha_factura) >= '$f_inicio' AND DATE(fa.fecha_factura) <= '$f_final' AND fa.fk_id_tipo_pago = 5 AND fa.grupo = '$grupo'";

	    return $this->ingresos($query,$f_inicio,$f_final,$grupo);

	}

	public function query_egresos($f_inicio,$f_final)
	{
		$query = "SELECT '2' tipo, '1' tipo_pago,COUNT(*) movimientos, SUM(importe) total FROM ga_registro re
			WHERE DATE(re.fecha_mov) >= '$f_inicio' AND DATE(re.fecha_mov) <= '$f_final'";
		return $this->egresos($query,$f_inicio,$f_final);
	}

	public function query_facturas($f_inicio,$f_final,$grupo)
	{
		$query = "SELECT '3' tipo,'1' tipo_pago, SUM(fa.imp_total) total,SUM(fa.a_cuenta) cuenta,SUM(fa.resta) resta,COUNT(*) folios FROM so_factura fa
		WHERE DATE(fa.fecha_factura) >= '$f_inicio' AND DATE(fa.fecha_factura) <= '$f_final' AND fa.fk_id_tipo_pago = 1 AND fa.grupo = '$grupo' AND fa.requiere_factura = 1

		UNION ALL

		SELECT '3' tipo, '2' tipo_pago, SUM(fa.imp_total) total,SUM(fa.a_cuenta) cuenta,SUM(fa.resta) resta,COUNT(*) folios FROM so_factura fa
		WHERE DATE(fa.fecha_factura) >= '$f_inicio' AND DATE(fa.fecha_factura) <= '$f_final' AND fa.fk_id_tipo_pago = 2 AND fa.grupo = '$grupo' AND fa.requiere_factura = 1

		UNION ALL

		SELECT '3' tipo, '3' tipo_pago, SUM(fa.imp_total) total,SUM(fa.a_cuenta) cuenta,SUM(fa.resta) resta,COUNT(*) folios FROM so_factura fa
		WHERE DATE(fa.fecha_factura) >= '$f_inicio' AND DATE(fa.fecha_factura) <= '$f_final' AND fa.fk_id_tipo_pago = 3 AND fa.grupo = '$grupo' AND fa.requiere_factura = 1

		UNION ALL

		SELECT '3' tipo, '4' tipo_pago, SUM(fa.imp_total) total,SUM(fa.a_cuenta) cuenta,SUM(fa.resta) resta,COUNT(*) folios FROM so_factura fa
		WHERE DATE(fa.fecha_factura) >= '$f_inicio' AND DATE(fa.fecha_factura) <= '$f_final' AND fa.fk_id_tipo_pago = 4 AND fa.grupo = '$grupo' AND fa.requiere_factura = 1

		UNION ALL

		SELECT '3' tipo, '5' tipo_pago, SUM(fa.imp_total) total,SUM(fa.a_cuenta) cuenta,SUM(fa.resta) resta,COUNT(*) folios FROM so_factura fa
		WHERE DATE(fa.fecha_factura) >= '$f_inicio' AND DATE(fa.fecha_factura) <= '$f_final' AND fa.fk_id_tipo_pago = 5 AND fa.grupo = '$grupo' AND fa.requiere_factura = 1";

	    return $this->facturas($query,$f_inicio,$f_final,$grupo);
	}


	public function query_detalle_ingresos($tp,$f_inicio,$f_final,$grupo)
	{
		$query = "SELECT fa.*,DATE_FORMAT(fa.fecha_factura, '%d de %M de %Y') f_factura,TIME_FORMAT(fa.fecha_factura, '%T') t_factura,
			DATE_FORMAT(fa.fecha_entrega, '%d de %M de %Y')
			f_entrega,TIME_FORMAT(fa.fecha_entrega, '%T') t_entrega,
			suc.desc_sucursal FROM so_factura fa
			LEFT OUTER JOIN kg_sucursales suc ON (suc.id_sucursal = fa.fk_id_sucursal)
			WHERE DATE(fa.fecha_factura) >= '$f_inicio' AND DATE(fa.fecha_factura) <= '$f_final'
			AND fa.fk_id_tipo_pago = $tp AND fa.grupo = '$grupo'";

		return $this->detalles_ingresos($query);
	}


	public function query_detalle_egresos($tp,$f_inicio,$f_final,$grupo)
	{
		$query = "SELECT re.id_registro,suc.desc_sucursal,DATE_FORMAT(re.fecha_mov, '%d de %M de %Y') f_mov,DATE_FORMAT(re.fecha_aut, '%d de %M de %Y') f_aut,re.nota,ben.nombre,re.importe FROM ga_registro re
			LEFT OUTER JOIN kg_sucursales suc ON (suc.id_sucursal = re.fk_id_sucursal)
			LEFT OUTER JOIN ga_beneficiarios ben ON (ben.id_beneficiario = re.fk_id_beneficiario)
			WHERE DATE(re.fecha_mov) >= '$f_inicio' AND DATE(re.fecha_mov) <= '$f_final'";

		return $this->detalles_egresos($query);
	}

	public function query_detalle_facturas($tp,$f_inicio,$f_final,$grupo)
	{
		$query = "SELECT fa.id_factura,suc.desc_sucursal,DATE_FORMAT(fa.fecha_factura, '%d de %M de %y') f_factura,
				DATE_FORMAT(fa.fecha_entrega, '%d de %M de %y') f_entrega,fa.imp_total,fa.a_cuenta,fa.resta FROM so_factura fa
				LEFT OUTER JOIN kg_sucursales suc ON (suc.id_sucursal = fa.fk_id_sucursal)
				WHERE DATE(fa.fecha_factura) >= '$f_inicio' AND DATE(fa.fecha_factura) <= '$f_final'
				AND fa.fk_id_tipo_pago = $tp AND fa.grupo = '$grupo' AND fa.requiere_factura = 1";

		return $this->detalles_facturas($query);
	}
}
?>