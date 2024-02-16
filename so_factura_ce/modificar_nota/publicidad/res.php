<?php 
date_default_timezone_set('America/Mexico_City');
require('../../fpdf/fpdf.php');
require_once ("../../so_factura/config/db.php");//Contiene las variables de configuracion para conectar a la 
require_once ("../../so_factura/config/conexion.php");//Contiene funcion que conecta a la base de datos
$factura=$_GET['factura'];


$query = "SELECT CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno) paciente FROM so_factura fa
LEFT OUTER JOIN so_clientes cl ON (cl.id_cliente = fa.fk_id_cliente)
WHERE fa.id_factura = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i",$factura);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc())
{
  $paciente = $row['paciente'];
  
}

$stmt->close();


$stmt = $con->prepare("SELECT * FROM so_c_publicidad WHERE estado = 'A'");
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc())
{
  $titulo = $row['titulo'];
  $texto = $row['texto'];
  
}

$stmt->close();


class PDF extends FPDF
{

  function Header()
  {

      global  $paciente;

  }

  function Cuerpo()
  {
    global  $paciente,$titulo,$texto;

    $this->ln(10);
    $this->Cell(3);
    $this->SetFont('Arial','B',16);
    $this->SetXY(80,10);
    $this->Cell(77,5,utf8_decode($titulo),0,'J');
    $this->Ln(5);

    $this->Ln(5);
    $this->SetXY(15,30);
    $this->SetFont('Arial','',12);
    $this->MultiCell(180,5,utf8_decode("Laboratorios clínicos ARCA, con domicilio en Josefa Ortiz de Domínguez 5, San Isidro, 16739 Ciudad de México, CDMX, es responsable del tratamiento de sus datos personales.

Con medio de contacto:

Correo electrónico (Mail) Atencion.clientes@laboratoriosarca.com.mx
Teléfono: 21614144
Domicilio: Mismo que Laboratorios clínicos ARCA

Sus datos personales serán utilizados para las siguientes finalidades:
Enviar Información sobre quiénes somos, nuestra misión y objetivo con beneficio a nuestros pacientes, mantenerlo a tanto de nueva información de Estudios y de las Promociones Vigentes que Ofrecemos.


Para las finalidades señaladas en el presente aviso de privacidad, podemos recabar sus datos personales de distintas formas: cuando usted nos los proporciona directamente; cuando visita nuestro sitio de Internet o utiliza nuestros servicios en línea, y cuando obtenemos información a través de otras fuentes que están permitidas por la ley.


Datos personales que recabamos de forma directa 
Recabamos sus datos personales de forma directa cuando usted mismo nos los proporciona por diversos medios, como cuando participa en nuestras promociones o nos da información con objeto de que le prestemos un servicio. Los datos que obtenemos por este medio pueden ser, entre otros:

1.- nombre
2.- Apelldio Paterno
3.- Apellido Materno
4.- Edad
5.- Domicilio
6.- Sexo
7.- Correo electrónico (mail)

Datos personales que recabamos cuando visita nuestro sitio de Internet o utiliza nuestros servicios en línea, entre otros:
1.  Nombre
2.  Apellido paterno
3.  Apellido Materno
4.  Edad
5.  Domicilio
6.  Sexo
7.  Correo electrónico (mail)





Datos personales que recabamos a través de otras fuentes 
Podemos obtener información de usted de otras fuentes permitidas por la ley, tales como los directorios telefónicos o laborales. Los datos que obtenemos por estos medios pueden ser, entre otros:
1.  Nombre
2.  Apellido paterno
3.  Apellido Materno
4.  Edad
5.  Domicilio
6.  Sexo
7.  Correo electrónico (mail)

No consiento que mis datos personales sensibles sean tratados conforme a los términos y condiciones del presente aviso de privacidad.

Usted puede dejar de recibir mensajes promocionales por teléfono fijo o celular siguiendo los siguientes pasos: enviar un correo electrónico dirigido a atencion.clientes@laboratoriosarca.com.mx, indicando que ya no está dispuesto a recibir propaganda, ni ningún tipo de notificaciones que provengan de LABORATORIOS CLINICOS ARCA, indicándonos su nombre completo, asi como su domicilio.

También puede dejar de recibir correos electrónicos con promocionales a través de la siguiente solicitud: enviar un correo electrónico dirigido a atencion.clientes@laboratoriosarca.com.mx, indicando que ya no está dispuesto a recibir propaganda, ni ningún tipo de notificaciones que provengan de LABORATORIOS CLINICOS ARCA, indicándonos su nombre completo, asi como su domicilio.

Usted tiene derecho de acceder a sus datos personales que poseemos y a los detalles del tratamiento de los mismos, así como a rectificarlos en caso de ser inexactos o incompletos; cancelarlos cuando considere que no se requieren para alguna de las finalidades señalados en el presente aviso de privacidad, estén siendo utilizados para finalidades no consentidas o haya finalizado la relación contractual o de servicio, o bien, oponerse al tratamiento de los mismos para fines específicos. 

Los mecanismos que se han implementado para el ejercicio de dichos derechos son a través de la presentación de la solicitud respectiva en ventanilla de la unidad donde recopilaron los datos o enviar un correo electrónico a atencion.clientes@laboratoriosarca.com.mx.
Su solicitud deberá contener la siguiente información: Indicarnos los motivos que lo ha llevado a requerir la información, o los datos que detectado que nos los correctos y los nuevos datos que substituyen a los datos anteriores.

Los plazos para atender su solicitud son los siguientes: 72 hrs.

Para mayor información, favor de comunicarse al departamento de privacidad aviso.privacidad@laboratoriosarca.com.mx  o visitar nuestra página de Internet sección aviso de privacidad. 





En todo momento, usted podrá revocar el consentimiento que nos ha otorgado para el tratamiento de sus datos personales, a fin de que dejemos de hacer uso de los mismos. Para ello, es necesario que presente su petición en un correo electrónico dirigido a atencion.clientes@laboratoriosarca.com.mx 

Su petición deberá ir acompañada de la siguiente información: Motivo por el cual ha dejado de compartirnos sus datos.

En un plazo máximo de 72 horas atenderemos su petición y le informaremos sobre la procedencia de la misma a través del correo electrónico.

Nos reservamos el derecho de efectuar en cualquier momento modificaciones o actualizaciones al presente aviso de privacidad, para la atención de novedades legislativas, políticas internas o nuevos requerimientos para la prestación u ofrecimiento de nuestros servicios o productos.

Estas modificaciones estarán disponibles al público a través de los siguientes medios: (i) anuncios visibles en nuestros establecimientos o centros de atención a clientes; (ii) trípticos o folletos disponibles en nuestros establecimientos o centros de atención a clientes; (iii) en nuestra página de Internet sección aviso de privacidad; (iv) o se las haremos llegar al último correo electrónico que nos haya proporcionado.

"),0,'J');
  $this->ln(20);
  $this->SetXY(50,190);
    $this->Cell(77,5,"_____________________________________________",0,'J');
  $this->SetXY(60,200);
    $this->Cell(77,5,utf8_decode($paciente),0,'J');
  }


}

$pdf = new PDF('P','mm','Letter');
$pdf->SetMargins(0,0,0);
$pdf->SetAutoPageBreak(true,20);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Cuerpo();
$pdf->Output();


 ?>