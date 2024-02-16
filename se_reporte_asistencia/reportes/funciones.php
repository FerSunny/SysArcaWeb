<?php

/**
 *
 */
class Asistencia
{
  function Dia($fecha)
  {
    $dia = date("d", strtotime($fecha));
    return $dia;
  }

  function Mes($fecha)
  {
    $meses = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre' ,'Noviembre' ,'Diciembre' );
    $mes = date("n", strtotime($fecha));
    $mes-=1;

    return $meses[$mes];
  }

  function Year($fecha)
  {
    $year = date("Y", strtotime($fecha));
    return $year;
  }

  function Saber_Dia($fecha) {
    $array_dias['Sunday'] = "Domingo";
    $array_dias['Monday'] = "Lunes";
    $array_dias['Tuesday'] = "Martes";
    $array_dias['Wednesday'] = "Miercoles";
    $array_dias['Thursday'] = "Jueves";
    $array_dias['Friday'] = "Viernes";
    $array_dias['Saturday'] = "Sabado";

    $dia = $array_dias[date('l', strtotime($fecha))];

    return $dia;
  }

  function Nombre($id)
  {
    global $conexion;
    $stmt = $conexion->prepare("SELECT CONCAT(nombre,' ',a_paterno,' ',a_materno)nombre FROM se_usuarios WHERE id_usuario = ?");
    $stmt->bind_param("i",$id);
    $stmt->execute();
    $stmt->bind_result($nombre);
    $stmt->fetch();
    return $nombre;
  }

