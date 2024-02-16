<?php
session_start();
date_default_timezone_set('America/Mexico_City');
header('Content-Type: text/html; charset=ISO-8859-1');
require('../../fpdf/fpdf.php');
require_once ("../../so_factura/config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../../so_factura/config/conexion.php");//Contiene funcion que conecta a la base de datos

//$fk_id_sucursal=$_SESSION['fk_id_sucursal'];
$id_usuario=$_SESSION['id_usuario'];
$clave=$_SESSION['clave'];
$desc_area=$_SESSION['desc_area'];
$fecha=$_SESSION['fecha'];
//$usr_1=$_GET['nombre'];
//echo $usr_1;

//$tulye = $_GET['tulye'];

$query = "
SELECT 
CONCAT(us.`nombre`,' ',us.`a_paterno`,' ',us.`a_materno`) AS usuario
FROM 
se_usuarios us
WHERE us.`id_usuario` = $id_usuario
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

    global $usuario, $desc_area, $clave;
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
      switch ($clave) {
        case 'QC':      
          $this->Cell(240,5,'LABORATORIOS CLINICOS ARCA',0,0,'C');
          $this->Ln(5);
          $this->SetFont('Arial','B',12);
          $this->Cell(142,10,'LISTA DE TRABAJO',0,0,'R');
          $this->Cell(120,10,'AR-F001',0,0,'R');
          $this->Ln(10);
          $this->SetFont('Arial','B',10);
          $this->Cell(10,10,'Area: ',0,0,'L');
          $this->SetFont('Arial','',9);
          $this->Cell(30,10,utf8_decode(trim($desc_area)),0,0,'L');

          $this->SetFont('Arial','B',10);
          $this->Cell(25,10,'Responsable: ',0,0,'L');
          $this->SetFont('Arial','',9);
          $this->Cell(20,10,trim($usuario),0,0,'L');

          $this->Cell(105);
          $this->Cell(20,10,utf8_decode($fecha).' '.strftime("y son las %H:%M"),0,0,'L');
          $this->Ln(1);
          $this->Cell(250,10,'____________________________________________________________________________________________________________________________________________________',0,0,'L');
          $this->Ln(4);
          $this->SetFont('Arial','B',7);

          $this->Cell(10,10,'Suc',0,0,'C');
          $this->Cell(17,10,'Folio',0,0,'C');
          $this->Cell(12,10,'Edad',0,0,'C');
          $this->Cell(45,10,'Paciente',0,0,'C');
          
          $this->Cell(70,10,'Estudio',0,0,'C');
          $this->Cell(55,10,'Diagnostico',0,0,'L');
          $this->Cell(35,10,'Observaciones',0,0,'L');
          $this->Ln(1);
          $this->Cell(250,10,'_______________________________________________________________________________________________________________________________________________________________________________________________',0,0,'L');
          // Salto de línea
          $this->Ln(5);
          break;
        case 'BA': 
          $this->Cell(150,5,'LABORATORIOS CLINICOS ARCA',0,0,'C');
          $this->Ln(5);
          $this->SetFont('Arial','B',12);
          $this->Cell(150,10,'LISTA DE TRABAJO',0,0,'C');
          $this->Cell(80,10,'AR-F001',0,0,'R');
          $this->Ln(10);
          $this->SetFont('Arial','B',10);
          $this->Cell(10,10,'Area: ',0,0,'L');
          $this->SetFont('Arial','',9);
          $this->Cell(30,10,utf8_decode(trim($desc_area)),0,0,'L');

          $this->SetFont('Arial','B',10);
          $this->Cell(25,10,'Responsable: ',0,0,'L');
          $this->SetFont('Arial','',9);
          $this->Cell(20,10,trim($usuario),0,0,'L');

          $this->Cell(40);
          $this->Cell(20,10,utf8_decode($fecha).' '.strftime("y son las %H:%M"),0,0,'L');
          // $this->Cell(20,10,strftime("Hoy es %A y son las %H:%M"));
          $this->Ln(1);
          $this->Cell(250,10,'__________________________________________________________________________________________________________________',0,0,'L');
          $this->Ln(4);           
            
        case 'HM':      
            $this->Cell(240,5,'LABORATORIOS CLINICOS ARCA',0,0,'C');
            $this->Ln(5);
            $this->SetFont('Arial','B',12);
            $this->Cell(142,10,'LISTA DE TRABAJO',0,0,'R');
            $this->Cell(120,10,'AR-F001',0,0,'R');
            $this->Ln(10);
            $this->SetFont('Arial','B',10);
            $this->Cell(10,10,'Area: ',0,0,'L');
            $this->SetFont('Arial','',9);
            $this->Cell(30,10,utf8_decode(trim($desc_area)),0,0,'L');
  
            $this->SetFont('Arial','B',10);
            $this->Cell(25,10,'Responsable: ',0,0,'L');
            $this->SetFont('Arial','',9);
            $this->Cell(20,10,trim($usuario),0,0,'L');
  
            $this->Cell(105);
            $this->Cell(20,10,utf8_decode($fecha).' '.strftime("y son las %H:%M"),0,0,'L');
            $this->Ln(1);
            $this->Cell(250,10,'____________________________________________________________________________________________________________________________________________________',0,0,'L');
            $this->Ln(4);
            $this->SetFont('Arial','B',7);
  
            $this->Cell(10,10,'Suc',0,0,'C');
            $this->Cell(17,10,'Folio',0,0,'C');
            $this->Cell(12,10,'Edad',0,0,'C');
            $this->Cell(55,10,'Paciente',0,0,'C');

            $this->SetFont('Arial','',6);
            $this->Cell(7,10,'CH',0,0,'C');
            $this->Cell(9,10,'VSG',0,0,'C');
            $this->Cell(9,10,'G.RH',0,0,'C'); //GPO. y RH.
            $this->Cell(9,10,'RETIS',0,0,'C');
            $this->Cell(9,10,'OTROS',0,0,'C');
            $this->Cell(55,10,'Datos CLinicos',0,0,'C');
            $this->Cell(35,10,'Observaciones',0,0,'C');
            $this->Ln(1);
            $this->Cell(250,10,'_______________________________________________________________________________________________________________________________________________________________________________________________',0,0,'L');
            // Salto de línea
            $this->Ln(5);
            break;
        case 'BA': 
              $this->Cell(150,5,'LABORATORIOS CLINICOS ARCA',0,0,'C');
              $this->Ln(5);
              $this->SetFont('Arial','B',12);
              $this->Cell(150,10,'LISTA DE TRABAJO',0,0,'C');
              $this->Cell(80,10,'AR-F001',0,0,'R');
              $this->Ln(10);
              $this->SetFont('Arial','B',10);
              $this->Cell(10,10,'Area: ',0,0,'L');
              $this->SetFont('Arial','',9);
              $this->Cell(30,10,utf8_decode(trim($desc_area)),0,0,'L');
    
              $this->SetFont('Arial','B',10);
              $this->Cell(25,10,'Responsable: ',0,0,'L');
              $this->SetFont('Arial','',9);
              $this->Cell(20,10,trim($usuario),0,0,'L');
    
              $this->Cell(40);
              $this->Cell(20,10,utf8_decode($fecha).' '.strftime("y son las %H:%M"),0,0,'L');
              // $this->Cell(20,10,strftime("Hoy es %A y son las %H:%M"));
              $this->Ln(1);
              $this->Cell(250,10,'__________________________________________________________________________________________________________________',0,0,'L');
              $this->Ln(4);    
          case 'IN':      
              $this->Cell(240,5,'LABORATORIOS CLINICOS ARCA',0,0,'C');
              $this->Ln(5);
              $this->SetFont('Arial','B',12);
              $this->Cell(142,10,'LISTA DE TRABAJO',0,0,'R');
              $this->Cell(120,10,'AR-F001',0,0,'R');
              $this->Ln(10);
              $this->SetFont('Arial','B',10);
              $this->Cell(10,10,'Area: ',0,0,'L');
              $this->SetFont('Arial','',9);
              $this->Cell(30,10,utf8_decode(trim($desc_area)),0,0,'L');
    
              $this->SetFont('Arial','B',10);
              $this->Cell(25,10,'Responsable: ',0,0,'L');
              $this->SetFont('Arial','',9);
              $this->Cell(20,10,trim($usuario),0,0,'L');
    
              $this->Cell(105);
              $this->Cell(20,10,utf8_decode($fecha).' '.strftime("y son las %H:%M"),0,0,'L');
              $this->Ln(1);
              $this->Cell(250,10,'____________________________________________________________________________________________________________________________________________________',0,0,'L');
              $this->Ln(4);
              $this->SetFont('Arial','B',7);
    
              $this->Cell(10,10,'Suc',0,0,'C');
              $this->Cell(17,10,'Folio',0,0,'C');
              $this->Cell(12,10,'Edad',0,0,'C');
              $this->Cell(52,10,'Paciente',0,0,'C');
              
              $this->Cell(30,10,'COAGULACION',0,0,'C');
              $this->Cell(30,10,'P. RAPIDAS',0,0,'L');
              $this->Cell(37,10,'R. FEBRILES',0,0,'L');
              $this->Cell(30,10,'P. REUMATICO',0,0,'L');
              $this->Cell(35,10,'Observaciones',0,0,'L');
              $this->Ln(5);
              $this->Cell(92);
              $this->Cell(30,10,'TP  INR  TPT  TC  TS',0,0,'LC');
              $this->Cell(20,10,'HIV  VDRL',0,0,'L');
              $this->Cell(45,10,'S.AH  S.BH  S.H.  S.O.  P.OX B.A.',0,0,'L');
              $this->Cell(30,10,'PCR.  FR. AEL A.U.',0,0,'L');
              $this->Ln(1);
              $this->Cell(250,10,'_______________________________________________________________________________________________________________________________________________________________________________________________',0,0,'L');
              // Salto de línea
              $this->Ln(5);
              break;
          case 'UR':      
            $this->Cell(240,5,'LABORATORIOS CLINICOS ARCA',0,0,'C');
            $this->Ln(5);
            $this->SetFont('Arial','B',12);
            $this->Cell(142,10,'LISTA DE TRABAJO',0,0,'R');
            $this->Cell(120,10,'AR-F001',0,0,'R');
            $this->Ln(10);
            $this->SetFont('Arial','B',10);
            $this->Cell(10,10,'Area: ',0,0,'L');
            $this->SetFont('Arial','',9);
            $this->Cell(30,10,utf8_decode(trim($desc_area)),0,0,'L');

            $this->SetFont('Arial','B',10);
            $this->Cell(25,10,'Responsable: ',0,0,'L');
            $this->SetFont('Arial','',9);
            $this->Cell(20,10,trim($usuario),0,0,'L');

            $this->Cell(105);
            $this->Cell(20,10,utf8_decode($fecha).' '.strftime("y son las %H:%M"),0,0,'L');
            $this->Ln(1);
            $this->Cell(250,10,'____________________________________________________________________________________________________________________________________________________',0,0,'L');
            $this->Ln(4);
            $this->SetFont('Arial','B',7);

            $this->Cell(10,10,'Suc',0,0,'C');
            $this->Cell(17,10,'Folio',0,0,'C');
            $this->Cell(12,10,'Edad',0,0,'C');
            $this->Cell(45,10,'Paciente',0,0,'C');
            $this->Ln(5);
            $this->Cell(1);
            $this->SetFont('Arial','',6);
            $this->Cell(7,10,'D',0,0,'C');
            $this->Cell(7,10,'PH',0,0,'C');
            $this->Cell(7,10,'LEU',0,0,'C');
            $this->Cell(7,10,'NCT',0,0,'CL');
            $this->Cell(7,10,'POT',0,0,'CL');
            $this->Cell(7,10,'GLU',0,0,'CL');
            $this->Cell(7,10,'CCT',0,0,'CL');
            $this->Cell(7,10,'UNO',0,0,'CL');
            $this->Cell(7,10,'BIL',0,0,'C');
            $this->Cell(7,10,'RGB',0,0,'C');
            $this->Cell(7,10,'CG',0,0,'C');
            $this->Cell(7,10,'CIL',0,0,'C');
            $this->Cell(7,10,'UL',0,0,'C');
            $this->Cell(7,10,'SAN',0,0,'C');
            $this->Cell(7,10,'COL',0,0,'C');
            $this->Cell(7,10,'OL',0,0,'C');
            $this->Cell(7,10,'ASA',0,0,'C');
            $this->Cell(7,10,'SED',0,0,'C');
            $this->Cell(7,10,'ASA',0,0,'C');
            $this->Cell(7,10,'CEL',0,0,'C');
            $this->Cell(7,10,'BAC',0,0,'C');
            $this->Cell(7,10,'LEU',0,0,'C');
            $this->Cell(7,10,'ERI',0,0,'C');
            $this->Cell(7,10,'PIO',0,0,'C');
            $this->Cell(7,10,'FM',0,0,'C');
            $this->Cell(7,10,'CC',0,0,'C');
            $this->Cell(7,10,'LEV',0,0,'C');
            $this->Cell(7,10,'CER',0,0,'C');
            $this->Cell(7,10,'GPR',0,0,'C');
            $this->Cell(7,10,'THD',0,0,'C');
            $this->Cell(7,10,'OX',0,0,'C');
            $this->Cell(7,10,'AU',0,0,'C');
            $this->Cell(7,10,'HIF',0,0,'C');
            $this->Cell(7,10,'FT',0,0,'C');
            $this->Cell(7,10,'FA',0,0,'C');
            $this->Cell(7,10,'UA',0,0,'C');
            $this->Cell(7,10,'CH',0,0,'C');
            $this->Cell(7,10,'CG',0,0,'C');
           // $this->Cell(7,10,'CL',0,0,'C');
           // $this->Cell(7,10,'CC',0,0,'C');
           // $this->Cell(7,10,'CLB',0,0,'C');
            $this->Ln(1);
            $this->Cell(250,10,'_________________________________________________________________________________________________________________________________________________________________________________________________________________________________',0,0,'L');
            // Salto de línea
            $this->SetFont('Arial','B',7);
            $this->Ln(5);
            break;
        default:
          # code...
          break;
      }
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
switch ($clave) {
  case 'QC':
    $pdf = new PDF('L','mm','Letter');
    break;
  case 'BA':
    $pdf = new PDF('P','mm','Letter');
    break;  
  case 'HM':
      $pdf = new PDF('L','mm','Letter');
      break;
  case 'IN':
    $pdf = new PDF('L','mm','Letter');
    break;
  case 'UR':
    $pdf = new PDF('L','mm','Letter');
    break;
  default:
    # code...
    break;
}

