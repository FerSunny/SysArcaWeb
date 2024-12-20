<?php
session_start();
date_default_timezone_set('America/Mexico_City');
header('Content-Type: text/html; charset=ISO-8859-1');
require('../../fpdf/fpdf.php');
require_once ("../../so_factura/config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../../so_factura/config/conexion.php");//Contiene funcion que conecta a la base de datos

//$fk_id_sucursal=$_SESSION['fk_id_sucursal'];
$id_usuario=$_SESSION['id_usuario'];
//$usr_1=$_GET['nombre'];
$fecha=$_GET['fecha'];
$hora=$_GET['hora'];
//echo $usr_1;
$query = "
SELECT 
CONCAT(us.`nombre`,' ',us.`a_paterno`,' ',us.`a_materno`) AS usuario
FROM 
se_usuarios us
WHERE us.`id_usuario` = 1
";
//echo $query;
$resultado = mysqli_query($con, $query);

if($row = mysqli_fetch_array($resultado))
{
  $usuario=$row['usuario'];
}

class PDF extends FPDF
{
// Cabecera de página
  function Header()
  {

    global $usuario, $desc_area;
      // Logo
      //$this->Image('logo_pb.png',10,8,33);
      // Arial bold 15

      setlocale(LC_ALL,"es_ES");
      $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
      $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
      $fecha=$dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
    
      $this->SetTextColor(0,0,0);
      $this->SetFont('Arial','B',14);
      // Movernos a la derecha
      $this->Cell(3);
      // Título
      //$this->Cell(240,5,'LABORATORIOS ARCA',0,0,'C');
      $this->Cell(240,5,'LABORATORIOS DE ANALISIS CLINCOS ARCA',0,0,'C');
      $this->Ln(5);
      $this->SetFont('Arial','B',12);
      $this->Cell(142,10,'REPORTE DE MUESTRAS',0,0,'R');
      $this->Cell(120,10,'FOR-REC-XX',0,0,'R');
      $this->Ln(10);
      $this->SetFont('Arial','B',10);
      $this->Cell(10,10,'Area: ',0,0,'L');
      $this->SetFont('Arial','',9);
      $this->Cell(30,10,trim(utf8_decode('Toma de muestras')),0,0,'L');

      $this->SetFont('Arial','B',10);
      $this->Cell(25,10,'Responsable: ',0,0,'L');
      $this->SetFont('Arial','',9);
      $this->Cell(20,10,trim($usuario),0,0,'L');

      $this->Cell(105);
      $this->Cell(20,10,utf8_decode($fecha).' '.strftime("y son las %H:%M"),0,0,'L');
      // $this->Cell(20,10,strftime("Hoy es %A y son las %H:%M"));
      $this->Ln(1);
      $this->Cell(250,10,'____________________________________________________________________________________________________________________________________________________',0,0,'L');
      $this->Ln(4);
      $this->SetFont('Arial','B',7);
	    $this->Cell(10,10,'Suc',0,0,'C');
      $this->Cell(17,10,'Folio',0,0,'C');
      $this->Cell(20,10,'Fecha',0,0,'C');
      $this->Cell(15,10,'Hora',0,0,'C');
      $this->Cell(12,10,'Edad',0,0,'C');
      $this->Cell(53,10,'Paciente',0,0,'C');
      
      $this->Cell(40,10,'Estudio',0,0,'C');
      //$this->Cell(35,10,'Recoleccion',0,0,'C');
      $this->Cell(48,10,'Dx',0,0,'C');
      $this->Cell(27,10,'Datos Clinicos',0,0,'L');
      $this->Ln(1);
      $this->Cell(250,10,'_______________________________________________________________________________________________________________________________________________________________________________________________',0,0,'L');
      // Salto de línea
      $this->Ln(5);
  }

  // Pie de página
  function Footer()
  {
      $this->SetTextColor(0,0,0);
      // Posición: a 1,5 cm del final
      $this->SetY(-15);
      // Arial italic 8
      $this->SetFont('Arial','I',8);
      // Número de página
      $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
  }
}

// Creación del objeto de la clase heredada
$pdf = new PDF('L','mm','Letter');
$pdf->SetAutoPageBreak(true,25);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$numero='1';

  $sql = " 
  SELECT 
  s.`desc_corta`,
  DATE(t.`fecha_toma`) AS fecha,
  -- time(t.`fecha_toma`) as tiempo,
  TIME(t.fecha_toma) AS hora,
  t.fk_id_factura,
  es.`iniciales`,
  CONCAT(cl.nombre,' ',cl.`a_paterno`,' ',cl.`a_materno`) AS paciente,
  cl.`fecha_nac`,
  cl.`anios`,
  cl.`meses`,
  cl.`dias`,
  fa.diagnostico,
  fa.datos_clinicos
  FROM tm_tomas t
  LEFT OUTER JOIN vw_resultado r ON (r.fk_id_factura = t.`fk_id_factura` AND r.`fk_id_estudio` = t.`fk_id_estudio`),
  km_estudios es,
  kg_sucursales s,
  so_factura fa,
  so_clientes cl
  WHERE t.`fk_id_estudio` = es.`id_estudio`
  AND t.`fk_id_sucursal` = s.`id_sucursal`
  AND t.`fk_id_factura` = fa.`id_factura`
  AND fa.`fk_id_cliente` = cl.`id_cliente`
  AND t.`aplico` = 'S'
  AND DATE(t.fecha_toma) = '$fecha'
  AND HOUR(t.`fecha_toma`) >= $hora
  ORDER BY 1,2,3
";
//echo $sql;
$sucursal='';
$num_muestras=0;
$v_nombre=' ';
if ($result = mysqli_query($con, $sql)) {
  //$pdf->Ln(5);
  $pdf->SetTextColor(0,0,0);
  $pdf->SetFont('Arial','B',8);
  //$pdf->Cell(175,10,'PETICIONES EN CURSO',0,0,'C');
  while($row = $result->fetch_assoc())
      {


        $pdf->Ln(4);
        $pdf->SetFont('Courier','',7);
	      $pdf->Cell(10,5,$row['desc_corta'],0,0,'L');
	      $pdf->SetFont('Courier','',8);
        $pdf->Cell(18,5,$row['fk_id_factura'],0,0,'L');
        $pdf->Cell(19,5,$row['fecha'],0,0,'L');
        $pdf->Cell(18,5,$row['hora'],0,0,'L');
        $pdf->Cell(18,5,'A'.$row['anios'].'M'.$row['meses'].'D'.$row['dias'],0,0,'L');
        //if ($v_nombre <> $row['paciente'])
        //{
        $pdf->Cell(60,5,utf8_decode(strtolower(substr($row['paciente'],0,55))),0,0,'L');
        //  $v_nombre = $row['paciente'];
        //}else
        //{
        //  $pdf->Cell(65,5,' ',0,0,'L');
        //}
        
        $pdf->Cell(25,5,utf8_decode(substr($row['iniciales'],0,15)),0,0,'L');
        //$pdf->cell(40,5,utf8_decode(substr($row['desc_muestra'],0,20)),0,0,'L');
        $pdf->Cell(40,5,substr(utf8_decode($row['diagnostico']),0,20),0,0,'L');
        $pdf->Cell(40,5,substr(utf8_decode($row['datos_clinicos']),0,20),0,0,'L');
        $num_muestras=$num_muestras+1;
        }
        $pdf->Ln(10);
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(45,5,"Total de muestras = ".$num_muestras,0,0,'L');
		$pdf->Cell(45,5,"Elaboro: ".$id_usuario,0,0,'L');
    }    


$pdf->Output();

?>