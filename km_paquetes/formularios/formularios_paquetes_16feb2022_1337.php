<?php 
  include("../controladores/conex.php");
  date_default_timezone_set('America/Mexico_City');
  $FechaHoy=date("d/m/Y : H : i : s");
?>
<head>
	<meta charset="UTF-8">
</head>


<div class="modal fade" id="myModals" role="dialog">
  <div class="modal-dialog">

      <!-- Modal content-->
   <form name="AltasUsuario" action="controladores/registro_paquetes.php" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h2 style="color:blue;text-align:center" class="modal-title">Nuevo Paquete</h2>
          <h5 style="color:blue;text-align:center" class="modal-title">Datos Generales</h5>
        </div>
        <!--<div style="color:#000000;background:#EFFBF5" class="modal-body"> -->
        <div style="color:##fff;background:#e3f2fd" class="modal-body">
          <table border="0" align="center" BGCOLOR=#F5FBEF style="border-bottom:1px solid #819FF7">
              <!-- Id paquete -->
              <tr>
                <td class="renglon_titulo"> Id Paquete: </td>
                <td class="renglon_valor" class="form-control" >
                    <input type="text" name="fn_id_paquete" id="fi_id_paquete" readonly="readonly" maxlength="11" size="11" placeholder="Asignado por el sistema"/>
                </td>
              </tr>

              <!-- Paquete -->  
              <tr>
                <td class="renglon_titulo">Paquete: </td>
                <td class="renglon_valor" class="form-control">
                  <select name="fn_paquete" id="fi_paquete" style="width:350px" >
                    <?php
                      $sql="SELECT * FROM km_estudios where estatus = 'A' and per_paquete = 'Si' order by desc_estudio";
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


              <!-- estudio -->  
              <tr>
                <td class="renglon_titulo">Estudio: </td>
                <td class="renglon_valor" class="form-control">
                  <select name="fn_estudio" id="fi_estudio" style="width:350px">
                    <?php
                      $sql="SELECT * FROM km_estudios where estatus = 'A' and per_paquete = 'No'";
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


              <!-- Estado del registro -->
              <tr>
                <td>Estado</td>
                <td>
                    <select class="" id="fi_estado" name="fn_estado">
                       <option value="A">Activo</option>
                       <option value="S">Suspendido</option>
                    </select>
                </td>
              </tr>


              <!-- Fecha de alta -->
              <tr>
                  <td class="renglon_titulo">Fecha Alta: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="date" required name="fn_falta" id="fi_falta" maxlength="15" size="15" placeholder="Fecha  Alta"/>
                  </td> 
              </tr>

              <!-- Fecha de actualización -->
              <tr>
                  <td class="renglon_titulo">Fecha Actuaizacion: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="text" readonly="readonly" disabled  value="<?php echo $FechaHoy;?>" name="fn_factualiza" id="fi_factualiza" maxlength="15" size="20" placeholder="Fecha  Alta"/>
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
</div>
</form>



<!--Editar usuario-->
<!-- SCRIPT PARA ACTUALIZAR -->
<form id="frmedit" class="form-horizontal" action="controladores/actualizar.php" method="POST">
  <div class="row">
    <!-- REVISAR -->
    <div id="cuadro1" class="col-sm-12 col-md-12 col-lg-12 ocultar">
      <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h2 style="color:blue;text-align:center" class="modal-title" id="modalEliminarLabel">Editar Paquete</h2>
              <h5 style="color:blue;text-align:center" class="modal-title">Datos Generales</h5>
            </div>
            <!-- INICIA EL BODY -->
            <div style="color:#000000;background:#EFFBF5" class="modal-body">
             <input type="hidden" id="idpaquete" name="idpaquete" value="0">
             <input type="hidden" id="opcion" name="opcion" value="modificar">
             <table border="0" align="center" BGCOLOR=#F5FBEF style="border-bottom:1px solid #819FF7">
                  <!-- Id perfil -->
                  <tr>
                    <td class="renglon_titulo"> Id Paquete: </td>
                    <td class="renglon_valor" class="form-control" >
                        <input type="text" name="fn_id_paquete" id="fi_id_paquete" readonly="readonly" maxlength="11" size="11" placeholder="Asignado por el sistema"/>
                    </td>
                  </tr>

              <!-- Paquete -->  
                  <tr>
                    <td class="renglon_titulo">Paquete: </td>
                    <td class="renglon_valor" class="form-control">
                      <select name="fn_paquete" id="fi_paquete" style="width:350px" >
                        <?php
                          $sql="SELECT * FROM km_estudios where estatus = 'A' and per_paquete = 'Si'";
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


                  <!-- estudio -->  
                  <tr>
                    <td class="renglon_titulo">Estudio: </td>
                    <td class="renglon_valor" class="form-control">
                      <select name="fn_estudio" id="fi_estudio" style="width:350px">
                        <?php
                          $sql="SELECT * FROM km_estudios where estatus = 'A' and per_paquete = 'No'";
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

                  <!-- Estado del registro -->
                  <tr>
                    <td>Estado</td>
                    <td>
                        <select class="" id="fi_estado" name="fn_estado">
                           <option value="A">Activo</option>
                           <option value="S">Suspendido</option>
                        </select>
                    </td>
                  </tr>

                  <!-- Fecha de alta -->
                  <tr>
                      <td class="renglon_titulo">Fecha Alta: </td>
                      <td class="renglon_valor" class="form-control">
                            <input type="date" required name="fn_falta" id="fi_falta" maxlength="11" size="11" placeholder="Fecha  Alta"/>
                      </td> 
                  </tr>

                  <!-- Fecha de actualización -->
                  <tr>
                      <td class="renglon_titulo">Fecha Actuaizacion: </td>
                      <td class="renglon_valor" class="form-control">
                            <input type="text" readonly="readonly" disabled  value="<?php echo $FechaHoy;?>" name="fn_factualiza" id="fi_factualiza" maxlength="15" size="20" placeholder="Fecha  Alta"/>
                      </td> 
                  </tr>              
                
             </table>  
            </div><!--Cierre modal body-->
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" id="btniniciar"  >Ingresar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
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
        <h4 class="modal-title" id="modalEliminarLabel">Eliminar Paquete</h4>
      </div>
      <div class="modal-body">
        <form id="frmEliminarpaquete" action="controladores/eliminar_paquete.php" method="POST">
          Esta seguro de eliminar el estudio? <strong data-name=""></strong>
           <input type="hidden" id="idpaquete" name="idpaquete" value="">
            <input type="hidden" id="opcion" name="opcion" value="eliminar">
                ID
              <input id="paquete" name="paquete" type="text" class="form-control" maxlength="1" size="3" autofocus disabled>
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
