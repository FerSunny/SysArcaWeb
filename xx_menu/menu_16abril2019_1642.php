<?php
  session_start();
  $para=($_SESSION['nombre']);
  if (isset($_SESSION['nombre']) && $_SESSION['ingreso']=='YES')
  {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Menu</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="../media/css/font-awesome.min.css">
    <link href="../media/css/navbar.css" rel="stylesheet"> <!-- tercer menu -->
    <script type="text/javascript" src="js/jquery.js" charset="UTF-8"></script>
    <script type="text/javascript" src="js/bootstrap.min.js" charset="UTF-8"></script>
    <script type="text/javascript" src="js/jquery-ui.js"></script>
    <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- menu tercero -->
    <script
          src="https://code.jquery.com/jquery-3.1.1.js"
          integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA="
          crossorigin="anonymous">
    </script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="../media/js/navbar.js"></script>
    <!-- menu tercero -->
    <style>
    .carousel-inner > .item > img,
    .carousel-inner > .item > a > img {
        width: 70%;
        margin: auto;
    }
    </style>
</head>
<body background="../imagenes/logo_arca_sys_web.jpg">
  <div class="container">

    <div class="bs-docs-section clearfix">
      <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
              <div class="bs-component">
                <nav class="navbar navbar-light" style="background-color: #e3f2fd; color: #fff;">
                    <div class="container-fluid">
                        <div class="navbar-header">
                          <a class="navbar-brand" href="menu.php"><i class="fa fa-home" aria-hidden="true"></i>    Inicio</a>
                        </div>
                        <ul class="nav navbar-nav">

                          <!-- administracion -->  

                            <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-users" aria-hidden="true"></i>    Administracion<span class="caret"></span></a>
                              <ul class="dropdown-menu" role="menu">
                                <li><a href="../se_usuarios/tabla_usuarios.php">Usuarios</a></li>
                                <li><a href="../se_perfiles/tabla_perfiles.php">Perfiles</a></li>
                                <li><a href="../se_modulos/tabla_modulos.php">Modulos</a></li>
                              </ul>
                            </li>

                          <!-- catalogos -->

                            <li>
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-book" aria-hidden="true"></i>    Catalogos<b class="caret"></b></a>

                              <ul class="dropdown-menu">
                                <li>
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Operativo<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="../km_estudios/km_estudios_t.php">Estudios</a></li>
                                        <li><a href="../km_muestras/tabla_muestras.php">Muestras</a></li>
                                        <li><a href="../km_indicaciones/tabla_indicaciones.php">Indicaciones</a></li>
                                        <li><a href="../km_perfiles/lista_perfiles.php">Perfiles</a></li>
                                        <li><a href="../so_medicos/tabla_medicos.php">Medicos</a></li>
                                        <li><a href="../so_clientes/tabla_clientes.php">Pacientes</a></li>
                                        <li><a href="../so_clientes_hist/tabla_clientes.php">Pacientes Historico</a></li>
                                        
                                        <li><a href="../kg_zonas/tabla_zonas.php">Zonas</a></li>
                                        <li><a href="#">Sucursales</a></li>
                                        <li><a href="../ww_precios_estudios/precios_estudios.php">Precios</a></li>
                                        <li><a href="../km_paquetes/tabla_paquetes.php">Paquetes</a></li>
                                        <li><a href="../km_dosis/tabla_dosis.php">Dosis</a></li>
                                        <li><a href="../km_vias/tabla_via.php">Vias</a></li>
                                        <li><a href="../km_diagnosticos/tabla_diagnosticos.php">Diagnosticos</a></li>
                                        <li><a href="../km_servicios/tabla_servicios.php">Servicios</a></li>
                                    </ul>
                                </li>

                                <li>
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Aministrativos<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="../kg_comisiones/tabla_comisiones.php">Participaciones</a></li>
                                        <li><a href="../kg_promociones/tabla_promociones.php">Promociones</a></li>
                                        <li><a href="../kg_descuentos/tabla_descuentos.php">Descuentos</a></li>
                                        <li><a href="../kg_estado_civil/tabla_estado_civil.php">Esado Civil</a></li>
                                        <li><a href="../kg_ocupaciones/tabla_ocupaciones.php">Ocupaciones</a></li>
                                        <li><a href="../km_especialidades/tabla_especialidad.php">Especialidades</a></li>
                                    </ul>
                                </li>


                                <li>
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Ubicacion<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="">Estados</a></li>
                                        <li><a href="">Municipios</a></li>
                                        <li><a href="">Localidades</a></li>
                                        <li><a href="">Colonias</a></li>
                                    </ul>
                                </li>

                              </ul>
                            </li>

                          <!-- Plantillas -->

                            <li>
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-book" aria-hidden="true"></i>Plantillas<b class="caret"></b></a>

                              <ul class="dropdown-menu">
                                <li>
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Quimica Clinica<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="../in_bitacora/tabla_interface.php">Interface</a></li>
                                    </ul>
                                </li>

                                <li>
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Gabinete<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="">Radiografias</a></li>
                                        <li><a href="../cr_plantilla_ekg/tabla_plantilla_ekg.php">Electrocardiogramas</a></li>
                                        <li><a href="../cr_plantilla_4/tabla_plantilla_4.php">Colpo/PPN</a></li>
                                        <li><a href="">Tomografias</a></li>
                                        <li><a href="">Generico</a></li>

                                    </ul>
                                </li>

                                <li>
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Imagenologia<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        
                                        <li><a href="../cr_plantilla_usg/tabla_plantilla_usg.php">Usg</a></li>
                                        
                                        <li><a href="../cr_plantilla_rx/tabla_plantilla_rx.php">Rx</a></li>
                                        
                                        <li><a href="../cr_plantilla_colpo/tabla_plantilla_colpo.php">Colpo</a></li>
<!--                                        
                                        <li><a href="../cr_plantilla_usg/tabla_plantilla_usg.php">Usg</a></li>
                                        
                                        <li><a href="">Obstericos 2er Trim.</a></li>
                                        <li><a href="">Obstericos 3er Trim.</a></li>
                                        <li><a href="">Pelvico</a></li>
                                        <li><a href="">Renal</a></li>
                                        <li><a href="">Higado y Vias Biliares</a></li>
                                        <li><a href="">Abdomen Completo</a></li>
                                        <li><a href="">Abdomen Suprior</a></li>
                                        <li><a href="">Abdomen Inferior</a></li>
                                        <li><a href="">Glandulas mamarias</a></li>
                                        <li><a href="">Tiroides</a></li>
                                        <li><a href="">Muesculo escletico</a></li>
                                        <li><a href="">Transvaginal</a></li>
                                        <li><a href="">Generico</a></li>
-->
                                    </ul>
                                </li>


                                <li>
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Biometria Hematica<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="../cr_plantilla_1/tabla_plantilla_1.php">Grupo 1 (P1)</a></li>
                                        <li><a href="../cr_plantilla_2/tabla_plantilla_2.php">Grupo 2 (PIE/GR-RH)</a></li>
                                        <li><a href="../cr_plantilla_cvo/tabla_plantilla_cvo.php">Grupo 3 (CULT/COP/BACI)</a></li>
                                    </ul>
                                </li>

                              </ul>
                            </li>

                          <!-- notas -->

                            <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-sticky-note" aria-hidden="true"></i>    Notas<span class="caret"></span></a>
                              <ul class="dropdown-menu" role="menu">
                                  <li><a href="../so_factura/facturas.php">Administracion</a></li> 
                                  <li><a href="../ww_consulta_notas/lista_notas.php">Consulta</a></li>
                                  <li><a href="../so_pagos/tabla_saldos.php">Pagos</a></li>
                                  <li><a href="../so_medicos_consulta/tabla_medicos.php">Consulta Medicos</a></li>
                                 
                                  <li><a href="../ww_precios_estudios/precios_estudios.php">Lista de precios</a></li>
                                  <li><a href="../so_factura_hist/facturas.php">Notas Historico</a></li>
                                  
                                  <li>
                                   <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Facturas<span class="caret"></span></a>
                                   <ul class="dropdown-menu" role="menu">
                                       <li><a href="../fa_nota_factura/tabla_notafac.php">Asignacion Folio</a></li>
                                   </ul>
                                 </li>                                  
                                  
                                  <!--
                                  <li><a href="{% url 'clientes:listado_clientes' %}">Cancelaciones</a></li>
                                -->
                              </ul>
                            </li>

                            <!-- agenda-->

                            <li>
                             <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Agenda<span class="caret"></span></a>
                             <ul class="dropdown-menu" role="menu">
                                 <li><a href="../ag_orden_dia_p1/tabla_agenda">Orden del Dia (P1)</a></li>
                                 <li><a href="../ag_orden_dia_p1_nvo/tabla_agenda.php">Orden del Dia (P1) - NVO</a></li>
                                 <li><a href="../ag_orden_dia_p2/tabla_agenda">Orden del Dia (PIE/GR-RH)</a></li>
                                 <li><a href="../ag_orden_dia_cvo/tabla_agenda">Orden del Dia (CULT/COP/BACI)</a></li>
                                 <!--
                                 <li><a href="../ag_orden_dia_p4/tabla_agenda.php">Orden del Dia (COLPO/PPN)</a></li>
                                 -->
                                 <li><a href="../ag_orden_dia_ekg/tabla_agenda">Orden del Dia (EKG)</a></li>
                                 <li><a href="../ag_orden_dia_usg/tabla_agenda">Orden del Dia (USG)</a></li>
                                 <!--
                                 <li><a href="../ag_orden_dia_colpo/tabla_agenda.php">Orden del Dia (COLPO)</a></li>
                                 -->
                                 <li><a href="../ag_orden_dia_colpo_4/tabla_colpo_papa">Orden del Dia (COLPO/PPN - 4)</a></li>
                                
                                <li><a href="../ag_confirma/tabla_validar">Valida Resultados</a></li> 
                                <li><a href="../ag_confirma_i/tabla_validar">Interfase</a></li> 
                                <li><a href="../ag_confirma_v2.0/tabla_validar"> <font color="red" face="Comic Sans MS,arial,verdana">Valida Resultados - V.2.0</a> </font> </li>

                                <li><a href="../ag_orden_dia_p1_v5.3/tabla_agenda"> <font color="red" face="Comic Sans MS,arial,verdana"> Orden del Dia (P1) - V.5.3 </font> </a></li>

                                <li><a href="../ag_orden_dia_p1_nvo_v1.3/tabla_agenda"> <font color="red" face="Comic Sans MS,arial,verdana">Orden del Dia (P1) - NVO - V.1.3 </font> </a></li>

                                <li><a href="../ag_orden_dia_p1_pacientes/tabla_p1"> <font color="red" face="Comic Sans MS,arial,verdana">Orden del Dia (P1) - NVO - Pacientes </font> </a></li>
                                
                             </ul>

                           </li>



                           <li>
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Consulta Externa<span class="caret"></span></a>
                              <ul class="dropdown-menu" role="menu">
                                  <li><a href="#">Paciente</a></li>
                              </ul>
                           </li>
<!-- Rutas -->

                           <li>
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Rutas<span class="caret"></span></a>
                              <ul class="dropdown-menu" role="menu">
                                  <li><a href="../cr_plantilla_ruta/tabla_ruta.php">Medicos</a></li>
                                  <li><a href="">Visitadores Medicos</a></li>
                              </ul>
                           </li>

<!-- REPORTES  -->

                            <li>
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-book" aria-hidden="true"></i>Informes<b class="caret"></b></a>

                              <ul class="dropdown-menu">
                                <li>
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Maquila<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a target='_blank' href='../op_maquila/maquila_unidades.php?usuario=<?php echo $para?>'>Unidad (completo)</a></li>
                                        
                                                                                <li><a target='_blank' href='../op_maquila/maquila_unidades_lab.php?usuario=<?php echo $para?>'>Unidad (labora)</a></li>
                                                                                
                                        <li><a target='_blank' href='../op_maquila/maquila_unidades_lab_arca.php?usuario=<?php echo $para?>'>Unidad (ARCA)</a></li>
                                        
                                    </ul>
                                </li>

                                <li>
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Participaciones<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        
                                        <li><a href="../pa_participaciones/lista_participa.php">Detalle Participaciones</a></li>
                                        
                                        <li><a href="../pa_participaciones/lista_zona_tabla.php">Informes por zona</a></li>                                                                       <li><a href="../pa_participaciones/lista_individual_tabla.php">Informe Individual</a></li>
                                    </ul>
                                </li>

                                <li>
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Folios<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="../co_caja/tab_lista_folios_unidad.php">Folios por unidad</a></li>
                                        <li><a href="../co_caja/tab_lista_folios_empresa.php">Folios por empresa</a></li>
                                    </ul>
                                </li>

                                <li>
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Participaciones His<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        
                                        <li><a href="../pa_participaciones_his/lista_participa.php">Detalle Participaciones</a></li>
                                        
                                        <li><a href="../pa_participaciones_his/lista_zona_tabla.php">Informes por zona</a></li>                                                                       <li><a href="../pa_participaciones_his/lista_individual_tabla.php">Informe Individual</a></li>
                                    </ul>
                                </li>
                                
                                <li>
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Ingresos<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        
                                        <li><a href="../so_desglose_de_pagos/tabla_pagosucursal.php">Desglose de ingresos</a></li>
                                    </ul>
                                </li>

                              </ul>
                            </li>

<!-- GASTOS -->

                          <li>
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Gastos <span class="caret"></span></a>
                              <ul class="dropdown-menu" role="menu">
                                  <li><a href="../ga_clasifica/tabla_clasifica.php">Clasificacion</a></li>
                                  <li><a href="../ga_gastos/tabla_gastos.php">Conceptos</a></li>
                                  <li><a href="../ga_giros/tabla_giros.php">Giros</a></li>
                                  <li><a href="../ga_beneficiarios/tabla_beneficia.php">Beneficiario</a></li>
                                  <li><a href="../ga_registro/tabla_registro.php">Registro</a></li>
                                  <li><a href="../ga_autoriza/tabla_autoriza.php">Autorizaciones</a></li>
                                  
                              </ul>
                           </li>

<!-- CIERRE-->

                           <li>
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Cierre <span class="caret"></span></a>
                              <ul class="dropdown-menu" role="menu">
                                  <li><a href="../co_caja/lista_diario.php">Diario</a></li>
                                  <li><a href="../co_caja/lista_mes.php">Mensual</a></li>
                                  <li><a href="../co_caja/lista_unidad.php">Unidad</a></li>
                                  <li><a href="../co_caja/lista_diario_his.php">Historico (Diario)</a></li>
                              </ul>
                           </li>

                        </ul>
                        <div class="navbar-right">
                                 <a class="navbar-brand" href="../includes/logout.php">
                                     <span class="glyphicon glyphicon-log-out"></span> Salir
                                 </a>
                        </div>
                  </div>
              </nav>
          </div>
          </div>
      </div>
  </div>

  </div>

   <div class="container center" id="centro">
      <h2 align="center"> Bienvenido(a) <?php echo $_SESSION['nombre_completo']?> al sistema de control de </h2>
      <h1 align="center">Laboratorios Arca</h1>
   </div>

   <div class="container">
     <br>
     <div id="myCarousel" class="carousel slide" data-ride="carousel">
       <!-- Indicators -->
       <ol class="carousel-indicators">
         <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
         <li data-target="#myCarousel" data-slide-to="1"></li>
         <li data-target="#myCarousel" data-slide-to="2"></li>
         <li data-target="#myCarousel" data-slide-to="3"></li>
       </ol>

       <!-- Wrapper for slides -->
       <div class="carousel-inner" role="listbox">

         <div class="item active">
           <img src="../img_carrusel/redes_tulye.jpg" alt="Chania" width="460" height="345">
           <div class="carousel-caption">
             <h3>San Gregorio</h3>
             <p>Unidad de laboratorios clinicos ARCA</p>
           </div>
         </div>
         <div class="item">
           <img src="../img_carrusel/DSC_0081.jpg" alt="Flower" width="460" height="345">
           <div class="carousel-caption">
             <h3>Flowers</h3>
             <p>Beautiful flowers in Kolymbari, Crete.</p>
           </div>
         </div>
         <div class="item">
           <img src="../img_carrusel/redes_tecomitl.jpg" alt="Chania" width="460" height="345">
           <div class="carousel-caption">
             <h3>San Pedro</h3>
             <p>Unidad de laboratorios clinicos ARCA</p>
           </div>
         </div>
           <div class="item">
           <img src="../img_carrusel/DSC_0112.jpg" alt="Flower" width="460" height="345">
           <div class="carousel-caption">
             <h3>Flowers</h3>
             <p>Beautiful flowers in Kolymbari, Crete.</p>
           </div>
         </div>
         <div class="item">
           <img src="../img_carrusel/redes_san.pedro.jpg" alt="Flower" width="460" height="345">
           <div class="carousel-caption">
             <h3>Flowers</h3>
             <p>Beautiful flowers in Kolymbari, Crete.</p>
           </div>
         </div>
            <div class="item">
           <img src="../img_carrusel/DSC_0129.jpg" alt="Flower" width="460" height="345">
           <div class="carousel-caption">
             <h3>Flowers</h3>
             <p>Beautiful flowers in Kolymbari, Crete.</p>
           </div>
         </div>

         <div class="item">
           <img src="../img_carrusel/redes_san.pablo.jpg" alt="Flower" width="460" height="345">
           <div class="carousel-caption">
             <h3>Flowers</h3>
             <p>Beautiful flowers in Kolymbari, Crete.</p>
           </div>
         </div>
           <div class="item">
           <img src="../img_carrusel/DSC_0140.jpg" alt="Flower" width="460" height="345">
           <div class="carousel-caption">
             <h3>Flowers</h3>
             <p>Beautiful flowers in Kolymbari, Crete.</p>
           </div>
         </div>
         <div class="item">
           <img src="../img_carrusel/redes_santiago.jpg" alt="Flower" width="460" height="345">
           <div class="carousel-caption">
             <h3>Flowers</h3>
             <p>Beautiful flowers in Kolymbari, Crete.</p>
           </div>
         </div>
          <div class="item">
           <img src="../img_carrusel/DSC_0141.jpg" alt="Flower" width="460" height="345">
           <div class="carousel-caption">
             <h3>Flowers</h3>
             <p>Beautiful flowers in Kolymbari, Crete.</p>
           </div>
         </div>
         <div class="item">
           <img src="../img_carrusel/redes_xochimilco.jpg" alt="Flower" width="460" height="345">
           <div class="carousel-caption">
             <h3>Flowers</h3>
             <p>Beautiful flowers in Kolymbari, Crete.</p>
           </div>
         </div>
          <div class="item">
           <img src="../img_carrusel/DSC_0163.jpg" alt="Flower" width="460" height="345">
           <div class="carousel-caption">
             <h3>Flowers</h3>
             <p>Beautiful flowers in Kolymbari, Crete.</p>
           </div>
         </div>
         <div class="item">
           <img src="../img_carrusel/san.gregorio.jpg" alt="Flower" width="460" height="345">
           <div class="carousel-caption">
             <h3>Flowers</h3>
             <p>Beautiful flowers in Kolymbari, Crete.</p>
           </div>
          </div>
            <div class="item">
           <img src="../img_carrusel/DSC_0180.jpg" alt="Flower" width="460" height="345">
           <div class="carousel-caption">
             <h3>Flowers</h3>
             <p>Beautiful flowers in Kolymbari, Crete.</p>
           </div>
         </div>
          <div class="item">
           <img src="../img_carrusel/redes_tulyehualco2.jpg" alt="Flower" width="460" height="345">
           <div class="carousel-caption">
             <h3>Flowers</h3>
             <p>Beautiful flowers in Kolymbari, Crete.</p>
           </div>
         </div>
          <div class="item">
           <img src="../img_carrusel/DSC_0243.jpg" alt="Flower" width="460" height="345">
           <div class="carousel-caption">
             <h3>Flowers</h3>
             <p>Beautiful flowers in Kolymbari, Crete.</p>
           </div>
         </div>

       </div>

       <!-- Left and right controls -->
       <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
         <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
         <span class="sr-only">Previous</span>
       </a>
       <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
         <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
         <span class="sr-only">Next</span>
       </a>
     </div>
    </div>
</body>
<script type="text/javascript">var $zoho= $zoho || {livedesk:{values:{},ready:function(){$zoho.livedesk.chat.floatingwindow('all');}}};var d=document;s=d.createElement("script");s.type="text/javascript";s.defer=true;s.src="https://salesiq.zoho.com/support.medisyslabs/float.ls?embedname=medisyslabs";t=d.getElementsByTagName("script")[0];t.parentNode.insertBefore(s,t);</script>
</html>
<?php

  }
  else
  {
    header("location: ../index.html");
  }
 ?>
