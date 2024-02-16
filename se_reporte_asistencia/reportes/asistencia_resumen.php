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
    if($function->DiaFestivo($fecha) > 0)
    {
      $this->Cell(10,5,utf8_decode('Resuemen de Asistencia '. $function->Saber_Dia($fecha)." ".$function->Dia($fecha)." de ".$function->Mes($fecha)." de ".$function->Year($fecha).'  "Día Festivo"'),0,0,'C');//numero empleado
    }else
    {
      $this->Cell(10,5,utf8_decode('Resuemen de Asistencia '. $function->Saber_Dia($fecha)." ".$function->Dia($fecha)." de ".$function->Mes($fecha)." de ".$function->Year($fecha)),0,0,'C');//numero empleado
    }
    
    $this->ln(10); 
  }


  function Footer()
  {}

  function All($fecha,$sucursal)
  {
    global $function;

    $sucursal = json_decode($sucursal);

    foreach ($sucursal as $key)
    {
      $this->SetFont('Arial','B',10);
      $this->Cell(10,5,"Lista de asistencia Unidad: ". strtoupper($key->desc),0,0,'L');//numero empleado
      $this->ln();
      $this->SetFont('Arial','',8);
      $this->Cell(10,5,'No',1,0,'L');//numero empleado
      $this->Cell(70,5,'Nombre',1,0,'L');
      $this->Cell(30,5,'Horario',1,0,'L');
      $this->Cell(15,5,'Entrada',1,0,'L');
      $this->Cell(15,5,'Salida',1,0,'L');
      $this->Cell(15,5,'Asistencia',1,0,'L');
      $this->Cell(100,5,'Observaciones',1,0,'L');
      $this->ln();
      $user = array(1,2,6,8,30);

      $result = $function->UsuarioAllSucursal($key->idsuc);

      while($row = $result->fetch_assoc())
      {
        $this->Cell(10,5,$row['id_usuario'],1,0,'L');
        $this->Cell(70,5,utf8_decode($row['nombre'].' '.$row['a_paterno'].' '.$row['a_materno']),1,0,'L');
        if($function->DiaFestivo($fecha) > 0)
        {
          $res = $function->HorasFestivo($fecha);
          $res = json_decode($res);
          $this->Cell(30,5,$res[0]->start_time.' a '.$res[0]->end_time,1,0,'L');
        }else
        {
          if($function->Saber_Dia($fecha) == "Sabado")
          {
            $ho = $row['salida_s'];
            if($row['entra_s'] == "" || $row['salida_s'] == "")
            {
              $this->Cell(30,5,"Registrar Horario",1,0,'L');
            }else
            {
              $this->Cell(30,5,$row['entra_s'].' a '.$row['salida_s'],1,0,'L');
            }
            
          }else
          if($function->Saber_Dia($fecha) == "Domingo")
          {
            $ho = $row['salida_d'];
            if($row['entra_s'] == "" || $row['salida_s'] == "")
            {
              $this->Cell(30,5,"Registrar Horario",1,0,'L');
            }else
            {
              $this->Cell(30,5,$row['entra_d'].' a '.$row['salida_d'],1,0,'L');
            }
            
          }else
          {
            $ho = $row['salida'];
            if($row['entra_s'] == "" || $row['salida_s'] == "")
            {
              $this->Cell(30,5,"Registrar Horario",1,0,'L');
            }else
            {
              $this->Cell(30,5,$row['entra'].' a '.$row['salida'],1,0,'L');
            }
            
          }
        }
        $this->Cell(15,5,$function->Entrada($row['id_usuario'],$fecha),1,0,'L');
        $this->Cell(15,5,$function->Salida($row['id_usuario'],$fecha),1,0,'L');
        if($function->DiaFestivo($fecha) > 0)
        {
          $res = $function->HorasFestivo($fecha);
          $res = json_decode($res);
          $this->Cell(15,5,$function->RetardoFestivo($row['id_usuario'],$fecha,$res[0]->start_time),1,0,'L');
        }else
        {

         $this->Cell(15,5,$function->Retardo($row['id_usuario'],$fecha),1,0,'L'); 
        }
        $this->Cell(100,5,utf8_decode($function->Observaciones($row['id_usuario'],$fecha)),1,0,'L');
        $this->ln();
      }
      //in_array($key->id, $user)
      $this->ln();
    }
  }

  function Sucursal($suc,$fecha)
  {
    global $function,$conexion;

    $this->SetFont('Arial','B',10);
    $this->Cell(10,5,"Lista de asistencia Unidad: ". strtoupper($function->Sucursal($suc)),0,0,'L');//numero empleado
    $this->ln();
    $this->SetFont('Arial','',8);
    $this->Cell(10,5,'No',1,0,'L');//numero empleado
    $this->Cell(70,5,'Nombre',1,0,'L');
    $this->Cell(30,5,'Horario',1,0,'L');
    $this->Cell(15,5,'Entrada',1,0,'L');
    $this->Cell(15,5,'Salida',1,0,'L');
    $this->Cell(15,5,'Asistencia',1,0,'L');
    $this->Cell(100,5,'Observaciones',1,0,'L');
    $this->ln();
    $result = $function->UsuarioSucursal($suc);

    while($row = $result->fetch_assoc())
    {
      $this->Cell(10,5,$row['id_usuario'],1,0,'L');
        $this->Cell(70,5,utf8_decode($row['nombre'].' '.$row['a_paterno'].' '.$row['a_materno']),1,0,'L');
        if($function->DiaFestivo($fecha) > 0)
        {
          $res = $function->HorasFestivo($fecha);
          $res = json_decode($res);
          $this->Cell(30,5,$res[0]->start_time.' a '.$res[0]->end_time,1,0,'L');
        }else
        {
          if($function->Saber_Dia($fecha) == "Sabado")
          {
            $ho = $row['salida_s'];
            if($row['entra_s'] == "" || $row['salida_s'] == "")
            {
              $this->Cell(30,5,"Registrar Horario",1,0,'L');
            }else
            {
              $this->Cell(30,5,$row['entra_s'].' a '.$row['salida_s'],1,0,'L');
            }
            
          }else
          if($function->Saber_Dia($fecha) == "Domingo")
          {
            $ho = $row['salida_d'];
            if($row['entra_s'] == "" || $row['salida_s'] == "")
            {
              $this->Cell(30,5,"Registrar Horario",1,0,'L');
            }else
            {
              $this->Cell(30,5,$row['entra_d'].' a '.$row['salida_d'],1,0,'L');
            }
            
          }else
          {
            $ho = $row['salida'];
            if($row['entra_s'] == "" || $row['salida_s'] == "")
            {
              $this->Cell(30,5,"Registrar Horario",1,0,'L');
            }else
            {
              $this->Cell(30,5,$row['entra'].' a '.$row['salida'],1,0,'L');
            }
            
          }
        }
        $this->Cell(15,5,$function->Entrada($row['id_usuario'],$fecha),1,0,'L');
        $this->Cell(15,5,$function->Salida($row['id_usuario'],$fecha),1,0,'L');
        if($function->DiaFestivo($fecha) > 0)
        {
          $res = $function->HorasFestivo($fecha);
          $res = json_decode($res);
          $this->Cell(15,5,$function->RetardoFestivo($row['id_usuario'],$fecha,$res[0]->start_time),1,0,'L');
        }else
        {

         $this->Cell(15,5,$function->Retardo($row['id_usuario'],$fecha),1,0,'L'); 
        }
        $this->Cell(100,5,utf8_decode($function->Observaciones($row['id_usuario'],$fecha)),1,0,'L');
        $this->ln();
    }
  }

}


