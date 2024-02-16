<?php
session_start();
date_default_timezone_set('America/Mexico_City');
header('Content-Type: text/html; charset=ISO-8859-1');
require('../fpdf/fpdf.php');
require_once ("../so_factura/config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../so_factura/config/conexion.php");//Contiene funcion que conecta a la base de datos

//$fk_id_sucursal=$_SESSION['fk_id_sucursal'];
$id_usuario=$_SESSION['nombre'];
//$usr_1=$_GET['nombre'];
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
      $this->Cell(240,5,'LABORATORIOS CLINICOS ARCA',0,0,'C');
      $this->Ln(5);
      $this->SetFont('Arial','B',12);
      $this->Cell(142,10,'Reporte de inventario',0,0,'R');
      $this->Cell(120,10,'FOR-COM-13',0,0,'R');
      $this->Ln(10);
      $this->SetFont('Arial','B',10);
      $this->Cell(53,10,'GENERADO POR LA UNIDAD: ',0,0,'L');
      $this->SetFont('Arial','',9);
      $this->Cell(20,10,$sucursal,0,0,'L');
      $this->Cell(120);
      $this->Cell(20,10,utf8_decode($fecha).' '.strftime("y son las %H:%M"),0,0,'L');
      // $this->Cell(20,10,strftime("Hoy es %A y son las %H:%M"));
      $this->Ln(1);
      $this->Cell(250,10,'____________________________________________________________________________________________________________________________________________________',0,0,'L');
      $this->Ln(4);
      $this->SetFont('Arial','B',7);
	    $this->Cell(17,10,'Id',0,0,'C');
      $this->Cell(35,10,utf8_decode('Producto'),0,0,'C');
      $this->Cell(65,10,utf8_decode('Unidad Medida'),0,0,'C');
      $this->Cell(60,10,utf8_decode('Proveedor'),0,0,'C');
      //$this->Cell(45,10,utf8_decode('U. medida'),0,0,'C');
      
      //$this->Cell(10,10,'Costo',0,0,'C');
      $this->Cell(30,10,'Existencias',0,0,'C');
      //$this->Cell(48,10,'DX',0,0,'C');
      $this->Cell(25,10,'Minimo',0,0,'C');
      $this->Cell(15,10,'Maximo',0,0,'C');
      $this->Ln(1);
      $this->Cell(250,10,'_______________________________________________________________________________________________________________________________________________________________________________________________',0,0,'L');
      // Salto de línea
      $this->Ln(5);
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
$pdf = new PDF('L','mm','Letter');
$pdf->SetAutoPageBreak(true,25);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$numero='1';

  $sql = "
SELECT ac.`fk_id_producto`,
p.`razon_social`,
pr.`desc_producto`,
ca.`descripcion`,
um.`unidad_medida`,
ac.`costo_producto`,
ac.`existencias`,
ac.`min`,
ac.`max`,
pr.cod_producto
FROM eb_almacen_central ac
LEFT OUTER JOIN eb_productos pr ON (pr.`id_producto` = ac.`fk_id_producto`)
LEFT OUTER JOIN eb_categoria ca ON (ca.`id_categoria` = pr.`fk_id_categoria`)
LEFT OUTER JOIN eb_unidad_medida um ON (um.`id_unidad` = pr.`fk_unidad_medida`)
LEFT OUTER JOIN eb_proveedores p ON (p.`id_proveedor` = pr.`fk_id_proveedor` AND p.estado = 'A')
WHERE ac.`estado` = 'A'
order by 3
";
//echo $sql;
$sucursal='';
$num_muestras=0;
$v_nombre=' ';
if ($result = mysqli_query($con, $sql)) {
  //$pdf->Ln(5);
  $pdf->SetTextColor(0,0,0);
  $pdf->SetFont('Arial','B',8);
  //$pdf->Cell(175,10,'PETICIONES EN CURSO',0,0,'C');
  while($row = $result->fetch_assoc())
      {


        $pdf->Ln(4);
        $pdf->cell(2);
        $pdf->SetFont('Courier','',7);
        
	      $pdf->Cell(20,5,$row['cod_producto'],0,0,'L');
        $pdf->cell(3);
        $pdf->Cell(60,5,utf8_decode($row['desc_producto']),0,0,'L');

        $pdf->cell(3);
        $pdf->Cell(55,5,utf8_decode(substr($row['unidad_medida'],0,34)),0,0,'L');
        $pdf->Cell(55,5,utf8_decode(substr($row['razon_social'],0,25)),0,0,'L');

        $pdf->Cell(20,5,utf8_decode(strtolower(substr($row['existencias'],0,33))),0,0,'L');
       
        
        //$pdf->Cell(15,5,($row['costo_producto']),0,0,'R');

        //$pdf->cell(15,5,substr($row['existencias'],0,20),0,0,'R');

        $pdf->Cell(15,5,$row['min'],0,0,'R');
        $pdf->Cell(15,5,$row['max'],0,0,'R');
        $num_muestras=$num_muestras+1;
        }
        $pdf->Ln(10);
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(45,5,"Total de productos = ".$num_muestras,0,0,'L');
		$pdf->Cell(45,5,"Elaboro: ".$id_usuario,0,0,'L');
    }    


$pdf->Output();

?>