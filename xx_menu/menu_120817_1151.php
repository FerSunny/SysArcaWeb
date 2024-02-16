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
                          <a class="navbar-brand" href="menu.php"><i class="fa fa-home" aria-hidden="true"></i>    Inicio</a>
                        </div>
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-users" aria-hidden="true"></i>    Administracion<span class="caret"></span></a>
                              <ul class="dropdown-menu" role="menu">
                                <li><a href="../se_usuarios/tabla_usuarios.php">Usuarios</a></li>
                                <li><a href="perfiles.php">Perfiles</a></li>
                                <li><a href="modulos.php">Modulos</a></li>
                              </ul>
                            </li>
                            <li>
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-book" aria-hidden="true"></i>    Catalogos<b class="caret"></b></a>

                              <ul class="dropdown-menu">
                                <li>
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Operativo<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="../km_estudios/km_estudios_t.php">Estudios</a></li>
                                        <li><a href="../km_muestras/tabla_muestras.php">Muestras</a></li>
                                        <li><a href="../km_indicaciones/tabla_indicaciones.php">Indicaciones</a></li>
                                        <li><a href="#">Perfiles</a></li>
                                        <li><a href="../so_medicos/tabla_medicos.php">Medicos</a></li>
                                        <li><a href="../so_clientes/tabla_clientes.php">Pacientes</a></li>
                                        <li><a href="../kg_zonas/tabla_zonas.php">Zonas</a></li>
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



                            <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-sticky-note" aria-hidden="true"></i>    Notas<span class="caret"></span></a>
                              <ul class="dropdown-menu" role="menu">
                                  <li><a href="../orden_trabajo/notas.php">Nuevas</a></li>
                                  <li><a href="../orden_trabajo/modificacion_orden.php">Modificaciones</a></li>
                                  <li><a href="{% url 'clientes:listado_clientes' %}">Reimpresiones</a></li>
                                  <li><a href="{% url 'clientes:listado_clientes' %}">Cancelaciones</a></li>
                              </ul>
                            </li>

                             <li>
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Resultados<span class="caret"></span></a>
                              <ul class="dropdown-menu" role="menu">
                                  <li><a href="{% url 'productos:listado_proveedores' %}">Registro</a></li>
                                  <li><a href="#">Listar</a></li>
                              </ul>

                            </li>
                            <li>
                             <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Autorizacion<span class="caret"></span></a>
                             <ul class="dropdown-menu" role="menu">
                                 <li><a href="{% url 'autos:listado_autos' %}">Mis Autorizaciones</a></li>
                                 <li><a href="#">Listar</a></li>
                             </ul>

                           </li>
                            <li>
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Formularios<span class="caret"></span></a>
                              <ul class="dropdown-menu" role="menu">
                                  <li><a href="#">Mas datos</a></li>

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
      <h2 align="center"> Bienvenidos al sistema de control de </h2>
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
</html>
<?php

  }
  else
  {
    header("location: ../index.html");
  }
 ?>
