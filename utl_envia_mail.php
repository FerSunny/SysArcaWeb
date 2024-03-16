<?php
include("emails/envia_email.php");
$valida = envia_email(1,'soporte.producto@medisyslabs.onmicrosoft.com','','aqui va el asunto','aqui va el contenido');
echo $valida;
?>