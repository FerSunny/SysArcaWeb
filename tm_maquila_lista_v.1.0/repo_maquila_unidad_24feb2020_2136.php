<?php
session_start();
date_default_timezone_set('America/Mexico_City');
header('Content-Type: text/html; charset=ISO-8859-1');
require('../fpdf/fpdf.php');
require_once ("../so_factura/config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../so_factura/config/conexion.php");//Contiene funcion que conecta a la base de datos

//$fk_id_sucursal=$_SESSION['fk_id_sucursal'];
$id_usuario=$_SESSION['nombre'];
//$usr_1=$_GET['nombre'];
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
AND id_usr= '" . $id_usuario . "' ";
//echo $query;
$resultado = mysqli_query($con, $query);

if($row = mysqli_fetch_array($resultado))
{
  $sucursal=$row['desc_sucursal'];
  $fk_id_sucursal=$row['fk_id_sucursal'];
}

class PDF extends FPDF
{
// Cabecera de página
  function Header()
  {

    global $sucursal;
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
      $this->Cell(240,5,'LABORATORIOS ARCA',0,0,'C');
      $this->Ln(5);
      $this->SetFont('Arial','B',12);
      $this->Cell(142,10,'AGENDA DEL DIA',0,0,'R');
      $this->Cell(120,10,'AR-F001',0,0,'R');
      $this->Ln(10);
      $this->SetFont('Arial','B',10);
      $this->Cell(53,10,'GENERADO POR LA UNIDAD: ',0,0,'L');
      $this->SetFont('Arial','',9);
      $this->Cell(20,10,$sucursal,0,0,'L');
      $this->Cell(120);
      $this->Cell(20,10,utf8_decode($fecha).' '.strftime("y son las %H:%M"),0,0,'L');
      // $this->Cell(20,10,strftime("Hoy es %A y son las %H:%M"));
      $this->Ln(1);
      $this->Cell(250,10,'____________________________________________________________________________________________________________________________________________________',0,0,'L');
      $this->Ln(4);
      $this->SetFont('Arial','B',7);
	  $this->Cell(17,10,'LOTE',0,0,'C');
      $this->Cell(11,10,'FOLIO',0,0,'C');
      $this->Cell(10,10,'EDAD',0,0,'C');
      $this->Cell(53,10,'PACIENTE',0,0,'C');
      
      $this->Cell(50,10,'ESTUDIO',0,0,'C');
      $this->Cell(40,10,'RECOLECCION',0,0,'C');
      $this->Cell(48,10,'DX',0,0,'C');
      $this->Cell(27,10,'FECHA ENTREGA',0,0,'L');
      $this->Cell(5,10,'EGA',0,0,'C');
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

  $sql = " SELECT     su.desc_corta AS sucursal,
    tm.`fk_id_factura`,
    cl.`anios`,
    CONCAT(cl.`nombre`,' ',cl.`a_paterno`,' ',cl.`a_materno`) AS nombre,
    substr(es.`iniciales`,1,25) as iniciales,
    substr(mu.`recoleccion`,1,225) as recoleccion,
    fa.`diagnostico`,
    date(fa.`fecha_entrega`) as fecha_entrega,
    CASE
        WHEN fa.`email_medico` = 0 AND fa.email_paciente = 0 THEN
            'VE'
        WHEN fa.`email_medico` = 0 AND fa.email_paciente <> 0 THEN
            'MP'   
        WHEN fa.`email_medico` <> 0 AND fa.email_paciente = 0 THEN
            'MM'   
        ELSE
            'DE'
    END AS via,
	tm.fk_id_usuario,
	tm.lote
        
FROM tm_tomas tm, so_factura fa, so_clientes cl, km_estudios es, km_muestras mu, kg_sucursales su
 WHERE fa.fk_id_sucursal > 0 
AND date(tm.fecha_toma) >=  CURDATE()
AND tm.`fk_id_factura` = fa.`id_factura`
AND fa.`fk_id_cliente` = cl.`id_cliente`
AND tm.`fk_id_estudio` = es.`id_estudio`
AND tm.`fk_id_muestra` = mu.`id_muestra`
AND fa.fk_id_sucursal = su.id_sucursal
AND tm.aplico = 'S'
AND tm.lote <> ''
order by tm.lote
";
//echo $sql;
$sucursal='';
$num_muestras=0;
if ($result = mysqli_query($con, $sql)) {
  //$pdf->Ln(5);
  $pdf->SetTextColor(0,0,0);
  $pdf->SetFont('Arial','B',8);
  //$pdf->Cell(175,10,'PETICIONES EN CURSO',0,0,'C');
  while($row = $result->fetch_assoc())
      {

        $pdf->Ln(4);
        $pdf->SetFont('Courier','',7);
	    $pdf->Cell(18,5,$row['lote'],0,0,'L');
	    $pdf->SetFont('Courier','',9);
        $pdf->Cell(15,5,$row['fk_id_factura'],0,0,'L');
        $pdf->Cell(3,5,$row['anios'],0,0,'R');
        $pdf->Cell(65,5,utf8_decode(strtolower($row['nombre'])),0,0,'L');
        $pdf->Cell(50,5,utf8_decode($row['iniciales']),0,0,'L');
        $pdf->cell(40,5,$row['recoleccion'],0,0,'L');
        $pdf->Cell(40,5,substr($row['diagnostico'],1,20),0,0,'L');
        $pdf->Cell(25,5,$row['fecha_entrega'],0,0,'L');
        $pdf->Cell(30,5,$row['via'],0,0,'L');
        $num_muestras=$num_muestras+1;
        }
        $pdf->Ln(10);
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(45,5,"Total de muestras = ".$num_muestras,0,0,'L');
		$pdf->Cell(45,5,"Elaboro: ".$id_usuario,0,0,'L');
    }    


$pdf->Output();

?>