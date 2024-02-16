<?php 

require ("../../fpdf/fpdf.php");



class PDF extends FPDF
{
//cabecera de la pagina 
function Header()
{

$this->Image('../../imagenes/logo_arca.png',15,5,140,0);
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
    $this->SetTextColor(0,0,0);
    $this->ln(10);

}

//pie de pagina 
function Footer()
{

    $this->ln(34);
    $this->Cell(5);
    $this->SetTextColor(0,0,255);
    $this->Cell(180,5,'_________________________________________________________________________',0,0,'L');
    $this->SetTextColor(26,35,126);
    $this->SetFont('Arial','B',16);
    $this->SetXY(65,272); 
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
       include ("../../controladores/conex.php"); 
       $id_proveedor = $_GET['val'];
       $query ="SELECT nombre_respon,direccion,telefono,correo FROM eb_proveedores WHERE id_proveedor = $id_proveedor";
       $result = $conexion->query($query);
            $this->Ln(15);
            $this->SetFont('Arial','B',8);
            $this->Cell(5,15,'RESPONSABLE:',0);
            $this->Cell(1,3,'',0,0,'C');
            $this->Cell(-1,35,'TELEFONO:',0);
            $this->Cell(-1,20,'',0,0,'C');
            $this->Cell(10,25,utf8_decode('DIRECCIÓN:'),0);
            $this->Cell(13,25,'',0,0,'C');
            //$this->Ln();
            while ($row = mysqli_fetch_array($result))
            {
                $nombre = $row['nombre_respon'];
                $direccion = $row['direccion'];
                $tel = $row['telefono'];
                //$email = $row['correo'];
                $this->SetFont('Arial','',10);
                $this->Cell(1,15,$nombre,0);
                $this->Cell(-1,25,$direccion,0);
                $this->Cell(6,35,$tel,0);
                //$this->Cell(29,7,$email,0);          
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
    include ("../../controladores/conex.php");
    $id_detalle = $_GET['val'];
    $query = "SELECT pro.cod_producto,pro.id_producto,pro.producto,pro.desc_producto, prs.razon_social,so.cantidad,so.costo_pza FROM eb_solicitudes so
        LEFT OUTER JOIN eb_productos pro ON (pro.id_producto = so.fk_id_producto)
        LEFT OUTER JOIN eb_proveedores prs ON (prs.id_proveedor = so.fk_id_proveedor)
        WHERE fk_id_detalle = $id_detalle";

    $result = $conexion->query($query);


            $this->Ln(40);

            $this->SetFont('Arial','B',13);
            $this->Cell(40,9,'codigo',1);
            $this->Cell(40,9,'Producto',1);
            $this->Cell(25,9,'Cantidad',1);
            $this->Cell(29,9,'Proveedor',1);
            $this->Cell(25,9,'Total',1);
            $this->Ln();
            while ($row = mysqli_fetch_array($result))
            {

                $cod_producto = $row['cod_producto'];
                $producto = $row['producto'];
                $cantidad = $row['desc_producto'];
                $cantidad = $row['cantidad'];
                $social = $row['razon_social'];
                $costo_pza = $row['costo_pza'];
                $this->SetFont('Arial','',13);
                $this->Cell(40,7,$cod_producto,1);
                $this->Cell(40,7,$producto,1);
                $this->Cell(25,7,$cantidad,1);
                $this->Cell(29,7,$social,1);
                $this->Cell(25,7,$costo_pza,1);
                $this->Ln();            
        }


    $query2 = "SELECT importe_total FROM eb_detalle_solicitud WHERE id_detalle = $id_detalle";
        $result2 = $conexion->query($query2);
        $row2 =mysqli_fetch_array($result2);
        $total = $row2['importe_total'];
         $this->Cell(35,5,'',0);
         $this->Cell(35,5,'',0);
         $this->Cell(35,5,'',0);
         $this->SetFont('Arial','B',13);
         $this->Cell(29,5,'Total',1);
         $this->SetFont('Arial','B',13);
         $this->Cell(25,5,'$'.$total,1);
         $this->Ln();

    }
}

$pdf=new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Tabla();
$y = $pdf->SetY(230);
$pdf->Output();
?>