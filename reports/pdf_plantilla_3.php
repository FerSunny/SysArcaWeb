<?php

// Version modificada por javier pradel
// Fecha: 06.febrero.2019
// Version 3.0
// Descripcion: Justificar los textos decodificados
date_default_timezone_set('America/Mexico_City');
header('Content-Type: text/html; charset=ISO-8859-1');
require('../fpdf/fpdf.php');
// version 3.0
//require('../../WriteHTML/WriteHTML.php');
// end
 require_once ("../so_factura/config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
 require_once ("../so_factura/config/conexion.php");//Contiene funcion que conecta a la base de datos

//se recibe los paramteros para la generación del reporte
$numero_factura=$_POST['factura'];
$studio=$_POST['estudio'];
$tipo_salida = $_POST['tipo_salida']; // 0 = navegador - 1 = PDF


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
mysqli_query($con, "SET CHARACTER SET utf8");
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

    $this->Image('./imagenes/logo_arca.png',10,5,70,0);
    $this->Image('./imagenes/pacal.jpg',160,5,40,0);
    $this->Image('../utl_tickets/codigo_ok.jpg',170,50,30,30);
    //$this->Image('../imagenes/firma.gif',153,225,40,0);

    $this->Image('../imagenes/logo_arca_sys_web.jpg',70,150,70,0);

    $this->Ln(18);
    $this->Cell(5);
    $this->SetFont('Arial','B',15);
    //$this->SetDrawColor(0,80,180);
   //$this->SetFillColor(230,230,0);
    $this->SetTextColor(0,0,255);
    //$this->Cell(185,5,'UNIDAD CENTRAL ARCA TULYEHUALCO ',0,0,'C');
    //$this->Ln(5);
    $this->SetFont('Arial','I',10);
    $this->Cell(185,5,'Josefa Ortiz de Dominguez No. 5 San Isidro Tuyehualco, Xocimilco, CDMX',0,0,'R');
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
    $this->Cell(40,5,'CONCEPTO',0,0,'L');
    //$this->Cell(25);
    $this->Cell(50,5,'RESULTADO',0,0,'C');

    $this->Ln();

}

// Pie de página
  function Footer()
  {

    global $studio,$con,$verificado,$tamfuev,$tipfuev,$numero_factura,$posiniv;

    $this->SetY(-43); //para subir nombres de medicos
    //$this->ln(10);
    $this->Cell($posiniv);

    $this->SetFont('Arial',$tipfuev,$tamfuev);
    $this->Cell(30,5,$verificado,0,0,'L'); 
    $this->ln(5); // aqui
    //$this->Cell(5);

    $sql="SELECT p2.concepto,posini,tipfue,tamfue FROM cr_plantilla_cvo p2 WHERE p2.fk_id_estudio =".$studio." AND p2.estado = 'A' AND p2.tipo = 'F' order by orden";
    if ($result = mysqli_query($con, $sql)) {
      while($row = $result->fetch_assoc())
        {
          $this->Cell(($row['posini']-=6));
          $firma=$row['concepto'];
          $this->Image('./imagenes/firma1.jpg',160,225,40,0);
          $this->SetFont('Arial','',$row['tamfue']);
          $this->Cell(170,5,utf8_decode($firma),0,0,'L');
          $this->ln(4);
        }


    $this->ln(-3);
    $this->Cell(2);
    $this->SetTextColor(0,0,255);
    $this->Cell(185,5,'_______________________________________________________________________________________________________',0,0,'L');

    $this->SetTextColor(26,35,126); 
    $this->SetFont('Arial','B',16);
    $this->SetXY(65,258); 
    $this->Write(0,'www.laboratoriosarca.com.mx');

    $this->Image('./imagenes/whatsapp.jpg',10,260,7,0);
    $this->SetTextColor(27,94,32); 
    $this->SetFont('Arial','B',12);
    $this->SetXY(16,264); 
    $this->Write(0,'55 3121 0700');
    $this->SetTextColor(0,0,0);

    $this->Image('./imagenes/telefono.jpg',50,260,7,0);
    $this->SetTextColor(230,81,0); 
    $this->SetFont('Arial','B',12);
    $this->SetXY(56,264); 
    $this->Write(0,'ARCATEL: 216 141 44');
    $this->SetTextColor(0,0,0);

    $this->Image('./imagenes/email.jpg',105,261,7,0);
    $this->SetTextColor(26,35,126); 
    $this->SetFont('Arial','B',11);
    $this->SetXY(110,264); 
    $this->Write(0,'atencion.cliente@laboratoriosarca.com.mx');
    $this->SetTextColor(0,0,0);

    $this->SetTextColor(26,35,126); 
    $this->SetFont('Arial','B',10);
    $this->SetXY(20,269); 
    $this->Write(0,'Tulyehualco - San Gregorio - Xochimilco - Santiago - San Pablo - San Pedro - Tecomitl - Tetelco');
    $this->SetTextColor(0,0,0);
     $this->ln(7);//subir codigo de seguridad

         $cadena = "";
      $sql="SELECT valor FROM cr_plantilla_cvo_re WHERE valor IS NOT NULL and fk_id_factura = ".$numero_factura." and fk_id_estudio=".$studio;
      if ($result = mysqli_query($con, $sql)) {
          while($row1 = $result->fetch_assoc())
            {

              $cadena=$cadena.' '.trim($row1['valor']);
            }
      };

    $this->ln(7);//bajar el nombre codigo de seguridad
    $this->SetFont('Arial','',6);
    $this->ln(-10);
    $this->MultiCell(200,3,base64_encode($cadena),0,'L');
    $this->ln(-10);
    }
  }
}
//
// Creación del objeto de la clase heredada
//
$pdf = new PDF('P','mm','Letter');

