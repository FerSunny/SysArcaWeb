<?php

function enviaWA($id_factura, $ruta, $id_estudio, $usuario){

//Datos de conexión a la base de datos
$server = "localhost";
// activar estas lineas par acceso al productivo
$user = "labora41_root";
$password = "ArcaRoot_2017";

// activar estas lineas cuando el accxeso se local
//$user = "root";
//$password = "";

$database = "labora41_bd_arca";

//Creamos la conexión
$mysqli = new mysqli($server, $user, $password, $database);

//Probamos la conexión
if($mysqli->connect_errno != 0){
    echo $mysqli->connect_error;
    exit();
}

//Recuperamos los datos del paciente
$stmt = $mysqli->prepare("SELECT replace(cl.telefono_movil,'-','') as celular, CONCAT(cl.nombre, ' ', cl.a_paterno, ' ', cl.a_materno) paciente FROM so_factura fa
LEFT OUTER JOIN so_clientes cl ON (cl.`id_cliente` = fa.`fk_id_cliente`)
WHERE id_factura = ?");
$stmt->bind_param("i",$id_factura);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($celular,$paciente);
$stmt->fetch();

//Recuperamos el estudio
$stmt = $mysqli->prepare("SELECT desc_estudio FROM so_detalle_factura de
LEFT OUTER JOIN km_estudios es ON (es.`id_estudio` = de.`fk_id_estudio`)
WHERE id_factura = ? AND fk_id_estudio = ?");
$stmt->bind_param("ii",$id_factura,$id_estudio);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($estudio);
$stmt->fetch();

//Token permanente de facebook
$token = 'EAAOQZBzYCNvoBO8myZADRmly5X9KDyWCOgwmsmsMr9P2ssm43FpSGdsOs1ZAZAFLfGdFpbM9w73H6cXFQkuVYjy6ZCx5Nqsber8sjaZCw1qq8w96celmpZB2M1xm7OwlG67pxO0uHzkwXnsDoeAq8sWuUFUCJhZAQzRWwNhaptYCwFU5THZCSjqNUGmgZC0bzRZAMJU';

//Teléfono del paciente
$length = strlen($celular);
if($length <> 10){
  $estatus = "Rechazado Length";
  $fk_id_empresa = 1;

  $stmt_insert =
  "
    INSERT INTO wa_registro
                (id,
                fecha_hora,
                estatus,
                telefono,
                fk_id_usuario)
    VALUES (0,
            NOW(),
            '$estatus',
            '$celular',
            '$usuario')
  ";
  $execute_stmt_insert = mysqli_query($mysqli,$stmt_insert); 
  return 2;
}else{
    $telefono = '52' . $celular;

    //URL a donde se envía el mensaje
    $url = 'https://graph.facebook.com/v17.0/108646072324432/messages';

    $ruta = $ruta;

    //Configuración del mensaje
    $mensaje = ''
    .'{'
      .'"messaging_product": "whatsapp",'
      .'"recipient_type": "individual",'
      .'"to": "'.$telefono.'",'
      .'"type": "template",'
      .'"template": {'
        .'"name": "resultados",'
        .'"language": { "code": "es" },'
        .'"components":'
        .'['
          .'{'
            .'"type": "header",'
            .'"parameters":'
            .'['
              .'{'
                .'"type": "document",'
                .'"document":'
                .'{'
                  .'"link": "'.$ruta.'"'
                .'}'
              .'}'
            .']'
          .'},'
          .'{'
            .'"type": "body",'
            .'"parameters":'
            .'['
              .'{'
                .'"type": "text",'
                .'"text": "'.$paciente.'"'
              .'},'
              .'{'
                .'"type": "text",'
                .'"text": "'.$estudio.'"'
              .'}'
            .']'
          .'}'
        .']'
      .'}'
    .'}';

    //Declaramos las cabeceras
    $header = array("Authorization: Bearer " . $token, "Content-Type: application/json",);

    //Iniciamos el curl
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $mensaje);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    //Obtenemos la respuesta de envío de información
    $response = json_decode(curl_exec($curl), true);

    //Imprimimos la respuesta
    //print_r($response);

    //Regresamos un valor dependiendo del estatus
    $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    //die('status_code-->'.$status_code);
    if($status_code == 200){
      $estatus = "Aceptado";
      $fk_id_empresa = 1;
      /*
      $stmt = $mysqli->prepare("INSERT INTO `wa_registro`
      (fecha_hora, estatus, usuario, telefono, fk_id_empresa)
      VALUES (?, ?, ?, ?, ?)");
      $stmt->bind_param("dsiii", NOW(), $estatus, $usuario, $celular, $fk_id_empresa);
      $stmt->execute();
      */
      $stmt_insert =
      "
        INSERT INTO wa_registro
                    (id,
                    fecha_hora,
                    estatus,
                    telefono,
                    fk_id_usuario)
        VALUES (0,
                NOW(),
                '$estatus',
                '$telefono',
                '$usuario')
      ";
      $execute_stmt_insert = mysqli_query($mysqli,$stmt_insert); 
      //Cerramos el curl
      curl_close($curl); 
      return 1;
      
    } else {
      //die('rechazado');
      $estatus = "Rechazado";
      $fk_id_empresa = 1;
      /*
      $stmt = $mysqli->prepare("INSERT INTO `wa_registro`
      (fecha_hora, estatus, usuario, telefono, fk_id_empresa)
      VALUES (NOW(), ?, ?, ?, ?)");
      $stmt->bind_param("siii", $estatus, $usuario, $celular, $fk_id_empresa);
      $stmt->execute();
      */
      $stmt_insert =
      "
        INSERT INTO wa_registro
                    (id,
                    fecha_hora,
                    estatus,
                    telefono,
                    fk_id_usuario)
        VALUES (0,
                NOW(),
                '$estatus',
                '$telefono',
                '$usuario')
      ";
      $execute_stmt_insert = mysqli_query($mysqli,$stmt_insert); 
      //Cerramos el curl
      curl_close($curl);
      return 0;
  }
}

}

?>