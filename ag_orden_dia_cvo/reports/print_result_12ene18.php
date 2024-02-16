<?php
date_default_timezone_set('America/Mexico_City');
header('Content-Type: text/html; charset=ISO-8859-1');
require('../../fpdf/fpdf.php');
 require_once ("../../so_factura/config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
 require_once ("../../so_factura/config/conexion.php");//Contiene funcion que conecta a la base de datos

//se recibe los paramteros para la generación del reporte
$numero_factura=$_GET['numero_factura'];
$studio=$_GET['studio'];

// actualiza las veces que se ha impreso el resultado
$sql_max="select max(num_imp) as num_imp FROM cr_plantilla_cvo_re
where fk_id_factura=".$numero_factura." and fk_id_estudio=".$studio;
// echo $sql_max;
$veces='0';
if ($result = mysqli_query($con, $sql_max)) {
  while($row = $result->fetch_assoc())
  {
      $veces=$row['num_imp']+1;
      //echo $veces;
      $sql_update="UPDATE cr_plantilla_cvo_re SET num_imp = '".$veces."'
      where fk_id_factura=".$numero_factura." and fk_id_estudio=".$studio;
      //echo $sql_update;
      $execute_query_update = mysqli_query($con,$sql_update);
  }
}



//Obtener los datos, de la cabecera, (datos del estudio)
$sql="
    SELECT df.id_factura,
       SUBSTR(es.desc_estudio,1,32) AS estudio,
       SUBSTR(es.desc_estudio,33,100) AS estudio1, 
       es.desc_estudio AS estudio2,
       CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno) AS paciente,
    CONCAT(me.nombre,' ',me.a_paterno,' ',me.a_materno) AS medico,
    date(fa.`fecha_factura`) AS fecha,
    CASE WHEN cl.anios > 0 THEN 
        CONCAT(cl.anios,' Años') 
         WHEN cl.meses > 0 THEN 
        CONCAT(cl.meses,' Meses') 
         WHEN cl.dias > 0 THEN 
        CONCAT(cl.dias,' Dias') 
    END AS edad 
FROM km_paquetes pq
     LEFT OUTER JOIN km_estudios es ON (es.id_estudio = pq.fk_id_estudio),
     so_detalle_factura df,
     so_factura fa
     LEFT OUTER JOIN so_clientes cl ON (cl.id_cliente = fa.fk_id_cliente) 
     LEFT OUTER JOIN so_medicos me ON (me.id_medico = fa.fk_id_medico) 
WHERE  pq.id_paquete = df.fk_id_estudio
   AND df.id_factura = fa.id_factura
   AND df.id_factura = ".$numero_factura." AND pq.fk_id_estudio = ".$studio."
    UNION
    SELECT  df.id_factura,
    substr(es.desc_estudio,1,32) AS estudio,
    substr(es.desc_estudio,33,100) AS estudio1,
    es.desc_estudio AS estudio2,
    CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno) AS paciente,
    CONCAT(me.nombre,' ',me.a_paterno,' ',me.a_materno) AS medico,
    date(fa.fecha_factura) AS fecha,
    CASE
        WHEN cl.anios > 0 THEN 
            CONCAT(cl.anios,' Años')
        WHEN cl.meses > 0 THEN 
            CONCAT(cl.meses,' Meses')
        WHEN cl.dias > 0 THEN 
            CONCAT(cl.dias,' Dias') 
    END AS edad
  FROM so_detalle_factura df
  LEFT OUTER JOIN so_factura fa ON (fa.id_factura=df.id_factura)
  LEFT OUTER JOIN km_estudios es ON (es.id_estudio = df.fk_id_estudio)
  LEFT OUTER JOIN so_clientes cl ON (cl.id_cliente = fa.fk_id_cliente)
  LEFT OUTER JOIN so_medicos me ON (me.id_medico = fa.fk_id_medico)
  WHERE df.id_factura = ".$numero_factura." AND df.fk_id_estudio=".$studio;
 //echo $sql;

  $paciente='0';

     if ($result = mysqli_query($con, $sql)) {
        while($row = $result->fetch_assoc())
        {
            $paciente=$row['paciente'];
            $medico=$row['medico'];
            $fecha=$row['fecha'];
            //$estudio=$row['estudio'];
            $edad=utf8_decode($row['edad']);
            $estudio2=$row['estudio2'];
            //$estudio1=$row['estudio1'];
        }
    }