  function Entrada($id,$fecha)
  {
    global $conexion;
    $stmt = $conexion->prepare("SELECT
                                  MIN(ga.hora_asistencia)
                                  FROM generar_asistencia  ga
                                  LEFT OUTER JOIN se_usuarios us ON (us.id_usuario = ga.fk_id_usuario)
                                  WHERE DATE(ga.fecha_asistencia) = ? AND fk_id_usuario = ?");
    $stmt->bind_param("si",$fecha,$id);
    $stmt->execute();
    $stmt->bind_result($entrada);
    $stmt->fetch();
    return $entrada;
  }

  function Salida($id,$fecha)
  {
    global $conexion;
    $stmt = $conexion->prepare("SELECT
                                  MAX(ga.hora_asistencia)
                                  FROM generar_asistencia  ga
                                  LEFT OUTER JOIN se_usuarios us ON (us.id_usuario = ga.fk_id_usuario)
                                  WHERE DATE(ga.fecha_asistencia) = ? AND fk_id_usuario = ?");
    $stmt->bind_param("si",$fecha,$id);
    $stmt->execute();
    $stmt->bind_result($entrada);
    $stmt->fetch();
    return $entrada;
  }

  function ObtenerHorario($id,$fecha,$horario)
  {
    global $conexion;
    $query = "SELECT $horario FROM se_usuarios
              WHERE id_usuario = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i",$id);
    $stmt->execute();
    $stmt->bind_result($entra);
    $stmt->fetch();

    return $entra;
  }

  function ObtenerAsistencia($id,$fecha)
  {
    global $conexion;
    $stmt = $conexion->prepare("SELECT * FROM generar_asistencia  ga
                                WHERE DATE(ga.fecha_asistencia) = ? AND fk_id_usuario = ?");
    $stmt->bind_param("si",$fecha,$id);
    $stmt->execute();
    $result = $stmt->get_result();
    $num = $result->num_rows;
    return $num;
  }

  function Entra($id,$fecha)
  {
    global $conexion;
    $dia = $this->Saber_Dia($fecha);
    if($dia == "Sabado"){
      $horario = "entra_s";
      $entra = $this->ObtenerHorario($id,$fecha,$horario);
    }else
    if($dia == "Domingo")
    {
      $horario = "entra_d";
      $entra = $this->ObtenerHorario($id,$fecha,$horario);
    }else{
      $horario = "entra";
      $entra = $this->ObtenerHorario($id,$fecha,$horario);
    }

    if($entra == '00:00:00'){
      return "No";
    }else
    if($entra == null){
      return "S/D";
    }
    else{
      return "Si";
    }
  }

  function Descanso($id,$fecha)
  {
    global $conexion;
    $dia = $this->Saber_Dia($fecha);

    if($dia == "Sabado")
    {
      $query = "SELECT entra_s FROM se_usuarios
                WHERE id_usuario = ?";
      $stmt = $conexion->prepare($query);
      $stmt->bind_param("i",$id);
      $stmt->execute();
      $stmt->bind_result($descanso);
      $stmt->fetch();
      $stmt->close();
      if($descanso == '00:00:00')
      {
        $stmt = $conexion->prepare("SELECT COUNT(*) si FROM generar_asistencia ga
                            WHERE DATE(ga.fecha_asistencia) = ? AND ga.fk_id_usuario = ?");
        $stmt->bind_param("si",$fecha,$id);
        $stmt->execute();
        $stmt->bind_result($si);
        $stmt->fetch();
        $stmt->close();
        if($si > 0)
        {
          return "x";
        }else
        {

        }

      }else{
      }
    }else
    if($dia == "Domingo")
    {
      $query = "SELECT entra_d FROM se_usuarios
                WHERE id_usuario = ?";
      $stmt = $conexion->prepare($query);
      $stmt->bind_param("i",$id);
      $stmt->execute();
      $stmt->bind_result($descanso);
      $stmt->fetch();
      if($descanso == '00:00:00')
      {
          return "x";
      }else{
        return "";
      }
    }else
    {
      //return "No";
    }

  }

  function PrimaD($id,$fecha)
  {
    $dia = $this->Saber_Dia($fecha);

    if($dia == "Domingo")
    {
      return "x";
    }else {
      return "";
    }
  }

  function Min_Entrada($id,$fi)
  {
    global $conexion;
    $stmt = $conexion->prepare("SELECT
                                CASE
                                WHEN (TIMEDIFF((SELECT MIN(hora_asistencia) FROM generar_asistencia WHERE fk_id_usuario = ga.fk_id_usuario AND fecha_asistencia = ga.fecha_asistencia),us.entra)) < 0 THEN
                                0
                                ELSE
                                TIMEDIFF((SELECT MIN(hora_asistencia) FROM generar_asistencia WHERE fk_id_usuario = ga.fk_id_usuario AND fecha_asistencia = ga.fecha_asistencia),us.entra)
                                END AS min_tarde
                                FROM generar_asistencia  ga
                                LEFT OUTER JOIN se_usuarios us ON (us.id_usuario = ga.fk_id_usuario)
                                WHERE DATE(ga.fecha_asistencia) = ? AND fk_id_usuario = ?");
    $stmt->bind_param("si",$fi,$id);
    $stmt->execute();
    $stmt->bind_result($min_tarde);
    $stmt->fetch();
    $stmt->close();
    if($min_tarde == ''){
      return "S/D";
    }else
    {
      return $min_tarde;
    }
  }

  function Retardo($id,$fi)
  {
    global $conexion;
    $stmt = $conexion->prepare("SELECT
                                CASE
                                WHEN (TIMEDIFF((SELECT MIN(hora_asistencia) FROM generar_asistencia WHERE fk_id_usuario = ga.fk_id_usuario AND fecha_asistencia = ga.fecha_asistencia),us.entra)) < 0 THEN
                                'A tiempo'
                                ELSE
                                'Tarde'
                                -- TIMEDIFF((SELECT MIN(hora_asistencia) FROM generar_asistencia WHERE fk_id_usuario = ga.fk_id_usuario AND fecha_asistencia = ga.fecha_asistencia),us.entra)
                                END AS min_tarde
                                FROM generar_asistencia  ga
                                LEFT OUTER JOIN se_usuarios us ON (us.id_usuario = ga.fk_id_usuario)
                                WHERE DATE(ga.fecha_asistencia) = ? AND fk_id_usuario = ?");
    $stmt->bind_param("si",$fi,$id);
    $stmt->execute();
    $stmt->bind_result($min_tarde);
    $stmt->fetch();
    $stmt->close();
    if($min_tarde == ''){
      return "S/D";
    }else
    {
      return $min_tarde;
    }
  }

  function Tiempo_Extra($id,$fecha)
  {
    global $conexion;
    //mysqli_query($con, "SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))");
    $dia = $this->Saber_Dia($fecha);
    if($dia == "Sabado")
    {
      $query = "SELECT
        CASE
        WHEN (TIMEDIFF((SELECT MAX(hora_asistencia) FROM generar_asistencia WHERE fk_id_usuario = ga.fk_id_usuario AND fecha_asistencia = ga.fecha_asistencia),us.entra)) < 0 THEN
        0
        ELSE
        TIMEDIFF((SELECT MAX(hora_asistencia) FROM generar_asistencia WHERE fk_id_usuario = ga.fk_id_usuario AND fecha_asistencia = ga.fecha_asistencia),us.salida)
        END AS min_extra
        FROM generar_asistencia  ga
        LEFT OUTER JOIN se_usuarios us ON (us.id_usuario = ga.fk_id_usuario)
        WHERE DATE(ga.fecha_asistencia) = ? AND fk_id_usuario = ?";
    }else
    if($dia == "Domingo"){
      $query = "SELECT
                CASE
                WHEN (TIMEDIFF((SELECT MAX(hora_asistencia) FROM generar_asistencia WHERE fk_id_usuario = ga.fk_id_usuario AND fecha_asistencia = ga.fecha_asistencia),us.entra)) < 0 THEN
                0
                ELSE
                TIMEDIFF((SELECT MAX(hora_asistencia) FROM generar_asistencia WHERE fk_id_usuario = ga.fk_id_usuario AND fecha_asistencia = ga.fecha_asistencia),us.salida)
                END AS min_extra
                FROM generar_asistencia  ga
                LEFT OUTER JOIN se_usuarios us ON (us.id_usuario = ga.fk_id_usuario)
                WHERE DATE(ga.fecha_asistencia) = ? AND fk_id_usuario = ?";
    }else {
      $query = "SELECT
                CASE
                WHEN (TIMEDIFF((SELECT MAX(hora_asistencia) FROM generar_asistencia WHERE fk_id_usuario = ga.fk_id_usuario AND fecha_asistencia = ga.fecha_asistencia),us.entra)) < 0 THEN
                0
                ELSE
                TIMEDIFF((SELECT MAX(hora_asistencia) FROM generar_asistencia WHERE fk_id_usuario = ga.fk_id_usuario AND fecha_asistencia = ga.fecha_asistencia),us.salida)
                END AS min_extra
                FROM generar_asistencia  ga
                LEFT OUTER JOIN se_usuarios us ON (us.id_usuario = ga.fk_id_usuario)
                WHERE DATE(ga.fecha_asistencia) = ? AND fk_id_usuario = ?";
    }

    $stmt = $conexion->prepare($query);
    $stmt->bind_param("si",$fecha,$id);
    $stmt->execute();
    $stmt->bind_result($min_extra);
    $stmt->fetch();

    if($min_extra < "00:00:00"){
      return 0;
    }else{
      return $min_extra;
    }
  }

  function Festivo($id,$fecha)
  {
    global $conexion;
    $query = "SELECT * FROM generar_asistencia
              WHERE fk_id_usuario = ? AND DATE(fecha_asistencia) = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("is",$id,$fecha);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $num = $resultado->num_rows;
    $stmt->close();
    $festivo = array('2019-09-15');
    if (in_array($fecha, $festivo)){
      ($num > 0 ) ? $result = "S" : $result =  "";
    }else{
      $result = "";
    }

    return $result;
  }

  function Faltas($id,$fecha)
  {
    global $conexion;
    $dia = $this->Saber_Dia($fecha);

    if($dia == 'Sabado')
    {
      $horario = "entra_s";
      $entra = $this->ObtenerHorario($id,$fecha,$horario);
    }else
    if($dia == 'Domingo')
    {
      $horario = "entra_d";
      $entra = $this->ObtenerHorario($id,$fecha,$horario);
    }else {
      $horario = "entra";
      $entra = $this->ObtenerHorario($id,$fecha,$horario);
    }

    if($entra == '00:00:00')
    {
      $asistencia = $this->ObtenerAsistencia($id,$fecha);

      if($asistencia > 0)
      {
        return "";
      }else{
        return "x";
      }
    }else{
      return "";
    }
  }

  function Observaciones($id,$fecha)
  {
    global $conexion;
    $query = "SELECT observaciones FROM generar_asistencia
              WHERE fk_id_usuario = ?
              AND DATE(fecha_asistencia) = ?";

    $stmt = $conexion->prepare($query);
    $stmt->bind_param("is",$id,$fecha);
    $stmt->execute();
    $stmt->bind_result($observaciones);
    $stmt->fetch();

    return $observaciones;
  }

  function Incidencia($id,$fecha)
  {
    global $conexion;
    $final = date("Y-m-d", strtotime("$fecha   6 day"));
    $query = "SELECT * FROM generar_asistencia
              WHERE fk_id_usuario = ?
              AND DATE(fecha_asistencia) >= ?
              AND DATE(fecha_asistencia) <= ?
              AND fk_id_sucursal != (SELECT fk_id_sucursal FROM se_usuarios WHERE id_usuario = ?)
              GROUP BY fk_id_usuario";

    $stmt = $conexion->prepare($query);
    $stmt->bind_param("issi",$id,$fecha,$final,$id);
    $stmt->execute();
    $result = $stmt->get_result();
    $num = $result->num_rows;

    if($num > 0)
    {
      return "Si";
    }else {
      return "No";
    }
  }

  function UsuarioAllSucursal($id)
  {
    global $conexion;

    $query = "SELECT * FROM se_usuarios WHERE fk_id_sucursal = ? AND activo = 'A' AND huella > ''";

    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i",$id);
    $stmt->execute();
    return $result = $stmt->get_result();

  }

  function UsuarioSucursal($id)
  {
    global $conexion;

    $query = "SELECT * FROM se_usuarios WHERE fk_id_sucursal = ? AND activo = 'A' AND huella > ''";

    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i",$id);
    $stmt->execute();
    return $result = $stmt->get_result();

  }


  function Sucursal($suc)
  {
    global $conexion;
    $stmt = $conexion->prepare("SELECT desc_sucursal FROM kg_sucursales WHERE id_sucursal = ? AND estado = 'A'");
    $stmt->bind_param("i",$suc);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
      return $row['desc_sucursal'];
    }
  }


  function DiaFestivo($fecha)
  {
    global $conexion;
    
    $query = "SELECT * FROM kg_festivos WHERE START = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("s",$fecha);
    $stmt->execute();
    $resultado = $stmt->get_result();
    return $num = $resultado->num_rows;
  }

  function HorasFestivo($fecha)
  {
    global $conexion;
    
    $query = "SELECT start_time,end_time FROM kg_festivos WHERE START = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("s",$fecha);
    $stmt->execute();
    $resultado = $stmt->get_result();

    while ($row = $resultado->fetch_assoc()) 
    {
      $festivo[] = array("start_time" => $row['start_time'], "end_time" => $row['end_time']);
    }

    $festivo = json_encode($festivo);
    return $festivo;
  }

  function RetardoFestivo($id,$fi,$start)
  {
    global $conexion;
    $stmt = $conexion->prepare("SELECT
            CASE
            WHEN (TIMEDIFF((SELECT MIN(hora_asistencia) FROM generar_asistencia WHERE fk_id_usuario = ga.fk_id_usuario AND fecha_asistencia = ga.fecha_asistencia), ? )) < '0' THEN
            'A tiempo'
            ELSE
            'Tarde'
            END AS min_tarde
            FROM generar_asistencia ga
            LEFT OUTER JOIN se_usuarios us ON (us.id_usuario = ga.fk_id_usuario)
            WHERE DATE(ga.fecha_asistencia) = ? AND fk_id_usuario = ?");
    $stmt->bind_param("ssi",$start,$fi,$id);
    $stmt->execute();
    $stmt->bind_result($min_tarde);
    $stmt->fetch();
    $stmt->close();
    if($min_tarde == ''){
      return "S/D";
    }else
    {
      return $min_tarde;
    }
  }


}


 ?>
