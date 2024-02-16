<?php 
  include("../controladores/conex.php");
  date_default_timezone_set('America/Mexico_City');
  $FechaHoy=date("d/m/Y : H : i : s");
?>
<div class="modal fade" id="myModals" role="dialog">
  <div class="modal-dialog">

      <!-- Modal content-->
   <form name="AltasModulos" action="controladores/registro_modulos.php" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h2 style="color:blue;text-align:center" class="modal-title">Nuevo Modulo</h2>
          <h5 style="color:blue;text-align:center" class="modal-title">Datos Generales</h5>
        </div>
        <div style="color:#000000;background:#EFFBF5" class="modal-body">
          <table border="0" align="center" BGCOLOR=#F5FBEF style="border-bottom:1px solid #819FF7">
              <!-- Id Modulo -->
              <tr>
                <td class="renglon_titulo"> Id Modulo: </td>
                <td class="renglon_valor" class="form-control" >
                    <input type="text" name="fn_id_modulo" id="fi_id_modulo" readonly="readonly" maxlength="12" size="19" placeholder="Asignado por el sistema"/>
                </td>
              </tr>

              <!-- Nombre -->
              <tr>
                  <td class="renglon_titulo">Nombre:</td>
                  <td class="renglon_valor" class="form-control">
                      <input type="text" required name="fn_nombre" id="fi_nombre" maxlength="35" size="35" placeholder="Nombre"/>
                   </td>
              </tr>

              <!-- Abreviado -->
              <tr>
                  <td class="renglon_titulo">Abreviatura:</td>
                  <td class="renglon_valor" class="form-control">
                      <input type="text" required name="fn_abreviado" id="fi_abreviado" maxlength="35" size="35" placeholder="Abreviacion"/>
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
                    <select class="" id="estado_re" name="estado_reg">
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



<!--Editar medicos-->
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
              <h2 style="color:blue;text-align:center" class="modal-title" id="modalEliminarLabel">Editar Modulos</h2>
              <h5 style="color:blue;text-align:center" class="modal-title">Datos Generales</h5>
            </div>
            <!-- INICIA EL BODY -->
            <div style="color:#000000;background:#EFFBF5" class="modal-body">
             <input type="hidden" id="idmodulo" name="idmodulo" value="0">
             <input type="hidden" id="opcion" name="opcion" value="modificar">
             <table border="0" align="center" BGCOLOR=#F5FBEF style="border-bottom:1px solid #819FF7">
              
              <!-- Id medico -->
              <tr>
                <td class="renglon_titulo"> Id Modulo: </td>
                <td class="renglon_valor" class="form-control" >
                    <input type="text" name="fn_id_modulo" id="fi_id_modulo" readonly="readonly" maxlength="12" size="19" placeholder="Asignado por el sistema"/>
                </td>
              </tr>

              <!-- Nombre -->
              <tr>
                  <td class="renglon_titulo">Nombre:</td>
                  <td class="renglon_valor" class="form-control">
                      <input type="text" required name="fn_nombre" id="fi_nombre" maxlength="35" size="35" placeholder="Nombre"/>
                   </td>
              </tr>
              <!-- Abrevido -->
              <tr>
                  <td class="renglon_titulo">Abreviatura:</td>
                  <td class="renglon_valor" class="form-control">
                      <input type="text" required name="fn_abreviado" id="fi_abreviado" maxlength="35" size="35" placeholder="Abreviado"/>
                   </td>
              </tr>

              <!-- Fecha de alta -->
              <tr>
                  <td class="renglon_titulo">Fecha Alta: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="text" required name="fn_falta" id="fi_falta" maxlength="15" size="15" placeholder="Fecha  Alta"/>
                  </td> 
              </tr>
              <!-- Fecha de actualización -->
              <tr>
                  <td class="renglon_titulo">Fecha Actuaizacion: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="text" required name="fn_factualiza" id="fi_factualiza" readonly="readonly" disabled  value="<?php echo $FechaHoy;?>" maxlength="15" size="20" />
                  </td> 
              </tr>              

              <!-- Estado del registro -->
              <tr>
                <td>Estado</td>
                <td>
                    <select class="" id="estado_re" name="estado_reg" id="fi_estado">
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
        <h4 class="modal-title" id="modalEliminarLabel">Eliminar Modulos</h4>
      </div>
      <div class="modal-body">
        <form id="frmEliminarmodulo" action="controladores/eliminar_modulo.php" method="POST">
          Esta seguro de eliminar el modulo? <strong data-name=""></strong>
           <input type="hidden" id="idmodulo" name="idmodulo" value="">
            <input type="hidden" id="opcion" name="opcion" value="eliminar">
                ID
              <input id="modulo" name="modulo" type="text" class="form-control" maxlength="1" size="3" autofocus disabled>
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
