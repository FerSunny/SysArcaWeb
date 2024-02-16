<?php

// **** Modificacion echa en vbase al o requerido 
// **** or el ticket  no. 404 de ARCA, solicitado Por mariela enriquez
// **** cambios realizados pr JPM 13dic2021
// **** linea 409-425

//Zona Horaria
date_default_timezone_set('America/Mexico_City');

//Libreria PF
require('../../fpdf/fpdf.php');

//Conexion a la base de datos
require_once ("../../controladores/conex.php");


//Recibimos valores
$numero_factura=$_GET['numero_factura'];
$studio=$_GET['studio'];
$fecha = date("Y-m-d H:i:s");
$veces='0';
//Obtenemos el numero de impreisones maximo
$stmt = $conexion->prepare("SELECT max(num_imp) as id_max FROM cr_plantilla_1_re WHERE fk_id_factura = ? and fk_id_estudio = ?");
    $stmt->bind_param("ii", $numero_factura, $studio);
    
    
    if($stmt->execute())
    {
      $stmt->bind_result($id_max);
      $stmt->fetch();
      $stmt->close();
      $veces = $id_max+1;
      $stmt = $conexion->prepare("UPDATE cr_plantilla_1_re SET num_imp = ?, fecha_impresion = ? WHERE fk_id_factura = ? AND fk_id_estudio = ?");
      $stmt->bind_param('isii', $veces,$fecha,$numero_factura,$studio);
      $result = $stmt->execute();
      $stmt->close();

    }else
    {
      echo "Ourrio un error";
    }


    //Obtener los datos, de la cabecera (datos del paciente y medico)
    $stmt = $conexion->prepare("SELECT
date(fa.fecha_factura),
CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno) paciente,
cl.anios,
CASE 
WHEN fa.vmedico > 0 THEN fa.vmedico
ELSE CONCAT(med.nombre,' ',med.a_paterno,' ',med.a_materno)
END medico
FROM so_factura fa
LEFT OUTER JOIN so_clientes cl ON (cl.id_cliente = fa.fk_id_cliente)
LEFT OUTER JOIN so_medicos med ON (med.id_medico = fa.fk_id_medico)
WHERE fa.id_factura = ?");

  $stmt->bind_param("i", $numero_factura);

   if($stmt->execute())
  {
      $stmt->bind_result($fecha,$paciente,$edad,$medico);
      $stmt->fetch();
      $stmt->close();
  }else
  {
    echo "Ourrio un error";
  }

 //Obtener los datos, de la cabecera (datos del estudio)
    $stmt = $conexion->prepare("SELECT desc_estudio FROM km_estudios WHERE id_estudio = ?");

  $stmt->bind_param("i", $studio);

   if($stmt->execute())
  {
      $stmt->bind_result($estudio2);
      $stmt->fetch();
      $stmt->close();
  }else
  {
    echo "Ourrio un error";
  }

   //Obtener los datos, de la cabecera (datos del metodo)
    $stmt = $conexion->prepare("SELECT p2.tipo,p2.concepto,posini,tipfue,tamfue FROM cr_plantilla_1 p2 WHERE p2.fk_id_estudio = ? AND p2.estado = 'A' AND p2.tipo IN ('M','R')");

  $stmt->bind_param("i", $studio);

   if($stmt->execute())
  {
      $stmt->bind_result($tipo,$concepto,$posini,$tipfue,$tamfue);
      $stmt->fetch();
      $stmt->close();
  }else
  {
    echo "Ourrio un error";
  }

  if($tipo=='M'){
        $metodo=$concepto;
        $posinim=$posini;
        $tipfuem=$tipfue;
        $tamfuem=$tamfue;
      }else{
        $verificado=$concepto;
        $posiniv=$posini;
        $tipfuev=$tipfue;
        $tamfuev=$tamfue;
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

      $this->Image('../imagenes/logo_arca.png',10,5,70,0);
      $this->Image('../imagenes/pacal.jpg',160,5,40,0);
      $this->Image('../imagenes/codigo1.jpg',170,50,30,30);

     // $this->Image('../../../imagenes/logo_arca_sys_web.jpg',70,150,70,0);
      $this->Ln(18);
      $this->Cell(5);
      $this->SetFont('Arial','B',15);
      //$this->SetDrawColor(0,80,180);
     //$this->SetFillColor(230,230,0);
      $this->SetTextColor(0,0,255);
      //$this->Cell(185,5,'UNIDAD CENTRAL ARCA TULYEHUALCO ',0,0,'C');
      //$this->Ln(5);
      $this->SetFont('Arial','I',10);
      $this->Cell(185,5,'Josefa Ortiz de Dominguez No. 5 San Isidro Tulyehualco, Xochimilco, CDMX',0,0,'R');
      $this->Ln(3);
      $this->Cell(185,5,'________________________________________________________________________________________________',0,0,'C');
      $this->SetTextColor(0,0,0);

  // Primer columna de titulos
      $this->Ln(15);
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
      $this->MultiCell(88,5,$estudio2,0,'L');
 
      $this->SetFont('Arial','B',11);
      $this->SetXY(122, 59); 
      $this->Write(0,'EDAD:'); 
      $this->SetFont('Arial','',11);
      $this->SetXY(137,59); 
      $this->Write(0,utf8_decode($edad.' años'));

  // Cuarta linea

  // quitar dos lineas para el estudio 410 (quimica de 12 elementos)
      if ($studio=='410' or $studio=='966' or $studio=='1051'){
        $this->ln(15);
      }else{
		  if($studio=='2616'){
			  $this->ln(10);
		  }else{
		  	$this->ln(20);
			}
      }

      $this->Cell(5);
      $this->SetFont('Arial','B',14);
      $this->Cell(170,5,$estudio2,0,0,'C');

  // linea de encavezados (metodo)
      $this->ln(10);
      $this->Cell(10);
      $this->SetFont('Arial',$tipfuem,$tamfuem);
      $this->Cell(50,5,utf8_decode($metodo),0,0,'L');

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
      $this->Cell(46,5,'',0,0,'C');

      $this->Ln();

  }

  function Footer()
  {

    global $studio,$conexion,$verificado,$tamfuev,$tipfuev,$numero_factura,$posiniv;

    $this->SetY(-50); //
    $this->ln(-1);
    $this->Cell($posiniv);

    $this->SetFont('Arial',$tipfuev,$tamfuev);
    $this->Cell(30,5,$verificado,0,0,'L'); 
    $this->ln(10); // aqui
    //$this->Cell(5);
//echo "19";
    $stmt = $conexion->prepare("SELECT p2.concepto
      -- ,posini,tipfue,tamfue 
      FROM cr_plantilla_1 p2 WHERE p2.fk_id_estudio = ? AND p2.estado = 'A' AND p2.tipo = 'F' order by orden");
    $stmt->bind_param('i',$studio);
    $stmt->execute();
    //$stmt->bind_result($concepto,$posini,$tipfue,$tamfue);
    $stmt->bind_result($concepto);
        //$stmt->close();
 
    $this->Image('../imagenes/firma.gif',153,230,40,0);
    $this->SetFont('Arial','',$tamfue);
    while ($stmt->fetch())
    {
       $this->Cell(($posini-=1));
      $eventos = array($concepto);
      $firma=$eventos[0];
      $this->Cell(170,5,utf8_decode($firma),0,0,'L');
      $this->ln(4); 
    }
$this->ln(-2);
    $this->Cell(5);
    $this->SetTextColor(0,0,255);
    $this->Cell(185,5,'_______________________________________________________________________________________________________',0,0,'L');

    $this->SetTextColor(26,35,126); 
    $this->SetFont('Arial','B',16);
    $this->SetXY(65,257); 
    $this->Write(0,'www.laboratoriosarca.com.mx');

    $this->Image('../imagenes/whatsapp.jpg',10,258,7,0);
    $this->SetTextColor(27,94,32); 
    $this->SetFont('Arial','B',12);
    $this->SetXY(16,262); 
    $this->Write(0,'55 3121 0700');
    $this->SetTextColor(0,0,0);

    $this->Image('../imagenes/telefono.jpg',50,258,7,0);
    $this->SetTextColor(230,81,0); 
    $this->SetFont('Arial','B',12);
    $this->SetXY(56,262); 
    $this->Write(0,'ARCATEL: 216 141 44');
    $this->SetTextColor(0,0,0);

    $this->Image('../imagenes/email.jpg',105,259,7,0);
    $this->SetTextColor(26,35,126); 
    $this->SetFont('Arial','B',11);
    $this->SetXY(110,262); 
    $this->Write(0,'atencion.cliente@laboratoriosarca.com.mx');
    $this->SetTextColor(0,0,0);

    $this->SetTextColor(26,35,126); 
    $this->SetFont('Arial','B',10);
    $this->SetXY(20,267); 
    $this->Write(0,'Tulyehualco - San Gregorio - Xochimilco - Santiago - San Pablo - San Pedro - Tecomitl - Tetelco');
    $this->SetTextColor(0,0,0);
    $this->ln(-10);//subir codigo de seguridad
    $cadena = "";
    $stmt = $conexion->prepare("SELECT valor FROM cr_plantilla_1_re WHERE valor IS NOT NULL AND fk_id_factura = ? and fk_id_estudio = ?");
    $stmt->bind_param('ii',$numero_factura,$studio);
    $stmt->execute();
    $stmt->bind_result($valor);
    while ($stmt->fetch())
    {
      $cadena=$cadena.' '.trim($valor);

    }

    $this->ln(8);//bajar el nombre codigo de seguridad
    $this->SetFont('Arial','',6);
    $this->ln(5);
    $this->MultiCell(200,3,base64_encode($cadena),0,'L');
    $this->ln(10);


    }
}

