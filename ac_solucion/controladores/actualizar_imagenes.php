<?php
date_default_timezone_set('America/Mexico_City');
session_start();
include("../../controladores/conex.php");
$empresa ="1";
$estado = $_POST['fn_estado']; //estado
$fecha_registro=date("y-m-d H:i:s");
$alt=0;
$anc=0;
$id_insert = $_POST['fn_nota'];
$studio = $_POST['fn_estudio'];
$fecha=date("dmY");
$hora=date("His");


    if($_FILES["fn_archivo"]["error"]>0)
    {
      echo "Error en cargar";
    }else
    {
        $permitidos = array("image/gif","image/png","image/jpeg");
        $limite_kb = 800;
        if(in_array($_FILES["fn_archivo"]["type"], $permitidos) && $_FILES["fn_archivo"]["size"] <= $limite_kb * 1024)
        {
            $ruta = '../img_rx/'.$id_insert.'/';
            $nombre = $_POST['fn_archivo'];
            $ruta_archivo = 'img_ekg/'.$id_insert.'/';
            $target_path = $ruta.$nombre;
          //  $nombre=$_FILES["fn_archivo"]["name"];
            if(!file_exists($ruta)){
                mkdir($ruta);
            }

                if(move_uploaded_file($_FILES["fn_archivo"]["tmp_name"], $target_path))
                {
                    $atributos=getimagesize($target_path);
                    $alt=$atributos[0];
                    $anc=$atributos[1];
                    echo "La imagen se guardo correctamente";
                }else
                {
                    echo "No pudo guardar el fichero";
                }
        } else {
            echo "Error en caracteristicas";
        }

    }
//
?>
