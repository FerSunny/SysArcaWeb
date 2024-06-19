<?php
/*
// Detalles del servidor FTP
$ftpHost = '74.208.88.97';
$ftpUsername = 'pacs';
$ftpPassword = 'pacs';

// Abrir una conexión FTP
$connId = ftp_connect($ftpHost) or die("No se pudo conectar a $ftpHost");

// Intentar iniciar sesión
if (@ftp_login($connId, $ftpUsername, $ftpPassword)) {
    echo "Conectado como $ftpUsername@$ftpHost";
} else {
    echo "No se pudo conectar como $ftpUsername";
}

// Cerrar la conexión
ftp_close($connId);
*/
//<?php
// Detalles del servidor FTP
$ftpHost = '74.208.88.97';
$ftpUsername = 'pacs';
$ftpPassword = 'pacs';
$ftpport = '21';
// Abrir una conexión FTP
$connId = ftp_connect($ftpHost,$ftpport) or die("No se pudo conectar a $ftpHost");

// Iniciar sesión en el servidor FTP
$ftpLogin = ftp_login($connId, $ftpUsername, $ftpPassword);

//$mode = ftp_pasv($connId, TRUE);
// Rutas locales y remotas del archivo
$localFilePath = 'C:\Users\USER\OneDrive - Medisyslabs\Documentos\ARCA\acreditacion\1_Cl_15189\2_Difusión_MP_FE031_RequisitosCriterios.pdf';
$remoteFilePath = '2_Difusión_MP_FE031_RequisitosCriterios.pdf';

// Intentar subir el archivo
if (ftp_put($connId, $remoteFilePath, $localFilePath, FTP_BINARY)) {
    echo "Transferencia de archivo exitosa: $localFilePath";
} else {
    echo "Error al subir $localFilePath";
}

// Cerrar la conexión
ftp_close($connId);
?>


?>