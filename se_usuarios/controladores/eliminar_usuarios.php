<?php
include("../../controladores/conex.php");

$idusuario = $_POST["idusuario"];
$activo="A";
$suspendido="S";


$query="SELECT  activo FROM se_usuarios WHERE id_usuario ='$idusuario'";

//echo $query;

$resultado = mysqli_query($conexion, $query);

if($row = mysqli_fetch_array($resultado))
  {
    //echo $row['activo'];
  if($row['activo'] == $activo)
    {
      //echo 'aqui2';
      $query1="UPDATE se_usuarios SET  activo='$suspendido' WHERE id_usuario ='$idusuario'";

      //echo $query1;

      $resultado1 = mysqli_query($conexion, $query1);
      if ($resultado1)
        {
          echo "<script>location.href='../tabla_usuarios.php'</script>";
    		}
    		else
        {
    			  $codigo = mysqli_errno($conexion);
  echo $codigo;
    		}

    		if (mysqli_close($conexion))
        {
    			echo "desconexion realizada. <br />";
    		}
    		else
        {
    			  $codigo = mysqli_errno($conexion);
  echo $codigo;
    		}
      }
    }
else
{
  $codigo = mysqli_errno($conexion);
  echo $codigo;}
 ?>
