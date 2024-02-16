<?php
session_start();
date_default_timezone_set('America/Mexico_City');
header('Content-Type: text/html; charset=ISO-8859-1');
require('../../fpdf/fpdf.php');
//require_once ("../so_factura/config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
//require_once ("../so_factura/config/conexion.php");//Contiene funcion que conecta a la base de datos

include ("../../controladores/conex.php");
include ("../../controladores/conex_arca.php");

$fk_id_sucursal=$_SESSION['fk_id_sucursal'];
//$id_usuario=$_SESSION['nombre'];
$usr_1=$_SESSION['id_usuario'];
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
AND id_usuario= '" . $usr_1 . "' ";
//echo $query;
$resultado = mysqli_query($conexion, $query);

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
      $this->Cell(170,5,'LABORATORIOS ARCA',0,0,'C');
      $this->Ln(5);
      $this->SetFont('Arial','B',12);
      $this->Cell(175,10,'Envio de Maquila',0,0,'C');
      $this->Ln(10);
      $this->SetFont('Arial','B',10);
      $this->Cell(17,10,'UNIDAD: ',0,0,'L');
      $this->SetFont('Arial','',9);
      $this->Cell(20,10,$sucursal,0,0,'L');
      $this->Cell(90);
      $this->Cell(20,10,utf8_decode($fecha).' '.strftime("y son las %H:%M"),0,0,'L');
      // $this->Cell(20,10,strftime("Hoy es %A y son las %H:%M"));
      $this->Ln(1);
      $this->Cell(250,10,'_______________________________________________________________________________________________________________',0,0,'L');
      $this->Ln(4);
      $this->SetFont('Arial','B',8);
      $this->Cell(11,10,'FOLIO',0,0,'C');
      $this->Cell(65,10,'NOMBRE',0,0,'C');
      $this->Cell(15,10,'EDAD',0,0,'C');
      
      $this->Cell(40,10,'ESTUDIO',0,0,'C');
      $this->Cell(50,10,'GENERO',0,0,'C');
      $this->Cell(25,10,'COSTO',0,0,'L');

      $this->Ln(1);
      $this->Cell(250,10,'_____________________________________________________________________________________________________________________________',0,0,'L');
      // Salto de línea
      $this->Ln(10);
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
$pdf = new PDF('P','mm','Letter');
$pdf->SetAutoPageBreak(true,25);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$numero='1';

$sql="SELECT  ma.*, fa.*
FROM  ma_maquila ma, so_factura fa
WHERE ma.se_envia = 'S'
AND ma.estado = 'A'
AND DATE(ma.fecha_envio) = CURDATE()
AND ma.fk_id_factura = fa.id_factura
ORDER BY ma.fk_id_factura
";
//echo $sql;
$tipo_estudio='';
if ($result = mysqli_query($conexion, $sql)) {
  //$pdf->Ln(5);
  $pdf->SetTextColor(0,0,0);
  $pdf->SetFont('Arial','B',9);
  $pdf->Cell(175,10,'PETICIONES EN CURSO',0,0,'C');
  $pdf->Ln(5);
  while($row = $result->fetch_assoc())
      {

// Extrae los datos del cliente de la BD de ARCA
            $id_cliente = $row['fk_id_cliente'];
            $querycliente = mysqli_query($conexion_arca,"
                SELECT 
                case
                    when so_clientes.fk_id_sexo = '1' THEN
                        'Mujer'
                    else
                        'Hombre'
                end as sexo,
                CONCAT(nombre,' ',a_paterno,' ',a_materno) as paciente,
                CONCAT(colonia,' ',calle,' #',numero_exterior) as direccion,
                CONCAT(telefono_fijo,' - ',telefono_movil) AS telefono,
                CASE
                    WHEN `anios` > 0 THEN
                        CONCAT(`anios`,' Años')
                    WHEN `meses` > 0 THEN
                        CONCAT(`meses`,' Meses')
                    WHEN `dias` > 0 THEN
                        CONCAT(`dias`,' Dias')
                END AS edad
                FROM so_clientes WHERE id_cliente = $id_cliente");   
            $mostrar = mysqli_fetch_array($querycliente);      
            $sexo=$mostrar['sexo'];
            $paciente=($mostrar['paciente']);
            $edad=($mostrar['edad']);
//
// Extrae datos de la BD de ARCA datos del estudio
            $id_estudio = $row['fk_id_estudio'];

            $queryestudio = mysqli_query($conexion_arca,"SELECT es.* FROM km_estudios es WHERE id_estudio = $id_estudio");
            $mostrar = mysqli_fetch_array($queryestudio);

            $desc_estudio = $mostrar['desc_estudio'];
           // $id_muestra = $mostrar['fk_id_muestra'];

            $fk_id_estudio_maq = $mostrar['fk_id_estudio_maq'];


            $total_cole='';
            $recoleccion='';
            if($mostrar['fk_id_muestra'] <> 539){
              $id_muestra = $mostrar['fk_id_muestra'];
              $qmuestra = mysqli_query($conexion_arca,"SELECT m1.recoleccion FROM km_muestras m1 WHERE m1.id_muestra = $id_muestra");
              $muestra = mysqli_fetch_array($qmuestra);
              $recoleccion = $muestra['recoleccion'];
              $total_cole=$recoleccion;
            }

            $recoleccion_1='';
            if($mostrar['fk_id_muestra_1'] <> 539){
              $id_muestra_1 = $mostrar['fk_id_muestra_1'];
              $qmuestra1 = mysqli_query($conexion_arca,"SELECT m1.recoleccion FROM km_muestras m1 WHERE m1.id_muestra = $id_muestra_1");
              $muestra1 = mysqli_fetch_array($qmuestra1);
              $recoleccion_1 = $muestra1['recoleccion'];
              $total_cole=$total_cole.','.$recoleccion_1;
            }
            $recoleccion_2='';
            if($mostrar['fk_id_muestra_2'] <> 539){
              $id_muestra_2 = $mostrar['fk_id_muestra_2'];
              $qmuestra2 = mysqli_query($conexion_arca,"SELECT m1.recoleccion FROM km_muestras m1 WHERE m1.id_muestra = $id_muestra_2");
              $muestra2 = mysqli_fetch_array($qmuestra2);
              $recoleccion_2 = $muestra2['recoleccion'];
              $total_cole=$total_cole.','.$recoleccion_2;
            }

// Fin
// Extrae datos de la BD de ARCA datos del costo de la maquila
        $qestma = mysqli_query($conexion_arca,"SELECT es.costo FROM km_estudios es WHERE es.id_estudio = $fk_id_estudio_maq");
        $r_estmaq = mysqli_fetch_array($qestma);

           $costo = $r_estmaq['costo'];


        $pdf->Ln(5);
        $pdf->SetFont('Courier','',9);
        $pdf->Cell(10,5,$row['fk_id_factura'],0,0,'L');
   
        $pdf->Cell(65,5,utf8_decode(strtolower(substr($paciente,0,35))),0,0,'L');
        $pdf->Cell(20,5,utf8_decode($edad),0,0,'C');
        $pdf->Cell(60,5,$desc_estudio,0,0,'L');
        $pdf->Cell(30,5,$sexo,0,0,'L');
        $pdf->Cell(25,5,$costo,0,0,'L');
        $pdf->Ln(4);
        $pdf->Cell(10);
        
        $pdf->Cell(60,5,'Muestra:'.$total_cole,0,0,'L');
      }
}



$pdf->Output();

?>