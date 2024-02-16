<?php 
  include("../controladores/conex.php");
  date_default_timezone_set('America/Mexico_City');
  $FechaHoy=date("d/m/Y : H : i : s");
?>
<div class="modal fade" id="myModals" role="dialog">
  <div class="modal-dialog">

      <!-- Modal content-->
   <form name="AltasClientes" action="controladores/registro_clientes.php" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h2 style="color:blue;text-align:center" class="modal-title">Nuevo Cliente</h2>
          <h5 style="color:blue;text-align:center" class="modal-title">Datos Generales</h5>
        </div>
        <div style="color:#000000;background:#EFFBF5" class="modal-body">
          <table border="0" align="center" BGCOLOR=#F5FBEF style="border-bottom:1px solid #819FF7">
              <!-- Id cliente -->
              <tr>
                <td class="renglon_titulo"> Id Cliente: </td>
                <td class="renglon_valor" class="form-control" >
                    <input type="text" name="fn_id_cliente" id="fi_id_cliente" readonly="readonly" maxlength="12" size="19" placeholder="Asignado por el sistema"/>
                </td>
              </tr>
              <!-- RFC -->
              <tr>
                  <td class="renglon_titulo">RFC:</td>
                  <td class="renglon_valor" class="form-control">
                      <input type="text"  name="fn_rfc" id="fi_rfc" maxlength="15" size="20" placeholder="RFC"/>
                   </td>
              </tr>   
              <!-- Nombre -->
              <tr>
                  <td class="renglon_titulo">Nombre:</td>
                  <td class="renglon_valor" class="form-control">
                      <input type="text" required name="fn_nombre" id="fi_nombre" maxlength="35" size="35" placeholder="Nombre"/>
                   </td>
              </tr>
              <!-- Apellido Paterno -->
              <tr>
                  <td class="renglon_titulo">A. Paterno:</td>
                  <td class="renglon_valor" class="form-control">
                      <input type="text" required name="fn_apaterno" id="fi_apaterno" maxlength="35" size="35" placeholder="Apellido Paterno"/>
                   </td>
              </tr>
              <!-- Apellido Materno -->
              <tr>
                  <td class="renglon_titulo">A. Materno:</td>
                  <td class="renglon_valor" class="form-control">
                      <input type="text" required name="fn_amaterno" id="fi_amaterno" maxlength="35" size="35" placeholder="Apellido Materno"/>
                   </td>
              </tr>   

              <!-- Anios -->
              <tr>
                  <td class="renglon_titulo">Anios:</td>
                  <td class="renglon_valor" class="form-control">
                      <input type="number" min="0" max="105" required name="fn_anios" id="fi_anios" maxlength="15" size="20" placeholder="Anios"/>
                   </td>
              </tr>

              <!-- Meses -->
              <tr>
                  <td class="renglon_titulo">Meses:</td>
                  <td class="renglon_valor" class="form-control">
                      <input type="number" min="0" max="11" required name="fn_meses" id="fi_meses" maxlength="15" size="20" placeholder="Meses"/>
                   </td>
              </tr>

              <!-- dias -->
              <tr>
                  <td class="renglon_titulo">Dias:</td>
                  <td class="renglon_valor" class="form-control">
                      <input type="number" min="0" max="30" required name="fn_dias" id="fi_dias" maxlength="15" size="20" placeholder="Dias"/>
                   </td>
              </tr>

              <!-- Sexo -->  
              <tr>
                <td class="renglon_titulo">Sexo: </td>
                <td class="renglon_valor" class="form-control">
                  <select name="fn_sexo" id="fi_sexo" required >
                    <?php
                      $sql="SELECT * FROM so_sexo where activo= 'A'";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$row['id_sexo']."' >";
                          echo $row['desc_sexo'];
                          echo "</option>";
                        }
                    ?>
                  </select>
                </td>
              </tr>

              <!-- Estado Civil -->  
              <tr>
                <td class="renglon_titulo">Estado Civil: </td>
                <td class="renglon_valor" class="form-control">
                  <select name="fn_estado_civil" id="fi_estado_civil">
                    <?php
                      $sql="SELECT * FROM kg_estado_civil where estado = 'A'";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$row['id_estado_civil']."' >";
                          echo $row['desc_estado_civil'];
                          echo "</option>";
                        }
                    ?>
                  </select>
                </td>
              </tr>

              <!-- Ocupacion -->  
              <tr>
                <td class="renglon_titulo">Ocupacion: </td>
                <td class="renglon_valor" class="form-control">
                  <select name="fn_ocupacion" id="fi_ocupacion" style="width:350px">
                    <?php
                      $sql="SELECT * FROM kg_ocupaciones where estado = 'A' ORDER BY desc_ocupacion";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$row['id_ocupacion']."' >";
                          echo $row['desc_ocupacion'];
                          echo "</option>";
                        }
                    ?>
                  </select>
                </td>
              </tr>

              <!-- Telefono fijo -->
              <tr>
                  <td class="renglon_titulo">Tel. Fijo: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="text"  name="fn_tfijo" id="fi_tfijo" maxlength="15" size="15" placeholder="Telefono  Fijo"/>
                  </td> 
              </tr>   

              <!-- Telefono movil -->
              <tr>
                  <td class="renglon_titulo">Tel. Movil: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="tel" required name="fn_movil" id="fi_movil" maxlength="15" size="15" placeholder="Telefono  Movil"/>
                  </td> 
              </tr>              
                
              <!-- mail -->
              <tr>
                  <td class="renglon_titulo">Mail: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="mail" name="fn_mail" id="fi_mail" maxlength="50" size="40" placeholder="Mail"/>
                  </td> 
              </tr> 

              <!-- Estado de la republica -->  
              <tr>
                <td class="renglon_titulo">Estado: </td>
                <td class="renglon_valor" class="form-control">
                  <select name="fn_Estado" id="fi_Estado">
                    <?php
                      $sql="SELECT * FROM ku_estados where estado = 'A' ";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$estado=$row['id_estado']."' >";
                          echo $row['desc_estado'];
                          echo "</option>";
                        }
                        
                        echo $estado ;
                    ?>
                  </select>
                </td>
              </tr>   
              <!-- Municipio -->  
              <tr>
                <td class="renglon_titulo">Municipio: </td>
                <td class="renglon_valor" class="form-control">
                  <select name="fn_municipio" id="fi_municipio">
                    <?php
                      $sql="SELECT * FROM ku_municipios where estado = 'A' and  fk_id_estado in(9,15) order by desc_municipio ";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$row['id_municipio']."' >";
                          echo $row['desc_municipio'];
                          echo "</option>";
                        }
                    ?>
                  </select>
                </td>
              </tr>      
              <!-- Localidades -->  
              <tr>
                <td class="renglon_titulo">Localidad: </td>
                <td class="renglon_valor" class="form-control">
                  <select name="fn_Localidad" id="fi_Localidad">
                    <?php
                      $sql="SELECT * FROM ku_localidades WHERE estado = 'A' AND fk_id_municipio IN (273,275,277,665,681,671,695)
