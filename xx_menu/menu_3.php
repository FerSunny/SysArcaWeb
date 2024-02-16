<?php 
  include "../controladores/conex.php";
  $para=($_SESSION['nombre']);

  $stmt = $conexion->prepare("SELECT MIN(id_carrucel) minimo, COUNT(*) cantidad FROM so_carrucel WHERE estado = 'A'");
  //$stmt->bind_param("is", $area,$estado);
  $stmt->execute();
  $stmt->bind_result($minimo,$cantidad);
  $stmt->fetch();
  $stmt->close();
  if (isset($_SESSION['nombre']) && $_SESSION['ingreso']=='YES')
  {
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Menú</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/jquery.dataTables.min.css"/>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.10/css/mdb.min.css" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="../media/alert/dist/sweetalert2.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="menu.css">
    <link href="https://fonts.googleapis.com/css?family=Oswald&display=swap" rel="stylesheet">
  <style>
    .w-50{
      margin-left: 250px;
    }
    .level_1:hover + .lista_1{
      display: block;
    }
    #basicExampleNav ul li a{
      color:black;
      font-weight: 900;
    }
  </style>
</head>
<body background="../imagenes/logo_arca_sys_web.jpg">
  <!--Navbar-->
  <nav class="navbar navbar-expand-lg navbar-dark blue lighten-4">

    <!-- Navbar brand -->
    <a class="navbar-brand" href="#" style="font-weight: 900; color: black;">Inicio</a>

    <!-- Collapse button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
      aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation" style="margin-right: auto;">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Collapsible content -->
    <div class="collapse navbar-collapse" id="basicExampleNav">

      <!-- Links -->
      <ul class="navbar-nav mr-auto">
        <!-- Dropdown -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">Notas</a>
          <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="../so_factura/facturas.php">Administracion</a>
            <a class="dropdown-item" href="../ww_consulta_notas/lista_notas.php">Consulta</a>
            <a class="dropdown-item" href="../so_pagos/tabla_saldos.php">Pagos</a>
            <a class="dropdown-item" href="../so_medicos_consulta/tabla_medicos.php">Consulta Medicos</a>
            <a class="dropdown-item" href="../ww_precios_estudios/precios_estudios.php">Lista de precios</a>
            <a class="dropdown-item" href="../so_factura_hist/facturas.php">Notas Historico</a>
            <a class="dropdown-item" href="../ag_confirma_v4.0/tabla_validar">Resultados Historico</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">Agenda</a>
          <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item level_1" >Orden del Día (EKG)</a>
            <ul class="lista_1" style="display: none; float: right;">
              <li><a href="">A</a></li>
              <li><a href="">B</a></li>
              <li><a href="">C</a></li>
            </ul>
            <a class="dropdown-item" href="../ag_orden_dia_usg/tabla_agenda">Orden del Día (USG)</a>
            <a class="dropdown-item" href="../ag_orden_dia_colpo_4/tabla_colpo_papa">Orden del Día (COLPO/PPN - 4)</a>
            <a class="dropdown-item" href="../ag_confirma_v3.0/tabla_validar"> Validar Resultados</a>
            <a class="dropdown-item" href="../ag_orden_dia_pacientes/tabla_p1"> Orden del Día Pacientes </a>
            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false" style="color: black;">Facturas</a>
            <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
              <a href="../fa_nota_factura/tabla_notafac.php">Asignacion Folio</a>
            </div>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="../includes/logout.php" style="color: black; font-weight: 900">Salir</a>
        </li>
      </ul>
      <!-- Links -->
    </div>
    <!-- Collapsible content -->
  </nav>

  <!--/.Navbar-->
  <nav id="nav-menu-container">
    <ul class="nav-menu">
      <li class="menu-has-children"><a href="">Administracion</a>
        <ul style="display:none">
          <li><a href="../se_usuarios/tabla_usuarios">Usuarios</a></li>
          <li><a href="../se_perfiles/tabla_perfiles">Perfiles</a></li>
          <li><a href="../se_modulos/tabla_modulos">Modulos</a></li>
        </ul>
      </li>
      <li class="menu-has-children"><a href="">Catálogos (tablas)</a>
        <ul style="display:none">
          <li class="menu-has-children"> <a> Operativo </a> 
            <ul style="display:none">
              <li><a href="../km_estudios/km_estudios_t">Estudios</a></li>
              <li><a href="../km_muestras/tabla_muestras">Muestras</a></li>
              <li><a href="../km_indicaciones/tabla_indicaciones">Indicaciones</a></li>
              <li><a href="../km_perfiles/lista_perfiles">Perfiles</a></li>
              <li><a href="../so_medicos/tabla_medicos">Medicos</a></li>
              <li><a href="../so_clientes/tabla_clientes">Pacientes</a></li>
              <li><a href="../so_clientes_hist/tabla_clientes">Pacientes Historico</a></li>

              <li><a href="../kg_zonas/tabla_zonas">Zonas</a></li>
              <li><a href="../kg_sucursales/tabla_sucursales">Sucursales</a></li>
              <li><a href="../kg_grupos/tabla_grupos">Grupos</a></li>
              <li><a href="../ww_precios_estudios/precios_estudios">Precios</a></li>
              <li><a href="../km_paquetes/tabla_paquetes">Paquetes</a></li>
              <li><a href="../km_dosis/tabla_dosis">Dosis</a></li>
              <li><a href="../km_vias/tabla_via.php">Vias</a></li>
              <li><a href="../km_diagnosticos/tabla_diagnosticos">Diagnosticos</a></li>
              <li><a href="../km_servicios/tabla_servicios">Servicios</a></li>
              <li><a href="../kg_usos/tabla_usos">Usos</a></li>
            </ul>
          </li>
          <li class="menu-has-children"> <a> Aministrativos </a> 
            <ul style="display:none">
              <li><a href="../kg_comisiones/tabla_comisiones">Participaciones</a></li>
              <li><a href="../kg_promociones/tabla_promociones">Promociones</a></li>
              <li><a href="../kg_descuentos/tabla_descuentos">Descuentos</a></li>
              <li><a href="../kg_estado_civil/tabla_estado_civil">Estado Civil</a></li>
              <li><a href="../kg_ocupaciones/tabla_ocupaciones">Ocupaciones</a></li>
              <li><a href="../km_especialidades/tabla_especialidad">Especialidades</a></li>
            </ul>
          </li>
          <li class="menu-has-children"> <a> Ubicación </a> 
            <ul style="display:none">
              <li><a href="">Estados</a></li>
              <li><a href="">Municipios</a></li>
              <li><a href="">Localidades</a></li>
              <li><a href="">Colonias</a></li>
            </ul>
          </li>
        </ul>
      </li>
      <li class="menu-has-children"><a href="">Plantillas</a>
        <ul style="display:none">
          <li class="menu-has-children"> <a> Quimica Clinica </a> 
            <ul style="display:none">
              <li><a href="../in_bitacora/tabla_interface">Interface</a></li>
            </ul>
          </li>
          <li class="menu-has-children"> <a> Gabinete </a> 
            <ul style="display:none">
              <li><a href="">Radiografias</a></li>
              <li><a href="../cr_plantilla_ekg/tabla_plantilla_ekg">Electrocardiogramas</a></li>
              <li><a href="../cr_plantilla_4/tabla_plantilla_4">Colpo/PPN</a></li>
              <li><a href="">Tomografias</a></li>
              <li><a href="">Generico</a></li>
            </ul>
          </li>
          <li class="menu-has-children"> <a> Imagenologia </a> 
            <ul style="display:none">
              <li><a href="../cr_plantilla_usg/tabla_plantilla_usg">Usg</a></li>
              <li><a href="../cr_plantilla_rx/tabla_plantilla_rx">Rx</a></li>
              <li><a href="../cr_plantilla_colpo/tabla_plantilla_colpo">Colpo</a></li>
            </ul>
          </li>
          <li class="menu-has-children"> <a> Biometria Hematica </a> 
            <ul style="display:none">
              <li><a href="../cr_plantilla_1/tabla_plantilla_1">Grupo 1 (P1)</a></li>
              <li><a href="../cr_plantilla_2/tabla_plantilla_2">Grupo 2 (PIE/GR-RH)</a></li>
              <li><a href="../cr_plantilla_cvo/tabla_plantilla_cvo">Grupo 3 (CULT/COP/BACI)</a></li>
            </ul>
          </li>
        </ul>
      </li>
      <li class="menu-has-children"><a href="">Notas</a>
        <ul style="display:none">
          <li><a href="../so_factura/facturas">Administracion</a></li>
          <li><a href="../ww_consulta_notas/lista_notas">Consulta</a></li>
          <li><a href="../so_pagos/tabla_saldos">Pagos</a></li>
          <li><a href="../so_medicos_consulta/tabla_medicos">Consulta Medicos</a></li>
          <li><a href="../ww_precios_estudios/precios_estudios">Lista de precios</a></li>
          <li><a href="../so_factura_hist/facturas">Notas Historico</a></li>
          <li><a href="../ag_confirma_v4.0/tabla_validar">Resultados Historico</a></li>
          <li class="menu-has-children"> <a> Facturas </a> 
            <ul style="display:none">
              <li><a href="../fa_nota_factura/tabla_notafac">Asignacion Folio</a></li>
            </ul>
          </li>
        </ul>
      </li>
      <li class="menu-has-children"><a href="">Agenda</a>
        <ul style="display:none">
          <li><a href="../ag_orden_dia_ekg/tabla_agenda">Orden del Día (EKG)</a></li>
          <li><a href="../ag_orden_dia_usg/tabla_agenda">Orden del Día (USG)</a></li>
          <li><a href="../ag_orden_dia_colpo_4/tabla_colpo_papa">Orden del Día (COLPO/PPN - 4)</a></li>
          <li><a href="../ag_confirma_v3.0/tabla_validar"> Validar Resultados </a></li>
          <li><a href="../ag_orden_dia_pacientes/tabla_p1"> Orden del Día Pacientes </a></li>
        </ul>
      </li>
      <li class="menu-has-children"><a href=""> Consulta Externa </a>
        <ul style="display:none">
          <li><a href="#">Paciente</a></li>
        </ul>
      </li>
      <li class="menu-has-children"><a href=""> Informes </a>
        <ul style="display:none">
          <li class="menu-has-children"> <a> Maquila </a> 
            <ul style="display:none">
              <li><a target='_blank' href='../op_maquila/maquila_unidades.php?usuario=<?php echo $para?>'>Unidad (completo)</a></li>
              <li><a target='_blank' href='../op_maquila/maquila_unidades_lab.php?usuario=<?php echo $para?>'>Unidad (labora)</a></li>
              <li><a target='_blank' href='../op_maquila/maquila_unidades_lab_arca.php?usuario=<?php echo $para?>'>Unidad (ARCA)</a></li>
            </ul>
          </li>
          <li class="menu-has-children"> <a> Participaciones </a> 
            <ul style="display:none">
              <li><a href="../pa_participaciones/lista_participa">Detalle Participaciones</a></li>
              <li><a href="../pa_participaciones/lista_zona_tabla">Informes por zona</a></li>     
              <li><a href="../pa_participaciones/lista_individual_tabla">Informe Individual</a></li>
            </ul>
          </li>
          <li class="menu-has-children"> <a> Folios </a> 
            <ul style="display:none">
              <li><a href="../co_caja/tab_lista_folios_unidad">Folios por unidad</a></li>
              <li><a href="../co_caja/tab_lista_folios_empresa">Folios por empresa</a></li>
            </ul>
          </li>
          <li class="menu-has-children"> <a> Participaciones His </a> 
            <ul style="display:none">
              <li><a href="../pa_participaciones_his/lista_participa">Detalle Participaciones</a></li>
              <li><a href="../pa_participaciones_his/lista_zona_tabla">Informes por zona</a></li>         
              <li><a href="../pa_participaciones_his/lista_individual_tabla">Informe Individual</a></li>
            </ul>
          </li>
          <li class="menu-has-children"> <a> Ingresos </a> 
            <ul style="display:none">
              <li><a href="../so_desglose_de_pagos/tabla_pagosucursal">Desglose de ingresos</a></li>
            </ul>
          </li>
        </ul>
      </li>
      <li class="menu-has-children"><a href="">Gastos</a>
        <ul style="display:none">
          <li><a href="../ga_clasifica/tabla_clasifica">Clasificacion</a></li>
          <li><a href="../ga_gastos/tabla_gastos">Conceptos</a></li>
          <li><a href="../ga_giros/tabla_giros">Giros</a></li>
          <li><a href="../ga_beneficiarios/tabla_beneficia">Beneficiario</a></li>
          <li><a href="../ga_registro/tabla_registro">Registro</a></li>
          <li><a href="../ga_autoriza/tabla_autoriza">Autorizaciones</a></li>
        </ul>
      </li>
      <li class="menu-has-children"><a href="">Cierre</a>
        <ul style="display:none">
          <li><a href="../co_caja/lista_diario">Diario</a></li>
          <li><a href="../co_caja/lista_mes">Mensual</a></li>
          <li><a href="../co_caja/lista_unidad">Unidad</a></li>
          <li><a href="../co_caja/lista_diario_his">Historico (Diario)</a></li>
        </ul>
      </li>
      <li class="menu-has-children"><a href=""> Toma de muestras </a>
        <ul style="display:none">
          <li><a href="">Tablero de monitoreo (unidad central)</a></li>
          <li><a href="">Registro de toma de muestra –enfermera- (unidades)</a></li>
          <li><a href="">Generación de maquila (unidades)</a></li>
          <li><a href="">Reporte de insumos (unidad)</a></li>
          <li><a href="">Seguimiento de incidencias</a></li>
          <li><a href="">Procedimiento operativo (Bajo normas ISO)</a></li>
        </ul>
      </li>
      <li class="menu-has-children"><a href=""> Recolector </a>
        <ul style="display:none">
          <li><a href=""> Recolección de muestras (unidades) </a></li>
          <li><a href=""> Entrega de muestras (Unidad central) </a></li>
        </ul>
      </li>
      <li class="menu-has-children"><a href=""> Laboratorio </a>
        <ul style="display:none">
          <li><a href=""> Recepción y verificación de muestras </a></li>
          <li><a href=""> Validación y reporte de muestras </a></li>
          <li><a href=""> Clasificación de muestras </a></li>
          <li><a href=""> Reporte de bitácora de proceso de muestras (cuaderno) </a></li>
        </ul>
      </li>
      <li class="menu-has-children"><a href=""> Publicidad </a>
        <ul style="display:none">
          <li><a href=""> Relacionar Nota – factura </a></li>
        </ul>
      </li>
      <li class="menu-has-children"><a href=""> Carrucel </a>
        <ul style="display:none">
          <li><a href="../so_carrucel/tabla_carrusel"> Imagenes Carrucel </a></li>
        </ul>
      </li>
      <li class=""><a href="../includes/logout" style="color: #FFF;font-weight: 900"> Salir </a>
      </li>
    </ul>
  </nav>
  
  <div class="container center" id="centro" style="margin-top: 20px;">
      <h2 align="center" style="font-family: 'Oswald', sans-serif; font-weight: 900"> Bienvenido(a) <?php echo $_SESSION['nombre_completo']?> al sistema de control de </h2>
      <h1 align="center" style="font-family: 'Oswald', sans-serif; font-weight: 400">Laboratorios Arca</h1>
   </div>
  
  <div class="container">
    <!--Carousel Wrapper-->
    <div id="carousel-example-2" class="carousel slide carousel-fade" data-ride="carousel">
      <!--Indicators-->
      <ol class="carousel-indicators">
        <!--<li data-target="#carousel-example-2" data-slide-to="0" class="active"></li>-->
        <?php
          $slide_to = 0;
          $stmt = $conexion->prepare("SELECT * FROM so_carrucel WHERE estado = 'A'");
          //$stmt->bind_param("is", $area,$estado);
          $stmt->execute();
          $result = $stmt->get_result();
            if($result->num_rows === 0) exit('No hay documentos proximos');
            while($row = $result->fetch_assoc())
            {
              if($row['id_carrucel'] == $minimo)
              {
                echo '<li data-target="#carousel-example-2" data-slide-to="'.$slide_to.'" class="active" style="background-color: black;"></li>';
              }else
              {
                echo '<li data-target="#carousel-example-2" data-slide-to="'.$slide_to.'" style="background-color: black;"></li>';
              }
              $slide_to++;
            }
        ?>
      </ol>
      <!--/.Indicators-->
      <!--Slides-->
        <div class="carousel-inner" role="listbox">
          <?php 
            $stmt = $conexion->prepare("SELECT * FROM so_carrucel WHERE estado = 'A'");
              $stmt->execute();
              $result = $stmt->get_result();
              if($result->num_rows === 0) exit('No hay documentos proximos');
              while($row = $result->fetch_assoc())
              {
                $ruta = $row['ruta_img'];
                $titulo = $row['titulo'];
                $subtitulo = $row['subtitulo'];
                if($row['id_carrucel'] == $minimo)
                {
                  if($row['tipo'] == 3)
                  {
           ?>
                    <div class="carousel-item active">
                      <div class="view">
                        <img class="d-block w-100" src="../so_carrucel/<?php echo $ruta; ?>"
                          alt="">
                      </div>
                      <div class="carousel-caption">
                        <h3 class="h3-responsive" style=" color:black; font-weight: 900;"><?php echo  $titulo; ?></h3>
                        <p style="color:black; font-weight: 900;"><?php echo $subtitulo; ?></p>
                      </div>
                    </div>
              <?php }else{?>
                    <div class="carousel-item active">
                      <div class="view">
                        <img class="d-block w-50" src="../so_carrucel/<?php echo $ruta; ?>"
                          alt="" height="900px" width="237px">
                      </div>
                      <div class="carousel-caption">
                        <h3 class="h3-responsive" style=" color:black; font-weight: 900;"><?php echo  $titulo; ?></h3>
                        <p style="color:black; font-weight: 900;"><?php echo $subtitulo; ?></p>
                      </div>
                    </div>
              <?php } ?>
          <?php 
              }else
              {
                if($row['tipo'] == 3)
                {
          ?>
                    <div class="carousel-item">
                      <!--Mask color-->
                      <div class="view">
                        <img class="d-block w-100" src="../so_carrucel/<?php echo $ruta; ?>"
                          alt="">
                      </div>
                      <div class="carousel-caption">
                        <h3 class="h3-responsive" style="color:black; font-weight: 900;"><?php echo  $titulo; ?></h3>
                        <p style="color:black; font-weight: 900;"><?php echo $subtitulo; ?></p>
                      </div>
                    </div>
          <?php }else{?>
                    <div class="carousel-item">
                      <!--Mask color-->
                      <div class="view">
                        <img class="d-block w-50" src="../so_carrucel/<?php echo $ruta; ?>"
                          alt="" height="900px" width="237px">
                      </div>
                      <div class="carousel-caption">
                        <h3 class="h3-responsive" style="color:black; font-weight: 900;"><?php echo  $titulo; ?></h3>
                        <p style="color:black; font-weight: 900;"><?php echo $subtitulo; ?></p>
                      </div>
                    </div>
          <?php }
              }
            } ?>

        </div>
      </div>
      <!--/.Slides-->
      <!--Controls-->
      <a class="carousel-control-prev" href="#carousel-example-2" role="button" data-slide="prev" style="background-color: black; width:50px ; height: 50px;margin-top: 500px;">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carousel-example-2" role="button" data-slide="next" style="background-color: black; width:50px ; height: 50px;margin-top: 500px;">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
      <!--/.Controls-->
    </div>
    <!--/.Carousel Wrapper-->
  </div>
