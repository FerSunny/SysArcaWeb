<?php 
    include ("../../controladores/conex.php");

    $sucursal =$_SESSION['fk_id_sucursal'];
    $tipo =$_POST['tipo'];
    $f_inicio =$_POST['f_inicio'];
    $f_final =$_POST['f_final'];
    $grupo =$_POST['grupo'];
    $cantidad = $_POST['cantidad'];

    $data = array();
    $stmt = $conexion->prepare("SELECT id_sucursal,desc_sucursal, porcentaje FROM kg_sucursales WHERE fk_id_grupo = ? GROUP BY desc_sucursal ORDER BY id_sucursal" );


    $stmt->bind_param("i",$grupo);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
	while ($row = $result->fetch_assoc()){
		$data[0][]=$row;
        $arrayName[] =$row;
	}

    $j1 = json_encode($arrayName);
    $j2 = json_decode($j1);

    foreach($j2 as $obj)
    {

        $por = $obj->porcentaje;
        $por = $por/100;
        $arreglo  = array('porcentaje' => $por);
        $data[1][]=$arreglo;
    }

    foreach($j2 as $obj)
    {

        $por = $obj->porcentaje;
        $por = $por/100;
        $total = $cantidad*$por;
        $arreglo  = array('t_porcentaje' => $total);
        $data[2][]=$arreglo;
    }

    foreach($j2 as $obj)
    {

        $id = $obj->id_sucursal;
        $stmt = $conexion->prepare("SELECT COUNT(*) folios FROM so_factura 
                WHERE DATE(fecha_factura) >= ? 
                AND DATE(fecha_factura) <= ?
                AND fk_id_tipo_pago IN (2,3,4,5)
                AND fk_id_sucursal = ?" );
        $stmt->bind_param("ssi",$f_inicio,$f_final,$id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        while ($row = $result->fetch_assoc()){
            $data[3][]=$row;
        }
    }

    foreach($j2 as $obj)
    {

        $id = $obj->id_sucursal;
        $stmt = $conexion->prepare("SELECT 
                CASE
                WHEN SUM(imp_total) IS NULL THEN
                '0'
                ELSE
                 SUM(imp_total)
                END total_b
                FROM so_factura 
                WHERE DATE(fecha_factura) >= ? 
                AND DATE(fecha_factura) <= ?
                AND fk_id_tipo_pago IN (2,3,4,5)
                AND fk_id_sucursal = ?" );
        $stmt->bind_param("ssi",$f_inicio,$f_final,$id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        while ($row = $result->fetch_assoc()){
            $data[4][]=$row;
            $bancos[]=$row;
        }
    }

    foreach($j2 as $obj)
    {

        $id = $obj->id_sucursal;
        $stmt = $conexion->prepare("SELECT COUNT(*) folios_e FROM so_factura 
                WHERE DATE(fecha_factura) >= ? 
                AND DATE(fecha_factura) <= ?
                AND fk_id_tipo_pago = 1
                AND fk_id_sucursal = ?" );
        $stmt->bind_param("ssi",$f_inicio,$f_final,$id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        while ($row = $result->fetch_assoc()){
            $data[5][]=$row;
        }
    }

    foreach($j2 as $obj)
    {

        $id = $obj->id_sucursal;
        $stmt = $conexion->prepare("SELECT 
                CASE
                WHEN SUM(imp_total) IS NULL THEN
                '0'
                ELSE
                 SUM(imp_total)
                END total_e
                FROM so_factura 
                WHERE DATE(fecha_factura) >= ? 
                AND DATE(fecha_factura) <= ?
                AND fk_id_tipo_pago = 1
                AND fk_id_sucursal = ?" );
        $stmt->bind_param("ssi",$f_inicio,$f_final,$id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        while ($row = $result->fetch_assoc()){
            $data[6][]=$row;
            $bancos[]=$row;
        }



    }

    foreach($j2 as $obj)
    {

        $id = $obj->id_sucursal;
        $stmt = $conexion->prepare("SELECT id_factura,imp_total FROM `so_factura` 
        WHERE DATE(`fecha_factura`) >= ?
        AND DATE(`fecha_factura`) <= ?
        AND fk_id_tipo_pago IN (1)
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

        $data[7][] = $total;

    }





   function resta()
   {
        global $f_inicio,$f_final,$conexion;
         $sql = "SELECT id_factura,imp_total FROM `so_factura` 
        WHERE DATE(`fecha_factura`) >= ?
        AND DATE(`fecha_factura`) <= ?
        AND fk_id_tipo_pago IN (1)
        AND fk_id_sucursal = ?";

        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ssi",$f_inicio,$f_final,$id);
        
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $dinero = 0;
        while ($row = $result->fetch_assoc()){
            
            while($dinero <= $total)
            {
                $dinero +=$row['imp_total'];
            }

            return $dinero;
        }
   }

    




    echo json_encode($data);

?>


 