<?php
    session_start();
    include("../../controladores/conex.php");
    
    $id_usuario=$_SESSION['id_usuario'];
    $desc_doc=$_SESSION['desc_doc'];

    $fk_id_doc=$_GET['fk_id_doc'];
    $id_imagen=$_GET['id_imagen'];
    $ruta=$_GET['ruta'];
    $nombre=$_GET['nombre'];
    $tipo=$_GET['tipo'];
    $ver=$_GET['ver'];

    //$nombre_ok = str_replace(".".$tipo, "", $nombre);

    $fichero_download = $ruta.$nombre;
    //die('fichero_download'.$fichero_download);
    if (file_exists($fichero_download)) {
 //die('tipo:'.$tipo);   
 
        header('Content-Description: File Transfer');
        header('Content-Type: application/pdf');
     
        if ($tipo == 'pdf'){
           // die('tipo'.$tipo);
            header('Content-Disposition: inline; filename="'.basename($fichero_download).'"'); 
        }else{
            header('Content-Disposition: attachment; filename="'.basename($fichero_download).'"');  
        }  
 
        header('Content-Length:'.filesize($fichero_download));
        readfile($fichero_download);
        
        /*
        if($tipo == 'pdf'){
            $estatus = 'C';
        }else{
            */
            $estatus = 'O';
        //}

        $stm_update1=
        "
        UPDATE sgc_lista_ficheros
        SET 
        fk_id_usuario_estatus = '$id_usuario',
        fecha_status = NOW(),
        estatus = '$estatus'
        WHERE fk_id_doc = '$fk_id_doc'
            AND ver = '$ver'
            AND id_imagen = '$id_imagen';
        ";
        //echo $stm_update1;
        $res_update1 = mysqli_query($conexion, $stm_update1);  
        if ($res_update1) {
            //die('recargue');
                //header("location: ../tabla_ficheros.php?id_doc=$fk_id_doc&num_version=$ver&desc_doc=$desc_doc");
                echo "<script>location.href='../tabla_ficheros.php?id_doc=$id_doc&num_version=$num_version&desc_doc=$desc_doc'</script>";
        }else {
                echo "error en la ejecucion de la consulta. <br />";
                    die('Error de Conexión: ' . $res_update1);
            }
            if (mysqli_close($conexion)){
                echo "desconexion realizada. <br />";
            }
            else {
                echo "error en la desconexión";
                die('Error de Conexión: ' . mysqli_connect_errno());
            }

          //readfile($fichero_download);  
    }else{
        die('El fichero'.$fichero_download.' a descargar no existe, verificar su area de sistemas');
    }

    //

?>