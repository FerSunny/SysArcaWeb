<?php 
  include("../controladores/conex.php");
  date_default_timezone_set('America/Mexico_City');
  $FechaHoy=date("d/m/Y : H : i : s");
?>


<div class="modal fade" id="almacen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 style="color:blue;text-align:center" class="modal-title">
          Editar Almac&eacute;n Central
         </h2> 
        <button type="button" class="close" data-dismiss="modal">&times;
        </button>
      </div>
      <div style="color:#000000;background:" class="modal-body">
        <form id="frm-edit">
          <input type="hidden" name="id_central" id="id_central">
          
          <div class="row">
            <div class="col">
              <div class="md-form mt=0">
                <label for="etiqueta">Producto</label>
              </div>  
             </div> 
             <div class="col-9">
             <div class="md-form mt-0">
                <select class="form-control" name="producto" id="producto"> 
                  <option value="">Producto</option>
                      <?php  
                    $variable="SELECT id_producto, desc_producto FROM eb_productos";
                    $variable2=$conexion->query($variable);
                    while ($variable3=mysqli_fetch_array($variable2)) {
                      echo '<option value="'.$variable3['id_producto'].'">'.$variable3['desc_producto'].'</option>';
                    }

                  ?>
                </select>
              </div>
             </div> 
            </div> 
          <div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <label for="">Proveedor</label>
              </div>
            </div>
            <div class="col-9">
              <div class="md-form mt-0">
                <select class="form-control form-control-sm" name="proveedor" id="proveedor" required>
                  <option value="" class="z-depth-5">Seleccione</option>
                    <?php 
                        $query = $conexion -> query("SELECT id_proveedor,razon_social FROM eb_proveedores WHERE estado = 'A'");
                        while($res = mysqli_fetch_array($query))
                        {
                            echo "<option value =".$res['id_proveedor'].">
                                ".$res['razon_social']."
                                </option>";
                        }
                    ?>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  <input type="text" name="existencias" id="existencias" class="form-control">
                  <label for="existencias">Existencias</label>  
               </div>
              </div>
            </div>
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
              <input type="text" name="min" id="min" class="form-control">
              <label for="min">Mínimo</label>
                </div>
               </div>
            </div>
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
              <input type="text" name="max" id="max" class="form-control">
              <label for="max">Máximo</label>
                </div>
              </div>
          </div>
      </div>
  </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn btn-success btn-md">Guardar</button>
        <button type="button" class="btn btn-danger btn-md" data-dismiss="modal">Cerrar</button>

        </form>
      </div>
    </div>
  </div>
</div>
</form>

