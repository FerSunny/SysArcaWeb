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
            aria-haspopup="true" aria-expanded="false">Toma de muestras</a>
          <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="../tm_paciente_muestra/tabla_muestra">Recepción de pacientes</a>
            <a class="dropdown-item" target='_blank' href='../tm_maquila_lista/repo_maquila_unidad.php?usuario=<?php echo $para?>'>Reporte de maquila unidad</a>
            <a class="dropdown-item" href="../tm_registgro_insumos/tabla_pacientes">Registro de insumos</a>
            <a class="dropdown-item" href="../tm_registro_insumos/reports/reporte_de_insumos">Reporte de insumos</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="" data-toggle=""
            aria-haspopup="true" aria-expanded="false" href="../tm_tablero_pacientes/tabla_muestra">Tablero de pacientess-en espera</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="" data-toggle=""
            aria-haspopup="true" aria-expanded="false" href="">Tablero de seguimiento de muestras</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="../includes/logout" style="color: black; font-weight: 900">Salir</a>
        </li>
      </ul>
      <!-- Links -->
    </div>
    <!-- Collapsible content -->
  </nav>

  <!--/.Navbar-->
  <nav id="nav-menu-container">
    <ul class="nav-menu">
        <li class="menu-has-children"><a href=""> Toma de muestras </a>
            <ul style="display:none">
                <li><a href="../tm_paciente_muestra/tabla_muestra">Recepción de pacientes</a></li>
                <li><a target='_blank' href='../tm_maquila_lista/repo_maquila_unidad.php?usuario=<?php echo $para?>'>Reporte de maquila unidad</a></li>
                <li><a href="../tm_registgro_insumos/tabla_pacientes">Registro de insumos</a></li>
                <li><a href="../tm_registro_insumos/reports/reporte_de_insumos">Reporte de insumos</a></li>
                <li><a href="../tm_tablero_pacientes/tabla_muestra">Tablero de pacientess-en espera</a></li>
                <li><a href="">Tablero de seguimiento de muestras</a></li>
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
