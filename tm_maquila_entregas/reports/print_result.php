<?php
session_start();
date_default_timezone_set('America/Mexico_City');

//header('Content-Type: text/html; charset=ISO-8859-1');

header("Content-Type: text/html;charset=utf-8");

require('../../fpdf/fpdf.php');

 require_once ("../../so_factura/config/db.php");//Contiene las variables de configuracion para conectar a la base de datos

 require_once ("../../so_factura/config/conexion.php");//Contiene funcion que conecta a la base de datos



//se recibe los paramteros para la generación del reporte

$id_plantilla=1;

$studio=1;
$id_usuario=$_SESSION['nombre'];
$fk_id_equipo=$_GET['fk_id_equipo'];
$fecha_toma=$_GET['fecha_toma'];


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
      $this->Cell(180,5,'LABORATORIOS CLINICOS ARCA',0,0,'C');
      $this->Ln(5);
      $this->SetFont('Arial','B',12);
      $this->Cell(170,10,utf8_decode('Bitácora de traslado de muestras'),0,0,'C');
      $this->Cell(100,10,'(FOR-PRE-03)',0,0,'L');
      $this->Ln(10);
      $this->SetFont('Arial','B',10);
      $this->Cell(53,10,'GENERADO POR LA UNIDAD: ',0,0,'L');
      $this->SetFont('Arial','',9);
      $this->Cell(20,10,$sucursal,0,0,'L');
      $this->Cell(57);
      $this->Cell(20,10,utf8_decode($fecha).' '.strftime("y son las %H:%M"),0,0,'L');
      // $this->Cell(20,10,strftime("Hoy es %A y son las %H:%M"));
      $this->Ln(1);
      $this->Cell(100,10,'___________________________________________________________________________________________________________________',0,0,'L');

      $this->Ln(5);
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



$equipo_ant='';

$sql="
  SELECT 
  s.desc_corta,
  t.`fk_id_equipo`,
  e.descripcion,
  m.`desc_medio`,
  DATE(t.fecha_toma) AS fecha_toma,
  t.aceptado_ia,
  t.`fecha_llego`,
  t.`fecha_salio`,
  temperatura,
  q.`descripcion` AS termometro,
  COUNT(*) muestras
  FROM 
  tm_tomas t
  LEFT OUTER JOIN eb_equipos e ON (e.id_equipo = t.fk_id_equipo)
  LEFT OUTER JOIN km_medios m ON (m.`id_medio` = t.`fk_id_medio`)
  LEFT OUTER JOIN kg_sucursales s ON (s.id_sucursal = t.`fk_id_sucursal`)
  LEFT OUTER JOIN eb_equipos q ON (q.`id_equipo` = t.`fk_id_termometro`)
  WHERE DATE(t.fecha_toma) >= '$fecha_toma'
  AND t.fk_id_equipo = $fk_id_equipo
  AND aceptado_ia IN (2)
  GROUP BY 1,2,3,4,5,6,7,8,9,10
  ORDER BY s.desc_corta,m.desc_medio
  ";
//echo $sql;

  $pdf->SetFont('Arial','',10);

  if ($result = mysqli_query($con, $sql)) {

    while($row = $result->fetch_assoc())

      {
        if ($row['descripcion'] =! $equipo_ant)
        {
          $pdf->ln(3);
          $pdf->Cell(1);
          $pdf->Cell(50,5,'Equipo: '.$row['descripcion'],0,0,'L');
          $equipo_ant = $row['descripcion'];
        }

        $pdf->ln(10);
        $pdf->Cell(1);
        $pdf->Cell(50,5,$row['desc_medio'],0,0,'L');
        $pdf->Cell(50,5,$row['muestras'],0,0,'L');
 
/*

        $pdf->Cell(1);

        $pdf->SetFont('Arial','B',13);

        $pdf->Cell(160,5,utf8_decode(($row['titulo_desc'])),0,0,'L');

*/





       }

      }



$pdf->Output();

?>