<?php 
date_default_timezone_set('America/Mexico_City');
include ("../../controladores/conex.php");
$data=json_decode($_POST['datos'],true);
$fecha = date("Y-m-d H:i:s");
$estado = 'A';
$count = 0;
foreach ($data as $key) {
   $sucursal = $key['sucursal'];
   $f_inicio = $key['f_inicio'];
   $f_final = $key['f_final'];

   $query = "SELECT fk_id_sucursal,id_factura,imp_total FROM so_factura
               WHERE DATE(fecha_factura) >= ?
               AND DATE(fecha_factura) <=  ?
               AND fk_id_sucursal = ?
               AND fk_id_tipo_pago IN (2,3,4,5)";
   $stmt = $conexion->prepare($query);
   $stmt->bind_param("ssi",$f_inicio,$f_final,$sucursal);
   $stmt->execute();
   $result = $stmt->get_result();
   $stmt->close();
   while ($row = $result->fetch_assoc())
   {
      $query = "INSERT INTO so_folios_banco (
                 fk_id_empresa,
                 fk_id_facturas,
                 importe,
                 fecha_inicio,
                 fecha_final,
                 fecha_registro,
                 estado
               ) VALUES (?,?,?,?,?,?,?)";

      $stmt = $conexion->prepare($query);
      $stmt->bind_param("iidssss",$sucursal,$row['id_factura'],$row['imp_total'],$f_inicio,$f_final,$fecha,$estado);
      $stmt->execute();
      $stmt->close();
   }
   

   $count ++;
}



sleep($count);

echo '<div class="row ">
         <div class="col-sm-12 col-md-12 col-lg-12  d-flex justify-content-center">Se han guardado los folios<br>
         </div> 
      </div>';
echo '<div class="row ">
         <div class="col-sm-12 col-md-12 col-lg-12  d-flex justify-content-center">
         	<button type="button" class="btn btn-success" id="btn-continuar" onclick="listar_bancos()">Continuar</button>
         </div> 
      </div>';


 ?>