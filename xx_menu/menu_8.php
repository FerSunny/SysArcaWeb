<?php
  session_start();
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
                          <a class="navbar-brand" href="menu_8.php"><i class="fa fa-home" aria-hidden="true"></i>    Inicio</a>
                        </div>
                        <ul class="nav navbar-nav">
                        <!--
                            <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-users" aria-hidden="true"></i>    Administracion<span class="caret"></span></a>
                              <ul class="dropdown-menu" role="menu">
                                <li><a href="../se_usuarios/tabla_usuarios.php">Usuarios</a></li>
                                <li><a href="../se_perfiles/tabla_perfiles.php">Perfiles</a></li>
                                <li><a href="../se_modulos/tabla_modulos.php">Modulos</a></li>
                              </ul>
                            </li>


                          

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
                                        <li><a href="../km_perfiles/tabla_perfiles.php">Perfiles</a></li>
                                        <li><a href="../so_medicos/tabla_medicos.php">Medicos</a></li>
                                        <li><a href="../so_clientes/tabla_clientes.php">Pacientes</a></li>
                                        <li><a href="../kg_zonas/tabla_zonas.php">Zonas</a></li>
                                        <li><a href="#">Sucursales</a></li>
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

                          -->
                          <!-- notas -->

                            <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-sticky-note" aria-hidden="true"></i>    Notas<span class="caret"></span></a>
                              <ul class="dropdown-menu" role="menu">
                                  <li><a href="../so_factura/facturas.php">Administracion</a></li>

                              </ul>
                            </li>

                          <!-- Resiultados 

                            <li>
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-book" aria-hidden="true"></i>Resultados<b class="caret"></b></a>

                              <ul class="dropdown-menu">
                                <li>
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Quimica Clinica<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="">Glucosa</a></li>
                                        <li><a href="">BUN</a></li>
                                        <li><a href="">Urea</a></li>
                                        <li><a href="">Creatinina</a></li>
                                        <li><a href="">Acido Urico</a></li>
                                        <li><a href="">Colesterol</a></li>
                                        <li><a href="">Trigliceridos</a></li>
                                        <li><a href="">Bilirrubina Total</a></li>
                                        <li><a href="">ALT/TGP</a></li>
                                        <li><a href="">AST/TGO</a></li>
                                        <li><a href="">Fosfatasa Alacalina</a></li>
                                        <li><a href="">LDH</a></li>
                                        <li><a href="">Amilasa</a></li>
                                        <li><a href="">GGT</a></li>
                                        <li><a href="">HDL Colesterol</a></li>
                                        <li><a href="">Proteinas Totales</a></li>
                                        <li><a href="">Albumina</a></li>
                                        <li><a href="">Globulina</a></li>
                                        <li><a href="">Relacion A/G</a></li>
                                        <li><a href="">Calcio</a></li>
                                        <li><a href="">Fisforo</a></li>
                                        <li><a href="">Hierro</a></li>
                                        <li><a href="">Generico</a></li>
                                    </ul>
                                </li>

                                <li>
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Gabinete<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="">Radiografias</a></li>
                                        <li><a href="">Electrocardiogramas</a></li>
                                        <li><a href="">Colposcopias</a></li>
                                        <li><a href="">Tomografias</a></li>
                                        <li><a href="">Generico</a></li>

                                    </ul>
                                </li>

                                <li>
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Ultrasonido<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="">Obstericos 1er Trim.</a></li>
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

                                    </ul>
                                </li>


                                <li>
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Biometria Hematica<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="">Hemoglobina</a></li>
                                        <li><a href="">Hematocrito</a></li>
                                        <li><a href="">Eritrocitos</a></li>
                                        <li><a href="">VGM</a></li>
                                        <li><a href="">HGM</a></li>
                                        <li><a href="">CMH</a></li>
                                        <li><a href="">RDW</a></li>
                                        <li><a href="">Leucocitos</a></li>
                                        <li><a href="">Linfocitos</a></li>
                                        <li><a href="">Monocitos</a></li>
                                        <li><a href="">Neutrofilos</a></li>
                                        <li><a href="">Eosinofilos</a></li>
                                        <li><a href="">Basofilos</a></li>
                                        <li><a href="">Plaquetas</a></li>
                                        <li><a href="">Generico</a></li>
                                    </ul>
                                </li>

                              </ul>
                            </li>

                            autorizaciones 

                            <li>
                             <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Agenda<span class="caret"></span></a>
                             <ul class="dropdown-menu" role="menu">
                                 <li><a href="#">Orden del Dia</a></li>
                             </ul>

                           </li>
                           <li>
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Historia Clinica<span class="caret"></span></a>
                              <ul class="dropdown-menu" role="menu">
                                  <li><a href="#">Historia</a></li>
                              </ul>
                           </li>
                          
                           <li>
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Cierre <span class="caret"></span></a>
                              <ul class="dropdown-menu" role="menu">
                                  <li><a href="#">Matutino</a></li>
                                  <li><a href="#">Vespertino</a></li>
                                  <li><a href="#">Dia</a></li>
                              </ul>
                           </li>
                          -->
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
