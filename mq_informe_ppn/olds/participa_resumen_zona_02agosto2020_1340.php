<?php
session_start();
date_default_timezone_set('America/Mexico_City');
header('Content-Type: text/html; charset=ISO-8859-1');
require('../../fpdf/fpdf.php');
include ("../../controladores/conex.php");

//$fk_id_sucursal=$_SESSION['fk_id_sucursal'];
//$id_usuario=$_SESSION['nombre'];

$id_zona=$_GET['id_zona'];
$periodo=$_GET['periodo'];

//echo $periodo;

$query = "SELECT * FROM kg_zonas
WHERE id_zona = ".$id_zona;
//echo $query;
$resultado = mysqli_query($conexion, $query);

if($row = mysqli_fetch_array($resultado))
{
  $desc_zona=$row['desc_zona'];
}

class PDF extends FPDF
{
// Cabecera de página
  function Header()
  {

    global $desc_zona,$periodo ;
      // Logo
      //$this->Image('logo_pb.png',10,8,33);
      // Arial bold 15
      setlocale(LC_ALL,"es_ES");
      $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
      $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
      $fecha=$dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
      

      $this->SetFont('Arial','B',14);
      // Movernos a la derecha
      $this->Cell(3);
      // Título
      $this->Image('../imagenes/logo_arca.png',13,7,40,15);
      /*
      $this->SetTextColor(0,0,255);
      $this->Cell(193,5,'LABORATORIOS ARCA',0,0,'C');
      $this->SetTextColor(0,102,204);
      $this->Ln(5);
      */
      $this->SetTextColor(0,0,255);
      $this->Cell(3);
      $this->SetFont('Arial','B',12);
      $this->Cell(200,15,'RESUMEN DE PAGO DE PARTICIPACIONES'.' ('.$periodo.')',0,0,'C');
      $this->Ln(10);
      $this->Cell(3);
      $this->SetTextColor(0,0,0);
      $this->SetFont('Arial','B',10);
      $this->Cell(17,10,'Zona: ',0,0,'L');
      $this->SetFont('Arial','',10);
      $this->Cell(20,10,$desc_zona,0,0,'L');
      $this->Cell(100);
      $this->Cell(20,10,utf8_decode($fecha),0,0,'L');
      $this->Ln(1);
      $this->Cell(3);
      $this->Cell(193,10,'_________________________________________________________________________________________________',0,0,'L');
      $this->Ln(4);
      $this->Cell(3);
      $this->SetFont('Arial','B',8);
      $this->Cell(5,10,'#',0,0,'C');
      $this->Cell(25,10,'Sucursal',0,0,'C');
      $this->Cell(75,10,'Medico',0,0,'C');
      $this->Cell(55,10,'Num. Estudio',0,0,'C');
      $this->Cell(15,10,'Importe Comision',0,0,'C');
      $this->Ln(1);
      $this->Cell(3);
      $this->Cell(193,10,'_________________________________________________________________________________________________________________________',0,0,'L');
      // Salto de línea
      $this->Ln(10);
  }

  // Pie de página
  function Footer()
  {
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
$corte_sucursal='0';
$imp_sucursal='0';
$primer_vez='s';
$total_comision='0';
$totgra_comision='0';


$sql="SELECT zo.desc_zona,
  su.desc_sucursal,
  CONCAT(me.`nombre`,' ',a_paterno,' ',a_materno) AS medico,
  COUNT(*) AS numestudios,
  SUM(ROUND((df.precio_venta*(CASE WHEN es.costo = df.precio_venta THEN co.porcentaje ELSE 10 END))/100,2)) AS comision
FROM so_factura fa,
      so_detalle_factura df,
      so_medicos me,
      kg_zonas zo,
      kg_sucursales su,
      km_estudios es,
      kg_comisiones co
WHERE DATE_FORMAT(fa.fecha_factura,'%Y-%m') = '".$periodo."' 
  AND fa.estado_factura <> '5'
  AND fa.id_factura = df.id_factura
  AND fa.fk_id_medico = me.id_medico
  AND me.fk_id_zona = zo.id_zona
  AND fa.fk_id_sucursal = su.id_sucursal
  AND df.`fk_id_estudio` = es.id_estudio
  AND es.fk_id_comision = co.id_comision
  AND me.`id_medico` <> 1607
  AND fa.afecta_comision = 1
  AND zo.`id_zona`= ".$id_zona." 
GROUP BY zo.desc_zona, su.desc_sucursal, 
  CONCAT(me.`nombre`,' ',a_paterno,' ',a_materno) 
ORDER BY 1,2,3";
//echo $sql;

if ($result = mysqli_query($conexion, $sql)) {
  while($row = $result->fetch_assoc())
      {
        if ($corte_sucursal != $row['desc_sucursal']){
          if($primer_vez == 's'){
            $primer_vez ='n';
          }else{
            //$pdf->Ln(5);
            $pdf->cell(160);
            $pdf->Cell(15,5,'----------',0,0,'R');
            $pdf->Ln(5);
            $pdf->Cell(175,5,$total_comision,0,0,'R');
            $pdf->Ln(10);
          }
          $corte_sucursal=$row['desc_sucursal'];
          $imp_sucursal=$row['desc_sucursal'];
          $total_comision='0';
        }else{
            $imp_sucursal=' ';
        }        
        $pdf->cell(3);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(5,5,$numero,0,0,'L');
        $pdf->Cell(35,5,$imp_sucursal,0,0,'L');
        $pdf->Cell(85,5,$row['medico'],0,0,'L');
        $pdf->Cell(10,5,$row['numestudios'],0,0,'R');
        $pdf->Cell(37,5,$row['comision'],0,0,'R');
        $numero+=1;
        $total_comision+=$row['comision'];
        $totgra_comision+=$row['comision'];
        $pdf->Ln(4);
      }
$pdf->Cell(175,5,$totgra_comision,0,0,'R');
}


$pdf->Output();

?>