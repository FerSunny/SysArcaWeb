<?php 
  include("../controladores/conex.php");
  date_default_timezone_set('America/Mexico_City');
  $FechaHoy=date("d/m/Y : H : i : s");
  header("Content-Type: text/html;charset=utf-8");
?>
<head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
	
</head>


<div class="modal fade" id="myModals" role="dialog">
  <div > <!--class="modal-dialog"> Tamaño de la pantalla--> 

      <!-- Modal content-->
   <form name="AltasPlantilla_usg" action="controladores/registro_plantilla_usg_rx.php" method="post" >
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 style="color:blue;text-align:center" class="modal-title">Nuevo Plantilla</h4>
        <!--
          <h5 style="color:blue;text-align:center" class="modal-title">Registro de valores</h5>
        -->
        </div>
        <!--<div style="color:#000000;background:#EFFBF5" class="modal-body"> -->
        <div style="color:##fff;background:#e3f2fd" class="modal-body">
          <table border="0" align="center" BGCOLOR=#F5FBEF style="border-bottom:1px solid #819FF7"  >
              
<!-- Id plantilla -->
              <tr>

                <td class="renglon_titulo"> Id Plantilla: </td>
                <td class="renglon_valor" class="form-control" >
                    <input type="text" name="fn_id_plantilla" id="fi_id_plantilla" readonly="readonly" maxlength="5" size="5" placeholder="Id plantilla"/>
                </td>
                
              </tr>

<!-- Nombre de la plantilla -->
              <tr>
                  <td class="renglon_titulo">Nombre:</td>
                  <td class="renglon_valor" class="form-control">
                      <input type="text" required name="fn_nombre" id="fi_nombre" maxlength="50" size="50" placeholder="Nombre de la plantilla"/>
                  </td>
              </tr>

<!-- Medico -->  
              <tr>
                <td class="renglon_titulo">Medico: </td>
                <td class="renglon_valor" class="form-control">
                  <select name="fn_medico" id="fi_medico" style="width:350px">
                    <?php
                      $sql="SELECT us.id_usuario,CONCAT(us.nombre,' ',us.a_paterno,' ',a_materno) AS nombre_usu FROM se_usuarios us
                      WHERE us.activo = 'A'
                      AND fk_id_perfil = 6
                      ORDER BY nombre,a_paterno,a_materno";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$row['id_usuario']."' >";
                          echo $row['nombre_usu'];
                          echo "</option>";
                        }
                    ?>
                  </select>
                </td>
              </tr>
<!-- estudio -->  
              <tr>
                <td class="renglon_titulo">Estudio: </td>
                <td class="renglon_valor" class="form-control">
                  <select name="fn_estudio" id="fi_estudio" style="width:350px">
                    <?php
                      $sql="SELECT * FROM km_estudios where estatus = 'A' order by desc_estudio";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$row['id_estudio']."' >";
                          echo $row['desc_estudio'];
                          echo "</option>";
                        }
                    ?>
                  </select>
                </td>
              </tr>
<!-- titulo descripcion -->
              <tr>
                  <td class="renglon_titulo">Titulo:</td>
                  <td class="renglon_valor" class="form-control">
                      <input type="text" required name="fn_titulo_desc" id="fi_titulo_desc" maxlength="50" size="50" placeholder="Titulo de la descripcion"/>
                  </td>
              </tr>
<!-- descripcion-->
              <tr>
                  <td class="renglon_titulo">Descripcion: </td>   
                  <td class="renglon_valor" class="form-control">
                      <textarea name="fn_descripcion" id="fi_descripcion" rows="14" cols="125" wrap="soft" placeholder="Descripcion del estudio">
                      </textarea>
                  </td> 
              </tr>


<!-- firma-->
              <tr>
                  <td class="renglon_titulo">Firma: </td>   
                  <td class="renglon_valor" class="form-control">
                      <textarea name="fn_firma" id="fi_firma" rows="3" cols="50" wrap="hard" >
                      </textarea>
                  </td> 
              </tr>

<!-- estado -->
              <tr>
                <td>Estado</td>
                <td>
                    <select class="" id="fi_estado" name="fn_estado">
                       <option value="A">Activo</option>
                       <option value="S">Suspendido</option>
                    </select>
                </td>
              </tr>     
                
          </table>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" id="btniniciar"  >Ingresar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>

</form>