$pdf = new PDF('P','mm','Letter');
//$pdf->SetMargins(0,0,0);
$pdf->SetAutoPageBreak(true,50);

$pdf->AliasNbPages();
$pdf->AddPage();

$hay_obs='';
$observaciones='';
$nle='0';
$blanco=' ';
 
    $stmt = $conexion->prepare("SELECT tipo,concepto, valor,unidad_medida, tamfue, tipfue, posini, observaciones  FROM cr_plantilla_1_re WHERE fk_id_factura = ? AND fk_id_estudio = ? ORDER BY orden");
    $stmt->bind_param('ii',$numero_factura,$studio);
    $stmt->execute();
    $stmt->bind_result($tipo,$concepto,$valor,$uniadad_medida,$tamfue,$tipfue,$posini,$observaciones);
    $justifica='R';
    $pdf->ln(2);
     if (strlen($observaciones)>0)
     {
        $hay_obs='1';
        $observaciones=$row['observaciones'];
    }
    while ($stmt->fetch())
    {
      $res = array($tipo,$concepto,$valor,$uniadad_medida,$tamfue,$tipfue,$posini,$observaciones);
        $pdf->Cell(9);
        $pdf->SetFont('Arial',$tipfue,$tamfue);
        $pdf->Cell(70,5,utf8_decode($concepto),0,0,'L');
        $pdf->Cell(9);
        $pdf->SetFont('Arial',$tipfue,$tamfue);
        $pdf->Cell(80,5,utf8_decode($valor.' '.$uniadad_medida),0,0,'L');
        //AYUNO
        //INGESTA DE GLUCOSA   75.0 gramos
        $pdf->ln(4);


      }

      if ($studio == 235) 
      {
        $pdf->ln(-20);
        $pdf->Cell(9);
        $pdf->SetX(-70);
        $pdf->SetFont('Arial',$tipfue,$tamfue);
        $pdf->Cell(26,5,utf8_decode('AYUNO'),0,0,$justifica);
        $pdf->ln(4);
        $pdf->Cell(9);
        $pdf->SetX(-40);
        $pdf->SetFont('Arial',$tipfue,$tamfue);
        $pdf->Cell(26,5,utf8_decode('INGESTA DE GLUCOSA   75.0 gramos'),0,0,$justifica);
      }else
      {
        $pdf->ln(-28);
        $pdf->Cell(9);
        $pdf->SetX(-70);
        $pdf->SetFont('Arial',$tipfue,$tamfue);
        $pdf->Cell(26,5,utf8_decode('AYUNO'),0,0,$justifica);
        $pdf->ln(4);
        $pdf->Cell(9);
        $pdf->SetX(-40);
        $pdf->SetFont('Arial',$tipfue,$tamfue);
        $pdf->Cell(26,5,utf8_decode('INGESTA DE GLUCOSA   75.0 gramos'),0,0,$justifica);
      }

 //echo "13";
   $pdf->Image('../../pdf_graficas/'.$numero_factura.'_'.$studio.'.png',13,130,145,80);
