<?php 

session_start();

include ("../../controladores/conex.php");

require ("../../fpdf/fpdf.php");

include './barcode/barcode.php';

$sucursal=$_SESSION['fk_id_sucursal'];

$nombre = $_SESSION['nombre_completo'];

$id_detalle = $_GET['val'];

class PDF extends FPDF

{

//cabecera de la pagina 

function Header()

{



$this->Image('../../imagenes/logo_arca.png',15,5,50,0);

    $this->Image('../../imagenes/pacal.jpg',160,5,40,0);

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
	$this->Ln(4);
	 $this->Cell(185,5,' ORDEN DE COMPRA FOR-COM-15',0,0,'C');
    $this->SetTextColor(0,0,0);

    $this->ln(15);



}



//pie de pagina 

function Footer()

{



    $this->ln(-1);

    $this->Cell(5);

    $this->SetTextColor(0,0,255);

    $this->Cell(180,5,'_________________________________________________________________________',0,0,'L');

    $this->SetTextColor(26,35,126);

    $this->SetFont('Arial','B',16);

    $this->SetXY(65,273); 

    $this->Write(0,'www.laboratoriosarca.com.mx');



    $this->Image('../../imagenes/whatsapp.jpg',10,275,7,0);

    $this->SetTextColor(27,94,32); 

    $this->SetFont('Arial','B',12);

    $this->SetXY(16,278); 

    $this->Write(0,'55 3121 0700');

    $this->SetTextColor(0,0,0);



    $this->Image('../../imagenes/telefono.jpg',50,275,7,0);

    $this->SetTextColor(230,81,0); 

    $this->SetFont('Arial','B',12);

    $this->SetXY(56,278); 

    $this->Write(0,'ARCATEL: 216 141 44');

    $this->SetTextColor(0,0,0);



    $this->Image('../../imagenes/email.jpg',105,275,7,0);

    $this->SetTextColor(26,35,126); 

    $this->SetFont('Arial','B',11);

    $this->SetXY(110,278); 

    $this->Write(0,'atencion.cliente@laboratoriosarca.com.mx');

    $this->SetTextColor(0,0,0);



    $this->SetTextColor(26,35,126); 

    $this->SetFont('Arial','B',10);

    $this->SetXY(20,284); 

    $this->Write(0,'Tulyehualco - San Gregorio - Xochimilco - Santiago - San Pablo - San Pedro - Tecomitl - Tetelco');



   }

 



    function Tabla()

    {

      global $nombre,$sucursal,$conexion,$id_detalle;

       $id_proveedor = $_GET['val'];

       $query1 = "SELECT desc_sucursal FROM kg_sucursales  WHERE id_sucursal = ?";

       $stmt = $conexion->prepare($query1);

       $stmt->bind_param("i",$sucursal);

       $stmt->execute();

       $result = $stmt->get_result();

            $this->Ln(10);

            $this->SetFont('Arial','B',8);

            $this->Cell(5,3,'RESPONSABLE:' . $nombre,0);        

            while ($row = $result->fetch_assoc())

            {

                $this->Cell(3,20,'SUCURSAL:' . $row['desc_sucursal'],0);   

            }



        date_default_timezone_set('America/Mexico_City');

        $dia = date("d");

        $numero_mes = date("n");

        $numero_mes-=1;

        $array = array("Enero", "Febrero", "Marzo", "Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

        $mes = $array[$numero_mes];

        $ano = date("Y");

    $this->Cell(90,7,'',0,0,'L');

    $this->Cell(15,1,utf8_decode('Ciudad de México a '.$dia.' de '.$mes.' de '.$ano),0);







    

    $id_detalle = $_GET['val'];

    $query = "SELECT pro.cod_producto,pro.id_producto,pro.producto,pro.desc_producto, prs.razon_social,so.cantidad,so.costo_pza,so.importe_total FROM eb_solicitudes so

        LEFT OUTER JOIN eb_productos pro ON (pro.id_producto = so.fk_id_producto)

        LEFT OUTER JOIN eb_proveedores prs ON (prs.id_proveedor = so.fk_id_proveedor)

        WHERE fk_id_detalle = $id_detalle";



    $result = $conexion->query($query);





            $this->Ln(30);



            $this->SetFont('Arial','B',10);

            $this->Cell(25,9,utf8_decode('Código'),1);

            $this->Cell(50,9,'Proveedor',1);

            $this->Cell(50,9,'Producto',1);

            $this->Cell(15,9,'Cantidad',1);

            $this->Cell(15,9,'Precio',1);

            $this->Cell(20,9,'Total',1);

            

            $this->Ln();

            while ($row = mysqli_fetch_array($result))

            {



                $cod_producto = $row['cod_producto'];

                $producto = $row['producto'];

                $social = $row['razon_social']; 

                $cantidad = $row['desc_producto'];

                $cantidad = $row['cantidad'];

                $costo_pza = $row['costo_pza'];

                $total = $row['importe_total'];

                $this->SetFont('Arial','',8);

                $this->Cell(25,7,$cod_producto,1);

                $this->Cell(50,7,utf8_decode($social),1);

                $this->Cell(50,7,utf8_decode($producto),1);

                $this->Cell(15,7,$cantidad,1);

                $this->Cell(15,7,$costo_pza,1);

                $this->Cell(20,7,$total,1);

                $this->Ln();            

        }





    $query2 = "SELECT importe_total FROM eb_detalle_solicitud WHERE id_detalle = $id_detalle";

        $result2 = $conexion->query($query2);

        $row2 =mysqli_fetch_array($result2);

        $total = $row2['importe_total'];

         $this->Cell(35,5,'',0);

         $this->Cell(35,5,'',0);

         $this->Cell(35,5,'',0);

         $this->Cell(30,5,'',0);

         $this->SetFont('Arial','B',8);

         $this->Cell(20,7,'Total',0,0);

         $this->SetFont('Arial','B',13);

         $this->Cell(20,7,'$'.$total,0,0);

         $this->Ln();



    }

}



$pdf=new PDF();

$pdf->AliasNbPages();

$pdf->AddPage();

$pdf->Tabla();

$y = $pdf->SetY(230);

include ("../../controladores/conex.php");

    $id = $_GET['val'];

    $query3 = "SELECT * FROM eb_detalle_solicitud WHERE id_detalle = $id";

    $result3 = $conexion->query($query3);

  while ($row3 = mysqli_fetch_array($result3))

    {

        $venta = $row3['id_detalle'];

        barcode('codigos/'.$venta.'.png', $venta, 10, 'horizontal', 'code128', true);



        $pdf->Image('codigos/'.$venta.'.png',70,$y,60,0,'PNG');

                

        $y = $y+15;

    }

    

$pdf->SetAutoPageBreak(false,200);    

$pdf->Output();

?>