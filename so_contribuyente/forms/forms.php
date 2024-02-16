
<!-- Editar -->

  <form id="frm-edit" class="form-horizontal" method="POST">
    <div class="modal fade" id="contribuyente" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h2 style="color:blue;text-align:center" class="modal-title">
              Editar Datos del Contribuyente
             </h2> 
            <button type="button" class="close" data-dismiss="modal">&times;
            </button>
         </div>
          <div style="color:#000000;background:#EFFBF5" class="modal-body">
          <form id="frm-edit">  

                <input type="hidden" size="10" maxlength="10"  name="id_facturacion" id="id_facturacion" class="form-control"  >  
            
          <div class="row">
            <div class="col">
              <div class="md-form">
                <input type="text" size="10" maxlength="10"  name="id_factura" id="id_factura" class="form-control" disabled="disabled">
                <label for="codigo"># Nota</label>
              </div> 
            </div>
            <div class="col">
              <div class="md-form">
                <input type="text" size="10" maxlength="10"  name="numero_factura" id="numero_factura" class="form-control" disabled="disabled">
                <label for="codigo"># Factura</label>
              </div> 
            </div>
          </div>

            
            <div class="md-form">
                <input type="text" name="nombre" id="nombre" class="form-control" required>
                <label for="codigo">Nombre</label>
            </div>  

            <div class="md-form">
                <input type="text" name="rfc" id="rfc" class="form-control" required size="13" maxlength="13">
                <label for="codigo">RFC</label>
            </div>  

            <div class="md-form">
                <input type="text" name="domicilio" id="domicilio" class="form-control" required>
                <label for="codigo">Domicilio</label>
            </div>  

            <div class="md-form">
                <input type="text" name="email" id="email" class="form-control" required>
                <label for="codigo">Email</label>
            </div>  

            <div class="row">
              <div class="col">
                <div class="md-form mt-0">
                  <select class="form-control" name="desc_uso" id="desc_uso" required disabled="disabled"> 
                    <option value="">Seleccione</option>
                        <?php  
                      $variable="SELECT id_uso, desc_uso FROM kg_usos";
                      $variable2=$conexion->query($variable);
                      while ($variable3=mysqli_fetch_array($variable2)) {
                        echo '<option value="'.$variable3['id_uso'].'">'.$variable3['desc_uso'].'</option>';
                      }

                    ?>
                  </select>
                </div>
              </div>

              <div class="col">
                <div class="md-form mt-0">
                  <select class="form-control" name="desc_tipo_pago" id="desc_tipo_pago" required disabled="disabled"> 
                    <option value="">Seleccione</option>
                        <?php  
                      $variable="SELECT id_tipo_pago, desc_tipo_pago FROM kg_tipo_pago";
                      $variable2=$conexion->query($variable);
                      while ($variable3=mysqli_fetch_array($variable2)) {
                        echo '<option value="'.$variable3['id_tipo_pago'].'">'.$variable3['desc_tipo_pago'].'</option>';
                      }

                    ?>
                  </select>
                </div>
              </div>
            </div>

                
           
                                
          <div class="modal-footer">
              <button type="submit" class="btn btn-success" id="btniniciar"  >Ingresar</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          </div>
      
        </div>
      </div>
    </div>
  </div> 
  </form>  


  <!-- ver -->

    <div class="modal fade" id="ver_datos" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h2 style="color:blue;text-align:center" class="modal-title">
              Datos del Contribuyente
             </h2> 
            <button type="button" class="close" data-dismiss="modal">&times;
            </button>
         </div>
          <div style="color:#000000;background:#EFFBF5" class="modal-body">
          <form id="frm-ver">  
              

                <input type="hidden" size="10" maxlength="10"  name="id_facturacion" id="id_facturacion" class="form-control"  >  
            
          <div class="row">
            <div class="col">
              <div class="md-form">
                <input type="text" size="10" maxlength="10"  name="id_factura" id="id_factura" class="form-control" disabled="disabled">
                <label for="codigo"># Nota</label>
              </div> 
            </div>
            <div class="col">
              <div class="md-form">
                <input type="text" size="10" maxlength="10"  name="numero_factura" id="numero_factura" class="form-control" disabled="disabled">
                <label for="codigo"># Factura</label>
              </div> 
            </div>
          </div>

            
            <div class="md-form">
                <input type="text" name="nombre" id="nombre" class="form-control" required disabled="disabled">
                <label for="codigo">Nombre</label>
            </div>  

            <div class="md-form">
                <input type="text" name="rfc" id="rfc" class="form-control" required disabled="disabled" size="13" maxlength="13">
                <label for="codigo">RFC</label>
            </div>  

            <div class="md-form">
                <input type="text" name="domicilio" id="domicilio" class="form-control" required disabled="disabled">
                <label for="codigo">Domicilio</label>
            </div>  

            <div class="md-form">
                <input type="text" name="email" id="email" class="form-control" required disabled="disabled">
                <label for="codigo">Email</label>
            </div>  

            <div class="row">
              <div class="col">
                <div class="md-form mt-0">
                  <select class="form-control" name="desc_uso" id="desc_uso" required disabled="disabled"> 
                    <option value="">Seleccione</option>
                        <?php  
                      $variable="SELECT id_uso, desc_uso FROM kg_usos";
                      $variable2=$conexion->query($variable);
                      while ($variable3=mysqli_fetch_array($variable2)) {
                        echo '<option value="'.$variable3['id_uso'].'">'.$variable3['desc_uso'].'</option>';
                      }

                    ?>
                  </select>
                </div>
              </div>

              <div class="col">
                <div class="md-form mt-0">
                  <select class="form-control" name="desc_tipo_pago" id="desc_tipo_pago" required disabled="disabled"> 
                    <option value="">Seleccione</option>
                        <?php  
                      $variable="SELECT id_tipo_pago, desc_tipo_pago FROM kg_tipo_pago";
                      $variable2=$conexion->query($variable);
                      while ($variable3=mysqli_fetch_array($variable2)) {
                        echo '<option value="'.$variable3['id_tipo_pago'].'">'.$variable3['desc_tipo_pago'].'</option>';
                      }

                    ?>
                  </select>
                </div>
              </div>
            </div>
          
                                
          <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          </div>
      
        </div>
      </div>
    </div>
  </div>             
</form>
