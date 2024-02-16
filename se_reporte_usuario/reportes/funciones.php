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

  function DiaFestivo($fecha)
  {
    global $conexion;
    
    $query = "SELECT * FROM kg_festivos WHERE START = ? AND dia_festivo = 1";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("s",$fecha);
    $stmt->execute();
    $resultado = $stmt->get_result();
    return $num = $resultado->num_rows;
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

  function HorasFestivo($fecha)
  {
    global $conexion;
    
    $query = "SELECT start_time,end_time FROM kg_festivos WHERE START = ? AND dia_festivo = 1";
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



  
}


 ?>