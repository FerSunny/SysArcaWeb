<?php 

include ("../../config/conex.php");


$accion = $_GET['val'];


switch ($accion) {
    case '1': // municipios
            $id_estado = $_POST['id_estado'];
            $id_municipio = $_POST['id_municipio'];
            Llenar_municipio($conexion,$id_estado,$id_municipio);
        break;
    case '2': // localidades
            $id_estado = $_POST['id_estado'];
            $id_municipio = $_POST['id_municipio'];
            Llenar_localidades($conexion,$id_estado,$id_municipio);
        break;
    case '3':
            $id_localidad = $_POST['id_localidad'];
            Llenar_localidades($conexion,$id_localidad);
        break;
    
    default:
        # code...
        break;
}

function Llenar_municipio($conexion,$id_estado,$id_municipio)
{
    $query = "SELECT * FROM ku_municipios WHERE  fk_id_estado = $id_estado";

    $result = $conexion->query($query);

    while ($row = mysqli_fetch_array($result)) 
    {
      echo '<option value="'.$row['id_municipio'].'">'.$row['desc_municipio'].'</option>';
    }

    /*echo '    <script>
                fk_municipio= $("#frmedit #fi_municipio").val("$id_municipio")
            </script>'*/


}
function Llenar_localidades($conexion,$id_estado,$id_municipio)
{
    $query = "SELECT * FROM ku_localidades WHERE id_estado =$id_estado AND fk_id_municipio = $id_municipio";

    $result = $conexion->query($query);

    while ($row = mysqli_fetch_array($result)) 
    {
      echo '<option value="'.$row['id_localidad'].'">'.$row['desc_localidad'].'</option>';
    }

}

 ?>