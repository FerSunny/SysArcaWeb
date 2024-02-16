<?php include("../controladores/conex.php") ?>

     
          <!-- Modal Actualizar Solicitud-->
<form id="frmedit" action="controladores/actualizar_orden.php" method="POST">
      <div class="modal fade" id="tabla1" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel" width="500%">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="modalEliminarLabel">Editar Solicicutd</h4>
            </div>
            <div class="modal-body">
                    <input type="hidden" id="idsol" name="idcliente" value="">
                    <table border="0px">
                       <tr>
                           <th class="renglon_titulo">Unidad</th>
                           <th class="renglon_valor"><select name="sucursal" id="sucursal" class="sucursal" disabled>
                             <?php
                                $sql="SELECT * FROM kg_sucursales";
                                $rec=mysqli_query($conexion,$sql);
                                while ($row=mysqli_fetch_array($rec))
                                {
                                  echo "<option value='".$row['id_sucursal']."' >";
                                  echo $row['des_sucursal'];
                                  echo "</option>";
                                }
                             ?>
                           </select></th>
                       </tr>
                       <tr>
                           <th class="renglon_titulo">ID</th>
                           <th class="renglon_valor"><input type="text" name="id" id="id" class="id" disabled size="5"></th>
                       </tr>
                       <tr>
                           <th>Fecha</th>
                           <th><input type="text" value="<?php echo $fecha;?>" size="30"></th>
                       </tr>
                        <tr>
                            <th>Fecha Entrega</th>
                            <th><input type="date" name="fe" id="fe" class="fe"></th>
                        </tr>
                        <tr>
                            <th>Hora Entrega</th>
                            <th><input type="time" name="he" id="he" class="fe"></th> 
                        </tr>
                        <tr>
                            <th class="renglon_titulo">Nombre</th>
                            <th class="renglon_valor"><input type="text" name="nombre" id="nombre" class="nombre" disabled size="30"></th>
                        </tr>
                        <tr>
                            <th>Edad</th>
                            <th><input type="text" name="edad" id="edad" class="edad"></th>
                        </tr>
                        <tr>
                            <th>Sexo</th>
                            <th>
                                <select name="sexo" id="sexo" class="sexo">
                                    <option value=""></option>
                                    <option value="H">Hombre</option>
                                    <option value="M">Mujer</option>
                                </select>
                            </th>
                        </tr>
                        <tr>
                            <th>Doctor(a)</th>
                            <th>
                             <select name="medico" id="medico">
                                 <?php
                                $sql="SELECT * FROM so_medicos";
                                $rec=mysqli_query($conexion,$sql);
                                while ($row=mysqli_fetch_array($rec))
                                {
                                  echo "<option value='".$row['id_medico']."' >";
                                  echo $row['nombre']. " " . $row['a_paterno']. " " .$row['a_materno'];
                                  echo "</option>";
                                }
                             ?>
                             </select>
                            </th>
                        </tr>
                        <tr>
                            <th>Observaciones</th>
                            <th><input type="text" name="obs" id="obs" class="obs"></th>
                        </tr>
                        <tr>
                            <th>Diagnostico</th>
                            <th><input type="text" name="diag" id="diag" class="diag"></th>
                        </tr>
                        <tr>
                            <th>Estudios</th>
                            <th><input type="text" name="est" id="est" class="est"></th>
                        </tr>
                        <tr>
                            <th>Estado</th>
                            <th>
                                <select name="estado" id="estado" class="estado">
                                    <option value=""></option>
                                    <option value="A">Activo</option>
                                    <option value="T">Terminado</option>
                                    <option value="S">Suspendido</option>
                                </select>
                            </th>
                        </tr>
                        <tr>
                            <th>Origen</th>
                            <th><select name="origen" id="origen" class="origen">
                                <option value=""></option>
                                <option value="L">Local</option>
                                <option value="I">Internet</option>
                            </select></th>
                        </tr>
                    </table>
            </div>
            <div class="modal-footer">
                <input type="reset" class="btn btn-primary">
              <button type="submit" class="btn btn-success" id="btniniciar"  >Aceptar</button>
            <button type="submit" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
          </div>
        </div>
      </div>
