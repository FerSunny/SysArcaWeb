<?php
date_default_timezone_set('America/Mexico_City');
header('Content-Type: text/html; charset=ISO-8859-1');
require('../../fpdf/fpdf.php');
 require_once ("../../so_factura/config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
 require_once ("../../so_factura/config/conexion.php");//Contiene funcion que conecta a la base de datos

//se recibe los paramteros para la generación del reporte
$numero_factura=$_POST['numero_factura'];
$studio=$_POST['studio'];

// actualiza las veces que se ha impreso el resultado
$sql_max="select max(num_imp) as num_imp FROM cr_plantilla_ekg_re
where fk_id_factura=".$numero_factura." and fk_id_estudio=".$studio;
// echo $sql_max;
$veces='0';
if ($result = mysqli_query($con, $sql_max)) {
  while($row = $result->fetch_assoc())
  {
      $veces=$row['num_imp']+1;
      //echo $veces;
      $sql_update="UPDATE cr_plantilla_ekg_re SET num_imp = '".$veces."'
      where fk_id_factura=".$numero_factura." and fk_id_estudio=".$studio;
      //echo $sql_update;
      $execute_query_update = mysqli_query($con,$sql_update);
  }
}


//Obtener los datos, de la cabecera, (datos del estudio)
$sql="
SELECT fa.id_factura,
  SUBSTR(es.desc_estudio,1,32) AS estudio,
  SUBSTR(es.desc_estudio,33,100) AS estudio1,
  es.desc_estudio AS estudio2,
  CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno) AS paciente,
  CASE
    WHEN LENGTH(fa.vmedico) > 0 THEN
      trim(fa.vmedico)
    ELSE
      CONCAT(me.nombre,' ',me.a_paterno,' ',me.a_materno)
  END AS medico,
  DATE(fa.`fecha_factura`) AS fecha,
  CASE WHEN cl.anios > 0 THEN
    CONCAT(cl.anios,' Años')
        WHEN cl.meses > 0 THEN
    CONCAT(cl.meses,' Meses')
        WHEN cl.dias > 0 THEN
    CONCAT(cl.dias,' Dias')
  END AS edad
FROM so_factura fa
     LEFT OUTER JOIN so_clientes cl ON (cl.id_cliente = fa.fk_id_cliente)
     LEFT OUTER JOIN so_medicos me ON (me.id_medico = fa.fk_id_medico),
     so_detalle_factura df,
     km_perfil_detalle dp,
     km_estudios es
WHERE fa.`id_factura` = ".$numero_factura."
  AND fa.`id_factura` = df.`id_factura`
  AND df.`fk_id_estudio`= dp.`fk_id_perfil`
  AND dp.`fk_id_estudio` = es.`id_estudio`
  AND dp.fk_id_estudio = ".$studio."
  
UNION

    SELECT df.id_factura,
       SUBSTR(es.desc_estudio,1,32) AS estudio,
       SUBSTR(es.desc_estudio,33,100) AS estudio1,
       es.desc_estudio AS estudio2,
       CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno) AS paciente,
      CASE
        WHEN LENGTH(fa.vmedico) > 0 THEN
          trim(fa.vmedico)
        ELSE
          CONCAT(me.nombre,' ',me.a_paterno,' ',me.a_materno)
      END AS medico,
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
/*
$sql="SELECT p2.tipo,p2.concepto,posini,tipfue,tamfue FROM cr_plantilla_1 p2 WHERE p2.fk_id_estudio =".$studio." AND p2.estado = 'A' AND p2.tipo in ('M','R')";
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
*/

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
            $con,
            $tamfuem;
    if($studio == 1153 || $studio == 1154){$desc = "ELECTROCARDIOGRAMA EN REPOSO";}else{
      $desc = $estudio2;
    }

    $this->Image('../imagenes/logo_arca.png',35,3,150,25);
    $this->Image('../imagenes/codigo1.jpg',179,43,20,20);
    //$this->Image('../imagenes/firma.gif',153,225,40,0);
    //$this->Ln(18);
    $this->Cell(5);
    $this->SetFont('Arial','B',15);
    //$this->SetDrawColor(0,80,180);
   //$this->SetFillColor(230,230,0);
    $this->SetTextColor(0,100,0);
    //$this->Cell(185,5,'UNIDAD CENTRAL ARCA TULYEHUALCO ',0,0,'C');
    //$this->Ln(5);
    $this->Ln(13);

    $this->SetFont('Arial','I',10);
   // $this->Cell(195,5,'BLVD San Buenaventura #51 Col. La Venta, Ixtapaluca EdoMex C.P.56530.',0,0,'C');
    //$this->Cell(195,5,'BLVD San Buenaventura, Col. La Venta, Ixtapaluca Edo. Mex',0,0,'C');
    $this->Ln(5);
    $this->SetTextColor(0,0,255);
    $this->Cell(193,5,'________________________________________________________________________________________________',0,0,'C');
    $this->SetTextColor(0,0,0);

