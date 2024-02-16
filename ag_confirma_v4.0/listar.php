<?php
  session_start();
  include ("../controladores/conex.php");
    $fk_id_perfil = $_SESSION['fk_id_sucursal'];
    $fk_id_sucursal = $_SESSION['fk_id_perfil'];

    $id_modulo=$_SESSION['id_modulo'];
    //$_POS['folio']
    if ($_GET['busqueda'] == 'si')
    {
      $and = "AND fa.fk_id_sucursal > 0 AND fa.id_factura =".$_GET['folio'];
    }
    else
    {
      $and = "AND DATE(fa.fecha_factura) BETWEEN DATE_SUB(CURDATE(), INTERVAL 5 DAY) AND DATE_ADD(CURDATE(), INTERVAL 4 DAY) AND fa.fk_id_sucursal = $fk_id_perfil";
    }

    $stmt = $conexion->prepare("SELECT DISTINCT $fk_id_perfil AS perfil,
    su.desc_sucursal,
  CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno) AS nombre_paciente,
  p1.fk_id_factura,
  p1.fk_id_estudio,
  p1.validado,
  es.desc_estudio,
  fa.fecha_factura,
  es.fk_id_plantilla,
  cl.anios,
  fa.fk_id_cliente
FROM cr_plantilla_1_re p1
LEFT OUTER JOIN km_estudios es ON (es.id_estudio = p1.fk_id_estudio),
so_factura fa
LEFT OUTER JOIN kg_sucursales su ON (su.id_sucursal=fa.fk_id_sucursal)
LEFT OUTER JOIN so_clientes cl ON (cl.id_cliente = fa.fk_id_cliente)
WHERE p1.fk_id_factura = fa.id_factura $and

UNION ALL

SELECT DISTINCT $fk_id_perfil AS perfil,
  su.desc_sucursal,
  CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno) AS nombre_paciente,
  p2.fk_id_factura,
  p2.fk_id_estudio,
  p2.validado,
  es.desc_estudio,
  fa.fecha_factura,
  es.fk_id_plantilla,
  cl.anios,
  fa.fk_id_cliente
FROM  cr_plantilla_2_re p2
LEFT OUTER JOIN km_estudios es ON (es.id_estudio = p2.fk_id_estudio),
so_factura fa
LEFT OUTER JOIN kg_sucursales su ON (su.id_sucursal=fa.fk_id_sucursal)
LEFT OUTER JOIN so_clientes cl ON (cl.id_cliente = fa.fk_id_cliente)
WHERE p2.fk_id_factura = fa.id_factura $and

UNION ALL

SELECT DISTINCT $fk_id_perfil AS perfil,
  su.desc_sucursal,
  CONCAT(cl.nombre,' ',cl.a_paterno,' ',cl.a_materno) AS nombre_paciente,
  p3.fk_id_factura,
  p3.fk_id_estudio,
  p3.validado,
  es.desc_estudio,
  fa.fecha_factura,
  es.fk_id_plantilla,
  cl.anios,
  fa.fk_id_cliente
FROM  cr_plantilla_cvo_re p3
LEFT OUTER JOIN km_estudios es ON (es.id_estudio = p3.fk_id_estudio),
so_factura fa
LEFT OUTER JOIN kg_sucursales su ON (su.id_sucursal=fa.fk_id_sucursal)
LEFT OUTER JOIN so_clientes cl ON (cl.id_cliente = fa.fk_id_cliente)
WHERE p3.fk_id_factura = fa.id_factura $and");

    //$stmt->bind_param('ii', $id_factura,$id_estudio);
  $stmt->execute();
  $stmt->bind_result($perfil,$desc_sucursal,$nombre_paciente,$fk_id_factura,$fk_id_estudio,$validado,$desc_estudio,$fecha_factura,$fk_id_plantilla,$anios,$fk_id_cliente);
  $data = array();

   while ($stmt->fetch())
      {
        $data[] = array(
          "0" => $fk_id_factura,
          "1" => $desc_sucursal,
          "2" => $nombre_paciente,
          "3" => $desc_estudio,
          "4" => $fecha_factura,
          "5" => "<button class='btn btn-danger btn-md' onclick='pdf(".$fk_id_factura.",".$fk_id_estudio.",".$fk_id_plantilla.")' style='background-color: #DF0101 !important;'><i class='fas fa-file-pdf'></i></button>",
          "6" => ($validado == 0) ? "<button type='button' class='btn btn-success btn-md' onclick=validar(".$fk_id_factura.",".$fk_id_estudio.",".$fk_id_plantilla.")><i class='fas fa-check'></i></button>" : "",
          "7" => "<button type='button' class='btn btn-primary btn-md' onclick=modificar(".$fk_id_factura.",".$fk_id_estudio.",".$fk_id_plantilla.",".$fk_id_cliente.")><i class='fas fa-edit'></button>"

        );
      }
      $results = array(
        //Se utiliza datatables y le tenemos que enviar informacion
        "sEcho" => 1, //Informacion para el datatables
        "iTotalRecords" => count($data),//Enviamos el total de registros al datatable
        "iTotalDisplayRecords" => count($data), //Enviamos el total de registros a visualizar
        "aaData" => $data);
      echo json_encode($results);
