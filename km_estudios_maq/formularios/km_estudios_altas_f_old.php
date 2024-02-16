
<?php
  include("../../controladores/conex.php");
?>
<html>
  <head>
    <meta content="text/html; charset=UTF-8" http-equiv="content-type">
    <meta name="Author" content="Javier Pradel"/>
    <meta name="Catalogo de estudios" content="Formulario de captura"/>
    <title> Catalogo de Estudios </title>
    <link rel="stylesheet" type="text/css" href="css/css_arca.css"/>


    <meta charset="UTF-8">
    <title>Estudios</title>
    <!--CSS-->
    <link rel="stylesheet" href="media/css/bootstrap.css">
    <link rel="stylesheet" href="media/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="media/font-awesome/css/font-awesome.css">
    <!--Javascript-->
    <script src="media/js/jquery-1.10.2.js"></script>
    <script src="media/js/jquery.dataTables.min.js"></script>
    <script src="media/js/dataTables.bootstrap.min.js"></script>
    <script src="media/js/bootstrap.js"></script>
    <script src="media/js/lenguajeusuario.js"></script>

    <script>
        $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
        });
    </script>



  </head>

  <body background="imagenes/logo_arca_sys_web.jpg">
<!--Barra superior-->
  <div class="container">
    <div class="bs-docs-section clearfix">
      <div class="row">
          <div class="col-lg-12">
              <div class="bs-component">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <div class="navbar-header">
                          <a class="navbar-brand" href="menu.php">Inicio</a>
                        </div>
                      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <div class="navbar-right">
                                 <a class="navbar-brand" href="km_estudios_t.php">
                                     <span class="glyphicon glyphicon-log-out"></span>Regresar
                                 </a>
                        </div>
                      </div>
                  </div>
              </nav>
          </div>
          </div>
      </div>
  </div>
<!--Fin de Barra superior-->

      <div id="header">
      <div id="cuerpo">
          <div id="formulario">
                <form name="AltasEstudio" action="km_estudios_altas_i.php" method="post">
                    <table border="0" align="center" BGCOLOR=#F5FBEF style="border-bottom:1px solid #819FF7">
                        <tr>
                            <td class="cabeza_y_pie" colspan="2"> CATALOGO DE ESTUDIOS</td>
                        </tr>

                        <tr>
                            <td class="renglon_titulo"> Id Estudio:</td>
                            <td class="renglon_valor">
                                <input type="text" name="id_estudio" readonly="readonly" maxlength="12" size="19" placeholder="Asignado por el sistema"/>
                            </td>
                        </tr>

                        <tr>
                            <td class="renglon_titulo">Iniciales: </td>
                            <td class="renglon_valor">
                                <input type="text" required name="iniciales" maxlength="50" size="10" placeholder="Iniciales Estudio"/>
                            </td>
                        </tr>

                        <tr>
                            <td class="renglon_titulo">Descripcion:</td>
                            <td class="renglon_valor">
                                <input type="text" required name="desc_estudio" maxlength="150" size="80" placeholder="Descripcion"/>
                             </td>
                        </tr>

                        <tr>
                            <td class="renglon_titulo">Tipo de estudiooo: </td>
                            <td class="renglon_valor">
                                <select name="id_tipo_estudio" >
                                   <?php
                                      $sql="SELECT * FROM km_tipo_estudio";
                                      $rec=mysqli_query($conexion,$sql);
                                      while ($row=mysqli_fetch_array($rec))
                                      {
                                        echo "<option value='".$row['id_tipo_estudio']."' >";
                                        echo $row['nombre_tipo_estudio'];
                                        echo "</option>";
                                      }
                                   ?>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td class="renglon_titulo">Urgente: </td>
                            <td  class="renglon_valor">
                                <input type="radio" name="urgente" value="Si"/>Si
                                <input type="radio" name="urgente" value="No"/>No
                            </td>
                        </tr>

                        <tr>
                            <td class="renglon_titulo">Tiempo de Entrega (hrs): </td>
                            <td  class="renglon_valor">
                                <input type="time" required name="tiempo_entrega" maxlength="12" size="19" placeholder="Tiempo de Entrega"/>
                            </td>
                        </tr>

                        <tr>
                            <td class="renglon_titulo">Comicion: </td>
                            <td class="renglon_valor">
                                <select name="id_comision" >
                                   <?php
                                      $sql="SELECT * FROM kg_comisiones";
                                      $rec=mysqli_query($conexion,$sql);
                                      while ($row=mysqli_fetch_array($rec))
                                      {
                                        echo "<option value='".$row['id_comision']."' >";
                                        echo $row['desc_comision'];
                                        echo "</option>";
                                      }
                                   ?>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td class="renglon_titulo">Observaciones: </td>
                            <td  class="renglon_valor">
                                <input type="text" name="observaciones" maxlength="250" size="80" placeholder="Observaciones"/>
                            </td>
                        </tr>

                        <tr>
                            <td class="renglon_titulo">Pertenece a Perfil:</td>
                            <td  class="renglon_valor">
                                <input type="radio" name="per_perfil" value="Si"/>Si
                                <input type="radio" name="per_perfil" value="No"/>No
                            </td>
                        </tr>

                        <tr>
                            <td class="renglon_titulo">Precio:</td>
                            <td class="renglon_valor">
                                <input type="text" required name="costo" maxlength="10" size="10" placeholder="Costo"/>
                             </td>
                        </tr>

                        <tr>
                            <td class="renglon_titulo">Descuentos: </td>
                            <td class="renglon_valor">
                                <select name="id_descuento" >
                                   <?php
                                      $sql="SELECT * FROM kg_descuentos";
                                      $rec=mysqli_query($conexion,$sql);
                                      while ($row=mysqli_fetch_array($rec))
                                      {
                                        echo "<option value='".$row['id_descuento']."' >";
                                        echo $row['desc_descuento'];
                                        echo "</option>";
                                      }
                                   ?>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td class="renglon_titulo">Promociones: </td>
                            <td class="renglon_valor">
                                <select name="id_promocion" >
                                   <?php
                                      $sql="SELECT * FROM kg_promociones";
                                      $rec=mysqli_query($conexion,$sql);
                                      while ($row=mysqli_fetch_array($rec))
                                      {
                                        echo "<option value='".$row['id_promocion']."' >";
                                        echo $row['desc_promocion'];
                                        echo "</option>";
                                      }
                                   ?>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td class="renglon_titulo">Indicaciones: </td>
                            <td class="renglon_valor">
                                <select name="id_indicaciones" >
                                   <?php
                                      $sql="SELECT * FROM km_indicaciones";
                                      $rec=mysqli_query($conexion,$sql);
                                      while ($row=mysqli_fetch_array($rec))
                                      {
                                        echo "<option value='".$row['id_indicaciones']."' >";
                                        echo $row['desc_indicaciones'];
                                        echo "</option>";
                                      }
                                   ?>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td class="cabeza_y_pie" colspan="2">
                                <input type='submit' name="btnAceptar" value="Aceptar">
                            </td>
                        </tr>

                    </table>
                </form>>
          </div>
      </div>
      </div>
        <div id="piedepagina">
            <p class="pie_de_pagina">
               2017 &#169; Javier Pradel | Terminos de uso | Privacidad
            </p>
        </div>
  </body>

</html>
