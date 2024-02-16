<?php 
class Estudios 
{
	
	function Buscar($conexion,$id)
	{
		$query = "SELECT es.desc_estudio FROM ce_detalle_factura cdf
                    LEFT OUTER JOIN km_estudios es ON (es.id_estudio = cdf.fk_id_estudio)
                    WHERE id_factura = $id";
          $stmt = $conexion->prepare($query);
          $stmt->execute();
          $result = $stmt->get_result();
   
           while($row = $result->fetch_assoc())
            {
                echo $row["desc_estudio"]."<br>";
            }
	}

  function Costo($conexion,$id)
  {
    $query ="SELECT SUM(es.costo) costo FROM ce_detalle_factura cdf 
    LEFT OUTER JOIN km_estudios es ON (es.id_estudio = cdf.fk_id_estudio)
    WHERE id_factura = $id";
      $stmt = $conexion->prepare($query);
          $stmt->execute();
          $result = $stmt->get_result();
   
           while($row = $result->fetch_assoc())
            {
                echo $row["costo"];
            }
  }
}

 ?>