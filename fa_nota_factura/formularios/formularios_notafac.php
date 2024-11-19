<?php 
  include("../controladores/conex.php");
  date_default_timezone_set('America/Mexico_City');
  $FechaHoy=date("d/m/Y : H : i : s");
?>


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
              <h2 style="color:blue;text-align:center" class="modal-title" id="modalEliminarLabel">Asignar Folio</h2>
              <h5 style="color:blue;text-align:center" class="modal-title">Datos Generales</h5>
            </div>
            <!-- INICIA EL BODY -->
            <div style="color:#000000;background:#EFFBF5" class="modal-body">
             <input type="hidden" id="idperfil" name="idperfil" value="0">
             <input type="hidden" id="opcion" name="opcion" value="modificar">
             <table border="0" align="center" BGCOLOR=#F5FBEF style="border-bottom:1px solid #819FF7">
              
              <!-- Id perfil -->
              <tr>
                <td class="renglon_titulo"> Numero de Notas: </td>
                <td class="renglon_valor" class="form-control" >
                    <input type="text" name="fn_nota" id="fi_nota"  readonly="readonly" maxlength="35" size="35" placeholder="Asignado por el sistema"/>
                    
                </td>
              </tr>

            <tr>
                <td class="renglon_titulo"> Fecha Nota </td>
                <td class="renglon_valor" class="form-control" >
                    <input type="text" name="fn_nombre" id="fi_fecha" readonly="readonly" maxlength="35" size="35" placeholder="Asignado por el sistema"/>
                    
                </td>
              </tr>


              <tr>
                <td class="renglon_titulo"> Nombre </td>
                <td class="renglon_valor" class="form-control" >
                    <input type="text" name="fn_nombre" id="fi_nombre" readonly="readonly" maxlength="35" size="35" placeholder="Asignado por el sistema"/ autofocus disabled>
                    
                </td>
              </tr>


              <tr>
                <td class="renglon_titulo"> Importe </td>
                <td class="renglon_valor" class="form-control" >
                    <input type="text" name="fn_nombre" id="fi_importe" readonly="readonly" maxlength="35" size="35" placeholder="Asignado por el sistema"/ autofocus disabled>
                    
                </td>
              </tr>


              <tr>
                  <td class="renglon_titulo">Folio de la factura:</td>
                  <td class="renglon_valor" class="form-control">
                      <input type="text" required name="fn_numero_factura" id="fi_numero_factura" maxlength="35" size="35" placeholder="Nombre"/>
                   </td>
              </tr>

              <tr>
                  <td class="renglon_titulo">Fecha de Facturacion:</td>
                  <td class="renglon_valor" class="form-control">
                      <input type="date" required name="fn_fecha_factura" id="fi_fecha_factura" maxlength="35" size="35" placeholder="Nombre"/>
                   </td>
              </tr>

              <tr>
                    <td class="renglon_titulo">Sucursal</td>
                    <td class="renglon_valor">
                        <select id="fi_sucursal" name="fn_sucursal"style="width:350px" >
                            <?php
                              $sql="SELECT su.id_sucursal, su.desc_sucursal FROM kg_sucursales su WHERE su.estado = 'A'";
                              $rec=mysqli_query($conexion,$sql);
                              while ($row=mysqli_fetch_array($rec))
                              {
                                echo "<option value='".$row['id_sucursal']."' >";
                                echo $row['desc_sucursal'];
                                echo "</option>";
                              }
                            ?>
                        </select>
                    </td>
                </tr>              

                <tr>
                    <td class="renglon_titulo">Grupo Contable</td>
                    <td class="renglon_valor">
                        <select id="fi_grupo" name="fn_grupo"style="width:350px" >
                            <?php
                              $sql="SELECT gr.`id_grupo`,gr.`desc_grupo` FROM kg_grupos gr WHERE gr.estado = 'A'";
                              $rec=mysqli_query($conexion,$sql);
                              while ($row=mysqli_fetch_array($rec))
                              {
                                echo "<option value='".$row['id_grupo']."' >";
                                echo $row['desc_grupo'];
                                echo "</option>";
                              }
                            ?>
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




 