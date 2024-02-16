<?php
  session_start();
  if (isset($_SESSION['nombre']) && $_SESSION['ingreso']=='YES')
  
  {
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=gb18030">
  <title>Ordenes</title> <!-- CAMBIO  Titulo de la forma -->
  <link rel="icon" type="image/png" href="../imagenes/ico/capital.png" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- DataTable 1.10.19 14/03/2019-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.6/css/mdb.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="../media/alert/dist/sweetalert2.css">
    <link rel="stylesheet" href="../media/estilos.css">

    <!-- estilos de los botones de la barra de RS -->
    <link rel="stylesheet" href="../media/barra/estilos.css">
    <link rel="stylesheet" type="text/css" href="../media/barra/fonts.css">


<!-- Chat en linea  -->
  <script type="text/javascript">
  (function() {
    window.sib = { equeue: [], client_key: "y55oh7id0ydq4gr4n67nkkha" };
    /* OPTIONAL: email to identify request*/
    window.sib.email_id = 'example@domain.com';
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
<style>
  option:hover{
    background-color:red !important;
    -webkit-box-shadow: 17px 10px 31px 5px rgba(0,0,0,0.75);
    -moz-box-shadow: 17px 10px 31px 5px rgba(0,0,0,0.75);
    box-shadow: 17px 10px 31px 5px rgba(0,0,0,0.75);
  }
</style>
<body background="../imagenes/logo_arca_sys_web.jpg">
 
<!-- Redes sociales -->
    <div class="social">
      <ul>
        <li><a href="http:" target="_blank" class="icon-facebook"></a></li>
        <li><a href="http:" target="_blank" class="icon-twitter"></a></li>
        <li><a href="http:" target="_blank" class="icon-google-plus"></a></li>
        <li><a href="http:" target="_blank" class="icon-pinterest2"></a></li>
        <li><a href="http:" target="_blank" class="icon-youtube"></a></li>
        <li><a href="http:" target="_blank" class="icon-skype"></a></li>
        <li><a href="http:" target="_blank" class="icon-linkedin"></a></li>
        <li><a href="https://api.whatsapp.com/send?phone=525625988448&text=Hola!%20En%20que%20podemos%20ayudarle!" target="_blank" class="icon-whatsapp"></a></li>
        <li><a href="http:" target="_blank" class="icon-instagram"></a></li>
        <li><a href="mailto:soporte@laboratoriosarca.mx" class="icon-mail21"></a></li>
      </ul>
    </div>
<!-- Fin redes sociales --> 
 
 
 
  <?php
    include("../includes/barra.php");
    include("formularios/formularios_productos.php"); // CAMBIO programa de la forma
  ?>

  <div class="container" style="margin-top: 30px;">
    <h1 style="text-align: center;">Recepcion de Ordenes <!-- CAMBIO Se cambia el titulo de la tabla -->

    </h1>
  </div>

  <div id="cuadro1" class="col-sm-12 col-md-12 col-lg-12"> <!-- REVISAR -->
    <div class="col-sm-offset-2 col-sm-8">
      <h3 class="text-center">
        <small class="mensaje"></small>
      </h3>
    </div>
    <div class="container table-responsive">
      <table id="dt_productos" class="table table-bordered table-hover" cellspacing="1" width="100%">
        <thead>
          <tr>
            <!-- CAMBIO Se cambian las columnas segun las columnas a mostrar -->
            <th>Origen </th>
            <th>Maquila </th>
            <th>Oreden Num.</th>
            <th>Folio ARCA</th>
            <th>Paciente</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Estudio</th>
<!--            
            
            <th>Maquila</th>
            <th>Enviado</th>
-->
            <th>Aceptar</th>
            <th>Regresar</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
  <script src="../media/js/jquery-1.12.3.js"></script>
  <script src="../media/alert/dist/sweetalert2.js"></script>
  <!-- JQuery -->

  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.6/js/mdb.min.js"></script>
  
  <!-- DataTable 1.10.19 14/03/2019-->
  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
  <script language="javascript" src="js/tabla_productos.js"></script>
</body>
</html>
<?php

  }
  else
  {
  header("location: index.html");
  }
 ?>