// Primer columna de titulos
    $this->Ln(9);
    $this->Cell(2);
    $this->SetFont('Arial','B',11);
    $this->Cell(22,5,'PACIENTE:',0,0,'L');
    $this->SetFont('Arial','',11);
    $this->Cell(88,5,utf8_decode($paciente),0,0,'L');

    $this->SetFont('Arial','B',11);
    $this->Cell(15,5,'DR(A):',0,0,'L');
    $this->SetFont('Arial','',11);
    $this->Cell(70,5,utf8_decode($medico),0,0,'L');
// Segunda linea
    $this->ln(5);
    $this->Cell(2);
    $this->SetFont('Arial','B',11);
    $this->Cell(22,5,'FOLIO:',0,0,'L');
    $this->SetFont('Arial','',11);
    $this->Cell(88,5,$numero_factura,0,0,'L');

    $this->SetFont('Arial','B',11);
    $this->Cell(15,5,'FECHA:',0,0,'L');
    $this->SetFont('Arial','',9);
    $this->Cell(81,5,$fecha,0,0,'L');

// Tercer linea
    $this->ln(5);
    $this->Cell(2);
    $this->SetFont('Arial','B',11);
    $this->Cell(22,5,'ESTUDIO:',0,0,'L');
    $this->SetFont('Arial','',11);
    $this->MultiCell(88,5,$desc,0,'L');

    $this->SetFont('Arial','B',11);
    $this->SetXY(122, 57);
    $this->Write(-12,'EDAD:');
    $this->SetFont('Arial','',11);
    $this->SetXY(135,65);
    $this->Write(-29,$edad);


// Cuarta linea

    $this->ln(-1);
    $this->Cell(5);
    $this->SetFont('Arial','B',14);
    $this->Cell(170,5,$desc,0,0,'C');
/*
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
    $this->Cell(48,5,'CONCEPTO',0,0,'L');
    $this->Cell(57,5,'RESULTADO',0,0,'C');
    $this->Cell(46,5,'VALORES DE REFERENCIA',0,0,'C');
*/
    $this->Ln();

}