$pdf->SetAutoPageBreak(true,25);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$numero='1';




$sql = " 
SELECT 
DISTINCT
o.orden,
su.`desc_corta`,
fa.`id_factura`,
date(fa.fecha_factura) as fecha_factura,
-- CONCAT('A',cl.`anios`,'M',cl.`meses`,'D',cl.`dias`) AS edad,
CASE
WHEN cl.anios = 0 AND cl.meses = 0 AND cl.dias > 0 THEN
CONCAT(cl.dias,'D')
WHEN cl.anios = 0 AND cl.meses > 0 THEN
CONCAT(cl.meses,'M')
WHEN cl.anios > 0 THEN
CONCAT(cl.anios,'A')
END AS edad,
CONCAT(cl.`nombre`,' ',cl.`a_paterno`,' ',cl.`a_materno`) AS paciente,
es.id_estudio,
es.`iniciales`,
fa.observaciones,
fa.diagnostico,
date(tm.fecha_toma) as fecha_toma,
' ' as ceva
FROM 
tm_tomas tm,
km_estudios_area ea,
so_factura fa,
kg_sucursales su,
so_clientes cl,
km_estudios es,
vw_tm_orden o
WHERE DATE(tm.`fecha_toma`) = '$fecha' -- curdate()
AND tm.`fk_id_estudio` = ea.`fk_id_estudio`
AND tm.check_in = 1
AND tm.fk_id_rechazo_area IS NULL 
AND ea.`fk_id_clave_area` = '$clave'
AND tm.`fk_id_factura` = fa.`id_factura`
AND fa.`fk_id_sucursal` = su.`id_sucursal`
AND fa.`fk_id_cliente` = cl.`id_cliente`
AND tm.`fk_id_estudio` = es.`id_estudio`
AND tm.`fk_id_sucursal` = o.`sucursal` AND ea.`fk_id_clave_area` = o.`fk_id_clave` AND o.`fk_id_usuario` = $id_usuario
AND o.imprime = 1
order BY 1 asc,2,6
-- limit 1
";
//echo $sql;

