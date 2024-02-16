<?php
date_default_timezone_set('America/Mexico_City');
session_start();
include "../controladores/conex.php";
$fecha = date("Y-m-d");
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Perfiles</title>
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

    <style media="screen">
      .menu-barra .menubar{
        list-style: none;
        text-decoration: none;
        display: inline-block;
      }
      .menu-barra .menubar li{
        display: inline-block;
        margin: 0 30px;
      }
      .menu-barra .menubar li a{
        color: #FFF;
      }
    </style>
  </head>
  <body background="../imagenes/logo_arca_sys_web.jpg">
    <?php  include "../includes/barra.php";?>
    <section class="menus" style="margin-top: 50px;">
      <div class="container">
        <h1 style="text-align: center;">Crear Perfil</h1>
        <div class="row" style="margin-bottom: 30px;">
          <div class="col-md-4"></div>
          <div class="col-md-4" style="margin-right: auto; margin-left: auto;">
            <div class="md-form">
              <select class="browser-default custom-select" name="sl-perfil" id="sl-perfil">
                <option value="">Seleccione Perfil</option>
                <?php 
                  $query = "SELECT id_perfil,desc_perfil FROM se_perfiles WHERE estado = 'A'";
                  $stmt = $conexion->prepare($query);
                  $stmt->execute();
                  $result = $stmt->get_result();
                  
                  while ($row = $result->fetch_assoc()) 
                  {
                ?>
                <option value="<?php echo $row['id_perfil']; ?>"><?php echo $row['desc_perfil']; ?></option>
                <?php
                  }
                  $stmt->close(); 
                ?>
              </select>
            </div>
          </div>
          <div class="col-md-4"></div>
        </div>
        <div class="row">
          <div class="col-md-4" style="margin-left: auto; margin-right: auto;">
            <label for="" style="font-weight: 900; font-size: 1em;">Nivel 1</label>
            <select class="custom-select sl-menu" name="sl-menu" id="sl-menu" multiple style="width: 100%;">
              <?php 
                $query = "SELECT * FROM se_menus WHERE estado = 'A' AND fk_id_nivel_menu = 1 ORDER BY titulo";
                $stmt = $conexion->prepare($query);
                $stmt->execute();
                $result = $stmt->get_result();
        
                while ($row = $result->fetch_assoc()) 
                {
              ?>
                <option value="<?php echo $row['id_menu'] ?>"><?php echo $row['titulo'] ?></option>
              <?php
                }
                $stmt->close();
              ?> 
            </select>
          </div>
          <div class="col-md-4" style="margin-left: auto; margin-right: auto;">
            <label for="" style="font-weight: 900; font-size: 1em;">Nivel 2</label>
            <select class="custom-select sl-menu" name="sl-menu2" id="sl-menu" multiple>
              <?php 
                $query = "SELECT * FROM se_menus WHERE estado = 'A' AND fk_id_nivel_menu = 2 ORDER BY titulo";
                $stmt = $conexion->prepare($query);
                $stmt->execute();
                $result = $stmt->get_result();

                while ($row = $result->fetch_assoc()) 
                {
              ?>
                <option value="<?php echo $row['id_menu'] ?>"><?php echo $row['titulo'] ?></option>
              <?php
                }
              ?> 
            </select>
          </div>
          <div class="col-md-4" style="margin-left: auto; margin-right: auto;">
            <label for="" style="font-weight: 900; font-size: 1em;">Nivel 3</label>
            <select class="custom-select sl-menu" name="sl-menu3" id="sl-menu" multiple>
              <?php 
                $query = "SELECT * FROM se_menus WHERE estado = 'A' AND fk_id_nivel_menu = 3 ORDER BY titulo";
                $stmt = $conexion->prepare($query);
                $stmt->execute();
                $result = $stmt->get_result();

                while ($row = $result->fetch_assoc()) 
                {
              ?>
                <option value="<?php echo $row['id_menu'] ?>"><?php echo $row['titulo'] ?></option>
              <?php
                }
              ?> 
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="col-md-4" style="margin-left: auto; margin-right: auto; margin-top: 20px; text-align: center;">
            <button type="button" class="btn btn-success" id="btn_save">Guardar</button>
          </div>  
          <div class="col-md-4"></div>
        </div>
      </div>
    </section>
    <section id="arbol" class="card z-depth-5" style="border-radius: 25px; margin-top: 50px; margin-bottom: 50px;">
      <div class="container">
        <h2 style="text-align: center; margin-top: 30px; font-weight: 900;">Vista Previa</h2>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="col-md-4">
            <div class="md-form">
              <select class="browser-default custom-select" name="list-perfil" id="list-perfil">
                <option value="">Seleccione Perfil</option>
                <?php 
                  $query = "SELECT id_perfil,desc_perfil FROM se_perfiles WHERE estado = 'A'";
                  $stmt = $conexion->prepare($query);
                  $stmt->execute();
                  $result = $stmt->get_result();
                  
                  while ($row = $result->fetch_assoc()) 
                  {
                ?>
                <option value="<?php echo $row['id_perfil']; ?>"><?php echo $row['desc_perfil']; ?></option>
                <?php
                  }
                  $stmt->close(); 
                ?>
              </select>

            </div>
          </div>
          <div class="col-md-4"></div>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-md-2">
              Menú Lateral: <input type="checkbox" class="checkbox-inline" name="menul" id="menul" value="L">
              Menú Barra: <input type="checkbox" class="checkbox-inline" name="menub" id="menub" value="B">
              <!--<button type="button" class="btn btn-secondary" id="mlateral">Menú lateral</button>-->
            </div>
            <div class="col-md-2">
              <!--<button type="button" class="btn btn-secondary" id="mbarra">Menú Barra</button>-->
            </div>
            <div class="col-md-4"></div>
          </div>
        </div>
        <div class="container menu-lateral">
            <h3 style="font-weight: 900; font-size: 2em; text-align: center;">Menú Lateral</h3>
          <nav class="vista-pr" style="margin-bottom: 30px;">
            <h3 style="font-weight: 900; font-size: 2em; text-align: center;">Seleccione un perfil</h3>
          </nav>
        </div>
        <div class="container menu-barra">
          <nav class="vista-barra" style="margin-bottom: 30px; display: none;">
            <h3 style="font-weight: 900; font-size: 2em; text-align: center;">Menú Barra</h3>
            <ul class="menubar" style="background-color: #33b5e5; color: #FFF; width: 100%;">
            </ul>
          </nav>
        </div>
      </div>
    </section>
    
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
    <script src="js/app.js"></script>
    <script>

      $("#btn_save").click(function()
      {
        slmenu = $('select[name=sl-menu]').val()
        slmenu2 = $('select[name=sl-menu2]').val()
        slmenu3 = $('select[name=sl-menu3]').val()
        slperfil = $("#sl-perfil").val()

        $('select[name=list-perfil').val(slperfil);

          console.log(slperfil.length)
          //console.log(slmenu2)
          //console.log(slmenu3)

          if(slperfil == 0)
          {
            swal("Seleccione un perfil")
            $("#sl-perfil").focus()
          }else
          {
            if(slmenu.length > 1)
            {
              swal("Solo debes seleccionar una opcion de nivel 1")
            }else
            if(slmenu.length == 0)
            {
              swal("Debes seleccionar una opcion de nivel 1")
            }else
            {
                if(slmenu2.length > 1)
                {
                   swal("Solo debes seleccionar una opcion de nivel 2")
                }else
                if(slmenu2.length == 0)
                {
                  swal("Debes seleccionar una opcion de nivel 2")
                }else
                {
                  $.ajax({
                    type: "POST",
                    url: "controladores/opciones.php?val=2",
                    data:{menu1: slmenu, menu2: slmenu2, menu3: slmenu3, perfil: slperfil},
                    beforeSend: function(){
                    },
                    success: function(data)
                      {
                        if(data == "ok")
                        {
                          swal("Opciones guardadas correctamente")
                          Arbol(slperfil)
                        }else
                        {
                          swal("Ocurrio un error");
                        }
                      }
                  });
                }
            }
          }
                
      })


      $("select[name=list-perfil]").change(function()
      {
          select = $('select[name=list-perfil]').val();
          $.ajax({
            type: "POST",
            url: "controladores/vista.php?val=1",
            data:{perfil : select},
            beforeSend: function(){
            },
            success: function(data)
            {
              $(".vista-pr").html("");
              $(".vista-pr").html(data)
              console.log(data)
            }
          });
          $("input[name=menul][value='L']").prop("checked",true);
      });

      function Arbol(slperfil)
      {        
        $.ajax({
            type: "POST",
            url: "controladores/vista.php?val=1",
            data:{perfil : slperfil},
            beforeSend: function(){
            },
            success: function(data)
            {
              $(".vista-pr").html("");
              $(".vista-pr").html(data)
              console.log(data)
            }
          });    
      }


      function DeleteMenu(id,perfil)
      {
        $.ajax({
            type: "POST",
            url: "controladores/eliminar.php?val=1",
            data:{id : id},
            beforeSend: function(){
            },
            success: function(data)
            {
              if(data == true)
              {
                swal("Se elimino correctamente el menu nivel 3")
                Arbol(perfil)
              }else
              {
                swal("Ocurrio un error: " + data)
              }
            }
          });   
      }


      function DeleteSubMenu(id,perfil)
      {
        $.ajax({
            type: "POST",
            url: "controladores/eliminar.php?val=2",
            data:{id : id},
            beforeSend: function(){
            },
            success: function(data)
            {
              if(data == true)
              {
                swal("Se elimino correctamente el menu nivel 3")
                Arbol(perfil)
              }else
              {
                swal("Ocurrio un error: " + data)
              }
            }
          });   
      }


      function DeleteSubSubMenu(id,perfil)
      {
        $.ajax({
            type: "POST",
            url: "controladores/eliminar.php?val=3",
            data:{id : id},
            beforeSend: function(){
            },
            success: function(data)
            {
              if(data == true)
              {
                swal("Se elimino correctamente el menu nivel 3")
                Arbol(perfil)
              }else
              {
                swal("Ocurrio un error: " + data)
              }
            }
          });   
      }

      function DeleteBarra(id,perfil)
      {
        $.ajax({
            type: "POST",
            url: "controladores/eliminar.php?val=4",
            data:{id : id},
            beforeSend: function(){
            },
            success: function(data)
            {
              if(data == true)
              {
                swal("Se elimino correctamente la opción de la barra")
                ArbolBarra()
              }else
              {
                swal("Ocurrio un error: " + data)
                console.log(data)
              }
            }
          }); 
      }


      function Abrir(enlace)
      {
        window.open('+enlace+"', "_blank")
      }

      $('#menul').click(function() {
          if( $(this).is(':checked') ){
              // Hacer algo si el checkbox ha sido seleccionado
              $(".vista-pr").css("display","block")
              $(".vista-barra").css("display","none")
              $("input[name=menub][value='B']").prop("checked",false);
          }
      });

      $('#menub').click(function() {

          select = $('select[name=list-perfil]').val();
          if(select > 0)
          {
              if( $(this).is(':checked') ){
                // Hacer algo si el checkbox ha sido seleccionado
                $(".vista-pr").css("display","none")
                $(".vista-barra").css("display","block")
                $("input[name=menul][value='L']").prop("checked",false);


                ArbolBarra();

            }
          }else
          {

            $("input[name=menub][value='B']").prop("checked",false);
            $("input[name=menul][value='L']").prop("checked",true);
            swal("Seleccione un perfil")
          }
          
      });


      function AddBarra(id,perfil)
      {

        parametros = 
        {
          "id" : id,
          "perfil" : perfil
        }

        
        select = $('select[name=list-perfil]').val();
        $.ajax({
            type: "POST",
            url: "controladores/barra.php",
            data:parametros,
            beforeSend: function(){
            },
            success: function(data)
            {
              swal(data)
              Arbol(select)
            }
          });   
      }

      function ArbolBarra()
      {
        select = $('select[name=list-perfil]').val();

        $.ajax({
            type: "POST",
            url: "controladores/vista.php?val=2",
            data:{perfil : select},
            beforeSend: function(){
            },
            success: function(data)
            {
              $(".menubar").html(data)
              console.log(data)
            }
          });  
      }


    </script>
  </body>
</html>