//$pdf = new PDF('P','mm','Letter');
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

        if($row['tipo']=='P' && strlen($row['valor'])==0 and ($studio=='231' or $studio=='234' or $studio=='275' or $studio=='276' or $studio=='278' or $studio=='720' or $studio=='876' or $studio=='909' or $studio=='721' or $studio=='214' or  $studio=='923' or $studio=='941' or $studio=='947' or $studio=='948' or $studio=='949' or $studio=='950' or $studio=='960' or $studio=='961' or $studio=='1014' or $studio=='1015' or $studio=='1016' or $studio=='1017' or $studio=='1018' or $studio=='1019' or $studio=='1020' or $studio=='1021' or $studio=='1022' or $studio=='1023' or $studio=='1024' or $studio=='1025'   or $studio=='1202' or $studio=='1225' or $studio=='1705' or $studio=='1953' or $studio=='2457' or $studio=='2433' or $studio=='2614' or $studio=='2601' or $studio=='2689' or $studio=='923')){
            $nle+=1;
            $nle-=1;
        }else{
        $pdf->Cell($row['posini']);
        $pdf->SetFont('Arial',$row['tipfue'],$row['tamfue']);

        //if ($row['tipo']=='T' and $studio=='1016'){
          //$pdf->Cell(170,5,utf8_decode($row['concepto']),0,0,'R');
        //}else{
          //$pdf->Cell(50,5,utf8_decode($row['concepto']),0,0,'L');
        //}
        //Bibliografia alineada a la derec. para estos dos estudios 
        if ($row['tipo']=='T' and ($studio=='1016' or $studio == '275' or $studio == '961' or $studio == '1202' or $studio == '1953' or $studio == '2433' or $studio == '2601')){
          /// La ultima letra si mueve la bibliografia izq o dere
          $pdf->Cell(170,5,utf8_decode($row['concepto']),0,0,'R');
        }else{
          //El 50 mueve los resultados de 1016 y 275, 
          $pdf->Cell(50,5,utf8_decode($row['concepto']),0,0,'L');
        }


        //$pdf->Cell(50,5,utf8_decode($row['concepto']),0,0,'L');
        
        //$pdf->ln(5);

        //$pdf->Cell(25);
        $pdf->SetFont('Arial',$tipfue,$row['tamfue']);
        if($row['concepto']=='OBSERVACION MICROSCOPICA:' or $row['concepto']=='CITOLOGIA:'){
          $pdf->MultiCell(120,5,utf8_decode(trim($row['valor'])),0,'L');
        }else{
          if($studio=='275' or $studio=='961' or $studio=='1016' or $studio=='1202' or $studio=='1953' or $studio=='2433' or $studio=='2601'){
            switch($row['concepto']){
                case "CUENTA BACTERIANA:": 
                    $cb='';
                    switch($row['valor']){
                        case "DESME":
                            $cb='Desarrollo muy escaso';
                            break;
                        case "DESE":
                            $cb='Desarrollo escaso';
                            break;
                        case "DESM":
                            $cb='Desarrollo moderado';
                            break;
                        case "DESA":
                            $cb='Desarrollo abundante';
                            break;
                        case "NSBH":
                            $cb='No se aisló estreptococo Beta hemolítico de
los grupos A, C o G; a las 48 horas de incubación.';
                            break;
                        default:
                          $cb=$row['valor'];
                          break;
                    }
                    $pdf->MultiCell(120,5,utf8_decode(trim($cb)),0,'L');
                    break;
              
                case "DESARROLLO:":
                  $de='';
                  switch ($row['valor']) {
                    case 'NSBH':
                      $de='No se aisló estreptococo Beta hemolítico de
los grupos A, C o G; a las 48 horas de incubación.';
                      break;
                    case 'SBHGA':
                      $de='Streptococcus pyogenes (Estreptococo Beta hemolítico
del grupo "A").';
                      break;  
                    case 'SBHGC':
                      $de='Streptococcus Beta hemolítico del Grupo "C".';
                      break;
                    case 'SBHGG':
                      $de='Streptococcus Beta hemolítico del Grupo "G".';
                      break;                                       
                    default:
                      $de=$row['valor'];
                      break;
                  }
                  //Ori   $pdf->MultiCell(120,5,utf8_decode(trim($de)),0,'L');
                  $pdf->MultiCell(120,5,utf8_decode(trim($de)),0,'$R');
                  break;

                case 'RESULTADO FINAL:':
                  $re1='';
                  switch ($row['valor']) {
                    case 'DSBH':
                      $re1='Aproximadamente el 80% de las faringitis son de origen viral por lo que no se obtiene crecimiento mediante éste estudio. De acuerdo a los lineamientos internacionales, el único agente causal de faringitis bacteriana es el estreptococo beta hemolítico del grupo A (Streptococcus pyogenes), aunque también se han reportado casos por estreptococo beta hemolíticos del grupo C y G. Las bacterias que causan formas específicas de faringitis como Corynebactarium diphtheriae, Bordetella pertusis, Neisseria gonorrhoeae, anaerobios (angina de Vincent), no se aíslan por este cultivo.';
                      break;
                    case 'DSBHPOS':
                      $re1='De acuerdo a los lineamientos internacionales, el único agente causal de faringitis bacteriana es el estreptococo beta-hemolítico del grupo "A" (Streptococcus pyogenes), así como también estreptococo beta-hemolítico del grupo C y G.

Las bacterias que causan formas específicas de faringitis como Bordetella pertusis, Corynebacterium diphtheriae, Neisseria gonorrhoeae y anaerobios (angina de Vicent) no se aíslan por éste cultivo.

No es necesaria la realización de pruebas de susceptibilidad a los antimicrobianos, porque hasta la fecha no se conoce resistencia al tratamiento de elección, que son las penicilinas. En caso de alergia a penicilinas, el tratamiento recomendado es la eritromicina.';

                      
                      break; 
                    default:
                      $re1=$row['valor'];
                      break;
                  }
                  $pdf->MultiCell(120,5,utf8_decode($re1),0,'J');
                  //$pdf->MultiCell(120,5, $pdf->WriteHTML($re1),0,'J');
                  //$pdf->Multicell(70,3.5, $pdf->WriteHTML($html));
                  break;
            } 
            // $pdf->MultiCell(120,5,trim($row['valor']),0,'L');
          }else{
				if($studio == 214 and $row['concepto']=='CARACTERISTICAS DE LA MUESTRA:'){
					$pdf->MultiCell(120,5,utf8_decode($row['valor']),0,'C');
				}else{
					if(($studio == 214 or $studio == 923) and $row['concepto']=='DESARROLLO:'){
						$pdf->MultiCell(120,5,utf8_decode($row['valor']),0,'L');
					}else{			  
			  
						  if($studio == 139 or $studio == 140 or $studio == 141){
							  $pdf->MultiCell(120,5,utf8_decode($row['valor']),0,'L');
						  }else{
							  if($studio == 183 or $studio == 1683 or $studio == 2342 or $studio == 1682 or $studio == 1714 or $studio == 183 or $studio == 881){
								  $pdf->Cell(25);
								  $pdf->Cell(50,5,utf8_decode($row['valor']),0,0,'L');
							  }else{
								  $pdf->Cell(50,5,utf8_decode($row['valor']),0,0,'C');
							  }
						  }
						}
				}
		  }
			
			
			
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
          $pdf->MultiCell(180,5,utf8_decode($observaciones),0,'J');
      }  
  }

//for($i=1;$i<=20;$i++)
//    $pdf->Cell(0,10,'Imprimiendo línea número '.$i,0,1);

//$pdf->Output();
$pdf->Output("../pdf_resenv/".$numero_factura."_".$studio.".pdf","F");
echo 1;
?>