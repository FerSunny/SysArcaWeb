<?php
//session_start();
date_default_timezone_set('America/Mexico_City');
header('Content-Type: text/html; charset=ISO-8859-1');
require('../../fpdf/fpdf.php');
 require_once ("../../so_factura/config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
 require_once ("../../so_factura/config/conexion.php");//Contiene funcion que conecta a la base de datos

//se recibe los paramteros para la generación del reporte
$mes=$_GET['mes'];
$anio=$_GET['anio'];
$sucursal = 1;


/*$ing_otros='0';
$ing_num='0';
$num_mov_egr='0';
$num_imp_egr='0';
$num_mov_egr_o='0';*/
$desc_sucursal='';

//Obtener los datos, de la cabecera
$sql="SELECT 
DISTINCT su.`desc_sucursal`
FROM eb_almacen_central ac
LEFT OUTER JOIN kg_sucursales su ON (su.`id_sucursal` = ac.`fk_id_sucursal`)
WHERE ac.estado ='A'
AND ac.`fk_id_sucursal` = ".$sucursal."

AND YEAR(ac.`fecha_actualizacion`) = ".$anio."
AND MONTH(ac.`fecha_actualizacion`) = ".$mes;


//echo $sql;

  $paciente='0';

     if ($result = mysqli_query($con, $sql)) {
        while($row = $result->fetch_assoc())
        {

            $desc_sucursal=$row['desc_sucursal'];
        }
    }


class PDF extends FPDF
{
// Cabecera de página
function Header()
{

    global $desc_sucursal,$mes;


    $this->Image('../imagenes/logo_arca.png',15,10,30,10);
    //$this->Ln(20);
    $this->Cell(35);
    $this->SetFont('Arial','B',10);
    //$this->SetDrawColor(0,80,180);
   //$this->SetFillColor(230,230,0);
    $this->SetTextColor(0,0,255);
    $this->Cell(125,5,'UNIDAD--> '.$desc_sucursal,0,0,'L');
	$this->ln(5);
    $this->Cell(8);
    $this->SetFont('Courier','B',12);
    $this->Cell(180,5,'CONTROL DE EXISTENCIA ,CONSUMO Y PEDIDO DE ABASTO',0,0,'C');
	$this->ln(5);
	$this->Cell(35);
	$this->Cell(100,5,'PERIODO: Mensual-->'.$mes,0,0,'L');
    $this->SetTextColor(0,0,0);
	
	$this->ln(15);	

}

// Pie de página
  function Footer()
  {

    $this->SetY(-10);

    $this->Cell(20);
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}
//
// Creación del objeto de la clase heredada
//
$pdf = new PDF('P','mm','Letter');
//$pdf->SetMargins(0,0,0);
$pdf->SetAutoPageBreak(true,10);

$pdf->AliasNbPages();
$pdf->AddPage();

$num='0';
//$id_factura='0';

      $pdf->Cell(9);
      $pdf->SetTextColor(0,130,200); 
      
      $pdf->SetFont('Arial','','9');
	  $pdf->Cell(25,5,"-----------------------------------------------------------------------------------------------------------------------------------------------------------------------",0,0,'L');
	  $pdf->ln(3);
	  $pdf->Cell(9);
      $pdf->Cell(5,5,"#",0,0,'R');
      $pdf->Cell(25,5,"Producto",0,0,'L');
	  $pdf->Cell(20);
      $pdf->Cell(10,5,"U. Medida",0,0,'L');
	  $pdf->Cell(12);    
      $pdf->Cell(23,5,"E. Inical",0,0,'L');
      $pdf->Cell(21,5,"Abasto",0,0,'L');
      $pdf->Cell(23,5,"Consumo",0,0,'L');
      $pdf->Cell(23,5,"Existencia",0,0,'L');
	  $pdf->ln(3);
	  $pdf->Cell(9);
	  $pdf->Cell(25,5,"-----------------------------------------------------------------------------------------------------------------------------------------------------------------------",0,0,'L');
	  $pdf->ln(5);

$sql="
SELECT 	pr.`cod_producto`,
	pr.`desc_producto`,
	um.`abreviatura`,
	pv.`razon_social`,
-- EXISTENCIA INICIAL	
	(ac.`existencias` - (SELECT IFNULL(SUM(so.cantidad),0) AS cantidad FROM eb_solicitudes so
WHERE so.`fk_id_producto` = ac.`fk_id_producto`
AND so.fk_id_sucursal = 1
AND so.estado = 'A'
AND so.llego = 'S'
AND YEAR(so.`fecha_registro`) = YEAR(ac.`fecha_actualizacion`)
AND MONTH(so.`fecha_registro`) = MONTH(ac.`fecha_actualizacion`))  ) AS existe_inicial,

-- EXISTENCIA SURTIDO

IFNULL((SELECT so.cantidad FROM eb_solicitudes so
WHERE so.`fk_id_producto` = ac.`fk_id_producto`
AND so.fk_id_sucursal = 1
AND so.estado = 'A'
AND so.llego = 'S'
AND YEAR(so.`fecha_registro`) = YEAR(ac.`fecha_actualizacion`)
AND MONTH(so.`fecha_registro`) = MONTH(ac.`fecha_actualizacion`)),0) AS abasto,

-- CONSUMOS

IFNULL((SELECT so.cantidad FROM eb_solicitudes so
WHERE so.`fk_id_producto` = ac.`fk_id_producto`
AND so.fk_id_sucursal <> 1
AND so.estado = 'A'
AND so.llego = 'S'
AND YEAR(so.`fecha_registro`) = YEAR(ac.`fecha_actualizacion`)
AND MONTH(so.`fecha_registro`) = MONTH(ac.`fecha_actualizacion`)),0) AS conumos,


/*
(SELECT IFNULL(SUM(df.cantidad),0) AS consumo
FROM 	so_detalle_factura df,
	so_factura fa,
	km_insumos_estudio ins
WHERE df.`id_factura` = fa.`id_factura`
AND df.`fk_id_estudio` = ins.`fk_id_estudio`
AND ins.`fk_id_producto` = pr.cod_producto
AND YEAR (fa.`fecha_factura`) = YEAR(ac.`fecha_actualizacion`)
AND MONTH(fa.`fecha_factura`) = MONTH(ac.`fecha_actualizacion`)) AS conumos,
*/

-- EXISTENCIA ACTUAL
	ac.`existencias`
FROM eb_almacen_central ac
LEFT OUTER JOIN eb_productos pr ON (pr.`id_producto` = ac.`fk_id_producto` AND pr.`estado` ='A')
LEFT OUTER JOIN eb_unidad_medida um ON (um.`id_unidad` = pr.`fk_unidad_medida`)
LEFT OUTER JOIN eb_proveedores pv ON (pv.`id_proveedor` = ac.`fk_id_proveedor`)
WHERE ac.estado ='A'
AND ac.`fk_id_sucursal` = 1
AND pr.`desc_producto` IS NOT NULL
AND YEAR(ac.`fecha_actualizacion`) = ".$anio."
AND MONTH(ac.`fecha_actualizacion`) = ".$mes
;

//echo $sql;
if ($result = mysqli_query($con, $sql)) {
  while($row = $result->fetch_assoc())
    {

      $num+=1;
      $pdf->Cell(9);
      $pdf->SetTextColor(0,130,200); 
      
      $pdf->SetFont('Arial','','9');       
      $pdf->Cell(5,5,$num,0,0,'R');
      $pdf->Cell(25,5,utf8_decode(substr($row['desc_producto'],1,28)),0,0,'L');
	  $pdf->Cell(20);
      $pdf->Cell(8,5,$row['abreviatura'],0,0,'L');
	  $pdf->Cell(1);    
      $pdf->Cell(23,5,number_format($row['existe_inicial'],2),0,0,'R');
      $pdf->Cell(21,5,number_format($row['abasto'],2),0,0,'R');
      $pdf->Cell(23,5,number_format($row['conumos'],2),0,0,'R');
      $pdf->Cell(23,5,number_format($row['existencias'],2),0,0,'R');

      $pdf->ln(5);
    } 

  }

$pdf->Output();
?>