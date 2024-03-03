<?php 





session_start();

include ("../../controladores/conex.php");







$pro = $_POST['pro'];

$codigo  = $_POST['codigo'];

$observa =$_POST['observa'];

$respuesta = $_POST['respuesta']; 


$query ="
INSERT INTO en_enc_directorio
            (fk_id_empresa,
             tipo,
             fk_id,
             fk_id_res_enc,
             observaciones,
             fecha_encuesta,
             estado)
VALUES (1,
        2,
        $codigo,
        $respuesta,
        '$observa',
        now(),
        'A'
      )
";

//echo $query;

$result = $conexion -> query($query);

if ($result) {

    echo 1;

}else{

  $codigo = mysqli_errno($conexion); 

  echo $codigo;

}

$conexion->close();



?>





































































