<?php
session_start();
date_default_timezone_set('America/Mexico_City');
header('Content-Type: text/html; charset=ISO-8859-1');
require('../fpdf/fpdf.php');
require_once ("../so_factura/config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../so_factura/config/conexion.php");//Contiene funcion que conecta a la base de datos

//$fk_id_sucursal=$_SESSION['fk_id_sucursal'];
$usr_1=$_SESSION['nombre'];
//$usr_1=$_GET['usuario'];
//echo $usr_1;
$query = "SELECT
  id_usuario,
  id_usr,
  fk_id_sucursal,
  nombre,
  a_paterno,
  a_materno,
  telefono_fijo,
  telefono_movil,
   us.mail,
  su.desc_sucursal
FROM se_usuarios us 
LEFT OUTER JOIN `kg_sucursales` su ON (su.id_sucursal = us.fk_id_sucursal)
WHERE us.activo = 'A' 
AND id_usr= '" . $usr_1 . "' ";
//echo $query;
$resultado = mysqli_query($con, $query);

if($row = mysqli_fetch_array($resultado))
{
  $sucursal1=$row['desc_sucursal'];
  $fk_id_sucursal=$row['fk_id_sucursal'];
}

class PDF extends FPDF
{
// Cabecera de página
  function Header()
  {

    global $sucursal1;
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
      $this->Cell(170,5,'LABORATORIOS ARCA',0,0,'C');
      $this->Ln(5);
      $this->SetFont('Arial','B',12);
      $this->Cell(175,10,'AGENDA DEL DIA',0,0,'C');
      $this->Ln(10);
      $this->SetFont('Arial','B',10);
      $this->Cell(53,10,'GENERADO POR LA UNIDAD: ',0,0,'L');
      $this->SetFont('Arial','',9);
      $this->Cell(20,10,$sucursal1,0,0,'L');
      $this->Cell(58);
      $this->Cell(20,10,utf8_decode($fecha).' '.strftime("y son las %H:%M"),0,0,'L');
      // $this->Cell(20,10,strftime("Hoy es %A y son las %H:%M"));
      $this->Ln(1);
      $this->Cell(250,10,'_______________________________________________________________________________________________________________',0,0,'L');
      $this->Ln(4);
      $this->SetFont('Arial','B',8);
      $this->Cell(11,10,'FOLIO',0,0,'C');
      $this->Cell(70,10,'NOMBRE',0,0,'C');
      $this->Cell(15,10,'EDAD',0,0,'C');
      
      $this->Cell(30,10,'ESTUDIO',0,0,'C');
      $this->Cell(27,10,'FECHA',0,0,'C');
      $this->Cell(10,10,'HORA',0,0,'C');
      $this->Cell(50,10,'STATUS',0,0,'C');
      $this->Ln(1);
      $this->Cell(250,10,'_____________________________________________________________________________________________________________________________',0,0,'L');
      // Salto de línea
      $this->Ln(10);
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
$pdf = new PDF('P','mm','Letter');
$pdf->SetAutoPageBreak(true,25);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$numero='1';

$sql="  
SELECT  
  CASE
    WHEN re.fk_id_estudio IS NULL THEN
      'Pendiente'
    ELSE
      'Realizado'
        END AS registrado,
  fa.id_factura,
  SUBSTR(CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno),1,33) AS nombre,
  CASE 
  WHEN cl.anios > 0 THEN 
      CONCAT(cl.anios,' Años') 
  WHEN cl.meses > 0 THEN 
      CONCAT(cl.meses,' Meses') 
  WHEN cl.dias > 0 THEN 
      CONCAT(cl.dias,' Dias') 
  END AS edad,
  df.fk_id_estudio,
  es.desc_estudio estudio,
  SUBSTR(es.iniciales,1,15) AS iniciales,
  fa.diagnostico,
  fa.fecha_factura,
  fa.fecha_entrega,
  te.nombre_tipo_estudio AS desc_tipo_estudio,
  su.desc_sucursal AS sucursal
FROM  so_factura fa
LEFT OUTER JOIN kg_sucursales su ON (su.id_sucursal = fa.fk_id_sucursal)
LEFT OUTER JOIN so_clientes cl ON (cl.id_cliente = fa.fk_id_cliente),
  so_detalle_factura df
LEFT OUTER JOIN km_estudios es ON (es.id_estudio = df.fk_id_estudio)
LEFT OUTER JOIN km_tipo_estudio te ON (te.id_tipo_estudio = es.fk_id_tipo_estudio)
LEFT OUTER JOIN vw_resultado re ON (df.id_factura = re.fk_id_factura AND df.fk_id_estudio = re.fk_id_estudio)
WHERE fa.id_factura = df.id_factura
AND DATE(fa.fecha_factura) = CURDATE()
AND es.per_perfil = 'no'
-- and fa.id_factura = 123201
AND te.id_tipo_estudio = 2

union

SELECT
  CASE
    WHEN re.fk_id_estudio IS NULL THEN
      'Pendiente'
    ELSE
      'Realizado'
        END AS registrado,
  fa.id_factura,
  SUBSTR(CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno),1,33) AS nombre,
  CASE 
  WHEN cl.anios > 0 THEN 
      CONCAT(cl.anios,' Años') 
  WHEN cl.meses > 0 THEN 
      CONCAT(cl.meses,' Meses') 
  WHEN cl.dias > 0 THEN 
      CONCAT(cl.dias,' Dias') 
  END AS edad,
  df.fk_id_estudio,
  es.desc_estudio estudio,
  SUBSTR(es.iniciales,1,15) AS iniciales,
  fa.diagnostico,
  fa.fecha_factura,
  fa.fecha_entrega,
  te.nombre_tipo_estudio AS desc_tipo_estudio,
  su.desc_sucursal AS sucursal
