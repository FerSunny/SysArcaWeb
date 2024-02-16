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
   <form name="AltasBeneficia" action="controladores/registro_beneficia.php" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h2 style="color:blue;text-align:center" class="modal-title">Nuevo Beneficiario</h2>
          <h5 style="color:blue;text-align:center" class="modal-title">Datos Generales</h5>
        </div>
        <!--<div style="color:#000000;background:#EFFBF5" class="modal-body"> -->
        <div style="color:##fff;background:#e3f2fd" class="modal-body">
          <table border="0" align="center" BGCOLOR=#F5FBEF style="border-bottom:1px solid #819FF7">
              <!-- Id beneficirio -->
              <tr>
                <td class="renglon_titulo"> Id Beneficiario: </td>
                <td class="renglon_valor" class="form-control" >
                    <input type="text" name="fn_id_beneficiario" id="fi_id_beneficiario" readonly="readonly" maxlength="11" size="11" placeholder="Asignado por el sistema"/>
                </td>
              </tr>

              <!-- giro -->  
              <tr>
                <td class="renglon_titulo">Giro: </td>
                <td class="renglon_valor" class="form-control">
                  <select name="fn_giro" id="fi_giro">
                    <?php
                      $sql="SELECT * FROM ga_giros where estado = 'A'";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$row['id_giro']."' >";
                          echo $row['desc_giro'];
                          echo "</option>";
                        }
                    ?>
                  </select>
                </td>
              </tr>


              <!-- nombre -->
              <tr>
                  <td class="renglon_titulo">Nombre:</td>
                  <td class="renglon_valor" class="form-control">
                      <input type="text" required name="fn_nombre" id="fi_nombre" maxlength="45" size="45" placeholder="Nombre beneficiario"/>
                  </td>
              </tr>

            
              <!-- Telefono fijo-->
              <tr>
                  <td class="renglon_titulo">T. Fijo: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="text" required name="fn_tfijo" id="fi_tfijo" maxlength="15" size="15" placeholder="Telefono fijo"/>
                  </td> 
              </tr>

              <!-- Telefono Movil-->
              <tr>
                  <td class="renglon_titulo">T. Movil: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="text" required name="fn_tmovil" id="fi_tmovil" maxlength="15" size="15" placeholder="Telefono novil"/>
                  </td> 
              </tr>

              <!-- direccion-->
              <tr>
                  <td class="renglon_titulo">Direccion: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="text" required name="fn_direccion" id="fi_direccion" maxlength="120" size="35" placeholder="Direccion"/>
                  </td> 
              </tr>

              <!-- mail-->
              <tr>
                  <td class="renglon_titulo">Mail: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="mail" required name="fn_mail" id="fi_mail" maxlength="50" size="50" placeholder="Mail"/>
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
              <h2 style="color:blue;text-align:center" class="modal-title" id="modalEliminarLabel">Editar Beneficiario</h2>
              <h5 style="color:blue;text-align:center" class="modal-title">Datos Generales</h5>
            </div>
            <!-- INICIA EL BODY -->
            <div style="color:#000000;background:#EFFBF5" class="modal-body">
             <input type="hidden" id="idbeneficiario" name="idbeneficiario" value="0">
             <input type="hidden" id="opcion" name="opcion" value="modificar">
             <table border="0" align="center" BGCOLOR=#F5FBEF style="border-bottom:1px solid #819FF7">
                  
              <!-- Id beneficirio -->
              <tr>
                <td class="renglon_titulo"> Id Beneficiario: </td>
                <td class="renglon_valor" class="form-control" >
                    <input type="text" name="fn_id_beneficiario" id="fi_id_beneficiario" readonly="readonly" maxlength="11" size="11" placeholder="Asignado por el sistema"/>
                </td>
              </tr>

              <!-- giro -->  
              <tr>
                <td class="renglon_titulo">Giro: </td>
                <td class="renglon_valor" class="form-control">
                  <select name="fn_giro" id="fi_giro">
                    <?php
                      $sql="SELECT * FROM ga_giros where estado = 'A'";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$row['id_giro']."' >";
                          echo $row['desc_giro'];
                          echo "</option>";
                        }
                    ?>
                  </select>
                </td>
              </tr>


              <!-- nombre -->
              <tr>
                  <td class="renglon_titulo">Nombre:</td>
                  <td class="renglon_valor" class="form-control">
                      <input type="text" required name="fn_nombre" id="fi_nombre" maxlength="45" size="45" placeholder="Nombre beneficiario"/>
                  </td>
              </tr>

            
              <!-- Telefono fijo-->
              <tr>
                  <td class="renglon_titulo">T. Fijo: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="text" required name="fn_tfijo" id="fi_tfijo" maxlength="15" size="15" placeholder="Telefono fijo"/>
                  </td> 
              </tr>

              <!-- Telefono Movil-->
              <tr>
                  <td class="renglon_titulo">T. Movil: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="text" required name="fn_tmovil" id="fi_tmovil" maxlength="15" size="15" placeholder="Telefono novil"/>
                  </td> 
              </tr>

              <!-- direccion-->
              <tr>
                  <td class="renglon_titulo">Direccion: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="text" required name="fn_direccion" id="fi_direccion" maxlength="120" size="35" placeholder="Direccion"/>
                  </td> 
              </tr>

              <!-- mail-->
              <tr>
                  <td class="renglon_titulo">Mail: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="mail" required name="fn_mail" id="fi_mail" maxlength="50" size="50" placeholder="Mail"/>
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
        <h4 class="modal-title" id="modalEliminarLabel">Eliminar Beneficiario</h4>
      </div>
      <div class="modal-body">
        <form id="frmEliminarbeneficiario" action="controladores/eliminar_beneficia.php" method="POST">
          Esta seguro de eliminar el beneficiario? <strong data-name=""></strong>
           <input type="hidden" id="idbeneficiario" name="idbeneficiario" value="">
            <input type="hidden" id="opcion" name="opcion" value="eliminar">
                ID
              <input id="beneficiario" name="beneficiario" type="text" class="form-control" maxlength="1" size="3" autofocus disabled>
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
