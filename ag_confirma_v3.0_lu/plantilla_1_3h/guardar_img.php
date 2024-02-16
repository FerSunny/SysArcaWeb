<?php 
$base64 = $_POST['base64'];
$factura = $_POST['factura'];
$estudio = $_POST['estudio'];
$baseFromJavascript = $base64;

// Nuestro base64 contiene un esquema Data URI (data:image/png;base64,)
// que necesitamos remover para poder guardar nuestra imagen
// Usa explode para dividir la cadena de texto en la , (coma)
$base_to_php = explode(',', $baseFromJavascript);
// El segundo item del array base_to_php contiene la información que necesitamos (base64 plano)
// y usar base64_decode para obtener la información binaria de la imagen
$data = base64_decode($base_to_php[1]);// BBBFBfj42Pj4....

// Proporciona una locación a la nueva imagen (con el nombre y formato especifico)
$filepath = "../../pdf_graficas/".$factura."_".$estudio.".png"; // or image.jpg

// Finalmente guarda la imágen en el directorio especificado y con la informacion dada
file_put_contents($filepath, $data);

echo 1;

 ?>