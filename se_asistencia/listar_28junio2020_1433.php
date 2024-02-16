<?php
date_default_timezone_set('America/Mexico_City');
include '../controladores/conex.php';

$stmt = $conexion->prepare("SET lc_time_names = 'es_ES'");
$stmt->execute();

$stmt = $conexion->prepare("
SELECT
gs.*,
CASE
WHEN gs.fk_id_empresa = 1 THEN
'Tulyehualco'
ELSE
'La empresa no existe'
END empresa,
DATE_FORMAT(gs.fecha_asistencia, '%d de %M de %Y') f_asistencia,
TIME_FORMAT(gs.hora_asistencia, '%T') h_asistencia,
ks.desc_sucursal,
concat(us.nombre,' ',us.a_paterno,' ',us.a_materno) nombre
from generar_asistencia gs
left outer join kg_sucursales ks on (ks.id_sucursal = gs.fk_id_sucursal)
left outer join se_usuarios us on (us.id_usuario = gs.fk_id_usuario)"
);

	$stmt->execute();
	$result = $stmt->get_result();
	if($result->num_rows === 0) exit('No hay documentos proximos');
	$data = array();
	while($row = $result->fetch_assoc())
    {
    	$data["data"][] = $row;

    }
echo json_encode($data);


 ?>