$sucursal='';
$num_muestras=0;
$v_nombre=' ';
$registro=1;

$renglon=33;
$columna=10;


if ($result = mysqli_query($con, $sql)) {
//$pdf->Ln(5);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','B',8);
//$pdf->Cell(175,10,'PETICIONES EN CURSO',0,0,'C');
while($row = $result->fetch_assoc())
  {
      $id_factura = $row['id_factura'];
      $id_estudio = $row['id_estudio'];
      $fecha_toma = $row['fecha_toma'];   
      switch ($clave) {
        case 'QC':

            $pdf->Ln(4);
            $pdf->SetFont('Courier','',7);
            $pdf->Cell(10,5,$row['desc_corta'],0,0,'L');
            $pdf->Cell(17,5,$row['id_factura'],0,0,'L');
            $pdf->Cell(18,5,$row['edad'],0,0,'C');
            if ($v_nombre <> $row['paciente'])
            {
              $pdf->Cell(60,5,utf8_decode(strtolower(substr($row['paciente'],0,55))),0,0,'L');
              $v_nombre = $row['paciente'];
            }else
            {
              $pdf->Cell(60,5,' ',0,0,'L');
            }
              
            $pdf->Cell(40,5,utf8_decode(substr($row['iniciales'],0,15)),0,0,'L');
            $pdf->Cell(20,5,utf8_decode($row['diagnostico']),0,0,'L');
            $num_muestras=$num_muestras+1;
            break;
        case 'BA':

          $pdf->SetXY($columna,$renglon);
          //$renglon=$renglon-40;
          $pdf->SetFont('Courier','',8);
          $pdf->Cell(19,5,$row['id_factura'],0,0,'L');
          $pdf->Cell(9,5,$row['desc_corta'],0,0,'L');
          $pdf->Cell(60,5,utf8_decode(strtolower(substr($row['paciente'],0,55)))." ".$row['edad'],0,0,'L');
          break;
        case 'HM':

            $pdf->Ln(4);
            $pdf->SetFont('Courier','',7);
            $pdf->Cell(10,5,$row['desc_corta'],0,0,'L');
            $pdf->Cell(17,5,$row['id_factura'],0,0,'L');
            $pdf->Cell(18,5,$row['edad'],0,0,'C');
            if ($v_nombre <> $row['paciente'])
            {
              $pdf->Cell(50,5,utf8_decode(strtolower(substr($row['paciente'],0,55))),0,0,'L');
              $v_nombre = $row['paciente'];
            }else
            {
              $pdf->Cell(60,5,' ',0,0,'L');
            }
            
            $pdf->Cell(8,5,$row['ceva'],'L,T,R,B');
            $pdf->Cell(8,5,$row['ceva'],'L,T,R,B');
            $pdf->Cell(8,5,$row['ceva'],'L,T,R,B');
            $pdf->Cell(8,5,$row['ceva'],'L,T,R,B');
            $pdf->Cell(8,5,$row['ceva'],'L,T,R,B');
           // $pdf->Cell(8,5,$row['ceva'],'L,T,R,B');
            //$pdf->Cell(40,5,utf8_decode(substr($row['iniciales'],0,15)),0,0,'L');
            $pdf->Cell(20,5,utf8_decode($row['diagnostico']),0,0,'L');
            $num_muestras=$num_muestras+1;
            break;
        case 'IN':

          $pdf->Ln(4);
          $pdf->SetFont('Courier','',7);
          $pdf->Cell(10,5,$row['desc_corta'],0,0,'L');
          $pdf->Cell(17,5,$row['id_factura'],0,0,'L');
          $pdf->Cell(18,5,$row['edad'],0,0,'C');
          if ($v_nombre <> $row['paciente'])
          {
            $pdf->Cell(96,5,utf8_decode(strtolower(substr($row['paciente'],0,55))),0,0,'L');
            $v_nombre = $row['paciente'];
          }else
          {
            $pdf->Cell(60,5,' ',0,0,'L');
          }
            
          //$pdf->Cell(40,5,utf8_decode(substr($row['iniciales'],0,15)),0,0,'L');
         // $pdf->Cell(20,5,utf8_decode($row['diagnostico']),0,0,'L');
          $num_muestras=$num_muestras+1;
          break;
        case 'UR':
            $pdf->Ln(4);
            $pdf->SetFont('Courier','',7);
            $pdf->Cell(10,5,$row['desc_corta'],0,0,'L');
            $pdf->Cell(17,5,$row['id_factura'],0,0,'L');
            $pdf->Cell(18,5,$row['edad'],0,0,'C');
            if ($v_nombre <> $row['paciente'])
            {
              $pdf->Cell(60,5,utf8_decode(strtolower(substr($row['paciente'],0,55))),0,0,'L');
              $v_nombre = $row['paciente'];
            }else
            {
              $pdf->Cell(60,5,' ',0,0,'L');
            }
            //$pdf->Cell(40,5,utf8_decode(substr($row['iniciales'],0,15)),0,0,'L');
            //$pdf->Cell(20,5,utf8_decode($row['diagnostico']),0,0,'L');
            $pdf->Ln(4);
            //$pdf->SetFillColor(255,255,255);
            //$pdf->SetDrawColor(243,245,244);
          //  $pdf->Rect(12, 49.7,95,35);
            $pdf->Cell(7,5,$row['ceva'],'L,T,R,B');
            $pdf->Cell(7,5,$row['ceva'],'L,T,R,B');
            $pdf->Cell(7,5,$row['ceva'],'L,T,R,B');
            $pdf->Cell(7,5,$row['ceva'],'L,T,R,B');
            $pdf->Cell(7,5,$row['ceva'],'L,T,R,B');
            $pdf->Cell(7,5,$row['ceva'],'L,T,R,B');
            $pdf->Cell(7,5,$row['ceva'],'L,T,R,B');
            $pdf->Cell(7,5,$row['ceva'],'L,T,R,B');
            $pdf->Cell(7,5,$row['ceva'],'L,T,R,B');
            $pdf->Cell(7,5,$row['ceva'],'L,T,R,B');
            $pdf->Cell(7,5,$row['ceva'],'L,T,R,B');
            $pdf->Cell(7,5,$row['ceva'],'L,T,R,B');
            $pdf->Cell(7,5,$row['ceva'],'L,T,R,B');
            $pdf->Cell(7,5,$row['ceva'],'L,T,R,B');
            $pdf->Cell(7,5,$row['ceva'],'L,T,R,B');
            $pdf->Cell(7,5,$row['ceva'],'L,T,R,B');
            $pdf->Cell(7,5,$row['ceva'],'L,T,R,B');
            $pdf->Cell(7,5,$row['ceva'],'L,T,R,B');
            $pdf->Cell(7,5,$row['ceva'],'L,T,R,B');
            $pdf->Cell(7,5,$row['ceva'],'L,T,R,B');
            $pdf->Cell(7,5,$row['ceva'],'L,T,R,B');
            $pdf->Cell(7,5,$row['ceva'],'L,T,R,B');
            $pdf->Cell(7,5,$row['ceva'],'L,T,R,B');
            $pdf->Cell(7,5,$row['ceva'],'L,T,R,B');
            $pdf->Cell(7,5,$row['ceva'],'L,T,R,B');
            $pdf->Cell(7,5,$row['ceva'],'L,T,R,B');
            $pdf->Cell(7,5,$row['ceva'],'L,T,R,B');
            $pdf->Cell(7,5,$row['ceva'],'L,T,R,B');
            $pdf->Cell(7,5,$row['ceva'],'L,T,R,B');
            $pdf->Cell(7,5,$row['ceva'],'L,T,R,B');
            $pdf->Cell(7,5,$row['ceva'],'L,T,R,B');
            $pdf->Cell(7,5,$row['ceva'],'L,T,R,B');
            $pdf->Cell(7,5,$row['ceva'],'L,T,R,B');
            $pdf->Cell(7,5,$row['ceva'],'L,T,R,B');
            $pdf->Cell(7,5,$row['ceva'],'L,T,R,B');
            $pdf->Cell(7,5,$row['ceva'],'L,T,R,B');
            $pdf->Cell(7,5,$row['ceva'],'L,T,R,B');
            $pdf->Cell(7,5,$row['ceva'],'L,T,R,B');
           // $pdf->Cell(3);
            //$pdf->Cell(250,10,'____________________________________________________________________________________________________________________________________________________',0,0,'L');
            $num_muestras=$num_muestras+1;
            break;
        default:
            # code...
            break;
      }      
    $sql_update=
    "
    UPDATE tm_tomas
    SET check_in_area = 2
    where fk_id_factura = $id_factura
    AND fk_id_estudio = $id_estudio
    and date(fecha_toma) = '$fecha_toma'
    ";
    //echo $sql_update;
    $execute_query_update = mysqli_query($con,$sql_update);  
    $registro=$registro+1;

    if ($registro % 2==0){
      //echo "El $numero es par";
    }else{
    //  echo "El $numero es impar";
    }

  }
}
  $pdf->Ln(10);
  $pdf->SetFont('Arial','B',9);
  $pdf->Cell(45,5,"Total de muestras = ".$num_muestras,0,0,'L');
  $pdf->Cell(45,5,"Elaboro: ".$id_usuario,0,0,'L');

    


$pdf->Output();

?>