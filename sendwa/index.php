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
        <input name="ruta" type="text" placeholder="Inserte la ruta al pdf aquí">
        <button type="submit">Enviar datos</button>
    </form>
</body>
<?php include 'enviaWA.php';

$id_factura = $_POST['id_facura'];
$ruta = $_POST['ruta'];

//creaPDF();
if(isset($id_factura) && isset($ruta)){
    echo '<br>El folio del paciente es: ' . $id_factura . '<br><br>';
    echo '<br>La ruta es: ' . $ruta . '<br><br>';
    $resultado = enviaWA($id_factura, $ruta);
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