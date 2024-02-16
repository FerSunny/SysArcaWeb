<?php 
  date_default_timezone_set('America/Mexico_City');
  session_start();
  include ("../../controladores/conex.php");
  $empresa = 1;
  $sucursal = $_SESSION['fk_id_sucursal'];
  $id = $_SESSION['id_usuario'];
  $fecha = date("Y-m-d H:i:s");
  $estado = 'A';
  $id = $_POST['id'];
  $ruta_actual = $_POST['ruta'];
  $tamaño = $_FILES['carrucel']['size'];//Tamaño de a imagen
  $nombre = $_FILES['carrucel']['name'];//Nombre del archivo
  $tipo = $_FILES['carrucel']['type'];//Tipo de Archivo JPEG,JPG,PNG,GIF

  //Codigo para saber que extension tiene el archivo
  $explode= explode('.', $nombre);
  $extension=array_pop($explode);
  $target_path = "../uploads/";
  $estado = 'A';
  $ruta = "../img/".$id.".".$extension;
  $ruta_bd = "img/".$id.".".$extension;
  $renombrar = $id.".".$extension;


  //Eliminar imagen actual
  unlink("../".$ruta_actual);

  if($tipo == "image/jpeg" || $tipo == "image/jpg" || $tipo == "image/png" || $tipo == "image/gif")
  {
       if(move_uploaded_file($_FILES['carrucel']['tmp_name'], $ruta))
        {
          $query = "UPDATE so_carrucel SET ruta_img = ?, fecha_actualizacion = ? WHERE id_carrucel = ?";
          $stmt = $conexion->prepare($query);
          $stmt->bind_param('ssi',$ruta_bd,$fecha,$id);
              if($stmt->execute())
              {
                echo  "La imagen se guardo correctamente";
              }else
              {
                 $codigo = mysqli_errno($conexion); 
                echo "Error en la ejecución de la consulta: #".$codigo;
              }
        } else{
            echo "Ocurrio un error al subir la imagen";
        }
  }else
  {
    echo "La Imagen no tiene la extension permitida: JPEGE,JPG,PNG O GIF";
  }

 ?>
