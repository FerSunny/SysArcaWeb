<?php
date_default_timezone_set('America/Mexico_City');
//header('Content-Type: text/html; charset=ISO-8859-1');
header("Content-Type: text/html;charset=utf-8");
require('../../fpdf/fpdf.php');
 require_once ("../../so_factura/config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
 require_once ("../../so_factura/config/conexion.php");//Contiene funcion que conecta a la base de datos
 //require('html2pdf.php');

//se recibe los paramteros para la generación del reporte
$id_plantilla=$_GET['numero_factura'];
$studio=$_GET['studio'];

function hex2dec($couleur = "#000000"){
  $R = substr($couleur, 1, 2);
  $rouge = hexdec($R);
  $V = substr($couleur, 3, 2);
  $vert = hexdec($V);
  $B = substr($couleur, 5, 2);
  $bleu = hexdec($B);
  $tbl_couleur = array();
  $tbl_couleur['R']=$rouge;
  $tbl_couleur['V']=$vert;
  $tbl_couleur['B']=$bleu;
  return $tbl_couleur;
}

//conversion pixel -> millimeter at 72 dpi
function px2mm($px){
  return $px*25.4/72;
}

function txtentities($html){
  $trans = get_html_translation_table(HTML_ENTITIES);
  $trans = array_flip($trans);
  return strtr($html, $trans);
}


/*
// actualiza las veces que se ha impreso el resultado
$sql_max="select max(num_imp) as num_imp FROM cr_plantilla_4_re
where fk_id_factura=".$numero_factura." and fk_id_estudio=".$studio;
// echo $sql_max;
$veces='0';
if ($result = mysqli_query($con, $sql_max)) {
  while($row = $result->fetch_assoc())
  {
      $veces=$row['num_imp']+1;
      //echo $veces;
      $sql_update="UPDATE cr_plantilla_4_re SET num_imp = '".$veces."'
      where fk_id_factura=".$numero_factura." and fk_id_estudio=".$studio;
      //echo $sql_update;
      $execute_query_update = mysqli_query($con,$sql_update);
  }
}
*/

//Obtener los datos, de la cabecera, (datos del estudio)
$sql="
SELECT fa.id_factura,
  SUBSTR(es.desc_estudio,1,32) AS estudio,
  SUBSTR(es.desc_estudio,33,100) AS estudio1,
  es.desc_estudio AS estudio2,
  CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno) AS paciente,
  CONCAT(me.nombre,' ',me.a_paterno,' ',me.a_materno) AS medico,
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
WHERE fa.`id_factura` = ".$id_plantilla."
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
   AND df.id_factura = ".$id_plantilla." AND pq.fk_id_estudio = ".$studio."
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
  WHERE df.id_factura = ".$id_plantilla." AND df.fk_id_estudio=".$studio;
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

class PDF extends FPDF
{

//variables of html parser
protected $B;
protected $I;
protected $U;
protected $HREF;
protected $fontlist;
protected $issetfont;
protected $issetcolor;

function __construct($orientation='P', $unit='mm', $size='A4')
{
    //Call parent constructor
    parent::__construct($orientation,$unit,$size);
    //Initialization
    $this->B=0;
    $this->I=0;
    $this->U=0;
    $this->HREF='';
    $this->fontlist=array('arial', 'times', 'courier', 'helvetica', 'symbol');
    $this->issetfont=false;
    $this->issetcolor=false;
}

function WriteHTML($html)
{
    //HTML parser
    $html=strip_tags($html,"<b><u><i><a><img><p><br><strong><em><font><tr><blockquote>"); //supprime tous les tags sauf ceux reconnus
    $html=str_replace("\n",' ',$html); //remplace retour à la ligne par un espace
    $a=preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE); //éclate la chaîne avec les balises
    foreach($a as $i=>$e)
    {
        if($i%2==0)
        {
            //Text
            if($this->HREF)
                $this->PutLink($this->HREF,$e);
            else
                $this->Write(5,txtentities($e));
        }
        else
        {
            //Tag
            if($e[0]=='/')
                $this->CloseTag(strtoupper(substr($e,1)));
            else
            {
                //Extract attributes
                $a2=explode(' ',$e);
                $tag=strtoupper(array_shift($a2));
                $attr=array();
                foreach($a2 as $v)
                {
                    if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                        $attr[strtoupper($a3[1])]=$a3[2];
                }
                $this->OpenTag($tag,$attr);
            }
        }
    }
}

