<?php
  session_start(); 
  require_once 'database.php';
  require_once 'menu_db.php';
  $menu = new Menu();
  
  $para=($_SESSION['nombre']);

   foreach ($menu->Carousel() as $ca):
    $minimo= $ca['minimo'];
    $cantidad= $ca['cantidad'];
   endforeach;
  //$stmt->bind_param("is", $area,$estado);
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
    .carousel .carousel-indicators li
    {
      width: 2.65em !important;
    }
    .menu-oc{
      display: none;
    }
    .menu-ver{
      cursor: pointer;
    }
    .menu-ver:hover > .menu-oc{
      display: inline-block;
    }
  </style>

  </style>

    <!-- estilos de los botones  -->
    <link rel="stylesheet" href="../media/barra/estilos.css">
    <link rel="stylesheet" type="text/css" href="../media/barra/fonts.css">

<!-- Chat en linea  -->
  <script type="text/javascript">
  (function() {
    window.sib = { equeue: [], client_key: "y55oh7id0ydq4gr4n67nkkha" };
    /* OPTIONAL: email to identify request*/
    // window.sib.email_id = 'example@domain.com';
    /* OPTIONAL: to hide the chat on your script uncomment this line (0 = chat hidden; 1 = display chat) */
    // window.sib.display_chat = 0;
    // window.sib.display_logo = 0;
    /* OPTIONAL: to overwrite the default welcome message uncomment this line*/
    // window.sib.custom_welcome_message = 'Hello, how can we help you?';
    /* OPTIONAL: to overwrite the default offline message uncomment this line*/
    // window.sib.custom_offline_message = 'We are currently offline. In order to answer you, please indicate your email in your messages.';
    window.sendinblue = {}; for (var j = ['track', 'identify', 'trackLink', 'page'], i = 0; i < j.length; i++) { (function(k) { window.sendinblue[k] = function(){ var arg = Array.prototype.slice.call(arguments); (window.sib[k] || function() { var t = {}; t[k] = arg; window.sib.equeue.push(t);})(arg[0], arg[1], arg[2]);};})(j[i]);}var n = document.createElement("script"),i = document.getElementsByTagName("script")[0]; n.type = "text/javascript", n.id = "sendinblue-js", n.async = !0, n.src = "https://sibautomation.com/sa.js?key=" + window.sib.client_key, i.parentNode.insertBefore(n, i), window.sendinblue.page();
  })();
</script>

</head>
<body background="../imagenes/logo_arca_sys_web.jpg">

<!-- Redes sociales -->
    <div class="social">
      <ul>
        <li><a href="https://es-la.facebook.com/laboratorioarca/" target="_blank" class="icon-facebook" target="_blank" class="icon-facebook"></a></li>
        <li><a href="https://twitter.com/Aten_Lab_Arca" target="_blank" class="icon-twitter" target="_blank" class="icon-twitter"></a></li>
        <li><a href="http:" target="_blank" class="icon-google-plus"></a></li>
        <li><a href="http:" target="_blank" class="icon-pinterest2"></a></li>
        <li><a href="http:" target="_blank" class="icon-youtube"></a></li>
        <li><a href="http:" target="_blank" class="icon-skype"></a></li>
        <li><a href="http:" target="_blank" class="icon-linkedin"></a></li>
        <li><a href="https://api.whatsapp.com/send?phone=525625988448&text=Hola!%20En%20que%20podemos%20ayudarle!" target="_blank" class="icon-whatsapp"></a></li>
        <li><a href="https://www.instagram.com/laboratoriosarca/" target="_blank" class="icon-instagram" target="_blank" class="icon-instagram"></a></li>
        <li><a href="mailto:soporte@laboratoriosarca.mx" class="icon-mail21"></a></li>
      </ul>
    </div>