FROM so_factura fa,
so_detalle_factura df
LEFT OUTER JOIN vw_resultado re ON (df.id_factura = re.fk_id_factura AND df.fk_id_estudio = re.fk_id_estudio),
km_paquetes pa,
km_estudios es,
kg_sucursales su,
so_clientes cl,
km_tipo_estudio te
WHERE  DATE(fa.fecha_factura) = CURDATE()
AND fa.`estado_factura` <> 5
AND fa.`id_factura` = df.`id_factura`
AND es.`fk_id_tipo_estudio` = '2'
-- and es.`per_paquete` = 'si'
AND df.`fk_id_estudio` = pa.`id_paquete` AND pa.`estado` = 'A'
AND es.`id_estudio` = pa.`fk_id_estudio`
AND fa.`fk_id_sucursal` = su.`id_sucursal`
AND fa.fk_id_cliente = cl.`id_cliente` AND cl.`activo` = 'A'
AND es.fk_id_tipo_estudio = te.id_tipo_estudio
ORDER BY 12,2
";
//echo $sql;
$sucursal='';
if ($result = mysqli_query($con, $sql)) {
  //$pdf->Ln(5);
  $pdf->SetTextColor(0,0,0);
  $pdf->SetFont('Arial','B',9);
  $pdf->Cell(175,10,'PETICIONES EN CURSO',0,0,'C');
  while($row = $result->fetch_assoc())
      {

        if ($sucursal <> $row['sucursal'] ){
          $pdf->SetTextColor(0,0,0);
          $pdf->Ln(5);
          $pdf->SetFont('Arial','B',9);
          $pdf->Cell(15,5,$row['sucursal'],0,0,'L');
          $sucursal=$row['sucursal']; 
        }
        
        if($row['registrado']=='Pendiente'){
          $pdf->SetTextColor(255,0,0);
        }else{
          $pdf->SetTextColor(0,0,0); 
        }
        $pdf->Ln(5);
        $pdf->SetFont('Courier','',9);
        $pdf->Cell(15,5,$row['id_factura'],0,0,'L');
        $pdf->Cell(65,5,utf8_decode(strtolower($row['nombre'])),0,0,'L');
        $pdf->Cell(20,5,utf8_decode($row['edad']),0,0,'L');
        // $pdf->Cell(60,5,$row['estudio'],0,0,'L');
        $pdf->Cell(30,5,$row['iniciales'],0,0,'L');
        $pdf->Cell(50,5,$row['fecha_factura'],0,0,'L');

        $pdf->Cell(30,5,$row['registrado'],0,0,'L');
        if (strlen($row['diagnostico']) > 3){
          $pdf->Ln(4);
          $pdf->Cell(30,5,$row['diagnostico'],0,0,'L');
        }
        
      }
}

// estudios pendientes

$sql1="
SELECT  
  CASE
    WHEN re.fk_id_estudio IS NULL THEN
      'Pendiente'
    ELSE
      'Realizado'
        END AS registrado,
  fa.id_factura,
  SUBSTR(CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno),1,33) AS nombre,
  CASE 
  WHEN cl.anios > 0 THEN 
      CONCAT(cl.anios,' Años') 
  WHEN cl.meses > 0 THEN 
      CONCAT(cl.meses,' Meses') 
  WHEN cl.dias > 0 THEN 
      CONCAT(cl.dias,' Dias') 
  END AS edad,
  df.fk_id_estudio,
  es.desc_estudio estudio,
  SUBSTR(es.iniciales,1,15) AS iniciales,
  fa.diagnostico,
  fa.fecha_factura,
  fa.fecha_entrega,
  te.nombre_tipo_estudio AS desc_tipo_estudio,
  su.desc_sucursal AS sucursal