<img src="" alt="" height="" width="">
<script src="../media/alert/dist/sweetalert2.js"></script>
<!-- JQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.10/js/mdb.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
<script>
  // Mobile Navigation
  if( $('#nav-menu-container').length ) {
    var $mobile_nav = $('#nav-menu-container').clone().prop({ id: 'mobile-nav'});
    $mobile_nav.find('> ul').attr({ 'class' : '', 'id' : '' });
    $('body').append( $mobile_nav );
    $('body').prepend( '<button type="button" id="mobile-nav-toggle"><i class="fa fa-bars"></i></button>' );
    $('body').append( '<div id="mobile-body-overly"></div>' );
    $('#mobile-nav').find('.menu-has-children').prepend('<i class="fa fa-chevron-down"></i>');

    $(document).on('click', '.menu-has-children i', function(e){
      $(this).next().toggleClass('menu-item-active');
      $(this).nextAll('ul').eq(0).slideToggle();
      $(this).toggleClass("fa-chevron-up fa-chevron-down");
    });

    $(document).on('click', '#mobile-nav-toggle', function(e){
      $('body').toggleClass('mobile-nav-active');
      $('#mobile-nav-toggle i').toggleClass('fa-times fa-bars');
      $('#mobile-body-overly').toggle();
    });

    $(document).click(function (e) {
      var container = $("#mobile-nav, #mobile-nav-toggle");
      if (!container.is(e.target) && container.has(e.target).length === 0) {
       if ( $('body').hasClass('mobile-nav-active') ) {
          $('body').removeClass('mobile-nav-active');
          $('#mobile-nav-toggle i').toggleClass('fa-times fa-bars');
          //Codigo cuand se la click en la pantalla se cierra el menu
          $('#mobile-body-overly').fadeOut();
        }
      }
    });
  } else if ( $("#mobile-nav, #mobile-nav-toggle").length ) {
    $("#mobile-nav, #mobile-nav-toggle").hide();
  }

  function mostrar_info()
{
  $('.menu_h1').toggleClass('fa-times');
  $('.lista_ver').toggleClass('ocultar2');

 var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
      $('.lista_ver').addClass('fadeInDown').one(animationEnd, function() {
          $('.lista_ver').removeClass('fadeInDown');
           
        });
}


$(function() { 
  
  var botonMostrar = $("#boton-mostrar"),
      botonOcultar = $("#boton-ocultar"),
      parrafo = $("#parrafo");
      botonOcultar.hide();

  botonMostrar.on("click", function() {
   botonOcultar.show()
    botonMostrar.hide();
    parrafo.show("slow");
  });
  
  botonOcultar.on("click", function() {
    botonOcultar.hide()
    botonMostrar.show();
    parrafo.hide(200, function() {
      console.log("Mostrando texto");
    });
  }); 
  
});
</script>
</body>
</html>
<?php

  }
  else
  {
    header("location: ../index.html");
  }
 ?>