</form>
     
      <!-- Modal Actualizar Detalles-->
<form id="frmEdit1" action="controladores/actualizar_costos.php" method="POST">
      <div class="modal fade" id="modalEditar1" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="modalEliminarLabel">Eliminar Usuario</h4>
            </div>
            <div class="modal-body">
                    <input type="hidden" id="iddetalle" name="iddetalle" value="">
                    <table border="0px">
                       <tr>
                           <th class="renglon_titulo">Descuento</th>
                           <th class="renglon_valor"><input type="text" name="desc" id="desc" class="desc" size="5"></th>
                           <th>Comision</th>
                           <th class="renglon_valor">
                               <select name="comision" id="comision" class="comision">
                                   <option value=""></option>
                                   <option value="SI">Si</option>
                                   <option value="NO">No</option>
                               </select>
                           </th>
                       </tr>
                       <tr>
                           <th>importe</th>
                           <th><input type="text" name="importe" id="importe" class="importe" size="7"></th>
                           <th>A Cuenta</th>
                           <th><input type="text" name="cuenta" id="cuenta" class="cuenta" size="7"></th>
                       
                       </tr>
                       <tr>
                           <th>Total</th>
                           <th><input type="text" name="total" id="total" class="total" size="7"></th>
                           <th>Resta</th>
                           <th><input type="text" name="resta" id="resta" class="resta" size="7s"></th>
                       </tr>
                </table>
                    
            </div>
            <div class="modal-footer">
                <button  class="btn btn-primary" size="10" value="Cobrar" onclick="calcular_total()">Cobrar</button>
              <button type="submit" class="btn btn-success" id="btniniciar"  >Aceptar</button>
            <button type="submit" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal -->
    </form>

   
      <!-- Modal Actualizar Estudios-->
<form id="frmEdit2" action="controladores/actualizar_costos.php" method="POST">
      <div class="modal fade" id="modalEditar2" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="modalEliminarLabel">Eliminar Usuario</h4>
            </div>
            <div class="modal-body">
                    <input type="hidden" id="idsolicitud" name="iddetalle" value="">
                    <table class="table">
                       <tr>
                           <th>No</th>
                           <th>Lista EStudio</th>
                           <th>Costo</th>
                       </tr>
                       <tr>
                           <th>1</th>
                           <th><select name="txtestudio" id="txtestudio" style="width:350px">
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
                           </select></th>
                           <th><input type="text" name="txtcosto" id="txtcosto" size="7"></th>
                       </tr>
                        <tr>
                           <th>2</th>
                           <th><select name="txtestudio1" id="txtestudio1" style="width:350px">
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
                           </select></th>
                           <th><input type="text" name="txtcosto1" id="txtcosto1" size="7"></th>
                       </tr>
                        <tr>
                           <th>1</th>
                           <th><select name="txtestudio2" id="txtestudio2" style="width:350px">
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
                           </select></th>
                           <th><input type="text" name="txtcosto2" id="txtcosto2" size="7"></th>
                       </tr>
                        <tr>
                           <th>1</th>
                           <th><select name="txtestudio3" id="txtestudio3" style="width:350px">
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
                           </select></th>
                           <th><input type="text" name="txtcosto3" id="txtcosto3" size="7"></th>
                       </tr>
                        <tr>
                           <th>1</th>
                           <th><select name="txtestudio4" id="txtestudio4" style="width:350px">
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
                           </select></th>
                           <th><input type="text" name="txtcosto4" id="txtcosto4" size="7"></th>
                       </tr>
                        
                    </table>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success" id="btniniciar"  >Aceptar</button>
            <button type="submit" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal -->
    </form>
    