ORDER BY desc_localidad";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$row['id_localidad']."' >";
                          echo $row['desc_localidad'];
                          echo "</option>";
                        }
                    ?>
                  </select>
                </td>
              </tr>  
              <!-- Colonia -->
              <tr>
                  <td class="renglon_titulo">Colonia:</td>
                  <td class="renglon_valor" class="form-control">
                      <input type="text" required name="fn_colonia" id="fi_colonia" maxlength="50" size="50" placeholder="Colonia"/>
                  </td>
              </tr>   
              <!-- CP -->
              <tr>
                  <td class="renglon_titulo">CP:</td>
                  <td class="renglon_valor" class="form-control">
                      <input type="number" required name="fn_cp" id="fi_cp" maxlength="6" size="6" placeholder="CP"/>
                  </td>
              </tr> 
              <!-- Calle -->
              <tr>
                  <td class="renglon_titulo">Calle:</td>
                  <td class="renglon_valor" class="form-control">
                      <input type="text" required name="fn_calle" id="fi_calle" maxlength="150" size="60" placeholder="Calle"/>
                  </td>
              </tr>               
              <!-- Numero -->
              <tr>
                  <td class="renglon_titulo">Numero:</td>
                  <td class="renglon_valor" class="form-control">
                      <input type="text" required name="fn_numero" id="fi_numero" maxlength="35" size="35" placeholder="Numero"/>
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

              <!-- Estado del registro -->
              <tr>
                <td>Estado</td>
                <td>
                    <select class="" id="estado_reg" name="estado_reg">
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