<!-- Fin redes sociales -->

  <nav class="navbar navbar-expand-lg navbar-dark blue lighten-4">
    <a class="navbar-brand" href="#" style="font-weight: 900; color: black;">Inicio</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
      aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation" style="margin-right: auto;">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="basicExampleNav">
      <ul class="navbar-nav mr-auto">
        <?php 
            $num_rows_sub = count($menu->countBarra());

            if($num_rows_sub > 0)
            {
              foreach ($menu->getBarra() as $b):
        ?>
        <li class="nav-item dropdown">
          <a class="nav-link" id="navbarDropdownMenuLink" href="<?php echo $b['enlace']; ?>">
            <?php echo $b['titulo']; ?>
          </a>
        </li>
        <?php
               endforeach;
            }else
            {
        ?>
        <li class="nav-item dropdown">
          <a class="nav-link animated infinite flash" id="navbarDropdownMenuLink" style="color: red; font-weight: 900;">No tienes accesos directos</a>
        </li>
        <?php 
            }
         ?>
        <li class="nav-item dropdown">
          <a class="nav-link" href="../includes/logout.php" style="color: black; font-weight: 900">Salir</a>
        </li>
      </ul>
    </div>
  </nav>

  <!--/.Navbar-->
  <nav id="nav-menu-container">
    <ul class="nav-menu">
      <?php 
        foreach ($menu->getMenu() as $m):
            $num_rows_sub = count($menu->countSub($m['id']));
            if($num_rows_sub > 0)
            {
      ?>
      <li class="menu-has-children"><a href=""><?php echo $m['titulo'] ?></a>
        <ul style="display:none">
        <?php 
          foreach ($menu->getSubMenu($m['id']) as $s):
            $num_rows_subsub = count($menu->countSubSub($s['idsubmenu']));
            if( $num_rows_subsub > 0)
            {
        ?>
        <li class="menu-has-children"><a href="<?php echo $s['enlace'] ?>"><?php echo $s['titulo']; ?></a>
          <ul style="display:none">
            <?php foreach ($menu->getSubSubMenu($s['idsubmenu']) as $ss): ?>
              <li class=""><a href="<?php echo $ss['enlace'] ?>"><?php echo $ss['titulo']; ?></a></li>
            <?php endforeach; ?>
          </ul>
        </li>
        <?php }else{ ?>
        <li class=""><a href="<?php echo $s['enlace'] ?>"><?php echo $s['titulo']; ?></a></li>
        <?php }endforeach; ?>
        </ul>
      </li>
      <?php }else{ ?>
      <li><a href="" style="color: #FFF;"><?php echo $m['titulo'] ?></a></li>
      <?php }endforeach; ?>
    </ul>
  </nav>
  
  <div class="container center" id="centro" style="margin-top: 20px;">
      <h2 align="center" style="font-family: 'Oswald', sans-serif; font-weight: 900"> Bienvenido(a) <?php echo $_SESSION['nombre_completo']?> al sistema de control de </h2>
      <h1 align="center" style="font-family: 'Oswald', sans-serif; font-weight: 400">Laboratorios Arca</h1>
      <h0 align="center" style="font-family: 'Oswald', sans-serif; font-weight: 400">Version 3.0.1</h0>
   </div>
  <p style="display: inline-block;"></p>
  <div>
  </div>
  
  <div class="container">
    <!--Carousel Wrapper-->
    <div id="carousel-example-2" class="carousel slide carousel-fade" data-ride="carousel">
      <!--Indicators-->
      <ol class="carousel-indicators">
        <!--<li data-target="#carousel-example-2" data-slide-to="0" class="active"></li>-->
        <?php
          $slide_to = 0;
          foreach ($menu->SlideTo() as $to):
            if($to == $minimo)
            {
        ?>
         <li data-target="#carousel-example-2" data-slide-to="<?php echo $slide_to; ?>" class="active" style="background-color: black; size: 2em;"></li>'
        <?php }else{ ?>
          <li data-target="#carousel-example-2" data-slide-to="<?php echo $slide_to; ?>" style="background-color: black; size: 2em;"></li>
        <?php } $slide_to++; endforeach; ?>
      </ol>
      <!--/.Indicators-->
      <!--Slides-->
      <!-- Cambios realizados por JPM para quitar el titulo en las imagenes del carrusel (Version 3.0.1) -->

        <div class="carousel-inner" role="listbox">
          <?php 
            foreach ($menu->SlideTo() as $img):
              if($img['id_carrucel'] == $minimo)
              {
                if($img['tipo'] == 3)
                {
          ?>
          <div class="carousel-item active">
            <div class="view">
              <img class="d-block w-100" src="../so_carrusel/<?php echo $img['ruta_img']; ?>"
                alt="">
            </div>
            <div class="carousel-caption">
              <h3 class="h3-responsive" style=" color:black; font-weight: 900;"> </h3>
              <p style="color:black; font-weight: 900;"></p>
            </div>
          </div>
          <?php
                }else
                {
          ?>
          <div class="carousel-item active">
            <div class="view">
              <img class="d-block w-50" src="../so_carrusel/<?php echo $img['ruta_img']; ?>"
                alt="" height="900px" width="237px">
            </div>
            <div class="carousel-caption">
              <h3 class="h3-responsive" style=" color:black; font-weight: 900;"></h3>
              <p style="color:black; font-weight: 900;"></p>
            </div>
          </div>
          <?php
                }
              }else
              {
                if($img['tipo'] == 3)
                {
          ?>
          <div class="carousel-item">
            <!--Mask color-->
            <div class="view">
              <img class="d-block w-100" src="../so_carrusel/<?php echo $img['ruta_img']; ?>"
                alt="">
            </div>
            <div class="carousel-caption">
              <h3 class="h3-responsive" style="color:black; font-weight: 900;"></h3>
              <p style="color:black; font-weight: 900;"></p>
            </div>
          </div>
          <?php
                }else
                {
          ?>
          <div class="carousel-item">
            <!--Mask color-->
            <div class="view">
              <img class="d-block w-50" src="../so_carrusel/<?php echo $img['ruta_img']; ?>"
                alt="" height="900px" width="237px">
            </div>
            <div class="carousel-caption">
              <h3 class="h3-responsive" style="color:black; font-weight: 900;"></h3>
              <p style="color:black; font-weight: 900;"></p>
            </div>
          </div>
          <?php

                }
              }
            endforeach;
          ?>
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
