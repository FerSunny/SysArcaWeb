<?php
date_default_timezone_set('America/Mexico_City');
include "../../controladores/conex.php";
require('../../fpdf/fpdf.php');
require('funciones.php');
$function = new Asistencia();
class PDF extends FPDF
{
  function Header()
  {
    global $datos,$fecha,$function,$suc;
    $this->SetFont('Arial','',14);
    $this->SetX(140);
    $this->Cell(10,5,'Resuemen de Asistencia '. $function->Saber_Dia($fecha)." ".$function->Dia($fecha)." de ".$function->Mes($fecha)." de ".$function->Year($fecha),0,0,'C');//numero empleado
    $this->ln(10); 
  }

  function Footer()
  {}


  function Cuerpo($datos,$fecha)
  {

      global $function;

      $this->SetFont('Arial','',8);
      $this->Cell(10,5,'No',1,0,'L');//numero empleado
      $this->Cell(70,5,'Nombre',1,0,'L');
      $this->Cell(30,5,'Sucursal',1,0,'L');
      $this->Cell(15,5,'Entrada',1,0,'L');
      $this->Cell(15,5,'Salida',1,0,'L');
      $this->Cell(15,5,'Laborable',1,0,'L');
      $this->Cell(15,5,'Min. Tarde',1,0,'L');//Minutos Tarde
      $this->Cell(13,5,'T.E.',1,0,'L');//Tiempo Extra
      $this->Cell(6,5,'D.L',1,0,'L');//Descanso laborado
      $this->Cell(6,5,'P.D',1,0,'L');//Prima dominical
      $this->Cell(6,5,'F.L',1,0,'L');//Festivo Laborado
      $this->Cell(6,5,'F.I',1,0,'L');//Faltas injustificadas
      //$this->Cell(10,5,'T.O.U.',1,0,'L');
      $this->ln();
      $datos = json_decode($datos);
      foreach ($datos as $key)
      {
        $user = array(1,2,6,8,30);
        if(in_array($key->id, $user))
        {

        }else
        {
          $this->Cell(10,5,$key->id,1,0,'L');
          $this->Cell(70,5,utf8_decode($function->Nombre($key->id)),1,0,'L');
          $this->Cell(30,5,strtoupper($function->Sucursal($key->fk_sucursal)),1,0,'L');
          $this->Cell(15,5,$function->Entrada($key->id,$fecha),1,0,'L');
          $this->Cell(15,5,$function->Salida($key->id,$fecha),1,0,'L');
          $this->Cell(15,5,$function->Entra($key->id,$fecha),1,0,'L');
          $this->Cell(15,5,$function->Min_Entrada($key->id,$fecha),1,0,'L');
          $this->Cell(13,5,$function->Tiempo_Extra($key->id,$fecha),1,0,'L');
          $this->Cell(6,5,$function->Descanso($key->id,$fecha),1,0,'L');
          $this->Cell(6,5,$function->PrimaD($key->id,$fecha),1,0,'L');//Pendiente
          $this->Cell(6,5,$function->Festivo($key->id,$fecha),1,0,'L');
          $this->Cell(6,5,$function->Faltas($key->id,$fecha),1,0,'L');
          //$this->Cell(10,5,utf8_decode($function->Incidencia($key->id,$fecha)),1,0,'L');
          $this->ln();
        }
      }
  }

  function Obs($datos,$fecha)
  {
    global $function;
    $this->SetFont('Arial','',8);
    $this->Cell(10,5,'No',1,0,'L');//numero empleado
    $this->Cell(100,5,'Observaciones',1,0,'L');
    //$this->Cell(100,5,'Trabajo Otra Unidad',1,0,'L');
    $this->ln();
    $datos = json_decode($datos);
    foreach ($datos as $key)
    {
      $user = array(1,2,6,8,30);
      if(in_array($key->id, $user))
      {

      }else
      {
        $this->Cell(10,5,$key->id,1,0,'L');
        $this->Cell(100,5,utf8_decode($function->Observaciones($key->id,$fecha)),1,0,'L');
        $this->ln();
      }
    }

  }


}

/*
$this->SetFont('Arial','',8);
$this->Cell(10,5,$key->id,1,0,'J');
$this->Cell(60,5,$key->nombre,1,0,'J');
$this->Cell(20,5,$fi,1,0,'J');
*/

$pdf = new PDF('L','mm',array(216,279));
$pdf->SetAutoPageBreak(true,10);
$pdf->AliasNbPages();

$fi = $_GET['fi'];
//$ff = $_GET['ff'];

$semana = date("Y-m-d");
$semana = date('w', strtotime($semana));
$dia = $semana-1;

$stmt = $conexion->prepare("SELECT * FROM se_usuarios WHERE activo = 'A' AND huella > ''");
$stmt->execute();
$result = $stmt->get_result();
$num = $result->num_rows;
$stmt->close();
$data = array();
while ($row = $result->fetch_assoc()) {
    $id[] = array("id" => $row['id_usuario'], "fk_sucursal" => $row['fk_id_sucursal']);
}

  $datos = json_encode($id);
  $obs = json_encode($id);

for($i=0;$i<=$dia;$i++)
{
  $fecha = date("Y-m-d", strtotime("$fi $i day"));
  $pdf->AddPage();
  $pdf->Cuerpo($datos,$fecha);
  $pdf->ln(5);
  $pdf->Obs($datos,$fecha);
}

$pdf->Output();
?>