<!--Editar clientes-->
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
              <h2 style="color:blue;text-align:center" class="modal-title" id="modalEliminarLabel">Editar Clientes</h2>
              <h5 style="color:blue;text-align:center" class="modal-title">Datos Generales</h5>
            </div>
            <!-- INICIA EL BODY -->
            <div style="color:#000000;background:#EFFBF5" class="modal-body">
             <input type="hidden" id="idcliente" name="idcliente" value="0">
             <input type="hidden" id="opcion" name="opcion" value="modificar">
                       <table border="0" align="center" BGCOLOR=#F5FBEF style="border-bottom:1px solid #819FF7">
              <!-- Id cliente -->
              <tr>
                <td class="renglon_titulo"> Id Cliente: </td>
                <td class="renglon_valor" class="form-control" >
                    <input type="text" name="fn_id_cliente" id="fi_id_cliente" readonly="readonly" maxlength="12" size="19" placeholder="Asignado por el sistema"/>
                </td>
              </tr>
              <!-- RFC -->
              <tr>
                  <td class="renglon_titulo">RFC:</td>
                  <td class="renglon_valor" class="form-control">
                      <input type="text"  name="fn_rfc" id="fi_rfc" maxlength="15" size="20" placeholder="RFC"/>
                   </td>
              </tr>   
              <!-- Nombre -->
              <tr>
                  <td class="renglon_titulo">Nombre:</td>
                  <td class="renglon_valor" class="form-control">
                      <input type="text" required name="fn_nombre" id="fi_nombre" maxlength="35" size="35" placeholder="Nombre"/>
                   </td>
              </tr>
              <!-- Apellido Paterno -->
              <tr>
                  <td class="renglon_titulo">A. Paterno:</td>
                  <td class="renglon_valor" class="form-control">
                      <input type="text" required name="fn_apaterno" id="fi_apaterno" maxlength="35" size="35" placeholder="Apellido Paterno"/>
                   </td>
              </tr>
              <!-- Apellido Materno -->
              <tr>
                  <td class="renglon_titulo">A. Materno:</td>
                  <td class="renglon_valor" class="form-control">
                      <input type="text" required name="fn_amaterno" id="fi_amaterno" maxlength="35" size="35" placeholder="Apellido Materno"/>
                   </td>
              </tr>   

              <!-- Anios -->
              <tr>
                  <td class="renglon_titulo">Anios:</td>
                  <td class="renglon_valor" class="form-control">
                      <input type="text" required name="fn_anios" id="fi_anios" maxlength="15" size="20" placeholder="Anios"/>
                   </td>
              </tr>

              <!-- Meses -->
              <tr>
                  <td class="renglon_titulo">Meses:</td>
                  <td class="renglon_valor" class="form-control">
                      <input type="text" required name="fn_meses" id="fi_meses" maxlength="15" size="20" placeholder="Meses"/>
                   </td>
              </tr>

              <!-- dias -->
              <tr>
                  <td class="renglon_titulo">Dias:</td>
                  <td class="renglon_valor" class="form-control">
                      <input type="text" required name="fn_dias" id="fi_dias" maxlength="15" size="20" placeholder="Dias"/>
                   </td>
              </tr>
            
              <!-- Sexo -->  
              <tr>
                <td class="renglon_titulo">Sexo: </td>
                <td class="renglon_valor" class="form-control">
                  <select name="fn_sexo" id="fi_sexo">
                    <?php
                      $sql="SELECT * FROM so_sexo where activo= 'A'";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$row['id_sexo']."' >";
                          echo $row['desc_sexo'];
                          echo "</option>";
                        }
                    ?>
                  </select>
                </td>
              </tr>

              <!-- Estado Civil -->  
              <tr>
                <td class="renglon_titulo">Estado Civil: </td>
                <td class="renglon_valor" class="form-control">
                  <select name="fn_estado_civil" id="fi_estado_civil">
                    <?php
                      $sql="SELECT * FROM kg_estado_civil where estado = 'A'";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$row['id_estado_civil']."' >";
                          echo $row['desc_estado_civil'];
                          echo "</option>";
                        }
                    ?>
                  </select>
                </td>
              </tr>

              <!-- Ocupacion -->  
              <tr>
                <td class="renglon_titulo">Ocupacion: </td>
                <td class="renglon_valor" class="form-control">
                  <select name="fn_ocupacion" id="fi_ocupacion" style="width:350px">
                    <?php
                      $sql="SELECT * FROM kg_ocupaciones where estado = 'A'";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$row['id_ocupacion']."' >";
                          echo $row['desc_ocupacion'];
                          echo "</option>";
                        }
                    ?>
                  </select>
                </td>
              </tr>

              <!-- Telefono fijo -->
              <tr>
                  <td class="renglon_titulo">Tel. Fijo: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="text" name="fn_tfijo" id="fi_tfijo" maxlength="15" size="15" placeholder="Telefono  Fijo"/>
                  </td> 
              </tr>   

              <!-- Telefono movil -->
              <tr>
                  <td class="renglon_titulo">Tel. Movil: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="text" required name="fn_movil" id="fi_movil" maxlength="15" size="15" placeholder="Telefono  Movil"/>
                  </td> 
              </tr>              
                
              <!-- mail -->
              <tr>
                  <td class="renglon_titulo">Mail: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="mail"  name="fn_mail" id="fi_mail" maxlength="50" size="40" placeholder="Mail"/>
                  </td> 
              </tr> 

              <!-- Estado de la republica -->  
              <tr>
                <td class="renglon_titulo">Estado: </td>
                <td class="renglon_valor" class="form-control">
                  <select name="fn_Estado_fed" id="fi_Estado_fed">
                    <?php
                      $sql="SELECT * FROM ku_estados where estado = 'A' ";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$estado=$row['id_estado']."' >";
                          echo $row['desc_estado'];
                          echo "</option>";
                        }
                        
                        echo $estado ;
                    ?>
                  </select>
                </td>
              </tr>   
              <!-- Municipio -->  
              <tr>
                <td class="renglon_titulo">Municipio: </td>
                <td class="renglon_valor" class="form-control">
                  <select name="fn_municipio" id="fi_municipio">
                    <?php
                      $sql="SELECT * FROM ku_municipios where estado = 'A' and  fk_id_estado  IN (9,15) ";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$row['id_municipio']."' >";
                          echo $row['desc_municipio'];
                          echo "</option>";
                        }
                    ?>
                  </select>
                </td>
              </tr>      
              <!-- Localidades -->  
              <tr>
                <td class="renglon_titulo">Localidad: </td>
                <td class="renglon_valor" class="form-control">
                  <select name="fn_Localidad" id="fi_Localidad">
                    <?php
                      $sql="SELECT * FROM ku_localidades WHERE estado = 'A' AND fk_id_municipio IN (273,275,277)
