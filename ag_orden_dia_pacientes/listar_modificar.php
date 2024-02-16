<?php 

session_start();
include "../controladores/conex.php";
$derechos = $_SESSION['admin'];
$fk_id_sucursal=$_SESSION['fk_id_sucursal'];


if($derechos == 1)
{
  $condicion = '> 0';
  $fk_id_perfil = 1;
}
else
{
  $condicion = '='.$fk_id_sucursal;
  $fk_id_perfil=$_SESSION['fk_id_perfil'];
}



$query = "SELECT fa.id_factura,CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno) nombre,fa.fecha_factura,cl.id_cliente FROM so_factura fa
LEFT OUTER JOIN so_clientes cl ON (cl.id_cliente = fa.fk_id_cliente)
WHERE fa.fk_id_sucursal$condicion
AND DATE(fa.fecha_factura) BETWEEN DATE_SUB(CURDATE(), INTERVAL 80 DAY) AND DATE_ADD(CURDATE(), INTERVAL 80 DAY)";
	
	$resultado =$conexion->query($query);

    if(!$resultado){
        die("Error");
    }else{
        while($data=mysqli_fetch_assoc($resultado)){
            $arreglo["data"][]=$data;
        }
        echo json_encode($arreglo);
    }

    mysqli_free_result($resultado);
    mysqli_close($conexion);


 ?>