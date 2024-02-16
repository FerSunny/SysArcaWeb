<?php

  // Archivo de Conexión a la Base de Datos 
  include('conexion.php');

  $fk_id_usuario = $_SESSION['fk_id_usuario'];
  $anio = $_SESSION['anio'];
  $mes = $_SESSION['mes'];
  $dia = $_SESSION['dia'];

  // Listamos las direcciones con todos sus datos (lat, lng, dirección, etc.)
  $result = mysqli_query($con, "
     SELECT   gp.* ,
      CONCAT(me.`nombre`,' ',me.`a_paterno`,' ',me.`a_materno`) nombre,
      me.`fk_id_usuario`,
      CASE
      WHEN a.direccion IS NULL THEN
        b.direccion
      ELSE
        a.direccion
      END AS direccion,

      CASE
      WHEN a.latitud IS NULL THEN
        TRUNCATE(b.latitud,4)
      ELSE
        TRUNCATE(a.latitud,4)
      END AS lat,
      
      CASE
      WHEN a.longitud IS NULL THEN
        TRUNCATE(b.longitud,4)
      ELSE
        TRUNCATE(a.longitud,4)
      END AS lng,
      'Mexico' AS pais
      
    FROM vw_gps_medico gp
    LEFT OUTER JOIN gps_medico a ON (a.`fk_id_medico` = gp.`fk_id_medico` AND DATE(a.`fecha_registro`) = DATE(gp.`fecha_registro`))
    LEFT OUTER JOIN ce_vmedicos b ON (b.`fk_id_medico` = gp.`fk_id_medico` AND DATE(b.`fecha_registro`) = DATE(gp.`fecha_registro`)),
    so_medicos me
    WHERE year(gp.`fecha_registro`) = $anio
    AND monthname(gp.`fecha_registro`) = '".$mes."'
    AND day(gp.`fecha_registro`) = $dia
    AND gp.`fk_id_medico` = me.`id_medico`
    AND me.fk_id_usuario = $fk_id_usuario
    ");

  // Seleccionamos los datos para crear los marcadores en el Mapa de Google serian direccion, lat y lng 
  while ($row = mysqli_fetch_array($result)) {
      echo '["' . $row['nombre'] . ', ' . $row['direccion'] . '", ' . $row['lat'] . ', ' . $row['lng'] . '],';
  }
?>