//echo "14";
    $pdf->SetX(230);
    $pdf->SetY(200);
    //

    $stmt = $conexion->prepare("SELECT tipo,concepto,posini,tamfue FROM cr_plantilla_1 WHERE fk_id_estudio = ? AND tipo = 'T'");
    $stmt->bind_param('i',$studio);
    $stmt->execute();
    $stmt->bind_result($tipo,$concepto,$posini,$tamfue);
    $pdf->Cell(9);

    while($stmt->fetch())
    {
        $pdf->Cell(12);
      $eventos = array($concepto);
      $res=$eventos[0];
      $pdf->SetFont('Arial','',$tamfue);
      $pdf->SetX(22);
      $pdf->Cell(150,5,utf8_decode($res),0,'L');
      $pdf->ln(4);
      //$pdf->MultiCell(150,5,utf8_decode('a'),0,'L');
    }

    if(strlen($observaciones)>0){
      $pdf->ln(2);
      $pdf->Cell(5);
      $pdf->SetTextColor(191, 54, 12);
      $pdf->SetFont('Arial','B',12);
      $pdf->Cell(26,5,utf8_decode('OBSERVACIONES:'),0,0,'L');
      $pdf->SetTextColor(0,0,0);
      $pdf->SetFont('Arial','',10);
      $pdf->ln(5);
      $pdf->Cell(5);
      $pdf->MultiCell(150,5,utf8_decode($observaciones),0,'L');
    }



    $stmt->close();
$pdf->Output();
?>