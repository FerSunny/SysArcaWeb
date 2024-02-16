<?php
include '../../controladores/conex.php';
include '../../fpdf/fpdf.php';
session_start();
$id_usuario = $_SESSION['id_usuario'];

class PDF extends FPDF
{

  protected $col = 0; // Columna actual
protected $y0 = 20;      // Ordenada de comienzo de la columna
// Cabecera de página


    function SetCol($col)
    {
        // Establecer la posición de una columna dada
        $this->col = $col;
        $x = 10+$col*65;
        $this->SetLeftMargin($x);
        $this->SetX($x);
        $this->SetY($x);
    }

    function AcceptPageBreak()
    {
        // Método que acepta o no el salto automático de página
        if($this->col<1)
        {
            // Ir a la siguiente columna
            $this->SetCol($this->col+1.5);
            // Establecer la ordenada al principio
            $this->SetY($this->y0);
            // Seguir en esta página
            return false;
        }
        else
        {
            // Volver a la primera columna
            $this->SetCol(0);
            // Salto de página
            $this->SetY($this->y0-20);
            return true;
        }
    }

    function Meses($fecha)
    {
      $meses = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre' ,'Noviembre' ,'Diciembre' );
      $dia = date("d", strtotime($fecha));
      $mes = date("n", strtotime($fecha));
      $mes-=1;
      $año = date("Y", strtotime($fecha));
      $fecha_cadena = $dia." de ".$meses[$mes].' de '.$año;


      return $fecha_cadena;
    }

    function Sucursales($id_sucursal)
    {
      global $conexion;

      $stmt = $conexion->prepare("SELECT UPPER(desc_sucursal) desc_sucursal FROM kg_sucursales WHERE id_sucursal = ?");
      $stmt->bind_param("i",$id_sucursal);
      $stmt->execute();
      $result = $stmt->get_result();

      while ($row = $result->fetch_assoc())
      {
        $sucursal = $row['desc_sucursal'];
        return $sucursal;
      }
    }

    function TotalSucursales()
    {
      global $conexion;

      $stmt = $conexion->prepare("SELECT COUNT(*) total FROM kg_sucursales");
      $stmt->execute();
      $result = $stmt->get_result();
      while ($row = $result->fetch_assoc())
      {
        $total = $row['total'];
        return $total;
      }
    }

