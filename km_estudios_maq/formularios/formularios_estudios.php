<?php include("../controladores/conex.php") ?>
<div class="modal fade" id="myModals" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
 <form name="AltasEstudio" action="controladores/km_estudios_altas_i.php" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">CATALOGO DE ESTUDIOS</h4>
        </div>
        <div class="modal-body">
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
                            <td class="renglon_titulo">Estudio original: </td>
                            <td class="renglon_valor">
                                <select name="estudio_orig"style="width:350px" >
                                   <?php
                                      $sql="SELECT * FROM km_estudios";
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



                        <tr>
                            <td class="renglon_titulo">Iniciales: </td>
                            <td class="renglon_valor">
                                <input type="text" required name="iniciales" maxlength="50" size="10" placeholder="Iniciales Estudio"/>
                            </td>
                        </tr>

                        <tr>
                            <td class="renglon_titulo">Descripcion:</td>
                            <td class="renglon_valor">
                                <input type="text" required name="desc_estudio" maxlength="100" size="50" placeholder="MAQ-Nombre estudio"/>
                             </td>
                        </tr>

                        <tr>
                            <td class="renglon_titulo">Tipo de estudio: </td>
                            <td class="renglon_valor">
                                <select name="tipo_estudio" >
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
<!-- Tipo de plantilla de captura -->
                        <tr>
                            <td class="renglon_titulo">Tipo Plantilla: </td>
                            <td class="renglon_valor">
                                <select name="tipo_plantilla" >
                                   <?php
                                      $sql="SELECT * FROM cr_plantillas";
                                      $rec=mysqli_query($conexion,$sql);
                                      while ($row=mysqli_fetch_array($rec))
                                      {
                                        echo "<option value='".$row['id_plantilla']."' >";
                                        echo $row['desc_plantilla'];
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
                            <td class="renglon_titulo">Tiempo de Entrega (dias): </td>
                            <td  class="renglon_valor">
                                <input type="decimal" required name="tiempo_entrega" maxlength="12" size="19" placeholder="Tiempo de Entrega (DIAS)"/>
                            </td>
                        </tr>

                        <tr>
                            <td class="renglon_titulo">Comision: </td>
                            <td class="renglon_valor">
                                <select name="id_comision" >
                                   <?php
                                      $sql="SELECT * FROM kg_comisiones WHERE estado = 'A'";
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
                                <input type="text" name="observaciones" maxlength="250" size="50" placeholder="Observaciones"/>
                            </td>
                        </tr>

                        <tr>
                            <td class="renglon_titulo">Es Perfil:</td>
                            <td  class="renglon_valor">
                                <input type="radio" name="per_perfil" value="Si"/>Si
                                <input type="radio" name="per_perfil" value="No"/>No
                            </td>
                        </tr>

                        <tr>
                            <td class="renglon_titulo">Es Paquete:</td>
                            <td  class="renglon_valor">
                                <input type="radio" name="per_paquete" value="Si"/>Si
                                <input type="radio" name="per_paquete" value="No"/>No
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
                                      $sql="SELECT * FROM kg_descuentos WHERE estado = 'A'";
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
                                      $sql="SELECT * FROM kg_promociones WHERE estado = 'A'";
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
                                <select name="id_indicaciones" style="width:350px" required>
                                   <?php
                                      $sql="SELECT * FROM km_indicaciones WHERE activo = 'A' ORDER BY desc_indicaciones";
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
                          <td class="renglon_titulo">Muestra: </td>
                          <td class="renglon_valor">
                              <select name="id_muestras" style="width:350px" required>
                                 <?php
                                    $sql="SELECT * FROM km_muestras WHERE estado = 'A' ORDER BY desc_muestra";
                                    $rec=mysqli_query($conexion,$sql);
                                    while ($row=mysqli_fetch_array($rec))
                                    {
                                      echo "<option value='".$row['id_muestra']."' >";
                                      echo $row['desc_muestra'];
                                      echo "</option>";
                                    }
                                 ?>
                              </select>
                          </td>
                      </tr>

                         <tr>
                          <td class="renglon_titulo">Muestra 1: </td>
                          <td class="renglon_valor">
                              <select name="id_muestras_1" style="width:350px" required>
                                 <?php
                                    $sql="SELECT * FROM km_muestras WHERE estado = 'A' ORDER BY desc_muestra";
                                    $rec=mysqli_query($conexion,$sql);
                                    while ($row=mysqli_fetch_array($rec))
                                    {
                                      echo "<option value='".$row['id_muestra']."' >";
                                      echo $row['desc_muestra'];
                                      echo "</option>";
                                    }
                                 ?>
                              </select>
                          </td>
                      </tr>

                         <tr>
                          <td class="renglon_titulo">Muestra 2: </td>
                          <td class="renglon_valor">
                              <select name="id_muestras_2" style="width:350px" required>
                                 <?php
                                    $sql="SELECT * FROM km_muestras WHERE estado = 'A' ORDER BY desc_muestra";
                                    $rec=mysqli_query($conexion,$sql);
                                    while ($row=mysqli_fetch_array($rec))
                                    {
                                      echo "<option value='".$row['id_muestra']."' >";
                                      echo $row['desc_muestra'];
                                      echo "</option>";
                                    }
                                 ?>
                              </select>
                          </td>
                      </tr>

                         <tr>
                          <td class="renglon_titulo">Muestra 3: </td>
                          <td class="renglon_valor">
                              <select name="id_muestras_3" style="width:350px" required>
                                 <?php
                                    $sql="SELECT * FROM km_muestras WHERE estado = 'A' ORDER BY desc_muestra";
                                    $rec=mysqli_query($conexion,$sql);
                                    while ($row=mysqli_fetch_array($rec))
                                    {
                                      echo "<option value='".$row['id_muestra']."' >";
                                      echo $row['desc_muestra'];
                                      echo "</option>";
                                    }
                                 ?>
                              </select>
                          </td>
                      </tr>

                         <tr>
                          <td class="renglon_titulo">Muestra 4: </td>
                          <td class="renglon_valor">
                              <select name="id_muestras_4" style="width:350px" required>
                                 <?php
                                    $sql="SELECT * FROM km_muestras WHERE estado = 'A' ORDER BY desc_muestra";
                                    $rec=mysqli_query($conexion,$sql);
                                    while ($row=mysqli_fetch_array($rec))
                                    {
                                      echo "<option value='".$row['id_muestra']."' >";
                                      echo $row['desc_muestra'];
                                      echo "</option>";
                                    }
                                 ?>
                              </select>
                          </td>
                      </tr>

                        <tr>
                          <td>Origen</td>
                          <td>
                              <select class="" id="origen" name="origen">
                                 <option value="I">Interface</option>
                                 <option value="C">Captura</option>
                              </select>
                          </td>
                        </tr>

<!-- cubiculo -->
                        <tr>
                          <td>Cubic&uacute;lo</td>
                          <td>
                              <select class="" id="cubiculo" name="cubiculo">
                                 <option value="S">Si</option>
                                 <option value="N">No</option>
                              </select>
                          </td>
                        </tr>

<!-- cubiculo -->
                        <tr>
                          <td>Maquila </td>
                          <td>
                              <select class="" id="maquila" name="maquila">
                                 <option value="S">Si</option>
                                 <option value="N">No</option>
                              </select>
                          </td>
                        </tr>


                        <tr>
                          <td>Estado</td>
                          <td>
                              <select class="" id="estatus" name="estatus">
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
</div>
</form>



<!--Editar estudio-->
<form id="frmedit" class="form-horizontal" action="controladores/actualizar_estudios.php" method="POST">
<div class="row">
  <div id="cuadro1" class="col-sm-12 col-md-12 col-lg-12 ocultar">
      <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="modalEliminarLabel">Editar Estudio</h4>
            </div>
            <div class="modal-body">
              <input type="hidden" id="idusuario" name="idusuario" value="0">
                <input type="hidden" id="opcion" name="opcion" value="modificar">
                <div class="form-group">
                     <label for="nombre" class="col-sm-2 control-label">ID</label>
                    <div class="col-sm-8"><input id="edit1" name="edit1" type="disable" class="form-control"  autofocus disabled></div>
                </div>
                <div class="form-group">
                      <label for="nombre" class="col-sm-2 control-label">Estudio original</label>
                    
                          <select class="selectpicker" style="width:350px" name="estudio_orig" id="estudio_orig" required  >
                              <?php
                              $sql="SELECT * FROM km_estudios";
                              $rec=mysqli_query($conexion,$sql);
                              while ($row=mysqli_fetch_array($rec))
                              {
                                  
                              echo "<option value='".$row['id_estudio']."' >";
                              echo $row['desc_estudio'];
                            
                         
                         echo "</option>";

                              
                              }
                                 ?>
                          </select>
                </div>

                <div class="form-group">
                    <label for="nombre" class="col-sm-2 control-label">Iniciales</label>
                    <div class="col-sm-8"><input id="edit2" name="edit2" type="disable" class="form-control" required></div>
                 </div>
                <div class="form-group">
                  <label for="apellidos" class="col-sm-2 control-label">Descripcion</label>
                   <div class="col-sm-8"><input id="edit3" name="edit3" type="text" class="form-control" ></div>
                </div>
             <div class="form-group">
                      <label for="nombre" class="col-sm-2 control-label">Tipo de estudio</label>
                    
                          <select class="selectpicker" name="edit4" id="edit4" >
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
                </div>
<!--  tipo de plantilla de captura  -->
             <div class="form-group">
                      <label for="nombre" class="col-sm-2 control-label">Tipo de Plantilla</label>
                    
                          <select class="selectpicker" name="tipo_plantilla" id="tipo_plantilla" >
                              <?php
                              $sql="SELECT * FROM cr_plantillas";
                              $rec=mysqli_query($conexion,$sql);
                              while ($row=mysqli_fetch_array($rec))
                              {
                              echo "<option value='".$row['id_plantilla']."' >";
                              echo $row['desc_plantilla'];
                              echo "</option>";
                              }
                                 ?>
                          </select>
                </div>

                <div class="form-group">
                    <label for="apellidos" class="col-sm-2 control-label "> Urgente:</label>
                   
                      <select class="" name="edit5" id="edit5">
                        <option value="Si">SI</option>
                        <option value="No">NO</option>
                      </select>
                
                </div>
                <div class="form-group">
                  <label for="apellidos" class="col-sm-2 control-label">Tiempo Entrega (Dias)</label>
                    <div class="col-sm-8"><input id="edit6" name="edit6" type="text" class="form-control" maxlength="8" ></div>
                </div>
                  <div class="form-group">
                     <label for="apellidos" class="col-sm-2 control-label">Participacion</label>
                         <select class="selectpicker" name="edit7" id="edit7" >
                              <?php
                              $sql="SELECT * FROM kg_comisiones WHERE estado = 'A'";
                              $rec=mysqli_query($conexion,$sql);
                              while ($row=mysqli_fetch_array($rec))
                              {
                              echo "<option value='".$row['id_comision']."' >";
                              echo $row['desc_comision'];
                              echo "</option>";
                              }
                                 ?>
                          </select>
                  </div>
                <div class="form-group">
                  <label for="apellidos" class="col-sm-2 control-label">observaciones</label>
              <div class="col-sm-8"><input id="edit8" name="edit8" type="text" class="form-control" ></div>
                </div>
                <div class="form-group">
                  <label for="apellidos" class="col-sm-2 control-label">Es Perfil</label>
                    <select name="edit9" id="edit9">
                      <option value="Si">Si</option>
                      <option value="No">No</option>
                    </select>
                 </div>
<!-- es paquete -->
                <div class="form-group">
                  <label for="apellidos" class="col-sm-2 control-label">Es Paquete</label>
                    <select name="es_paq" id="es_paq">
                      <option value="Si">Si</option>
                      <option value="No">No</option>
                    </select>
                 </div>


                <div class="form-group">
                  <label for="apellidos" class="col-sm-2 control-label">Precio</label>
                    <div class="col-sm-8"><input id="edit10" name="edit10" type="text" class="form-control" maxlength="8" ></div>
                </div>
                <div class="form-group">
                  <label for="apellidos" class="col-sm-2 control-label">Descuento</label>
                    <div class="col-sm-8">

                    <select class="selectpicker" name="edit11" id="edit11" required>
                      <?php
                          $sql="SELECT * FROM kg_descuentos WHERE estado = 'A'";
                         $rec=mysqli_query($conexion,$sql);
                         while ($row=mysqli_fetch_array($rec))
                          {
                           echo "<option value='".$row['id_descuento']."' >";
                           echo $row['desc_descuento'];
                          echo "</option>";
                        }
                      ?>
                    </select>
                   </div>
                </div>
          <div class="form-group">
              <label for="apellidos" class="col-sm-2 control-label">Promocion</label>
              <div class="col-sm-8">
                <select name="edit12" id="edit12" required>
                 <?php
                    $sql="SELECT * FROM kg_promociones WHERE estado = 'A'";
                    $rec=mysqli_query($conexion,$sql);
                    while ($row=mysqli_fetch_array($rec))
                    {
                      echo "<option value='".$row['id_promocion']."' >";
                      echo $row['desc_promocion'];
                      echo "</option>";
                    }
                 ?>
                </select>
              </div>
          </div>
        <div class="form-group">
            <label for="apellidos" class="col-sm-2 control-label">Indicaciones</label>
            <div class="col-sm-8">
                <select name="edit13" id="edit13" style="width:350px" required>
                   <?php
                      $sql="SELECT * FROM km_indicaciones WHERE activo = 'A' ORDER BY desc_indicaciones";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                      {
                        echo "<option value='".$row['id_indicaciones']."' >";
                        echo $row['desc_indicaciones'];
                        echo "</option>";
                      }
                   ?>
                 </select>
            </div>
         </div>
         <div class="form-group">
             <label for="apellidos" class="col-sm-2 control-label">Muestra</label>
        
                <select name="edit14" id="edit14" style="width:350px" required>
                   <?php
                      $sql="SELECT * FROM km_muestras WHERE estado = 'A' ORDER BY desc_muestra";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                      {
                        echo "<option value='".$row['id_muestra']."' >";
                        echo $row['desc_muestra'];
                        echo "</option>";
                      }
                   ?>
                 </select>
          
         </div>

         <div class="form-group">
             <label for="apellidos" class="col-sm-2 control-label">Muestra 1</label>
        
                <select name="edit14_1" id="edit14_1" style="width:350px" required>
                   <?php
                      $sql="SELECT * FROM km_muestras WHERE estado = 'A' ORDER BY desc_muestra";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                      {
                        echo "<option value='".$row['id_muestra']."' >";
                        echo $row['desc_muestra'];
                        echo "</option>";
                      }
                   ?>
                 </select>
          
         </div>

         <div class="form-group">
             <label for="apellidos" class="col-sm-2 control-label">Muestra 2</label>
        
                <select name="edit14_2" id="edit14_2" style="width:350px" required >
                   <?php
                      $sql="SELECT * FROM km_muestras WHERE estado = 'A' ORDER BY desc_muestra";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                      {
                        echo "<option value='".$row['id_muestra']."' >";
                        echo $row['desc_muestra'];
                        echo "</option>";
                      }
                   ?>
                 </select>
          
         </div>

         <div class="form-group">
             <label for="apellidos" class="col-sm-2 control-label">Muestra 3</label>
        
                <select name="edit14_3" id="edit14_3" style="width:350px" required>
                   <?php
                      $sql="SELECT * FROM km_muestras WHERE estado = 'A' ORDER BY desc_muestra";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                      {
                        echo "<option value='".$row['id_muestra']."' >";
                        echo $row['desc_muestra'];
                        echo "</option>";
                      }
                   ?>
                 </select>
          
         </div>

         <div class="form-group">
             <label for="apellidos" class="col-sm-2 control-label">Muestra 4</label>
        
                <select name="edit14_4" id="edit14_4" style="width:350px" required>
                   <?php
                      $sql="SELECT * FROM km_muestras WHERE estado = 'A' ORDER BY desc_muestra";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                      {
                        echo "<option value='".$row['id_muestra']."' >";
                        echo $row['desc_muestra'];
                        echo "</option>";
                      }
                   ?>
                 </select>
          
         </div>


              <div class="form-group">
              <label for="apellidos" class="col-sm-2 control-label">Origen</label>
              
                <select  name="edit16" id="edit16" required>
                  <option value="I">Interface</option>
                  <option value="C">Captura</option>
                </select>
           </div>

            <div class="form-group">
              <label for="apellidos" class="col-sm-2 control-label">Cubiculo</label>
              
                <select  name="edit17" id="edit17" required>
                  <option value="S">Si</option>
                  <option value="N">No</option>
                </select>
           </div>


            <div class="form-group">
              <label for="apellidos" class="col-sm-2 control-label">Maquila</label>
              
                <select  name="maquila" id="maquila" required>
                  <option value="S">Si</option>
                  <option value="N">No</option>
                </select>
           </div>


           <div class="form-group">
              <label for="apellidos" class="col-sm-2 control-label">Activo</label>
              
                <select  name="edit15" id="edit15" required>
                  <option value="A">Activo</option>
                  <option value="S">Suspendido</option>
                </select>
           </div>
          </div><!--Cierre modal body-->
      <div class="modal-footer">
      <button type="submit" class="btn btn-success" id="btniniciar"  >Ingresar</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
          </div>
        </div>
      </div>
   </div>
  
 </form>
<!--Editar Usuario-->


 <!-- Modal Eliminar-->
<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modalEliminarLabel">Eliminar Estudios</h4>
      </div>
      <div class="modal-body">
        <form id="frmEliminarUsuario" action="controladores/baja_estudio.php" method="POST">
          ¿Está seguro de eliminar el estudio?<strong data-name=""></strong>
           <input type="hidden" id="idusuario" name="idusuario" value="">
            <input type="hidden" id="opcion" name="opcion" value="eliminar">
                ID
              <input id="usuario" name="usuario" type="text" class="form-control" maxlength="1" size="3" autofocus disabled>
                Descripcion
              <input id="desc" name="desc" type="text" class="form-control" maxlength="1" size="3" autofocus disabled>
          </div>
        <div class="modal-footer">
        <button type="submit" class="btn btn-success" id="btniniciar"  >Aceptar</button>
        <button type="submit" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
      </form>
    </div>
  </div>
</div>
