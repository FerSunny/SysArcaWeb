<?php 





session_start();

include ("../../controladores/conex.php");







$pro = $_POST['pro'];

$codigo  = $_POST['codigo'];

$numpac =$_POST['numpac'];

$merec = $_POST['merec']; 

$mispac = $_POST['mispac'];

$id_medico = $_POST['id_medico'];

  $q_existe = mysqli_query($conexion,"SELECT mc.* FROM so_medicos_catego mc WHERE mc.id_catego = '$codigo' AND estado ='A' ");
  $nrda= mysqli_num_rows($q_existe);
  if($nrda == 0){

$q_insert="
    INSERT INTO so_medicos_catego
            (fk_id_empresa,
             id_catego,
             fk_id_medico,
             me_atiende,
             mis_pacientes,
             pacientes_dia,
             dia_visita,
             hora_visita,
             dia_visita_mes,
             estado)
VALUES (1,
        0,
        $id_medico,
        $merec,
        $mispac,
        $numpac,
        SUBSTR(DAYNAME(NOW()),1,2),
        time(now()),
        day(now()),
        'A')
        ";
        $result_i = $conexion -> query($q_insert);
        if ($result_i) {
            echo 1;
        }else{
          $codigo = mysqli_errno($conexion); 
          echo $codigo;
        }
  }else{
      $query = "
      UPDATE so_medicos_catego
      SET 
        fk_id_medico = $id_medico,
        me_atiende = $merec,
        mis_pacientes = $mispac,
        pacientes_dia = $numpac,
        dia_visita = SUBSTR(DAYNAME(NOW()),1,2),
        hora_visita = time(now()),
        dia_visita_mes = day(now())
      WHERE `id_catego` = $codigo
      ";
      $result = $conexion -> query($query);
      if ($result) {
          echo 1;
      }else{
        $codigo = mysqli_errno($conexion); 
        echo $codigo;
      }
}
$conexion->close();



?>





































