    function Asistencia($fecha,$sucursal)
    {
      global $conexion;
      $stmt = $conexion->prepare("SELECT
                            DISTINCT
                            UPPER(CONCAT(us.nombre,' ',us.a_paterno,' ',us.a_materno)) nombre,
                            TIMEDIFF((SELECT MAX(hora_asistencia) FROM generar_asistencia WHERE fk_id_usuario = ga.fk_id_usuario AND fecha_asistencia = ga.fecha_asistencia),
                            (SELECT MIN(hora_asistencia) FROM generar_asistencia WHERE fk_id_usuario = ga.fk_id_usuario AND fecha_asistencia = ga.fecha_asistencia)) horas_t
                            FROM generar_asistencia ga
                            LEFT OUTER JOIN kg_sucursales suc ON (suc.id_sucursal = ga.fk_id_sucursal)
                            LEFT OUTER JOIN se_usuarios us ON (us.id_usuario = ga.fk_id_usuario)
                            WHERE DATE(ga.fecha_asistencia) = ? AND ga.fk_id_sucursal = ? ORDER BY nombre");
      $stmt->bind_param("si",$fecha,$sucursal);
      $stmt->execute();
      $result = $stmt->get_result();
      $data = array();
      while ($row = $result->fetch_assoc()) {
          $data[] = $row;
      }
      $datos = json_encode($data);
      return $datos;

    }

    function Cabecera($inicio,$fin)
    {
      $this->Cell(180,5,'Reporte Asistencia del '.$this->Meses($inicio).' al '.$this->Meses($fin),0,0,'C');
      $this->Cell(180,5,'Semana No. '.date('W'),0,0,'C');
      $this->ln(15);
    }

    function SubCabecera($fecha,$id_sucursal)
    {
      $this->SetFont('Arial','B',7);
      $this->Cell(75,5,'Asistencia del '.$this->Meses($fecha).' Sucursal: '.$this->Sucursales($id_sucursal),1,0,"L");
      $this->ln();
    }

    function Titulos()
    {
      $this->SetFont('Arial','B',8);
      $this->Cell(60,5,'Usuario',1,0,'L');
      $this->Cell(15,5,'H T',1,0,'L');
      $this->ln();
    }

    function Recorrer($fecha,$id_sucursal)
    {
      $dia_1 = $this->Asistencia($fecha,$id_sucursal);
      $datos = json_decode($dia_1);
      foreach ($datos as $key)
      {
        $this->SetFont('Arial','B',8);
        $this->Cell(60,5,$key->nombre,1,0,'L');
        $this->Cell(15,5,$key->horas_t,1,0,'L');
        $this->ln();
      }
    }

    function Tabla()
    {
      global $conexion;
      $l = $_GET['fi'];
      $m = date("Y-m-d", strtotime("$l   1 day"));
      $mi = date("Y-m-d", strtotime("$l   2 day"));
      $j = date("Y-m-d", strtotime("$l   3 day"));
      $v = date("Y-m-d", strtotime("$l   4 day"));
      $s = date("Y-m-d", strtotime("$l   5 day"));
      $d = date("Y-m-d", strtotime("$l   6 day"));
      $this->SetFont('Arial','B',12);
      //$this->Cabecera($l,$d);
      $this->SetFont('Arial','B',9);
      $this->Cell(20,5,"H T => Horas trabajadas",0,0,"L");
      $this->ln();
      $numero=1;
      for($i=0;$i<7;$i++)
      {
        $m = date("Y-m-d", strtotime("$l   $i day"));
        //echo $m."<br>";
        for($j=1;$j<10;$j++)
        {
          if($i == 0)
          {

            $this->Cell(20,5,"Dia ".$numero,1,0,"L");
            $this->ln();
            $this->SubCabecera($l,$j);
            $this->Titulos();
            $this->Recorrer($l,$j);
            $this->ln();
          }else {
            $this->Cell(20,5,"Dia ".$numero,1,0,"L");
            $this->ln();
            $this->SubCabecera($m,$j);
            $this->Titulos();
            $this->Recorrer($m,$j);
            $this->ln();
            //echo $this->Sucursales($j)."<br>";
          }

        }
        $numero++;
      }
    }
    function ChapterTitle($l,$d)
  {
      // Título
      $this->SetFont('Arial','',12);
      $this->SetFillColor(200,220,255);
      $this->Cabecera($l,$d);

      // Guardar ordenada
    }

    function PrintChapter($l,$d)
      {
          // Añadir capítulo
          $this->AddPage();
          $this->ChapterTitle($l,$d);
          $this->Tabla();
      }


}

//
// Creación del objeto de la clase heredada
//
$pdf = new PDF('P','mm','Letter');
//$pdf->SetMargins(0,0,0);

$l = $_GET['fi'];
$m = date("Y-m-d", strtotime("$l   1 day"));
$mi = date("Y-m-d", strtotime("$l   2 day"));
$j = date("Y-m-d", strtotime("$l   3 day"));
$v = date("Y-m-d", strtotime("$l   4 day"));
$s = date("Y-m-d", strtotime("$l   5 day"));
$d = date("Y-m-d", strtotime("$l   6 day"));
$title = 'Reporte de Asistencia';
$pdf->SetTitle($title);
$pdf->PrintChapter($l,$d);
$pdf->Output();


$stmt = $conexion->prepare("SELECT
DISTINCT
ga.fk_id_usuario,
us.nombre,
CASE
WHEN (ELT(WEEKDAY(fecha_asistencia) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo')) = 'SABADO' THEN
us.entra_s
WHEN (ELT(WEEKDAY(fecha_asistencia) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo')) = 'DOMINGO' THEN
us.entra_d
ELSE
us.entra
END hora_entrada,
CASE
WHEN (ELT(WEEKDAY(fecha_asistencia) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo')) = 'SABADO' THEN
TIMEDIFF((SELECT MIN(hora_asistencia) FROM generar_asistencia WHERE fk_id_usuario = ga.fk_id_usuario AND fecha_asistencia = ga.fecha_asistencia),us.entra_s)
WHEN (ELT(WEEKDAY(fecha_asistencia) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo')) = 'DOMINGO' THEN
TIMEDIFF((SELECT MIN(hora_asistencia) FROM generar_asistencia WHERE fk_id_usuario = ga.fk_id_usuario AND fecha_asistencia = ga.fecha_asistencia),us.entra_d)
ELSE
TIMEDIFF((SELECT MIN(hora_asistencia) FROM generar_asistencia WHERE fk_id_usuario = ga.fk_id_usuario AND fecha_asistencia = ga.fecha_asistencia),us.entra)
END minutos_tarde
FROM generar_asistencia  ga
LEFT OUTER JOIN se_usuarios us ON (us.id_usuario = ga.fk_id_usuario)
WHERE DATE(fecha_asistencia) = '2019-08-05'");
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
$data = array();
while ($row = $result->fetch_assoc()) {
    $asistencia[] = array("id_usuario_2" => $row['fk_id_usuario'], "entrada" => $row['hora_entrada']);
}

$a = json_decode($datos);
$b = json_decode($datos2);

foreach ($a as $key) {
  foreach ($b as $key2) {
    if($key->id == $key2->id_usuario_2){
      $entra = $key2->entrada;
    }else {
      $entra = "SIN DATOS";
    }

    $asistencia[] = array("asistencia" => $entra);
  }
}

$asistencia =  json_encode($asistencia);
  $datos2 = json_encode($asistencia);
?>
