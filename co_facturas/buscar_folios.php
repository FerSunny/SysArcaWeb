<?php 
 include ("../controladores/conex.php");

$dinero = 0;

 $sql = "SELECT id_factura,imp_total FROM `so_factura` 
		WHERE DATE(`fecha_factura`) >= '2019-01-01' 
		AND DATE(`fecha_factura`) <= '2019-01-31'
		AND fk_id_tipo_pago IN (1)
		AND fk_id_sucursal = 1";
	$stmt = $conexion->prepare($sql);
	$stmt->execute();
	$result = $stmt->get_result();
	$stmt->close();
	
	$total = 0;
    while ($row = $result->fetch_assoc())
    {

       $total += $row['imp_total'];

 		
    }
    $data[]=$total;
    echo json_encode($data);
    /*

    $id = $obj->id_sucursal;
        $stmt = $conexion->prepare("SELECT id_factura,imp_total FROM so_factura 
                WHERE DATE(fecha_factura) >= ? 
                AND DATE(fecha_factura) <= ?
                AND fk_id_tipo_pago = 1
                AND fk_id_sucursal = ?" );
        $stmt->bind_param("ssi",$f_inicio,$f_final,$id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
    
        $total = 0;
        while ($row = $result->fetch_assoc())
        {

           $total += $row['imp_total'];

            
        }
        $data[7][] = array('efectivo' => $total);*/
 ?>