// Pie de página
  function Footer()
  {

    global $studio,$con,$verificado,$tamfuev,$tipfuev,$numero_factura,$posiniv;

    $this->SetY(-57); //
    //$this->ln(10);
    $this->Cell($posiniv);

    $this->SetFont('Arial',$tipfuev,$tamfuev);
    $this->Cell(30,5,$verificado,0,0,'L');
    $this->ln(15); // aqui
    //$this->Cell(5);

    $sql="SELECT p2.concepto,posini,tipfue,tamfue FROM cr_plantilla_ekg p2 WHERE p2.fk_id_estudio =".$studio." AND p2.estado = 'A' AND p2.tipo = 'F' order by orden";
    if ($result = mysqli_query($con, $sql)) {
      while($row = $result->fetch_assoc())
        {
          $this->Cell(($row['posini']-=6));
          $firma=$row['concepto'];
          $this->Image('../imagenes/firma_dr_ekg.png',150,227,30,0);
          $this->SetFont('Arial','',$row['tamfue']);
          $this->Cell(170,5,$firma,0,0,'L');
          $this->ln(4);
        }
        $this->ln(-2);
        $this->Cell(5);
        $this->SetTextColor(0,0,255);
        $this->Cell(185,5,'__________________________________________________________________________________________',0,0,'L');
    $this->SetTextColor(26,35,126); 
        $this->SetFont('Arial','B',10);
        $this->SetXY(118,260); 
        $this->Write(0,'www.estudiosclinicosanbuenaventura.com.mx');
    
        //$this->Image('../imagenes/whatsapp.jpg',10,262,7,0);
        //$this->Image('../imagenes/telefono.jpg',18,262.3,7,0);
        $this->SetTextColor(27,94,32); 
        $this->SetFont('Arial','',12);
        $this->SetXY(15,260); 
        $this->Write(0,'Matriz:');
    
        $this->SetTextColor(27,94,32); 
        $this->SetFont('Arial','',10);
        $this->SetXY(15,264); 
        $this->Write(0,'Ixtapaluca');
    
        $this->SetXY(15,268); 
        $this->SetFont('Arial','',8);
        $this->Write(0,'Blvd. San Buenaventura No. 51');
    
        $this->SetXY(15,271);
        $this->Write(0,'Col. La Venta');
        
        $this->SetXY(15,274);
        $this->Write(0,'Ixtapaluca Edo. Mex.');
    
        $this->SetXY(15,277);
        $this->Write(0,'Tel. 55 5972 5169 - 55 6298 2670');
    
    // sucursal
        $this->SetTextColor(27,94,32); 
        $this->SetFont('Arial','',12);
        $this->SetXY(65,260); 
        $this->Write(0,'Sucursal:');
    
        $this->SetTextColor(27,94,32); 
        $this->SetFont('Arial','',10);
        $this->SetXY(65,264); 
        $this->Write(0,'Chalco');
    
        $this->SetXY(65,268); 
        $this->SetFont('Arial','',8);
        $this->Write(0,'Av. Cuauhutemoc No. 27 Local 6');
    
        $this->SetXY(65,271);
        $this->Write(0,'Col. Centro');
        
        $this->SetXY(65,274);
        $this->Write(0,'Chalco Edo. Mex.');
    
        $this->SetXY(65,277);
        $this->Write(0,'Tel. 55 8865 1720 - 55 8865 1721');
    
    
    
        /*$this->Image('../imagenes/telefono.jpg',50,258,7,0);
        $this->SetTextColor(230,81,0); 
        $this->SetFont('Arial','B',12);
        $this->SetXY(56,262); 
        $this->Write(0,'ARCATEL: 216 141 44');
        $this->SetTextColor(0,0,0);*/
    
        //$this->Image('../imagenes/email.jpg',85,262,7,0);
        $this->SetTextColor(26,35,126); 
        $this->SetFont('Arial','B',9);
        $this->SetXY(114,266); 
        $this->Write(0,'atencion.cliente@estudiosclinicosanbuenaventura.com.mx');
        $this->SetXY(135,271); 
        $this->Write(0,'Estudios Clinicos San Buenaventura');    
        $this->Image('../imagenes/fb.png',130,268,5,5);
    
        $this->SetXY(142,276); 
        $this->Write(0,'estclinbuenaventura');
        $this->Image('../imagenes/instagram.png',137,273,5,5);  
        $this->SetTextColor(0,0,0);
    
        $this->SetTextColor(26,35,126); 
        $this->SetFont('Arial','B',10);
        $this->SetXY(90,272); 
        //$this->Write(0,'Chalco - Ixtapaluca');
        $this->SetTextColor(0,0,0);//subir codigo de seguridad


        $cadena = "";
      $sql="SELECT valor FROM cr_plantilla_ekg_re WHERE valor IS NOT NULL and fk_id_factura = ".$numero_factura." and fk_id_estudio=".$studio;
      if ($result = mysqli_query($con, $sql)) {
          while($row1 = $result->fetch_assoc())
            {

             // $cadena=$cadena.' '.trim($row1['valor']);
            }
      };

    $this->ln(8);//bajar el nombre codigo de seguridad
    $this->SetFont('Arial','',7);
    $this->ln(3);
    $this->MultiCell(200,3,base64_encode($cadena),0,'L');
    $this->ln(-1);

    }
  }
}
//
// Creación del objeto de la clase heredada
//
$pdf = new PDF('P','mm','Letter');
//$pdf->SetMargins(0,0,0);
$pdf->SetAutoPageBreak(true,38);//para determinar el tamaño de espacio para el body

$pdf->AliasNbPages();
$pdf->AddPage();

$hay_obs='';
$observaciones='';
$nle='0';