<!--Editar usuario-->
<!-- SCRIPT PARA ACTUALIZAR -->
<form id="frmedit" class="form-horizontal" action="controladores/actualizar.php" method="POST">
  <div class="row">
    <!-- REVISAR -->
    <div id="cuadro1" class="col-sm-12 col-md-12 col-lg-12 ocultar">
      <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
        <div  role="document"> <!-- class="modal-dialog" determina el tamaño del fondo-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 style="color:blue;text-align:center" class="modal-title" id="modalEliminarLabel">Editar Conceptos</h4>
              <!--
              <h5 style="color:blue;text-align:center" class="modal-title">Cambio de valores</h5>
              -->
            </div>

            <!-- INICIA EL BODY -->
            <div style="color:#000000;background:#EFFBF5" class="modal-body">
             <input type="hidden" id="idvalor" name="idvalor" value="0">
             <input type="hidden" id="opcion" name="opcion" value="modificar">
             <table border="0" align="center" BGCOLOR=#F5FBEF style="border-bottom:1px solid #819FF7">
                  
<!-- Id plantilla -->
              <tr>

                <td class="renglon_titulo"> Id Plantilla: </td>
                <td class="renglon_valor" class="form-control" >
                    <input type="text" name="fn_id_plantilla" id="fi_id_plantilla" readonly="readonly" maxlength="5" size="5" placeholder="Id plantilla"/>
                </td>
                
              </tr>

<!-- Nombre de la plantilla -->
              <tr>
                  <td class="renglon_titulo">Nombre:</td>
                  <td class="renglon_valor" class="form-control">
                      <input type="text" required name="fn_nombre" id="fi_nombre" maxlength="50" size="50" placeholder="Nombre de la plantilla"/>
                  </td>
              </tr>

<!-- Medicos  -->
              <tr>
                <td class="renglon_titulo">Medico: </td>
                <td class="renglon_valor" class="form-control">
                  <select name="fn_medico" id="fi_medico" style="width:350px">
                    <?php
                      $sql="SELECT us.id_usuario,CONCAT(us.nombre,' ',us.a_paterno,' ',a_materno) AS nombre_usu FROM se_usuarios us
                      WHERE us.activo = 'A'
                      AND fk_id_perfil = 6
                      ORDER BY nombre,a_paterno,a_materno";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$row['id_usuario']."' >";
                          echo $row['nombre_usu'];
                          echo "</option>";
                        }
                    ?>
                  </select>
                </td>
              </tr>
 
<!-- estudio -->  
              <tr>
                <td class="renglon_titulo">Estudio: </td>
                <td class="renglon_valor" class="form-control">
                  <select name="fn_estudio" id="fi_estudio" style="width:350px">
                    <?php
                      $sql="SELECT * FROM km_estudios where estatus = 'A' order by desc_estudio";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$row['id_estudio']."' >";
                          echo $row['desc_estudio'];
                          echo "</option>";
                        }
                    ?>
                  </select>
                </td>
              </tr>
<!-- titulo descripcion -->
              <tr>
                  <td class="renglon_titulo">Titulo:</td>
                  <td class="renglon_valor" class="form-control">
                      <input type="text" required name="fn_titulo_desc" id="fi_titulo_desc" maxlength="50" size="50" placeholder="Titulo de la descripcion"/>
                  </td>
              </tr>
<!-- descripcion-->
              <tr>
                  <td class="renglon_titulo">Descripcion: </td>   
                  <td class="renglon_valor" class="form-control">
                      <textarea name="fn_descripcion" id="fi_descripcion" rows="14" cols="125" wrap="soft" dirname="idea-dir">
                      </textarea>
                  </td> 
              </tr>
<!-- firma-->
              <tr>
                  <td class="renglon_titulo">Firma: </td>   
                  <td class="renglon_valor" class="form-control">
                      <textarea name="fn_firma" id="fi_firma" rows="3" cols="70" wrap="hard" ">
                      </textarea>
                  </td> 
              </tr>

<!-- estado -->
              <tr>
                <td>Estado</td>
                <td>
                    <select class="" id="fi_estado" name="fn_estado">
                       <option value="A">Activo</option>
                       <option value="S">Suspendido</option>
                    </select>
                </td>
              </tr>             
                
             </table>  
            </div><!--Cierre modal body-->
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" id="btniniciar"  >Ingresar</button>
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
     </div>
   </div>
  </div>
</form>


 <!-- Modal Eliminar-->
<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modalEliminarLabel">Eliminar plantilla</h4>
      </div>
      <div class="modal-body">
        <form id="frmEliminarvalor" action="controladores/eliminar_plantilla_usg_rx.php" method="POST">
          Esta seguro de eliminar la plantilla? <strong data-name=""></strong>
           <input type="hidden" id="idvalor" name="idvalor" value="">
            <input type="hidden" id="opcion" name="opcion" value="eliminar">
                ID
              <input id="valor" name="valor" type="text" class="form-control" maxlength="1" size="3" autofocus disabled>
                Nombre
              <input id="nombre" name="nombre" type="text" class="form-control" maxlength="1" size="3" autofocus disabled>
      </div>
        <div class="modal-footer">
        <button type="submit" class="btn btn-success" id="btniniciar"  >Aceptar</button>
        <button type="submit" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
      </form>
    </div>
  </div>
</div>
