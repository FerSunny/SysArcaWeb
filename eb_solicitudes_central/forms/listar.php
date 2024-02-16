<?php

  include ("../../controladores/conex.php");
  //include ("../controladores/actualizar_estatus.php")
    session_start();
    $fk_id_perfil=$_SESSION['fk_id_perfil'];
    $id_detalle = $_GET['id'];
    $sucursal = $_GET['sucursal'];

  $query = "SELECT '$fk_id_perfil' perfil, sol.id_solicitud,pt.desc_producto,pro.razon_social,sol.cantidad,sol.costo_pza costo_total,sol.fk_id_sucursal,sol.fk_id_producto,sol.fk_id_proveedor,sol.cantidad,
        sol.fk_id_detalle,sol.tipo,sol.importe_total
     FROM eb_solicitudes sol
LEFT OUTER JOIN eb_proveedores pro ON (pro.id_proveedor = sol.fk_id_proveedor)
LEFT OUTER JOIN eb_productos pt ON (pt.id_producto = sol.fk_id_producto)
WHERE fk_id_detalle = $id_detalle AND sol.fk_id_sucursal = $sucursal
AND sol.estado = 'A' AND (sol.estatus = 'C' OR sol.estatus = 'P' OR sol.estatus = 'R')
ORDER BY sol.id_solicitud";

  $resultado = mysqli_query($conexion, $query);

  $data = Array();

 if (mysqli_num_rows($resultado)!=0) {
    

        //Recorremos todos los datos de la tabla categoria para listarla
        while ($reg = $resultado->fetch_object())
        {
          $hola = "Hola como estas";
          $arreglo[]=$reg;
          $data[] = array(
            "0" => $reg->desc_producto,
            "1" => $reg->cantidad,
            "2" => $reg->importe_total,
            "3" => "<button type='button' class='btn btn-primary' onClick='view_productos(".$reg->fk_id_detalle.",".$reg->id_solicitud.")'><i class='fas fa-edit'></i></button>",
            "4" => ($reg->tipo == "1") ? "<button type='button' class='add btn btn-dark' onClick='add_almacen(".$reg->fk_id_detalle.",".$reg->id_solicitud.")'><i class='fas fa-person-booth'></i></button>" : "",
            "5" => "<button type='button' class='delete btn btn-danger' onClick='delete_solcitud(".$reg->fk_id_detalle.",".$reg->id_solicitud.")'><i class='fas fa-trash-alt'></i></button>"
          );
        }
        $results = array(
          //Se utiliza datatables y le tenemos que enviar informacion
          "sEcho" => 1, //Informacion para el datatables
          "iTotalRecords" => count($data),//Enviamos el total de registros al datatable
          "iTotalDisplayRecords" => count($data), //Enviamos el total de registros a visualizar
          "aaData" => $data);
        echo json_encode($results); //Al finalizar ahora si se envian los datos al datatable en formato json
  }else{

    $estatus="L";

    $query = "UPDATE eb_detalle_solicitud SET estatus = '$estatus' WHERE id_detalle = '$id_detalle'";
    
    $cambioStatus = $conexion -> query($query);

    $query1 = "UPDATE eb_solicitudes SET estatus = '$estatus' WHERE fk_id_detalle = '$id_detalle'";
    $cambioStatus2 = $conexion -> query($query1);

    if ($cambioStatus && $cambioStatus2) {
      
      echo 1;

    }else{
        $codigo = mysqli_errno($conexion);
        echo $codigo;
    }
     
  }

  
?>