ORDER BY desc_localidad";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$row['id_localidad']."' >";
                          echo $row['desc_localidad'];
                          echo "</option>";
                        }
                    ?>
                  </select>
                </td>
              </tr>  
              <!-- Colonia -->
              <tr>
                  <td class="renglon_titulo">Colonia:</td>
                  <td class="renglon_valor" class="form-control">
                      <input type="text"  name="fn_colonia" id="fi_colonia" maxlength="50" size="50" placeholder="Colonia"/>
                  </td>
              </tr>   
              <!-- CP -->
              <tr>
                  <td class="renglon_titulo">CP:</td>
                  <td class="renglon_valor" class="form-control">
                      <input type="number"  name="fn_cp" id="fi_cp" maxlength="6" size="6" placeholder="CP"/>
                  </td>
              </tr> 
              <!-- Calle -->
              <tr>
                  <td class="renglon_titulo">Calle:</td>
                  <td class="renglon_valor" class="form-control">
                      <input type="text"  name="fn_calle" id="fi_calle" maxlength="150" size="60" placeholder="Calle"/>
                  </td>
              </tr>               
              <!-- Numero -->
              <tr>
                  <td class="renglon_titulo">Numero:</td>
                  <td class="renglon_valor" class="form-control">
                      <input type="text"  name="fn_numero" id="fi_numero" maxlength="35" size="35" placeholder="Numero"/>
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

              <!-- Estado del registro -->
              <tr>
                <td>Estado</td>
                <td>
                    <select class="" id="estado_reg" name="estado_reg">
                       <option value="A">Activo</option>
                       <option value="S">Suspendido</option>
                    </select>
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
        <h4 class="modal-title" id="modalEliminarLabel">Eliminar Cliente</h4>
      </div>
      <div class="modal-body">
        <form id="frmEliminarclientes" action="controladores/eliminar_clientes.php" method="POST">
          ¿Está seguro de eliminar el Cliente?<strong data-name=""></strong>
           <input type="hidden" id="idcliente" name="idcliente" value="">
            <input type="hidden" id="opcion" name="opcion" value="eliminar">
                ID
              <input id="cliente" name="cliente" type="text" class="form-control" maxlength="1" size="3" autofocus disabled>
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