$pdf = new PDF('L','mm',array(216,279));
$pdf->SetAutoPageBreak(true,10);
$pdf->AliasNbPages();
$semana = date("Y-m-d");
$semana = date('w', strtotime($semana));
$dia = $semana-1;
$fi = $_GET['fi'];
$suc = $_GET['suc'];
//$ff = $_GET['ff'];

if($suc == 10)
{
  $stmt = $conexion->prepare("SELECT id_sucursal, desc_sucursal FROM kg_sucursales WHERE estado = 'A'");
  $stmt->execute();
  $result = $stmt->get_result();
  $num = $result->num_rows;
  $stmt->close();
  $data = array();
  while ($row = $result->fetch_assoc()) {
    $sucursal[] = array("idsuc" => $row['id_sucursal'], "desc" => $row['desc_sucursal']);
  }

   $sucursal = json_encode($sucursal);
  
}else
{
  $suc = $suc;
}





  

for($i=0;$i<=$dia;$i++)
{
  $fecha = date("Y-m-d", strtotime("$fi $i day"));
  $pdf->AddPage();

  if($suc == 10)
  {
    $pdf->All($fecha,$sucursal);
    $pdf->ln(5);
  }else
  {
    $pdf->Sucursal($suc,$fecha);
    $pdf->ln(5);
  }
}

$pdf->Output();
?>
