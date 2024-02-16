<?php
  date_default_timezone_set('America/Mexico_City');
  session_start();
  include ("../../controladores/conex.php");
  $empresa = 1;
  $sucursal = $_SESSION['fk_id_sucursal'];
  $id = $_SESSION['id_usuario'];
  $fecha = date("Y-m-d H:i:s");
  $estado = 'A';
  $titulo = $_POST['titulo'];
  $sub = $_POST['sub'];

  $stmt = $conexion->prepare("SELECT MAX(Id_carrucel) id FROM so_carrucel");
  $stmt->execute();
  $stmt->bind_result($id);
  $stmt->fetch();
  $stmt->close();

  if($id == null)
  {
    $id = 1;
  }else{
    $id+=1;
  }

  
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


  if($tipo == "image/jpeg" || $tipo == "image/jpg" || $tipo == "image/png" || $tipo == "image/gif")
  {
       if(move_uploaded_file($_FILES['carrucel']['tmp_name'], $ruta))
        {
          $query = "INSERT INTO so_carrucel (
                      fk_id_empresa,
                      fk_id_sucursal,
                      fk_id_usuario,
                      ruta_img,
                      fecha_registro,
                      estado,
                      titulo,
                      subtitulo
                    ) VALUES (?,?,?,?,?,?,?,?)";
          $stmt = $conexion->prepare($query);
          $stmt->bind_param('iiisssss', $empresa,$sucursal,$id,$ruta_bd,$fecha,$estado,$titulo,$sub);
              if($stmt->execute())
              {
                echo "La imagen se guardo correctamente";
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
