<?php

function enviaWA($id_factura, $ruta){

//Datos de conexión a la base de datos
$server = "localhost";
$user = "root";
$password = "";
$database = "labora41_bd_arca";

//Creamos la conexión
$mysqli = new mysqli($server, $user, $password, $database);

//Probamos la conexión
if($mysqli->connect_errno != 0){
    echo $mysqli->connect_error;
    exit();
}

//Recuperamos el whatsapp del paciente
$stmt = $mysqli->prepare("SELECT whatsapp FROM so_factura WHERE id_factura = ?");
$stmt->bind_param("i",$id_factura);
$stmt->execute();
$resultado = $stmt->get_result();
$numero = $resultado->fetch_assoc();
echo "El número del paciente es: " . $numero['whatsapp'] . " ";

//Recuperamos los datos del paciente
$stmt = $mysqli->prepare("SELECT CONCAT(cl.nombre, ' ', cl.a_paterno, ' ', cl.a_materno) paciente FROM so_factura fa
LEFT OUTER JOIN so_clientes cl ON (cl.`id_cliente` = fa.`fk_id_cliente`)
WHERE id_factura = ?");
$stmt->bind_param("i",$id_factura);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($paciente);
$stmt->fetch();

//Recuperamos el estudio
$stmt = $mysqli->prepare("SELECT desc_estudio FROM so_detalle_factura de
LEFT OUTER JOIN km_estudios es ON (es.`id_estudio` = de.`fk_id_estudio`)
WHERE id_factura = ?");
$stmt->bind_param("i",$id_factura);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($estudio);
$stmt->fetch();

//Token permanente de facebook
$token = 'EAAOQZBzYCNvoBO8myZADRmly5X9KDyWCOgwmsmsMr9P2ssm43FpSGdsOs1ZAZAFLfGdFpbM9w73H6cXFQkuVYjy6ZCx5Nqsber8sjaZCw1qq8w96celmpZB2M1xm7OwlG67pxO0uHzkwXnsDoeAq8sWuUFUCJhZAQzRWwNhaptYCwFU5THZCSjqNUGmgZC0bzRZAMJU';

//Teléfono del paciente
$telefono = '52' . '5519605386';

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
    .'"name": "entrega_resultados",'
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
print_r($response);

//Obtenemos el código de la respuesta
$status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

//Cerramos el curl
curl_close($curl);
}

?>