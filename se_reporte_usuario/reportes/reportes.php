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
    global $function, $fi, $ff;

    //Fecha Inicio
    $d_inicio = $function->Dia($fi);
    $m_inicio = $function->Mes($fi);
    $y_inicio = $function->Year($fi);

    //Fecha Final
    $d_final = $function->Dia($ff);
    $m_final = $function->Mes($ff);
    $y_final = $function->Year($ff);

    $this->SetFont('Arial','B',10);
    $this->Cell(10,5,"Fecha de Asistencia: ".$d_inicio.' de '.$m_inicio. ' de '.$y_inicio.' al '.$d_final.' de '.$m_final. ' de '.$y_final,0,0,'L');//numero empleado
    $this->ln();
  }


  function Footer()
  {}

  function AsistenciaUser($datos,$fi,$ff)
  {
      global $function,$user;
      $datos = json_decode($datos);
      $this->SetFont('Arial','B',10);
      $this->Cell(10,5,"Usuario: ".$datos[0]->nombre,0,0,'L');//numero empleado
      $this->ln(15);
      $this->SetFont('Arial','',8);
      $this->Cell(30,5,'Dia',1,0,'L');
      $this->Cell(30,5,'Tipo Dia',1,0,'L');
      $this->Cell(30,5,'Horario',1,0,'L');
      $this->Cell(15,5,'Entrada',1,0,'L');
      $this->Cell(15,5,'Salida',1,0,'L');
      $this->Cell(15,5,'Asistencia',1,0,'L');
      $this->Cell(100,5,'Observaciones',1,0,'L');
      $this->ln();
      for($i = 0; $i<7; $i++)
      {
        $hoy= date("Y-m-d", strtotime("$fi   $i day"));
        $dia_n = $function->Dia($hoy);
        $dia = $function->Saber_Dia($hoy);
        if($function->DiaFestivo($hoy) > 0)
        {
          $res = $function->HorasFestivo($hoy);
          $res = json_decode($res);

          $this->Cell(30,5,$dia.' '.$dia_n,1,0,'J');
          $this->Cell(30,5,'Festivo',1,0,'J');
          $this->Cell(30,5,$res[0]->start_time.' a '.$res[0]->end_time,1,0,'L');
          $this->Cell(15,5,$function->Entrada($user,$hoy),1,0,'L');
          $this->Cell(15,5,$function->Salida($user,$hoy),1,0,'L');
          $this->Cell(15,5,$function->Min_Entrada($user,$hoy),1,0,'L');
          $this->Cell(100,5,$function->Observaciones($user,$hoy),1,0,'L');
          $this->ln();
        }else
        {
          if($dia == "Sabado")
          {
            if($datos[0]->entra_s == '00:00:00' || $datos[0]->salida_s == '00:00:00')
            {
              $this->Cell(30,5,$dia.' '.$dia_n,1,0,'J');
              $this->Cell(205,5,"DESCANSO",1,0,'C');
            }else
            {
              $this->Cell(30,5,$dia.' '.$dia_n,1,0,'J');
              $this->Cell(30,5,'Normal',1,0,'J');
              $this->Cell(30,5,$datos[0]->entra_s.' a '.$datos[0]->salida_s,1,0,'L');
              $this->Cell(15,5,$function->Entrada($user,$hoy),1,0,'L');
              $this->Cell(15,5,$function->Salida($user,$hoy),1,0,'L');
              $this->Cell(15,5,$function->Min_Entrada($user,$hoy),1,0,'L');
              $this->Cell(100,5,$function->Observaciones($user,$hoy),1,0,'L');
              $this->ln();
            }
            
          }else
          if($dia == "Domingo")
          {
            if($datos[0]->entra_d == '00:00:00' || $datos[0]->salida_d == '00:00:00')
            {
              $this->Cell(30,5,$dia.' '.$dia_n,1,0,'J');
              $this->Cell(205,5,"DESCANSO",1,0,'C');
            }else
            {
              $this->Cell(30,5,$dia,1,0,'J');
              $this->Cell(30,5,'Normal',1,0,'J');
              $this->Cell(30,5,$datos[0]->entra_d.' a '.$datos[0]->salida_d,1,0,'L');
              $this->Cell(15,5,$function->Entrada($user,$hoy),1,0,'L');
              $this->Cell(15,5,$function->Salida($user,$hoy),1,0,'L');
              $this->Cell(15,5,$function->Min_Entrada($user,$hoy),1,0,'L');
              $this->Cell(100,5,$function->Observaciones($user,$hoy),1,0,'L');
              $this->ln();
            }
            
          }else
          {
            $this->Cell(30,5,$dia.' '.$dia_n,1,0,'J');
            $this->Cell(30,5,'Normal',1,0,'J');
            $this->Cell(30,5,$datos[0]->entra.' a '.$datos[0]->salida,1,0,'L');
            $this->Cell(15,5,$function->Entrada($user,$hoy),1,0,'L');
            $this->Cell(15,5,$function->Salida($user,$hoy),1,0,'L');
            $this->Cell(15,5,$function->Min_Entrada($user,$hoy),1,0,'L');
            $this->Cell(100,5,$function->Observaciones($user,$hoy),1,0,'L');
            $this->ln();
          }
        }
        
       
      }
  }

}


$pdf = new PDF('L','mm',array(216,279));
$pdf->SetAutoPageBreak(true,10);
$pdf->AliasNbPages();
$semana = date("Y-m-d");
$semana = date('w', strtotime($semana));
$dia = $semana-1;
$fi = $_GET['inicio'];
$ff = $_GET['final'];
$user = $_GET['user'];


  $stmt = $conexion->prepare("SELECT * FROM se_usuarios WHERE id_usuario = $user");
  $stmt->execute();
  $result = $stmt->get_result();
  $num = $result->num_rows;
  $stmt->close();
  while ($row = $result->fetch_assoc())
  {
    $paciente = $row['nombre'].' '.$row['a_paterno'].' '.$row['a_materno'];
    $datos[] = array( "id_usuario" => $row['id_usuario'], 
                      "nombre" => $paciente, 
                      "salida_s" => $row['salida_s'], 
                      "salida_d" => $row['salida_d'], 
                      "salida" => $row['salida'], 
                      "entra_s" => $row['entra_s'],
                      "entra_d" => $row['entra_d'], 
                      "entra" => $row['entra']);
  }

   $datos = json_encode($datos);

  $pdf->AddPage();
  $pdf->AsistenciaUser($datos,$fi,$ff);
  $pdf->ln(5);



$pdf->Output();
?>