FROM  so_factura fa
LEFT OUTER JOIN kg_sucursales su ON (su.id_sucursal = fa.fk_id_sucursal)
LEFT OUTER JOIN so_clientes cl ON (cl.id_cliente = fa.fk_id_cliente),
  so_detalle_factura df
LEFT OUTER JOIN km_estudios es ON (es.id_estudio = df.fk_id_estudio)
LEFT OUTER JOIN km_tipo_estudio te ON (te.id_tipo_estudio = es.fk_id_tipo_estudio)
LEFT OUTER JOIN vw_resultado re ON (df.id_factura = re.fk_id_factura AND df.fk_id_estudio = re.fk_id_estudio)
WHERE fa.id_factura = df.id_factura
AND DATE(fa.fecha_factura) BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND DATE_SUB(CURDATE(), INTERVAL 1 DAY)
AND es.per_perfil = 'no'
-- and fa.id_factura = 123201
AND te.id_tipo_estudio = 2

union

SELECT
  CASE
    WHEN re.fk_id_estudio IS NULL THEN
      'Pendiente'
    ELSE
      'Realizado'
        END AS registrado,
  fa.id_factura,
  SUBSTR(CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno),1,33) AS nombre,
  CASE 
  WHEN cl.anios > 0 THEN 
      CONCAT(cl.anios,' Años') 
  WHEN cl.meses > 0 THEN 
      CONCAT(cl.meses,' Meses') 
  WHEN cl.dias > 0 THEN 
      CONCAT(cl.dias,' Dias') 
  END AS edad,
  df.fk_id_estudio,
  es.desc_estudio estudio,
  SUBSTR(es.iniciales,1,15) AS iniciales,
  fa.diagnostico,
  fa.fecha_factura,
  fa.fecha_entrega,
  te.nombre_tipo_estudio AS desc_tipo_estudio,
  su.desc_sucursal AS sucursal
FROM so_factura fa,
so_detalle_factura df
LEFT OUTER JOIN vw_resultado re ON (df.id_factura = re.fk_id_factura AND df.fk_id_estudio = re.fk_id_estudio),
km_paquetes pa,
km_estudios es,
kg_sucursales su,
so_clientes cl,
km_tipo_estudio te
WHERE  DATE(fa.fecha_factura) BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND DATE_SUB(CURDATE(), INTERVAL 1 DAY)
AND fa.`estado_factura` <> 5
AND fa.`id_factura` = df.`id_factura`
AND es.`fk_id_tipo_estudio` = '2'
-- and es.`per_paquete` = 'si'
AND df.`fk_id_estudio` = pa.`id_paquete` AND pa.`estado` = 'A'
AND es.`id_estudio` = pa.`fk_id_estudio`
AND fa.`fk_id_sucursal` = su.`id_sucursal`
AND fa.fk_id_cliente = cl.`id_cliente` AND cl.`activo` = 'A'
AND es.fk_id_tipo_estudio = te.id_tipo_estudio
ORDER BY 12,2
";
//echo $sql1;
$sucursal='';
if ($result1 = mysqli_query($con, $sql1)) {
  $pdf->SetTextColor(0,0,0);
  $pdf->Ln(5);
  $pdf->SetFont('Arial','B',9);
  $pdf->Cell(175,10,'PETICIONES PENDIENTES   (ultimos 7 dias)',0,0,'C');
  while($row1 = $result1->fetch_assoc())
      {
        if ($sucursal <> $row1['sucursal'] ){
          $pdf->SetTextColor(0,0,0);
          $pdf->Ln(5);
          $pdf->SetFont('Arial','B',9);
          $pdf->Cell(15,5,$row1['sucursal'],0,0,'L');
          $sucursal=$row1['sucursal']; 
        }

        if($row1['registrado']=='Pendiente'){
          $pdf->SetTextColor(255,0,0);
        }else{
          $pdf->SetTextColor(0,0,0); 
        }
          
          $pdf->Ln(5);
          $pdf->SetFont('Courier','',9);
          $pdf->Cell(15,5,$row1['id_factura'],0,0,'L');
          $pdf->Cell(65,5,utf8_decode(strtolower($row1['nombre'])),0,0,'L');
          $pdf->Cell(20,5,utf8_decode($row1['edad']),0,0,'L');
          // $pdf->Cell(60,5,$row['estudio'],0,0,'L');
          $pdf->Cell(30,5,$row1['iniciales'],0,0,'L');
          $pdf->Cell(50,5,$row1['fecha_factura'],0,0,'L');

          $pdf->Cell(30,5,$row1['registrado'],0,0,'L');
          if (strlen($row1['diagnostico']) > 3){
            $pdf->Ln(4);
            $pdf->Cell(30,5,utf8_decode($row1['diagnostico']),0,0,'L');
          

        }
      }
}

$pdf->Output();

?>