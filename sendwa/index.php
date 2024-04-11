<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Envío de resultados por Whatsapp</title>
</head>
<body>
    <form method="post">
        <input name="id_facura" type="text" placeholder="Inserte el folio aquí">
        <input name="id_estudio" type="text" placeholder="Inserte el número del estudio aquí">
        <!--<input name="ruta" type="text" placeholder="Inserte la ruta al pdf aquí">\-->
        <button type="submit">Enviar datos</button>
    </form>
</body>
<?php 

include 'enviaWA.php';

$id_factura = $_POST['id_facura'];
$id_estudio = $_POST['id_estudio'];
//$ruta = $_POST['ruta'];
$factura=20032408004;
$estudio=2577;
$ruta = 'https://www.laboratoriosarca.com/sysarcaweb_1.0/pdf_resenv/'.$factura.'_'.$estudio.'.pdf';

//creaPDF();
if(isset($id_factura) && isset($ruta) && isset($id_estudio)){
    echo '<br>El folio del paciente es: ' . $id_factura . '<br><br>';
    echo '<br>La ruta es: ' . $ruta . '<br><br>';
    $resultado = enviaWA($id_factura, $ruta, $id_estudio);
    if($resultado == 1){
        echo "Enviado correctamente";
    } else {
        echo "No enviado";
    }
} else {
    echo '<br>Faltan datos';
}
?>
</html>