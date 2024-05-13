<?php
    session_start();
    require_once ("../../so_factura/config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
    require_once ("../../so_factura/config/conexion.php");//Contiene funcion que conecta a la base de datos

    $fk_id_doc=$_GET['fk_id_doc'];
    $id_imagen=$_GET['id_imagen'];
    $ruta=$_GET['ruta'];
    $nombre=$_GET['nombre'];

    die("termino sript."); 


?>