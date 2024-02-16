<?php
include ("../../controladores/conex.php");
date_default_timezone_set('America/Mexico_City');

$data=json_decode($_POST['datos'],true);

	$count = 0;
foreach ($data as $obj) {

	$id = $obj['id_sucursal'];
	$resta = $obj['resta'];
	$f_inicio = $obj['f_inicio'];
	$f_final = $obj['f_final'];

	$sql = "SELECT id_factura,imp_total FROM so_factura
		WHERE DATE(fecha_factura) >= ? 
		AND DATE(fecha_factura) <= ?
		AND fk_id_tipo_pago IN (1)
		AND fk_id_sucursal = ?";
	$stmt = $conexion->prepare($sql);
	$stmt->bind_param("ssi",$f_inicio,$f_final,$id);
	$stmt->execute();
	$result = $stmt->get_result();
	$stmt->close();
	$total = 0;
    while ($row = $result->fetch_assoc())
    {

       
		$total += $row['imp_total'];
	       if($resta <= $total)
	       {
	       }else
	       {
	          
	          $folio =$row['id_factura'];
	          $importe = $row['imp_total'];
	          $fecha = date("Y-m-d H:i:s");
	          $estado = "A";
	          $sql = "INSERT INTO so_folios_efectivo (fk_id_empresa,fk_id_facturas,importe,fecha_registro,estado,fecha_inicio,fecha_final) VALUES (?,?,?,?,?,?,?)";
	          $stmt = $conexion->prepare($sql);
	          $stmt->bind_param("iidssss",$id,$folio,$importe,$fecha,$estado,$f_inicio,$f_final);
	          $stmt->execute();
	          $stmt->close();
	       }

 		
    }
    $count += 1;
}


  

	


sleep($count);
echo '<div class="row ">
         <div class="col-sm-12 col-md-12 col-lg-12  d-flex justify-content-center">Se han obtenido los folios, Click en continuar
         </div> 
      </div>';
echo '<div class="row ">
         <div class="col-sm-12 col-md-12 col-lg-12  d-flex justify-content-center">
         	<button type="button" class="btn btn-success" id="btn-continuar" onclick="continuar()">Continuar</button>
         </div> 
      </div>';
?>