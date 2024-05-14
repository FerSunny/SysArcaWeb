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

    $fichero_download = $ruta.$nombre;

    if (file_exists($fichero_download)) {

        header('Content-Description: File Transfer');
        header('Content-Type: application/pdf');
       
        if ($tipo == 'pdf'){
            header('Content-Disposition: inline; filename="'.basename($fichero_download).'"'); 
        }else{
            header('Content-Disposition: attachment; filename="'.basename($fichero_download).'"');  
        }  
   
        header('Content-Length:'.filesize($fichero_download));
        
        $stm_update1=
        "
        UPDATE sgc_lista_ficheros
        SET 
        fk_id_usuario_estatus = '$id_usuario',
        fecha_status = NOW(),
        estatus = 'D'
        WHERE fk_id_doc = '$fk_id_doc'
            AND ver = '$ver'
            AND id_imagen = '$id_imagen';
        ";
        echo $stm_update1;
        $res_update1 = mysqli_query($conexion, $stm_update1);  
        if ($res_update1) {
                header("location: ../tabla_ficheros.php?id_doc=$fk_id_doc&num_version=$ver&desc_doc=$desc_doc");
        }
            else {
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

          readfile($fichero_download);  
    }else{
        die('El fichero a descargar no existe, verificar su area de sistemas');
    }

    //

?>