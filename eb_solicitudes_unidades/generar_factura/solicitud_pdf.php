<?php 


require('./fpdf/fpdf.php');
include './barcode/barcode.php';


class PDF extends FPDF
{
//Cabecera de página
   function Header()
   {
    //Logo
    //$this->Image('./logo_p.png',10,8,33);
    //Arial bold 15
    $this->SetFont('Arial','B',10);
    //Movernos a la derecha
    $this->Cell(60);
    //Título
    $this->Cell(50,10,'Laboratorios ARCA',0,0,'C');
    //Salto de línea
    $this->Ln(10);
      
   }
   
   //Pie de página
   function Footer()
   {
    //Posición: a 1,5 cm del final
    $this->SetY(-25);
    //Arial italic 8
    $this->SetFont('Arial','I',8);
    $this->Cell(30,10,'papeleriaeinternetyair.com.mx',10,0,'C');
    //Número de página
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
   }
   //Tabla simple
   function TablaSimple()
   {
    //Cabecera
    include ("../../controladores/conex.php");
	$id = urldecode(base64_decode($_GET['val']));
	$query = "SELECT *,pd.desc_producto,pe.razon_social FROM eb_solicitudes sl 
    LEFT OUTER JOIN eb_productos pd ON (pd.id_producto = sl.fk_id_producto)
    LEFT OUTER JOIN 
     pe ON (pe.id_proveedor = sl.fk_id_proveedor) 
    WHERE sl.fk_id_usuario = $id AND sl.estado = 'A'";

	$result = $conexion->query($query);
	//foreach($header as $col)
		$this->Cell(15,7,'ID',1);
		$this->Cell(55,7,'Producto',1);
		$this->Cell(60,7,'Proveedor',1);
		$this->Cell(20,7,'Cantidad',1);
		$this->Cell(25,7,'Costo',1);
		$this->Ln();
    while ($row = mysqli_fetch_array($result))
	{
			$id_solicitud = $row['id_solicitud'];
			$desc_producto = $row['desc_producto'];
			$razon_social = $row['razon_social'];
			$cantidad = $row['cantidad'];
			$costo_pza = $row['costo_pza'];
	      $this->Cell(15,5,$id_solicitud,1);
	      $this->Cell(55,5,$desc_producto,1);
	      $this->Cell(60,5,$razon_social,1);
	      $this->Cell(20,5,$cantidad,1);
	      $this->Cell(25,5,$costo_pza,1);
	      $this->Ln();
				
	}
	/*
		$query2 = "SELECT * FROM total_venta WHERE id_venta = $id";
		$result2 = $conexion->query($query2);
		$row2 =mysqli_fetch_array($result2);
		$num = $row2['total'];
		$num2 = $row2['descuento'];
		$num3 = $row2['total_pago'];
		$num4 = $row2['su_pago'];
		$num5 = $row2['cambio'];
		  $this->Cell(20,5,'',0);
	      $this->Cell(90,5,'',0);
	      $this->Cell(30,5,'',0);
	      $this->Cell(30,5,'Total',1);
	      $this->Cell(20,5,'$'.$num,1);
	      $this->Ln();
	      $this->Cell(20,5,'',0);
	      $this->Cell(90,5,'',0);
	      $this->Cell(30,5,'',0);
	      $this->Cell(30,5,'Descuento',1);
	      $this->Cell(20,5,'$'.$num2,1);
	      $this->Ln();
		  $this->Cell(20,5,'',0);
	      $this->Cell(90,5,'',0);
	      $this->Cell(30,5,'',0);
	      $this->Cell(30,5,'Total a Pagar',1);
	      $this->Cell(20,5,'$'.$num3,1);
	      $this->Ln();
	      $this->Cell(20,5,'',0);
	      $this->Cell(90,5,'',0);
	      $this->Cell(30,5,'',0);
	      $this->Cell(30,5,'Su Pago',1);
	      $this->Cell(20,5,'$'.$num4,1);
	      $this->Ln();
	      $this->Cell(20,5,'',0);
	      $this->Cell(90,5,'',0);
	      $this->Cell(30,5,'',0);
	      $this->Cell(30,5,'Cambio',1);
	      $this->Cell(20,5,'$'.$num5,1);
	      $this->Ln();*/
   }
   
}

$pdf=new PDF();
//Títulos de las columnas

$pdf->AliasNbPages();
//Primera página
$pdf->AddPage();
$pdf->SetY(50);
$pdf->Cell(60,5,'Calle',0,1);
$pdf->Cell(60,5,'Ubicacion',0,1);
$pdf->Cell(60,5,'Telefono: ',0,1);
$pdf->Cell(60,5,'E-mail:',0,1);
$pdf->Ln();
//$pdf->Cell(40,40,'Direccion: Fray Pedro de Gante #247');
$pdf->SetY(80);
$pdf->TablaSimple();
$y = $pdf->SetY(230);
/*include ("../../config/conexion.php");
	$id = $_GET['val'];
	$query3 = "SELECT * FROM total_venta WHERE id_venta = $id";
	$result3 = $conexion->query($query3);
  while ($row3 = mysqli_fetch_array($result3))
	{
		$venta = $row3['id_venta'];
		barcode('codigos/'.$venta.'.png', $venta, 20, 'horizontal', 'code128', true);

		$pdf->Image('codigos/'.$venta.'.png',70,$y,60,0,'PNG');
				
		$y = $y+15;
	}
*/
$pdf->SetAutoPageBreak(false,200);
$pdf->Output();
 ?>