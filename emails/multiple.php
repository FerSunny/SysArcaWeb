<?php

function multiple($tipo,$valor,$atach,$asunto,$contenido)
{
    include ("../../controladores/conex.php");
    include("envia_email2.php");
    $email="";
    switch ($tipo) {
        case '1': // paciente
            // obtener datos del paciente  
            $sql_pac="select mail as email FROM so_clientes
            where activo = 'A' AND id_cliente = $valor";
            //echo $sql_max;
            if ($result_pac = mysqli_query($conexion, $sql_pac)) {
              while($row_pac = $result_pac->fetch_assoc())
              {
                  $email=$row_pac['email'];
              }
            }
            break;
        case '2': // empleado
            // obtener datos del paciente  
            $sql_pac="select mail as email FROM se_usuarios
            where activo = 'A' AND id_usuario = $valor";
            //echo $sql_max;
            if ($result_pac = mysqli_query($conexion, $sql_pac)) {
                while($row_pac = $result_pac->fetch_assoc())
                {
                    $email=$row_pac['email'];
                }
            }
            break;
        case '3': // medico
            // obtener datos del paciente  
            $sql_pac="select e_mail as email FROM so_medicos
            where estado = 'A' AND id_medico = $valor";
            //echo $sql_max;
            if ($result_pac = mysqli_query($conexion, $sql_pac)) {
                while($row_pac = $result_pac->fetch_assoc())
                {
                    $email=$row_pac['email'];
                }
            }
            break;
        case '4': // calidad
            // obtener datos del paciente  
            $email="gerencia.calidad@laboratoriosarca.mx";
            break;
        case '5': // sucursal
            // obtener datos del sucursal  
            $sql_pac="select mail as email FROM kg_sucursales
            where estado = 'A' AND id_sucursal = $valor";
            //echo $sql_max;
            if ($result_pac = mysqli_query($conexion, $sql_pac)) {
                while($row_pac = $result_pac->fetch_assoc())
                {
                    $email=$row_pac['email'];
                }
            }
            break;
        case '6': // envio de resultados
            // obtener datos del paciente  
            $sql_pac="select mail as email FROM so_clientes
            where activo = 'A' AND id_cliente = $valor";
            if ($result_pac = mysqli_query($conexion, $sql_pac)) {
                while($row_pac = $result_pac->fetch_assoc())
                {
                    $email=$row_pac['email'];
                }
            }
            break;
        default:
            $email=NULL;
            break;
    }

// validamos e enviamos el email.

    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $valida = 2; //exit("invalid format");
    }else{
        /*
        echo "email, valido";
        echo $email;
        echo $asunto;
        echo $contenido;
        */
        $valida = envia_email2($tipo,$email,$atach,$asunto,$contenido);
        /*if ($valida == NULL){
            $valida = 1;
        }
        */
        //$valida=1;
    }
    //echo 'Valida -->'.$valida.'<--';
    return $valida;

}   

?>