<?php
  //session_start();
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
      'Mexico' AS pais,

      CASE
      WHEN a.fecha_registro IS NULL THEN
        time(b.fecha_registro)
      ELSE
        time(a.fecha_registro)
      END AS hora
      
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
//echo $result;
  // Creamos una tabla para listar los datos 
  echo "<div class='table-responsive'>";

  echo "<table class='table'>
          <thead class='thead-dark'>
            <tr>
              <th scope='col'>Nombre</th>
              <th scope='col'>Dirección</th>
              <th scope='col'>Latitud</th>
              <th scope='col'>Longitud</th>
              <th scope='col'>País</th>
              <th scope='col'>Hora</th>
            </tr>
            </thead>
            <tbody>";

  while ($row = mysqli_fetch_array($result)) {
      echo "<tr>";
      echo "<td scope='col'>" . $row['nombre'] . "</td>";
      echo "<td scope='col'>" . preg_replace('/\\\\u([\da-fA-F]{4})/', '&#x\1;', $row['direccion']) . "</td>";
      echo "<td scope='col'>" . $row['lat'] . "</td>";
      echo "<td scope='col'>" . $row['lng'] . "</td>";
      echo "<td scope='col'>" . utf8_decode($row['pais']) . "</td>";
      echo "<td scope='col'>" . $row['hora'] . "</td>";
      echo "</tr>";
  }
  echo "</tbody></table>";
  echo "</div>";

  mysqli_close($con);

?> 