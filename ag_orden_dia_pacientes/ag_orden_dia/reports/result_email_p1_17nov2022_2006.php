<?php
session_start();

date_default_timezone_set('America/Mexico_City');
//header('Content-Type: text/html; charset=ISO-8859-1');
require('../../../fpdf/fpdf.php');
 require_once ("../../../so_factura/config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
 require_once ("../../../so_factura/config/conexion.php");//Contiene funcion que conecta a la base de datos
$fk_id_perfil = $_SESSION['fk_id_perfil'];

//se recibe los paramteros para la generación del reporte
$numero_factura=$_GET['numero_factura'];
$studio=$_GET['studio'];
$fecha = date("Y-m-d H:i:s");
// actualiza las veces que se ha impreso el resultado
$sql_max="select max(num_imp) as num_imp FROM cr_plantilla_1_re
where fk_id_factura=".$numero_factura." and fk_id_estudio=".$studio;
// echo $sql_max;
if ($fk_id_perfil <> '1')
{
  $veces='0';
  if ($result = mysqli_query($con, $sql_max)) {
    while($row = $result->fetch_assoc())
    {
        $veces=$row['num_imp']+1;
        $fecha_impresion=date("y/m/d :H:i:s");
        //echo $veces;
        $sql_update="UPDATE cr_plantilla_1_re SET num_imp = $veces, fecha_impresion = '$fecha' WHERE fk_id_factura = $numero_factura AND fk_id_estudio = $studio";
        //echo $sql_update;
        $execute_query_update = mysqli_query($con,$sql_update);
    }
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
      CASE
        WHEN LENGTH(fa.vmedico) > 0 THEN
          trim(fa.vmedico)
        ELSE
          CONCAT(me.nombre,' ',me.a_paterno,' ',me.a_materno) 
      END AS medico,
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
    $this->Image('../imagenes/pacal.jpg',160,7,40,0);
    $this->Image('../imagenes/codigo1.jpg',170,50,30,30);

    $this->Image('../../../imagenes/logo_arca_sys_web.jpg',70,150,70,0);

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
    $this->Cell(88,5, utf8_decode($paciente),0,0,'L');

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
    $this->MultiCell(88,5,utf8_decode($estudio2),0,'L');
 
    $this->SetFont('Arial','B',11);
    $this->SetXY(122, 59); 
    $this->Write(0,'EDAD:'); 
    $this->SetFont('Arial','',11);
    $this->SetXY(137,59); 
    $this->Write(0,$edad);

// Cuarta linea

// quitar dos lineas para el estudio 410 (quimica de 12 elementos)
    if ($studio=='410' or $studio=='966' or $studio=='1051' or $studio=='1776'){
      $this->ln(15);
    }else{
      $this->ln(20);
    }

    $this->Cell(5);
    $this->SetFont('Arial','B',14);
    $this->Cell(170,5,utf8_decode($estudio2),0,0,'C');

// linea de encavezados (metodo)
    $this->ln(10);
    $this->Cell(10);
    $this->SetFont('Arial',$tipfuem,$tamfuem);
    $this->Cell(50,5,$metodo,0,0,'L');

    switch ($studio) {
      case '130': //ANTIGENO ESPECIFICO DE PROSTATA
          $this->Ln(15);
          break;
      case '1666': //ANTIGENO ESPECIFICO DE PROSTATA
          $this->Ln(15);
          break;
      case '535': //TRIGLICERIDOS
          $this->Ln(15);
      case '1858': //TRIGLICERIDOS
          $this->Ln(15);
      case '476': //PERFIL TIROIDEO BASICO I
          $this->Ln(10);
      case '260': //ELECTROLITOS SERICOS ( 3 ) 
          $this->Ln(10);
      case '1712': //ELECTROLITOS SERICOS ( 3 ) 
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

    $this->Ln();

}

// Pie de página
  function Footer()
  {

    global $studio,$con,$verificado,$tamfuev,$tipfuev,$numero_factura,$posiniv;

    $this->SetY(-50); //
    //$this->ln(10);
    $this->Cell($posiniv);

    $this->SetFont('Arial',$tipfuev,$tamfuev);
    $this->Cell(30,5,$verificado,0,0,'L'); 
    $this->ln(10); // aqui
    //$this->Cell(5);
    mysqli_query($con, "SET CHARACTER SET utf8");
    $sql="SELECT p2.concepto,posini,tipfue,tamfue FROM cr_plantilla_1 p2 WHERE p2.fk_id_estudio =".$studio." AND p2.estado = 'A' AND p2.tipo = 'F' order by orden";
    if ($result = mysqli_query($con, $sql)) {
      while($row = $result->fetch_assoc())
        {
          $this->Cell(($row['posini']-=6));
          $firma=$row['concepto'];
          $this->Image('../imagenes/firma.gif',153,230,40,0);
          $this->SetFont('Arial','',$row['tamfue']);
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
      $sql="SELECT valor FROM cr_plantilla_1_re WHERE valor IS NOT NULL and fk_id_factura = ".$numero_factura." and fk_id_estudio=".$studio;
      if ($result = mysqli_query($con, $sql)) {
          while($row1 = $result->fetch_assoc())
            {

              $cadena=$cadena.' '.trim($row1['valor']);
            }
      };

    $this->ln(8);//bajar el nombre codigo de seguridad
    $this->SetFont('Arial','',6);
    $this->ln(5);
    $this->MultiCell(200,3,base64_encode($cadena),0,'L');
    $this->ln(10);


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
$blanco=' ';
mysqli_query($con, "SET CHARACTER SET utf8");
$sql="
SELECT 	a.id_factura,
	a.fk_id_estudio,
	a.valor_solo,
	a.tipo,
	a.orden,
	CASE 
	WHEN a.id_factura = 242841 AND a.fk_id_estudio = 742 AND a.orden = 56.50 THEN
		'Metodo Fotometria Automatizada'
	ELSE
		a.concepto
	END AS concepto,
	CASE
	WHEN a.concepto = 'HIERRO' AND   a.id_factura = 242841 AND a.fk_id_estudio = 742  THEN
		REPLACE(a.valor,'mL','dL')
	ELSE
		a.valor
	END AS valor,	
	
	CASE
	WHEN a.concepto = 'HIERRO' AND   a.id_factura = 242841 AND a.fk_id_estudio = 742  THEN
		REPLACE(a.unidad_medida,'mL','dL')
	ELSE
		a.unidad_medida
	END AS unidad_medida,

	a.verificado,
	a.observaciones,
	CASE
	WHEN a.id_factura = 242841 AND a.fk_id_estudio = 742 AND a.orden = 56.50 THEN
		'19.0 - 156.3  µg/dL  MUJER'
	ELSE
		a.valor_refe
	END AS valor_refe,

	a.tamfue,
	a.posini,
	a.tipfue
FROM
(

(select $numero_factura as id_factura,
fk_id_estudio,
valor as valor_solo,tipo,orden,concepto,concat(LPAD(trim(valor),15,' '),' ',unidad_medida,verificado) as valor,concat(unidad_medida,verificado) as unidad_medida,verificado,observaciones,
CASE
  WHEN fk_id_estudio in (274,963,988,69,459,1029,49,1717,2432 ) THEN
        CONCAT(valor_refe) 
  ELSE
      CONCAT(valor_refe,' ',unidad_medida)
  END AS valor_refe,tamfue,posini,tipfue FROM cr_plantilla_1_re
  where fk_id_factura=".$numero_factura." and fk_id_estudio=".$studio.") 
  
  UNION

  (SELECT 
  $numero_factura as id_factura,
  p2.fk_id_estudio,
  
  null,p2.tipo,p2.orden,p2.concepto,null,null,null,null,
  CASE
  WHEN fk_id_estudio in (274,963,988,1029,2432) THEN

         CONCAT(valor_refe)

  ELSE
    CONCAT(valor_refe,' ',unidad_medida)
  END AS valor_refe, 
  tamfue,posini,tipfue FROM cr_plantilla_1 p2
  WHERE p2.fk_id_estudio =".$studio." AND p2.estado = 'A' AND p2.tipo IN ('V','T','B')) 
  ORDER BY orden
  ) a
  ";
  if ($result = mysqli_query($con, $sql)) {
    while($row = $result->fetch_assoc())
      {
        if (strlen($row['observaciones'])>0){
                $hay_obs='1';
                $observaciones=$row['observaciones'];
            }
            
/*
        switch ($row['concepto']) {
            case 'ACIDO URICO':
              $sexo=' HOMBRE';
              break;
            case 'GAMAGLUTAMIL TRANSPEPTIDASA (GGT)':
              $sexo=' HOMBRE';
              break;
            case 'HIERRO':
              $sexo=' HOMBRE';
              break;
            default:
              $sexo='';
              break;
        }
*/
        if($studio=='274' or $studio =='467' or $studio =='215' or $studio=='963' or $studio=='988' or $studio=='1029' or $studio=='1097' or $studio =='435' or $studio=='1201' or $studio=='1717' or $studio=='1781' or $studio=='1694' or $studio=='2432'){
          $justifica='C';
        }else{
          $justifica='R';
        }

        if($row['tipo']=='P' && strlen($row['valor_solo'])==0 and ($studio=='274' or $studio=='151' or $studio=='152' or $studio=='153' or $studio=='348' or $studio=='904' or $studio=='905' or $studio=='494' or $studio=='279' or $studio=='395' or $studio=='117' or $studio=='525' or $studio=='527' or $studio=='528' or $studio=='526' or $studio=='963' or $studio=='956' or $studio=='957' or $studio=='958' or $studio=='983' or $studio=='987' or $studio=='988' or $studio=='989' or $studio=='990' or $studio=='1027' or $studio=='1028' or $studio=='1029' or $studio=='202' or $studio=='1201' or $studio=='1194' or $studio=='1195' or $studio=='1196' or $studio=='1211' or $studio=='1226' or $studio=='1227' or $studio=='304' or $studio=='1204' or $studio=='1673' or $studio=='1830' or $studio=='1717' or $studio=='1854' or $studio=='1730' or $studio=='1961' or $studio=='1959' or $studio=='1962' or $studio=='1963' or $studio=='1748' or $studio=='1213' or $studio=='1766' or $studio=='1718' or $studio=='2152' or $studio=='2153' or $studio=='2154' or $studio=='2151' or $studio=='2427' or $studio=='2428' or $studio=='2429' or $studio=='2461' or $studio=='2432' or $studio=='2441' or $studio=='2429' or $studio=='2524'))   {
            $nle+=1;
            $nle-=1;
        }else{
             // $this->ln(5)
//inicia el cocepto
    //cambiamos la posicion inicial solo para el estudio 215
              if($studio =='215' or $studio =='1694'){
                $pdf->Cell($row['posini']);
                //$pdf->Cell(9);
              }else{
                $pdf->Cell(9);
              }
    // termina
              //$pdf->Cell(9);
              $pdf->SetFont('Arial',$row['tipfue'],$row['tamfue']);
              if ($row['concepto'] == '.'){
                $pdf->Cell(70,5,$blanco,0,0,'L');
              }else{
                  $pdf->Cell(70,5,utf8_decode($row['concepto']),0,0,'L');
              }
              //$pdf->ln(5);
// Termina conecpto

// inicia valor
    //cambiamos la posicion inicial solo para el estudio 215              
              if($studio =='215' or $studio =='1694'){
                $pdf->Cell(18-$row['posini']);
                //$pdf->Cell(9);
              }else{
                $pdf->Cell(9);
              }

              $pdf->SetFont('Arial','B',$row['tamfue']);
              if($row['valor_solo']=='.'){
                $pdf->Cell(26,5,$blanco,0,0,$justifica);
              }else{
                if(($studio =='215' && strlen($row['valor_solo'])==0) or ($studio =='1694' && strlen($row['valor_solo'])==0) ){
                  $pdf->Cell(26,5,'(   )',0,0,$justifica);
                }else{
                  if(($studio =='215' && ($row['valor_solo']=='X' or $row['valor_solo']=='x')) or ($studio =='1694' && ($row['valor_solo']=='X' or $row['valor_solo']=='x'))){
                    $pdf->Cell(26,5,'('.utf8_decode($row['valor_solo']).')',0,0,$justifica);
                  }else{
                    $pdf->Cell(26,5,utf8_decode($row['valor_solo']),0,0,$justifica);
                  } 
                }
              }
// termina valor
              //$pdf->Cell(9);
              $pdf->SetFont('Arial','B',$row['tamfue']);
              $pdf->Cell(18,5,utf8_decode($row['unidad_medida']),0,0,'L');

              switch ($row['concepto']) {
                  case 'ACIDO URICO':
                      $sexo=' HOMBRE';
                      break;

                  case 'GAMAGLUTAMIL TRANSPEPTIDASA (GGT)':
                       $sexo=' HOMBRE';
					             //$sexo='       ';
                        break;
                  case 'HIERRO':
                      if ($studio=='892' or $row['id_factura'] == 259544  or $row['id_factura'] == 259405  or $row['id_factura'] == 259527  or $row['id_factura'] == 259542 ) {
                        $sexo='';
                      }else{
                        $sexo=' HOMBRE';
                      }
                      break;
                  case 'FOSFATASA ALCALINA  (ALP)':
                      $sexo=' ADULTO';
                      break;
                  case 'FOSFATASA ALCALINA (ALP)':
                      $sexo=' ADULTO';
                      break;
                  default:
                      $sexo='';
                      break;
              }

              $pdf->Cell(8);
              $pdf->SetFont('Arial',$row['tipfue'],$row['tamfue']);
              if($row['concepto']=='Volumen Recibido'){
                $nle+=1;
                $nle-=1;
              }else{
  
                  if ($studio=='50' && $row['valor_refe'] == ' U/mL') {
                        $cero=0;
                  }else 
                  if($studio == '243' && $row['concepto'] == "Nitrogeno Ureico en Orina" || $row['concepto'] == "Volumen Referido (24h)" || $row['concepto'] == "Volumen Referido (24h)" )
                  {
                      $pdf->Cell(18,5,"",0,0,'L');
                  }
                  else{


                    if(
                      ($row['id_factura'] == 259544 and $row['orden'] == '58' and $studio=='414') or 
                      ($row['id_factura'] == 259405 and $row['orden'] == '56' and $studio=='1778') or
                      ($row['id_factura'] == 259527 and $row['orden'] == '56.50' and $studio=='742') or
                      ($row['id_factura'] == 259542 and $row['orden'] == '56' and $studio=='413') 
                      
                      ){
                      $pdf->Cell(18,5,"",0,0,'L');
                    }else{
                      $pdf->Cell(18,5,utf8_decode($row['valor_refe']).$sexo,0,0,'L');
                    }

                    //$pdf->Cell(18,5,utf8_decode($row['valor_refe']).$sexo,0,0,'L');
                  }                
                  
                //$pdf->Cell(18,5,utf8_decode($row['valor_refe']).$sexo,0,0,'L');
              }
              //$pdf->Cell(18,5,utf8_decode($row['valor_refe']).$sexo,0,0,'L');
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
          $pdf->MultiCell(170,5,utf8_decode($observaciones),0,'J');
      }  
  }

//for($i=1;$i<=20;$i++)
//    $pdf->Cell(0,10,'Imprimiendo línea número '.$i,0,1);

$pdf->Output();
//  $pdf->Output("../emails/".$numero_factura."_".$studio.".pdf","F");
?>