function OpenTag($tag, $attr)
{
    //Opening tag
    switch($tag){
        case 'STRONG':
            $this->SetStyle('B',true);
            break;
        case 'EM':
            $this->SetStyle('I',true);
            break;
        case 'B':
        case 'I':
        case 'U':
            $this->SetStyle($tag,true);
            break;
        case 'A':
            $this->HREF=$attr['HREF'];
            break;
        case 'IMG':
            if(isset($attr['SRC']) && (isset($attr['WIDTH']) || isset($attr['HEIGHT']))) {
                if(!isset($attr['WIDTH']))
                    $attr['WIDTH'] = 0;
                if(!isset($attr['HEIGHT']))
                    $attr['HEIGHT'] = 0;
                $this->Image($attr['SRC'], $this->GetX(), $this->GetY(), px2mm($attr['WIDTH']), px2mm($attr['HEIGHT']));
            }
            break;
        case 'TR':
        case 'BLOCKQUOTE':
        case 'BR':
            $this->Ln(5);
            break;
        case 'P':
            $this->Ln(10);
            break;
        case 'FONT':
            if (isset($attr['COLOR']) && $attr['COLOR']!='') {
                $coul=hex2dec($attr['COLOR']);
                $this->SetTextColor($coul['R'],$coul['V'],$coul['B']);
                $this->issetcolor=true;
            }
            if (isset($attr['FACE']) && in_array(strtolower($attr['FACE']), $this->fontlist)) {
                $this->SetFont(strtolower($attr['FACE']));
                $this->issetfont=true;
            }
            break;
    }
}

function CloseTag($tag)
{
    //Closing tag
    if($tag=='STRONG')
        $tag='B';
    if($tag=='EM')
        $tag='I';
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,false);
    if($tag=='A')
        $this->HREF='';
    if($tag=='FONT'){
        if ($this->issetcolor==true) {
            $this->SetTextColor(0);
        }
        if ($this->issetfont) {
            $this->SetFont('arial');
            $this->issetfont=false;
        }
    }
}

function SetStyle($tag, $enable)
{
    //Modify style and select corresponding font
    $this->$tag+=($enable ? 1 : -1);
    $style='';
    foreach(array('B','I','U') as $s)
    {
        if($this->$s>0)
            $style.=$s;
    }
    $this->SetFont('',$style);
}

function PutLink($URL, $txt)
{
    //Put a hyperlink
    $this->SetTextColor(0,0,255);
    $this->SetStyle('U',true);
    $this->Write(5,$txt,$URL);
    $this->SetStyle('U',false);
    $this->SetTextColor(0);
}


/*
// imprimir HTML
protected $B = 0;
protected $I = 0;
protected $U = 0;
protected $HREF = '';

function WriteHTML($html)
{
    // Intérprete de HTML
    $html = str_replace("\n",' ',$html);
    $a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
    foreach($a as $i=>$e)
    {
        if($i%2==0)
        {
            // Text
            if($this->HREF)
                $this->PutLink($this->HREF,$e);
            else
                $this->Write(5,$e);
        }
        else
        {
            // Etiqueta
            if($e[0]=='/')
                $this->CloseTag(strtoupper(substr($e,1)));
            else
            {
                // Extraer atributos
                $a2 = explode(' ',$e);
                $tag = strtoupper(array_shift($a2));
                $attr = array();
                foreach($a2 as $v)
                {
                    if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                        $attr[strtoupper($a3[1])] = $a3[2];
                }
                $this->OpenTag($tag,$attr);
            }
        }
    }
}

function OpenTag($tag, $attr)
{
    // Etiqueta de apertura
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,true);
    if($tag=='A')
        $this->HREF = $attr['HREF'];
    if($tag=='BR')
        $this->Ln(5);
}

function CloseTag($tag)
{
    // Etiqueta de cierre
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,false);
    if($tag=='A')
        $this->HREF = '';
}

function SetStyle($tag, $enable)
{
    // Modificar estilo y escoger la fuente correspondiente
    $this->$tag += ($enable ? 1 : -1);
    $style = '';
    foreach(array('B', 'I', 'U') as $s)
    {
        if($this->$s>0)
            $style .= $s;
    }
    $this->SetFont('',$style);
}

function PutLink($URL, $txt)
{
    // Escribir un hiper-enlace
    $this->SetTextColor(0,0,255);
    $this->SetStyle('U',true);
    $this->Write(5,$txt,$URL);
    $this->SetStyle('U',false);
    $this->SetTextColor(0);
}
*/

  // Cabecera de página
  function Header()
  {

      global $paciente,
              $medico,
              $id_plantilla,
              $fecha,
              $estudio2,
              $studio,
              $edad,
              $metodo,
              $posinim,
              $tipfuem,
              $tamfuem;

      $this->Image('../../imagenes/logo_arca.png',15,5,50,0);
      $this->Image('../../imagenes/pacal.jpg',160,5,40,0);
      //$this->Image('../imagenes/firma.gif',153,225,40,0);
      $this->Ln(18);
      $this->Cell(5);
      $this->SetFont('Arial','B',15);
      //$this->SetDrawColor(0,80,180);
    //$this->SetFillColor(230,230,0);
      $this->SetTextColor(0,0,255);
      //$this->Cell(185,5,'UNIDAD CENTRAL ARCA TULYEHUALCO ',0,0,'C');
      //$this->Ln(5);
      $this->SetFont('Arial','I',10);
      $this->Cell(185,5,'Josefa Ortiz de Dominguez No. 5 San Isidro Tulyehualco, Xochimilco, CDMX',0,0,'C');
      $this->Ln(3);
      $this->Cell(185,5,'________________________________________________________________________________________________',0,0,'C');
      $this->SetTextColor(0,0,0);

      // Primer columna de titulos
      $this->Ln(10);
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
      $this->Cell(81,5,$id_plantilla,0,0,'L');

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
      $this->SetXY(122, 54); 
      $this->Write(0,'EDAD:'); 
      $this->SetFont('Arial','',11);
      $this->SetXY(137,54); 
      $this->Write(0,$edad);

      // Cuarta linea


      $this->ln(10);

      $this->Ln();

  }