// Obtenemos el metodo

$sql="SELECT p2.tipo,p2.concepto,posini,tipfue,tamfue FROM cr_plantilla_cvo p2 WHERE p2.fk_id_estudio =".$studio." AND p2.estado = 'A' AND p2.tipo in ('M','R')";
if ($result = mysqli_query($con, $sql)) {
  while($row = $result->fetch_assoc())
    {
      if($row['tipo']=='M'){
        $metodo=$row['concepto'];
        $posinim=$row['posini'];
        $tipfuem=$row['tipfue'];
        $tamfuem=$row['tamfue'];
      }else{
        $verificado=$row['concepto'];
        $posiniv=$row['posini'];
        $tipfuev=$row['tipfue'];
        $tamfuev=$row['tamfue'];
      }

    }
}




class PDF extends FPDF
{
// Cabecera de página
function Header()
{

    global $paciente,
            $medico,
            $numero_factura,
            $fecha,
            $estudio2,
            $studio,
            $edad,
            $metodo,
            $posinim,
            $tipfuem,
            $tamfuem;


// Primer columna de titulos
    $this->Ln(35);
    $this->Cell(9);
    $this->SetFont('Arial','B',11);
    $this->Cell(22,5,'PACIENTE:',0,0,'L');
    $this->SetFont('Arial','',11);
    $this->Cell(81,5,$paciente,0,0,'L');

    $this->SetFont('Arial','B',11);
    $this->Cell(15,5,'DR(A):',0,0,'L');
    $this->SetFont('Arial','',11);
    $this->Cell(70,5,$medico,0,0,'L');
// Segunda linea
    $this->ln(5);
    $this->Cell(9);
    $this->SetFont('Arial','B',11);
    $this->Cell(22,5,'FOLIO:',0,0,'L');
    $this->SetFont('Arial','',11);
    $this->Cell(81,5,$numero_factura,0,0,'L');

    $this->SetFont('Arial','B',11);
    $this->Cell(15,5,'FECHA:',0,0,'L');
    $this->SetFont('Arial','',9);
    $this->Cell(81,5,$fecha,0,0,'L');

// Tercer linea
    $this->ln(5);
    $this->Cell(9);
    $this->SetFont('Arial','B',11);
    $this->Cell(22,5,'ESTUDIO:',0,0,'L');
    $this->SetFont('Arial','',11);
    $this->MultiCell(81,5,$estudio2,0,'L');
 
    $this->SetFont('Arial','B',11);
    $this->SetXY(122, 57); 
    $this->Write(0,'EDAD:'); 
    $this->SetFont('Arial','',11);
    $this->SetXY(137,57); 
    $this->Write(0,$edad);

// Cuarta linea

    $this->ln(20);
    $this->Cell(5);
    $this->SetFont('Arial','B',14);
    $this->Cell(170,5,$estudio2,0,0,'C');

// linea de encavezados (metodo)
    $this->ln(10);
    $this->Cell(10);
    $this->SetFont('Arial',$tipfuem,$tamfuem);
    $this->Cell(50,5,$metodo,0,0,'L');

    switch ($studio) {
      case '130': //ANTIGENO ESPECIFICO DE PROSTATA
          $this->Ln(15);
          break;
      case '535': //TRIGLICERIDOS
          $this->Ln(15);
      case '476': //PERFIL TIROIDEO BASICO I
          $this->Ln(10);
      case '260': //ELECTROLITOS SERICOS ( 3 ) 
          $this->Ln(10);
      default:
          $this->Ln(5);
          break;
    }  
   
    //$this->ln(6);  
    $this->Cell(25);
    $this->SetFont('Arial','B',9);
    $this->Cell(40,5,'CONCEPTO',0,0,'L');
    //$this->Cell(25);
    $this->Cell(50,5,'RESULTADO',0,0,'C');

    $this->Ln();

}

// Pie de página
  function Footer()
  {

    global $studio,$con,$verificado,$tamfuev,$tipfuev,$posiniv;

    $this->SetY(-50); //
    //$this->ln(10);
    $this->Cell($posiniv);

    $this->SetFont('Arial',$tipfuev,$tamfuev);
    $this->Cell(30,5,$verificado,0,0,'L'); 
    $this->ln(10); // aqui
    //$this->Cell(5);

    $sql="SELECT p2.concepto,posini,tipfue,tamfue FROM cr_plantilla_cvo p2 WHERE p2.fk_id_estudio =".$studio." AND p2.estado = 'A' AND p2.tipo = 'F' order by orden";
    if ($result = mysqli_query($con, $sql)) {
      while($row = $result->fetch_assoc())
        {
          $this->Cell(($row['posini']-=6));
          $firma=$row['concepto'];
          $this->Image('../imagenes/firma.gif',153,225,40,0);
          $this->SetFont('Arial','',$row['tamfue']);
          $this->Cell(170,5,$firma,0,0,'L');
          $this->ln(4);
        }
          //$this->Cell(20);
          //$this->SetFont('Arial','I',8);
          // Número de página
          //$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
  }
}
//
// Creación del objeto de la clase heredada
//
$pdf = new PDF('P','mm','Letter');
//$pdf->SetMargins(0,0,0);
$pdf->SetAutoPageBreak(true,50);

$pdf->AliasNbPages();
$pdf->AddPage();

$hay_obs='';
$observaciones='';
$nle='0';

$sql="(select valor,tipo,orden,concepto,observaciones,tamfue,posini,tipfue FROM cr_plantilla_cvo_re
  where fk_id_factura=".$numero_factura." and fk_id_estudio=".$studio.") 
  UNION
      (SELECT null,p2.tipo,p2.orden,p2.concepto,null,tamfue,posini,tipfue FROM cr_plantilla_cvo p2
  WHERE p2.fk_id_estudio =".$studio." AND p2.estado = 'A' AND p2.tipo IN ('V','T','B')) ORDER BY orden";
 // echo $sql;

  if ($result = mysqli_query($con, $sql)) {
    while($row = $result->fetch_assoc())
      {
        if (strlen($row['observaciones'])>0){
                $hay_obs='1';
                $observaciones=$row['observaciones'];
        }

        if ($row['concepto']=='DESARROLLO:' or $row['concepto']=='.'){
          $tipfue='BI';
        }else{
          $tipfue=$row['tipfue'];
        }

        if($row['tipo']=='P' && strlen($row['valor'])==0 and ($studio=='231' or $studio=='234' or $studio=='275' or $studio=='276' or $studio=='278' or $studio=='720' or $studio=='876' or $studio=='909' or $studio=='721'or $studio=='214' )){
            $nle+=1;
            $nle-=1;
        }else{
        $pdf->Cell($row['posini']);
        $pdf->SetFont('Arial',$row['tipfue'],$row['tamfue']);
        $pdf->Cell(50,5,$row['concepto'],0,0,'L');
        //$pdf->ln(5);

        //$pdf->Cell(25);
        $pdf->SetFont('Arial',$tipfue,$row['tamfue']);
        if($row['concepto']=='OBSERVACION MICROSCOPICA:' or $row['concepto']=='CITOLOGIA:'){
          $pdf->MultiCell(120,5,trim($row['valor']),0,'L');
        }else{
          $pdf->Cell(50,5,$row['valor'],0,0,'C');
        }   
        $pdf->ln(4);
       }
      }

      if($hay_obs=='1'){
          $pdf->ln(4);
          $pdf->Cell(9);
          $pdf->SetFont('Arial','B',9);
          $pdf->Cell(70,5,'OBSERVACIONES',0,0,'L');
          $pdf->ln(4);
          $pdf->Cell(9);
          $pdf->SetFont('Arial','',8);
          $pdf->MultiCell(150,5,$observaciones,0,'L');
      }  
  }

//for($i=1;$i<=20;$i++)
//    $pdf->Cell(0,10,'Imprimiendo línea número '.$i,0,1);

$pdf->Output();
?>