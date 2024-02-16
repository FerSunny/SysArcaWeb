<?php 
    include ("../../controladores/conex.php");


    $sucursal =$_SESSION['fk_id_sucursal'];
    $v1 =$_POST['v1']; // tipo
    $v2 =$_POST['v2']; // fecha inicio
    $v3 =$_POST['v3']; // fecha final
    $v4 =$_POST['v4']; // grupo
    $v5 =$_POST['v5']; // cantidad


        $query = "SELECT SUM(imp_total) AS total, COUNT(*) AS folios  FROM so_factura fa
            INNER JOIN kg_sucursales su
            ON su.id_sucursal = fa.fk_id_sucursal
            INNER JOIN kg_grupos gr
            ON gr.id_grupo = su.fk_id_grupo
            WHERE fk_id_grupo = $v4
            AND DATE(fecha_factura) >= '$v2'
            AND DATE(fecha_factura) <= '$v3'
            AND fk_id_tipo_pago = 1
            AND estado_factura <> 5
            ";
   

    $stmt = $conexion->prepare($query);
  //  $stmt->bind_param("iss",$v4,$v2,$v3);
    $stmt->execute();
    $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()){
            $data[]=$row;
        }
    echo json_encode($data);

?>

