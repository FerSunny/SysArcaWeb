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
//$usr_1=$_GET['nombre'];
//echo $usr_1;
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
          // $this->Cell(20,10,strftime("Hoy es %A y son las %H:%M"));
          $this->Ln(1);
          $this->Cell(250,10,'____________________________________________________________________________________________________________________________________________________',0,0,'L');
          $this->Ln(4);
          $this->SetFont('Arial','B',7);

          $this->Cell(10,10,'Suc',0,0,'C');
          $this->Cell(11,10,'Folio',0,0,'C');
          $this->Cell(12,10,'Edad',0,0,'C');
          $this->Cell(53,10,'Paciente',0,0,'C');
          
          $this->Cell(50,10,'Estudio',0,0,'C');
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
su.`desc_corta`,
fa.`id_factura`,
date(fa.fecha_factura) as fecha_factura,
CONCAT('A',cl.`anios`,'M',cl.`meses`,'D',cl.`dias`) AS edad,
CONCAT(cl.`nombre`,' ',cl.`a_paterno`,' ',cl.`a_materno`) AS paciente,
es.id_estudio,
es.`iniciales`,
fa.observaciones,
date(tm.fecha_toma) as fecha_toma
FROM 
tm_tomas tm,
km_estudios_area ea,
so_factura fa,
kg_sucursales su,
so_clientes cl,
km_estudios es 
WHERE DATE(tm.`fecha_toma`) = '2022-10-01' -- curdate()
AND tm.`fk_id_estudio` = ea.`fk_id_estudio`
AND tm.check_in = 1
AND ea.`fk_id_clave_area` = '$clave'
AND tm.`fk_id_factura` = fa.`id_factura`
AND fa.`fk_id_sucursal` = su.`id_sucursal`
AND fa.`fk_id_cliente` = cl.`id_cliente`
AND tm.`fk_id_estudio` = es.`id_estudio`
order by 1,2
limit 1
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
            $pdf->SetFont('Courier','',8);
            $pdf->Cell(13,5,$row['id_factura'],0,0,'L');
            $pdf->Cell(18,5,$row['edad'],0,0,'L');
            if ($v_nombre <> $row['paciente'])
            {
              $pdf->Cell(60,5,utf8_decode(strtolower(substr($row['paciente'],0,55))),0,0,'L');
              $v_nombre = $row['paciente'];
            }else
            {
              $pdf->Cell(60,5,' ',0,0,'L');
            }
              
            $pdf->Cell(40,5,utf8_decode(substr($row['iniciales'],0,15)),0,0,'L');
            $pdf->Cell(20,5,utf8_decode($row['observaciones']),0,0,'L');
            $num_muestras=$num_muestras+1;
            break;
        case 'BA':

          $pdf->SetXY($columna,$renglon);
          //$renglon=$renglon-40;
          $pdf->SetFont('Courier','',8);
          $pdf->Cell(19,5,$row['id_factura'],0,0,'L');
          $pdf->Cell(9,5,$row['desc_corta'],0,0,'L');
          $pdf->Cell(60,5,utf8_decode(strtolower(substr($row['paciente'],0,55)))." ".$row['edad'],0,0,'L');
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