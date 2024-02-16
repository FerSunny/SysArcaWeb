<?php
include("../../controladores/conex.php");

$id_solicitud = $_POST["id_solicitud"];
$iddetalle = $_POST["iddetalle"];
$cantidad = $_POST["cantidad"];
$costo = $_POST['costo'];
$total = $cantidad * $costo;

$stmt = $conexion->prepare("UPDATE  eb_solicitudes SET  cantidad = ?,costo_pza = ?, importe_total = costo_pza * ? WHERE id_solicitud = ?");
        $stmt->bind_param('iddi', $cantidad,$costo,$cantidad,$id_solicitud);
        $result = $stmt->execute();
        $stmt->close();
        
if($result)
{
        $stmt = $conexion->prepare("SELECT cantidad,costo_pza FROM eb_solicitudes WHERE fk_id_detalle = ?");
        $stmt->bind_param("i",$iddetalle);
        $stmt->execute();
        $stmt->store_result();
        $rows = $stmt->num_rows;
        if($rows > 0) 
        {
            $stmt->bind_result($cantidad,$costo_pza);
             $total_p = 0;
            while ($stmt->fetch()) {
              $array = array(
                "cantidad" => $cantidad,
                "costo_pza" => $costo_pza
            );
              $total_p+= $array['cantidad'] * $array['costo_pza'];
            }

            $stmt = $conexion->prepare("UPDATE  eb_detalle_solicitud SET importe_total = ? WHERE id_detalle = ?");
            $stmt->bind_param('di',$total_p,$iddetalle);
            $result = $stmt->execute();
            $stmt->close();
            if($result)
            {
                echo 1;
            }else
            {
                $codigo = mysqli_errno($conexion); 
                echo $codigo;
            }

        } else {
            echo 3;
        }
    
}else
{
    $codigo = mysqli_errno($conexion); 
    echo $codigo;
}

?>