$sql="(select valor,tipo,orden,concepto,observaciones,tamfue,posini,tipfue FROM cr_plantilla_ekg_re
  where fk_id_factura=".$numero_factura." and fk_id_estudio=".$studio.")
  UNION
      (SELECT null,p2.tipo,p2.orden,p2.concepto,null,tamfue,posini,tipfue FROM cr_plantilla_ekg p2
  WHERE p2.fk_id_estudio =".$studio." AND p2.estado = 'A' AND p2.tipo IN ('V','T','B')) ORDER BY orden";
//echo $sql;
  if ($result = mysqli_query($con, $sql)) {
    while($row = $result->fetch_assoc())
      {
        if (strlen($row['observaciones'])>0){
                $hay_obs='1';
                $observaciones=$row['observaciones'];
        }

        if($row['tipo']=='P' && strlen($row['valor'])=='0' and $studio=='721' and $studio=='1153' and $studio=='1154'){
            $nle+=1;
            $nle-=1;
            //echo 'aqui';
        }else{

          $pdf->Cell($row['posini']);
          $pdf->SetFont('Arial',$row['tipfue'],$row['tamfue']);
          $pdf->Cell(40,5,trim(utf8_decode($row['concepto'])),0,0,'L');
          if($row['concepto']=='Interpretación:' || $row['concepto']=='Impresión Diagnostica:' || $row['concepto']=='-'){
            $nombres = explode ("#", $row['valor']);//para saltar las conclusiones
              for($i = 0; $i < count($nombres); $i++ )
              {
                $pdf->SetX(55);
                $pdf->MultiCell(156,5,trim(utf8_decode( $nombres[$i])),0,'L');
                $pdf->ln(-1);
              }
              $cant = count($nombres)-1;
              if($cant == 0)
              {
                $pdf->ln(-1);
              }else
              if($cant == 1)
              {
                $pdf->ln(-2);
              }else
              if($cant == 2)
              {
                $pdf->ln(-7);
              }else
              if($cant == 3)
              {
                $pdf->ln(-10);
              }else
              if($cant == 4)
              {
                $pdf->ln(-15);
              }else
              if($cant == 5)
              {
                $pdf->ln(-15);
              }
              
          }else{
            // $pdf->Cell(120,5,utf8_decode($row['valor']),0,0,'C');
            if($row['concepto']=='Ondas T'){
                $just='L';
            }else{
                $just='L';
            }

            if($row['concepto'] == 'Duracion del QRS'){
              $val = str_word_count($row['valor'], 0);
              if($val <= 20)
              {
                $pdf->MultiCell(156,5,trim(utf8_decode($row['valor'])),0,$just);
              }else
              {
                $pdf->SetX(54);
                $pdf->MultiCell(156,5,trim(utf8_decode($row['valor'])),0,$just);
              }
            }else
            if($row['concepto']=='Onda T' || $row['concepto']=='Intervalo QTm' ||  $row['concepto']=='Intervalo QT'){
                $pdf->SetX(54);
                $pdf->MultiCell(156,5,trim(utf8_decode($row['valor'])),0,$just);
            }else
            if($row['concepto'] == '.' && $studio == '1154'){
              $pdf->SetX(50);
              $pdf->MultiCell(156,5,trim(utf8_decode($row['valor'])),0,$just);
            }else
            if($row['concepto'] == '.' && $studio == '1153'){
              $pdf->SetX(47);
              $pdf->MultiCell(156,5,trim(utf8_decode($row['valor'])),0,$just);
            }else
            if($row['concepto'] == "MEDICO CARDIOLOGO:" || $row['concepto'] == "CED. PROF." || $row['concepto'] == "MEDICO CARDIOLOGO" || $row['concepto'] == "CED. PROF."){
                $pdf->SetX(75);
                $pdf->MultiCell(156,5,trim(utf8_decode($row['valor'])),0,'L');
            }
            else{
               $pdf->MultiCell(156,5,trim(utf8_decode($row['valor'])),0,$just);
            }

          }

        }
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
          $pdf->MultiCell(180,5,$observaciones,0,'L');
      }
//for($i=1;$i<=20;$i++)
//    $pdf->Cell(0,10,'Imprimiendo línea número '.$i,0,1);

$pdf->Output("../emails/".$numero_factura."_".$studio.".pdf","F");
?>
