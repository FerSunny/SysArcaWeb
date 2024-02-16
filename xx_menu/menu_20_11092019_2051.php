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
                          <a class="navbar-brand" href="menu_20.php"><i class="fa fa-home" aria-hidden="true"></i>    Inicio</a>
                        </div>
                        <ul class="nav navbar-nav">



                            <li>
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-book" aria-hidden="true"></i>Almacén<b class="caret"></b></a>

                              <ul class="dropdown-menu">
                                <li>
                                <li>
                                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Catalogos<b class="caret"></b></a>
                                  <ul class="dropdown-menu">
                                  <li><a href="../eb_productos/tabla_productos">Productos</a></li>
                                  <li><a href="../eb_proveedores/tabla_proveedores">Proveedores</a></li>
                                  <li><a href="../eb_departamento/tabla_departamento">Departamento</a></li>
                                  <li><a href="../eb_categoria/tabla_categoria">Categoria</a></li>
                                    </ul>
                                </li>

                                  <li>
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Solicitudes<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                  <li><a href="../eb_crear_central/tabla_solicitudes">Crear Solicitud</a></li>
                                  <li><a href="../eb_solicitudes_central/tabla_solicitudes">Solicitudes</a></li>
                                  <li><a href="../eb_historial/tabla_historial">Historial de Solicitudes</a></li>
                                    </ul>
                                  </li>
                                    <li><a href="../eb_agenda/tabla_agenda">Agenda</a></li>
                                    <li><a href="../eb_almacen_central/tabla_almacen">Almacen Central</a></li>
                              </li>
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
      <h2 align="center"> Bienvenido(a) <?php echo $_SESSION['nombre_completo']?> al sistema de control de
      </h2>
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