// Pie de página
  function Footer()
  {

    global $id_plantilla,$studio,$con,$verificado,$tamfuev,$tipfuev,$posiniv;

    $this->SetY(-40); //
    //$this->ln(10);
    $this->Cell($posiniv);

    $this->SetFont('Arial','',10);
    $this->Cell(30,5,$verificado,0,0,'L'); 
    $this->ln(10); // aqui
    //$this->Cell(5);
/*
    $sql="SELECT p2.firma FROM cr_plantilla_usg_rx p2 WHERE p2.id_plantilla =".$id_plantilla." AND p2.estado = 'A'";
    if ($result = mysqli_query($con, $sql)) {
      while($row = $result->fetch_assoc())
        {
          $this->Cell(9);
          $firma=$row['firma'];
          //$this->Image('../../imagenes/firma.gif',153,225,40,0);
          $this->SetFont('Arial','B',10);
          $this->MultiCell(170,5,utf8_decode($firma),0,'L');
          $this->ln(4);
        }
*/
    $this->ln(-2);
    $this->Cell(1);
    $this->SetTextColor(0,0,255);
    $this->Cell(185,5,'_____________________________________________________________________________________________',0,0,'L');

    $this->SetTextColor(26,35,126); 
    $this->SetFont('Arial','B',16);
    $this->SetXY(65,257); 
    $this->Write(0,'www.laboratoriosarca.com.mx');

    $this->Image('../../imagenes/whatsapp.jpg',10,262,7,0);
    $this->SetTextColor(27,94,32); 
    $this->SetFont('Arial','B',12);
    $this->SetXY(16,266); 
    $this->Write(0,'55 3121 0700');
    $this->SetTextColor(0,0,0);

    $this->Image('../../imagenes/telefono.jpg',50,262,7,0);
    $this->SetTextColor(230,81,0); 
    $this->SetFont('Arial','B',12);
    $this->SetXY(56,266); 
    $this->Write(0,'ARCATEL: 216 141 44');
    $this->SetTextColor(0,0,0);

    $this->Image('../../imagenes/email.jpg',105,262,7,0);
    $this->SetTextColor(26,35,126); 
    $this->SetFont('Arial','B',11);
    $this->SetXY(110,266); 
    $this->Write(0,'atencion.cliente@laboratoriosarca.com.mx');
    $this->SetTextColor(0,0,0);

    $this->SetTextColor(26,35,126); 
    $this->SetFont('Arial','B',10);
    $this->SetXY(20,274); 
    $this->Write(0,'Tulyehualco - San Gregorio - Xochimilco - Santiago - San Pablo - San Pedro - Tecomitl - Tetelco');
    $this->SetTextColor(0,0,0);

    //}
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

$sql="select nombre_plantilla,titulo_desc,descripcion,firma FROM cr_plantilla_usg
  where id_plantilla=".$id_plantilla." and fk_id_estudio=".$studio;

  if ($result = mysqli_query($con, $sql)) {
    while($row = $result->fetch_assoc())
      {

        $pdf->Cell(9);
        $pdf->SetFont('Arial','B',14);
        $pdf->Cell(160,5,($row['titulo_desc']),0,0,'C');
        $pdf->ln(10);
/*
        $pdf->Cell(1);
        $pdf->SetFont('Arial','B',13);
        $pdf->Cell(160,5,utf8_decode(($row['titulo_desc'])),0,0,'L');
*/
        $pdf->ln(3);
        $pdf->SetFont('Arial','',9);
        //$pdf->MultiCell(185,5,utf8_decode($pdf->WriteHTML($row['descripcion'])),0,'J');
        //$pdf->WriteHTML($contents)
        $pdf->WriteHTML($row['descripcion']);
        $pdf->ln(5);

        $pdf->SetFont('Arial','B',10);
        $pdf->MultiCell(170,5,trim($row['firma']),0,'L');

       }
      }

$pdf->Output();
?>