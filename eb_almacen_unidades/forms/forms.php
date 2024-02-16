<?php 
  include("../controladores/conex.php");
  date_default_timezone_set('America/Mexico_City');
  $FechaHoy=date("d/m/Y : H : i : s");
?>

<!--<form id="form_unidades" action="" method="post">
  <div class="modal fade" id="myModals" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <h2 style="color:blue;text-align:center" class="modal-title">
                Nuevo registro
            </h2>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div style="color:#000000;background:#EFFBF5" class="modal-body">


          <div class="row">
            <div class="col">
              <div class="md-form mt=0">
                <label for="etiqueta">Producto</label>
              </div>  
            </div> 
            <div class="col-9">
             <div class="md-form mt-0">
                <select class="form-control" name="producto" id="producto" required> 
                  <option value="">Seleccione</option>
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
                    <select class="form-control" name="proveedor" id="proveedor" required>
                      <option value="">Seleccione</option>
                      <?php  
                        $variable="SELECT id_proveedor, razon_social FROM eb_proveedores";
                        $variable2=$conexion->query($variable);
                        while ($variable3=mysqli_fetch_array($variable2)) {
                          echo '<option value="'.$variable3['id_proveedor'].'">'.$variable3['razon_social'].'</option>';
                        }
                    ?>
                    </select>
                  </div>
              </div>
          </div>

          <div class="md-form">
              <input type="text" name="existencias" id="existencias" class="form-control" required>
              <label for="existencias">Existencias</label>
            </div>

            <div class="md-form">
              <input type="text" name="min" id="min" class="form-control" required>
              <label for="min">M&iacute;nimo</label>
            </div>

            <div class="md-form">
              <input type="text" name="max" id="max" class="form-control" required>
              <label for="max">M&aacute;ximo</label>
            </div>


        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-success" id="btniniciar"  >Ingresar</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>
</form>

-->

<div class="modal fade" id="unidades" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 style="color:blue;text-align:center" class="modal-title">
          Editar Almac&eacute;n Unidad
         </h2> 
        <button type="button" class="close" data-dismiss="modal"> &times;
        </button>
      </div>
     <div style="color:#000000;background:#EFFBF5" class="modal-body">
        <form id="frm-edit">
          <input type="hidden" name="id_unidades" id="id_unidades">
          
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
                    <select class="form-control" name="proveedor" id="proveedor">
                      <option value="">Proveedor</option>
                      <?php  
                        $variable="SELECT id_proveedor, razon_social FROM eb_proveedores";
                        $variable2=$conexion->query($variable);
                        while ($variable3=mysqli_fetch_array($variable2)) {
                          echo '<option value="'.$variable3['id_proveedor'].'">'.$variable3['razon_social'].'</option>';
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
                 <label for="min">M&iacute;nimo</label>
            </div>
          </div>
        </div>
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  <input type="text" name="max" id="max" class="form-control">
                  <label for="max">M&aacute;ximo</label>
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

