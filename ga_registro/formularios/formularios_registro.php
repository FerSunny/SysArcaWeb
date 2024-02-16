<?php 
  include("../controladores/conex.php");
  date_default_timezone_set('America/Mexico_City');
  $FechaHoy=date("d/m/Y : H : i : s");
?>
<div class="modal fade" id="myModals" role="dialog">
  <div class="modal-dialog">

      <!-- Modal content-->
   <form name="AltasRegistro" action="controladores/registro_registro.php" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h2 style="color:blue;text-align:center" class="modal-title">Nuevo Registro</h2>
          <h5 style="color:blue;text-align:center" class="modal-title">Datos del movimiento</h5>
        </div>
        <div style="color:#000000;background:#EFFBF5" class="modal-body">
          <table border="0" align="center" BGCOLOR=#F5FBEF style="border-bottom:1px solid #819FF7">
<!-- Id registro -->
              <tr>
                <td class="renglon_titulo"> Id Registro: </td>
                <td class="renglon_valor" class="form-control" >
                    <input type="text" name="fn_id_registro" id="fi_id_registro" readonly="readonly" maxlength="12" size="19" placeholder="Asignado por el sistema"/>
                </td>
              </tr>
 <!-- Gasto -->     
              <tr>
                <td class="renglon_titulo">Concepto: </td>
                <td class="renglon_valor" class="form-control">
                  <select name="gasto" >
                    <?php
                      $sql="SELECT * FROM ga_gasto where estado = 'A'";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$row['id_gasto']."' >";
                          echo $row['desc_gasto'];
                          echo "</option>";
                        }
                    ?>
                  </select>
                </td>
              </tr>

 <!-- beneficiario -->     
              <tr>
                <td class="renglon_titulo">Beneficiario: </td>
                <td class="renglon_valor" class="form-control">
                  <select name="beneficia" >
                    <?php
                      $sql="SELECT * FROM ga_beneficiarios where estado = 'A'";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$row['id_beneficiario']."' >";
                          echo $row['nombre'];
                          echo "</option>";
                        }
                    ?>
                  </select>
                </td>
              </tr>

<!-- Importe -->
              <tr>
                  <td class="renglon_titulo">Importe:</td>
                  <td class="renglon_valor" class="form-control">
                      <input type="text" required name="fn_importe" id="fi_importe" maxlength="15" size="15" placeholder="Importe"/>
                   </td>
              </tr>

<!-- Observacines -->
              <tr>
                  <td class="renglon_titulo">Descripcion:</td>
                  <td class="renglon_valor" class="form-control">
                      <input type="text" required name="fn_nota" id="fi_nota" maxlength="55" size="55" placeholder="Observaciones"/>
                   </td>
              </tr>

<!-- comprobante -->
              <tr>
                  <td class="renglon_titulo">Num. Comprobante:</td>
                  <td class="renglon_valor" class="form-control">
                      <input type="text" required name="fn_compro" id="fi_compro" maxlength="15" size="15" placeholder="Num. de comprobante"/>
                   </td>
              </tr>


<!-- Fecha de alta -->
              <tr>
                  <td class="renglon_titulo">Fecha Alta: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="text" readonly="readonly" disabled  value="<?php echo $FechaHoy;?>"  name="fn_fmov" id="fi_fmov" maxlength="20" size="20" placeholder="Fecha  Alta"/>
                  </td> 
              </tr>             

<!-- Estado del registro -->
              <tr>
                <td>Estado:</td>
                <td>
                    <select class="" id="estado" name="estado">
                       <option value="E">Pendiente aprobacion</option>
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
              <h2 style="color:blue;text-align:center" class="modal-title" id="modalEliminarLabel">Editar Registro</h2>
              <h5 style="color:blue;text-align:center" class="modal-title">Datos del movimiento</h5>
            </div>
            <!-- INICIA EL BODY -->
            <div style="color:#000000;background:#EFFBF5" class="modal-body">
             <input type="hidden" id="idregistro" name="idregistro" value="0">
             <input type="hidden" id="opcion" name="opcion" value="modificar">
             <table border="0" align="center" BGCOLOR=#F5FBEF style="border-bottom:1px solid #819FF7">
<!-- Id registro -->
              <tr>
                <td class="renglon_titulo"> Id registro: </td>
                <td class="renglon_valor" class="form-control" >
                    <input type="text" name="fn_id_registro" id="fi_id_registro" readonly="readonly" maxlength="12" size="19" placeholder="Asignado por el sistema"/>
                </td>
              </tr>
              
 <!-- Gasto -->     
              <tr>
                <td class="renglon_titulo">Concepto: </td>
                <td class="renglon_valor" class="form-control">
                  <select name="gasto" id="fi_gasto">
                    <?php
                      $sql="SELECT * FROM ga_gasto where estado = 'A'";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$row['id_gasto']."' >";
                          echo $row['desc_gasto'];
                          echo "</option>";
                        }
                    ?>
                  </select>
                </td>
              </tr>

 <!-- beneficiario -->     
              <tr>
                <td class="renglon_titulo">Beneficiario: </td>
                <td class="renglon_valor" class="form-control">
                  <select name="beneficia" >
                    <?php
                      $sql="SELECT * FROM ga_beneficiarios where estado = 'A'";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$row['id_beneficiario']."' >";
                          echo $row['nombre'];
                          echo "</option>";
                        }
                    ?>
                  </select>
                </td>
              </tr>

<!-- Importe -->
              <tr>
                  <td class="renglon_titulo">Importe:</td>
                  <td class="renglon_valor" class="form-control">
                      <input type="text" required name="fn_importe" id="fi_importe" maxlength="15" size="15" placeholder="Importe"/>
                   </td>
              </tr>

<!-- Observacines -->
              <tr>
                  <td class="renglon_titulo">Observaciones:</td>
                  <td class="renglon_valor" class="form-control">
                      <input type="text" required name="fn_nota" id="fi_nota" maxlength="35" size="35" placeholder="Observaciones"/>
                   </td>
              </tr>

<!-- comprobante -->
              <tr>
                  <td class="renglon_titulo">Num. Comprobante:</td>
                  <td class="renglon_valor" class="form-control">
                      <input type="text" required name="fn_compro" id="fi_compro" maxlength="15" size="15" placeholder="Num. de comprobante"/>
                   </td>
              </tr>

<!-- Fecha de alta -->
              <tr>
                  <td class="renglon_titulo">Fecha Alta: </td>
                  <td class="renglon_valor" class="form-control">
                        <input type="date"  readonly="readonly" disabled  name="fn_fmov" id="fi_fmov" maxlength="15" size="15" placeholder="Fecha  Alta"/>
                  </td> 
              </tr>             

<!-- Estado del registro -->
              <tr>
                <td>Estado</td>
                <td>
                    <select class="" id="estado" name="estado" >
                       <option value="E">Pendiente aprobacion</option>
                       <option value="S">Suspendido</option>
                       <option value="A">Aprobado</option>
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
        <h4 class="modal-title" id="modalEliminarLabel">Eliminar Registro</h4>
      </div>
      <div class="modal-body">
        <form id="frmEliminarregistro" action="controladores/eliminar_registro.php" method="POST">
          ¿Está seguro de eliminar el Registro?<strong data-name=""></strong>
           <input type="hidden" id="idregistro" name="idregistro" value="">
            <input type="hidden" id="opcion" name="opcion" value="eliminar">
                ID
              <input id="registro" name="registro" type="text" class="form-control" maxlength="1" size="3" autofocus disabled>
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
