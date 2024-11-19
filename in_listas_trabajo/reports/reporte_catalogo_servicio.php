<?php
session_start();
date_default_timezone_set('America/Mexico_City');
header('Content-Type: text/html; charset=ISO-8859-1');
require('../../fpdf/fpdf.php');
include ("../../controladores/conex.php");

//$fk_id_sucursal=$_SESSION['fk_id_sucursal'];
//$id_usuario=$_SESSION['nombre'];

//$id_estudio=$_GET['id_estudio'];
//$numot=$_GET['numot'];

//echo $periodo;



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
     // $this->Image('../imagenes/logo_arca.png',13,7,40,15);
      
      $this->SetTextColor(0,0,255);
      $this->Cell(200,5,'LABORATORIOS CLINICOS ARCA',0,0,'C');
      $this->SetTextColor(0,102,204);
      $this->Ln(5);

      $this->SetTextColor(0,0,255);
      $this->Cell(3);
      $this->SetFont('Arial','B',12);
      $this->Cell(200,15,'Catalogo de servicios (FOR-VEN-03)',0,0,'C');
      $this->Ln(10);
      $this->Cell(3);
      $this->SetTextColor(0,0,0);
      $this->SetFont('Arial','B',10);
     // $this->Cell(17,10,'Zona: ',0,0,'L');
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
      $this->Cell(10,10,'Id',0,0,'L');
     
      $this->Cell(5,10,'Abrevacion',0,0,'L');
      $this->Cell(35);
      $this->Cell(5,10,'Estudio',0,0,'L');
      $this->Cell(112);
      $this->Cell(5,10,'Costo',0,0,'L');
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

$nombre_tipo_estudio = '';

$sql="
SELECT 
es.`id_estudio`,
es.`iniciales`,
es.`desc_estudio`,
es.`costo`,
CASE
WHEN SUBSTR(es.desc_estudio,1,3) = 'MAQ' THEN
	'Maquila'
ELSE	
	te.nombre_tipo_estudio
END grupo,
i.desc_indicaciones,
es.fk_id_estudio_ori
FROM km_estudios es
LEFT OUTER JOIN km_tipo_estudio te ON (te.id_tipo_estudio = es.fk_id_tipo_estudio)
LEFT OUTER JOIN kg_promociones pr ON (pr.`id_promocion` = es.`fk_id_promosion`)
LEFT OUTER JOIN km_indicaciones i ON(i.id_indicaciones = es.fk_id_indicaciones)
WHERE es.`estatus` = 'A'
AND NOW() BETWEEN pr.`fecha_inicio` AND pr.`fecha_final`
AND es.desc_estudio NOT LIKE '%MAQDN%'
ORDER BY grupo,es.`desc_estudio`
";
//echo $sql;

if ($result = mysqli_query($conexion, $sql)) {
  while($row = $result->fetch_assoc())
      {
        $fk_id_estudio_ori = $row['fk_id_estudio_ori'];
        $id_estudio = $row['id_estudio'];

        if($nombre_tipo_estudio <> $row['grupo'])
        {
          $nombre_tipo_estudio = $row['grupo'];
          $pdf->Ln(4);
          $pdf->cell(3);
          $pdf->SetFont('Arial','',10);
          $pdf->Cell(40,5,'Grupo: '.utf8_decode($row['grupo']),0,0,'L');
          $pdf->Ln(8);
        }
        $pdf->cell(3);
        $pdf->SetFont('Arial','',8);
        //$pdf->Cell(5,5,$numero,0,0,'L');
        $pdf->Cell(10,5,$row['id_estudio'],0,0,'L');
        $pdf->Cell(40,5,substr($row['iniciales'],0,20),0,0,'L');
        $pdf->Cell(120,5,utf8_decode($row['desc_estudio']),0,0,'L');
        //money_format('%i',$row['costo'])
        //'$'.number_format($imp_total,2)
        $pdf->Cell(10,5,'$'.number_format($row['costo'],2),0,0,'R');
        if (Strlen($row['desc_indicaciones']) > 0){
          $pdf->SetFont('Arial','',6);
          $pdf->Ln(4);
          $pdf->cell(3);
          $pdf->MultiCell(190,3,trim(utf8_decode($row['desc_indicaciones'])),0,'J');
        }
        if($fk_id_estudio_ori <> $id_estudio){
          $sql1=
          "
          select id_estudio,iniciales,desc_estudio,costo from km_estudios
          where fk_id_estudio_ori = $id_estudio
          ";
          if ($result1 = mysqli_query($conexion, $sql1)) {
            while($row1 = $result1->fetch_assoc()){
              //$pdf->Ln(4);
              $pdf->cell(3);
              $pdf->SetFont('Arial','I',6);
              //$pdf->Cell(5,5,$numero,0,0,'L');
              $pdf->Cell(10,5,$row1['id_estudio'],0,0,'L');
              $pdf->Cell(40,5,substr($row1['iniciales'],0,20),0,0,'L');
              $pdf->Cell(120,5,utf8_decode($row1['desc_estudio']),0,0,'L');
              $pdf->Cell(10,5,'$'.number_format($row1['costo'],2),0,0,'R');
            }
          }          
        }
      


        //$numero+=1;
        $pdf->Ln(3);
      }

}


$pdf->Output();

?>