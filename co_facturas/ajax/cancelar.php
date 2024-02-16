<?php 
    include ("../../controladores/conex.php");
    $tabla = $_GET['tabla'];


    $ejecutar = new Cancelar();
    switch ($tabla) {
        case '1':
            $resultado = $ejecutar->Efectivo();
            break;
        case '2':
            $resultado = $ejecutar->Bancos();
            break;
        case '3':
            $resultado = $ejecutar->Todo();
            break;
        default:
            # code...
            break;
    }

    class Cancelar
    {
        function Efectivo()
        {
            global $conexion;
            $query = "TRUNCATE TABLE so_folios_efectivo";
            $stmt = $conexion->prepare($query);
            
            if($stmt->execute())
            {
                echo 1;
            }else
            {
                $codigo = mysqli_errno($conexion); 
                echo "Error MySQL #".$codigo;
            }
        }

        function Bancos()
        {
            global $conexion;
            $query = "TRUNCATE TABLE so_folios_banco";
            $stmt = $conexion->prepare($query);
            
            if($stmt->execute())
            {
                echo 2;
            }else
            {
                $codigo = mysqli_errno($conexion); 
                echo "Error MySQL #".$codigo;
            }
        }

        function Todo()
        {
            global $conexion;
            $query = "TRUNCATE TABLE so_folios_banco";
            $stmt = $conexion->prepare($query);
            
            if($stmt->execute())
            {
                $stmt->close();
                $query = "TRUNCATE TABLE so_folios_efectivo";
                $stmt = $conexion->prepare($query);
                
                if($stmt->execute())
                {
                    echo 1;
                }else
                {
                    $codigo = mysqli_errno($conexion); 
                    echo "Error MySQL #".$codigo;
                }
            }else
            {
                $codigo = mysqli_errno($conexion); 
                echo "Error MySQL #".$codigo;
            }
        }
    }
    

?>

