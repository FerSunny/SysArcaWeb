<?php 
  include("../controladores/conex.php");
  date_default_timezone_set('America/Mexico_City');
  $FechaHoy=date("d/m/Y : H : i : s");
?>

<form id="form_productos" action="" method="post">
  <div class="modal fade" id="myModals" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
            <h2 style="color:blue;text-align:center" class="modal-title">
                Nuevo Producto
            </h2>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div style="color:#000000;background:#EFFBF5" class="modal-body">
          <div class="md-form">
            <input type="number" name="codigo" id="codigo" class="form-control"  maxlength="30" required>
            <label for="codigo">Código</label>
          </div>
          <div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  <input type="text" name="producto" id="producto" class="form-control" maxlength="100" required>
                  <label for="producto"> Descripción corta </label>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  <input type="text" name="desc_p" id="desc_p" class="form-control" maxlength="100">
                  <label for="desc_p">Descripción larga </label>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form form-lg">
                  <p>Unidad de medida</p>
                    <select  class="form-control  form-control-sm" name="uni" id="uni">
                      <option class="z-depth-5">Seleccione</option>
                          <?php
                            $uni ='A';
                            $sql="SELECT * FROM eb_unidad_medida where estado = ?";
                            $stmt = $conexion->prepare($sql);
                                $stmt->bind_param("s",$uni);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                while($row = $result->fetch_assoc())
                                    {
                                    echo "<option value='".$row['id_unidad']."' >";
                                    echo $row['abreviatura'];
                                    echo "</option>";
                                    }
                          ?>
                    </select>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="md-form mt-0">
              <div class="md-form">
                  <input type="number" name="lote" id="lote" class="form-control" maxlength="100" readonly>
                  <label for="lote">Lote</label>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="md-form mt-0">
              <div class="md-form">
                  <input type="number" name="num_p" id="num_p" class="form-control" maxlength="100" readonly>
                  <label for="num_p">Numero de pedimento</label>
              </div>
            </div>
          </div>
        </div>
          <div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  <input type="number"  name="costo" id="costo" class="form-control" min="1" maxlength="5" step="0.01" onkeyup="calcular(1)" required>
                  <label for="costo">Bruto</label>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  <input type="number" name="utilidad" id="utilidad" class="form-control" min="0" maxlength="5"  step="0.01" onkeyup="calcular(1)" required>
                  <label for="utilidad">Iva</label>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  <input type="number" name="c_total" id="c_total" class="form-control" step="0.01" readonly>
                  <label for="c_total" id="lbl_total">Neto</label>
                </div>
              </div>
            </div>
          </div>
          <!--<div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <label for="">Departamento</label>
              </div>
            </div>
            <div class="col-9">
              <div class="md-form mt-0">
                <select class="form-control form-control-sm" name="depto" 
                id="depto" required>
                  <option value="" class="z-depth-5">Seleccione</option>
                    <?php 
                        $query = $conexion -> query("SELECT id_departamento,desc_departamento FROM eb_departamento WHERE estado = 'A'");
                        while($res = mysqli_fetch_array($query))
                        {
                            echo "<option value =".$res['id_departamento'].">
                                ".$res['desc_departamento']."
                                </option>";
                        }
                    ?>
                </select>
              </div>
            </div>
          </div>-->
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
                <label for="">Categoría</label>
              </div>
            </div>
            <div class="col-9">
              <div class="md-form mt-0">
                <select class="form-control form-control-sm" name="cat" id="cat" required>
                  <option value="" class="z-depth-5">Seleccione</option>
                    <?php 
                        $query = $conexion -> query("SELECT id_categoria,categoria FROM eb_categoria WHERE estado = 'A'");
                        while($res = mysqli_fetch_array($query))
                        {
                            echo "<option value =".$res['id_categoria'].">
                                ".$res['categoria']."
                                </option>";
                        }
                    ?>
                </select>
              </div>
            </div>
          </div>


<!-- tipo de consumo -->

          <div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <label for="">Consumo</label>
              </div>
            </div>
            <div class="col-9">
              <div class="md-form mt-0">
                <select class="form-control form-control-sm" name="con" id="con" required>
                  <option value="" class="z-depth-5">Seleccione</option>
                    <?php 
                        $query = $conexion -> query("SELECT id_tipo_consumo,desc_tipo_consumo FROM kg_tipo_consumo WHERE estado = 'A'");
                        while($res = mysqli_fetch_array($query))
                        {
                            echo "<option value =".$res['id_tipo_consumo'].">
                                ".$res['desc_tipo_consumo']."
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
                  <input type="date" value="01/01/2000" name="caducidad" id="caducidad" class="form-control" maxlength="100" readonly>
                  <label for="producto">Caducidad del producto</label>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-success" id="btniniciar">Ingresar</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>
</form>


<!-- Editar -->

<form id="frmedit" class="form-horizontal" method="POST">
  <div id="cuadro1" class="col-sm-12 col-md-12 col-lg-12 ocultar">
    <div class="modal fade" id="form_editar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
              <h2 style="color:blue;text-align:center" class="modal-title" id="modalEliminarLabel">
                  Editar Productos
              </h2>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div style="color:#000000;background:#EFFBF5" class="modal-body">
            <input type="hidden" id="idperfil" name="idperfil" value="0">
            <input type="hidden" id="opcion" name="opcion" value="modificar">
            <input type="hidden" class="form-control  form-control-sm" id="pro" name="pro">
             <input type="hidden" class="form-control  form-control-sm" id="dc" name="dc">
            <div class="md-form">
              <input type="text" name="codigo" id="codigo" class="form-control" required>
              <label for="codigo">Código</label>
            </div>
            <div class="row">
              <div class="col">
                <div class="md-form mt-0">
                  <div class="md-form">
                    <input type="text" name="producto" id="producto" class="form-control" required>
                    <label for="producto">Desacripción corta</label>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="md-form mt-0">
                  <div class="md-form">
                    <input type="text" name="desc_p" id="desc_p" class="form-control" required>
                    <label for="desc_p">Descripción larga</label>
                  </div>
                </div>
              </div>
            </div>
          <div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form form-lg">
                  <p>Unidad de medida</p>
                    <select required class="form-control  form-control-sm" name="uni" id="uni">
                      <option value="" class="z-depth-5">Seleccione</option>
                          <?php
                            $uni ='A';
                            $sql="SELECT * FROM eb_unidad_medida where estado = ?";
                            $stmt = $conexion->prepare($sql);
                                $stmt->bind_param("s",$uni);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                while($row = $result->fetch_assoc())
                                    {
                                    echo "<option value='".$row['id_unidad']."' >";
                                    echo $row['abreviatura'];
                                    echo "</option>";
                                    }
                          ?>
                    </select>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="md-form mt-0">
              <div class="md-form">
                  <input type="number" name="lote" id="lote" class="form-control" maxlength="100" readonly>
                  <label for="lote">Lote</label>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="md-form mt-0">
              <div class="md-form">
                  <input type="number" name="num_p" id="num_p" class="form-control" maxlength="100" readonly>
                  <label for="num_p">Numero de pedimento</label>
              </div>
            </div>
          </div>
        </div>
            <div class="row">
              <div class="col">
                <div class="md-form mt-0">
                  <div class="md-form">
                    <input type="number" name="costo" id="costo" class="form-control" step="0.01" onkeyup="calcular(2)" required>
                    <label for="costo">Bruto</label>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="md-form mt-0">
                  <div class="md-form">
                    <input type="number" name="utilidad" id="utilidad" class="form-control" value="0" step="0.01" onkeyup="calcular(2)" required>
                    <label for="utilidad">Iva</label>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="md-form mt-0">
                  <div class="md-form">
                    <input type="number" name="c_total" id="c_total" class="form-control" step="0.000000000001" required>
                    <label for="c_total" id="lbl_total">Neto</label>
                  </div>
                </div>
              </div>
            </div>
            <!--<div class="row">
              <div class="col">
                <div class="md-form mt-0">
                  <label for="">Departamento</label>
                </div>
              </div>
              <div class="col-9">
                <div class="md-form mt-0">
                  <select class="form-control form-control-sm" name="depto" 
                  id="depto" required>
                    <option value="" class="z-depth-5">Seleccione</option>
                      <?php 
                          $query = $conexion -> query("SELECT id_departamento,desc_departamento FROM eb_departamento WHERE estado = 'A'");
                          while($res = mysqli_fetch_array($query))
                          {
                              echo "<option value =".$res['id_departamento'].">
                                  ".$res['desc_departamento']."
                                  </option>";
                          }
                      ?>
                  </select>
                </div>
              </div>
            </div>-->
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

<!-- Categoria -->

          <div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <label for="">Categoría</label>
              </div>
            </div>
            <div class="col-9">
              <div class="md-form mt-0">
                <select class="form-control form-control-sm" name="cat" id="cat" required>
                  <option value="" class="z-depth-5">Seleccione</option>
                    <?php 
                        $query = $conexion -> query("SELECT id_categoria,categoria FROM eb_categoria WHERE estado = 'A'");
                        while($res = mysqli_fetch_array($query))
                        {
                            echo "<option value =".$res['id_categoria'].">
                                ".$res['categoria']."
                                </option>";
                        }
                    ?>
                </select>
              </div>
            </div>
          </div>

<!-- tipo de consumo -->

          <div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <label for="">Consumo</label>
              </div>
            </div>
            <div class="col-9">
              <div class="md-form mt-0">
                <select class="form-control form-control-sm" name="con" id="con" required>
                  <option value="" class="z-depth-5">Seleccione</option>
                    <?php 
                        $query = $conexion -> query("SELECT id_tipo_consumo,desc_tipo_consumo FROM kg_tipo_consumo WHERE estado = 'A'");
                        while($res = mysqli_fetch_array($query))
                        {
                            echo "<option value =".$res['id_tipo_consumo'].">
                                ".$res['desc_tipo_consumo']."
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
                  <input type="date" name="caducidad" id="caducidad" class="form-control" maxlength="100" readonly>
                  <label for="producto">Caducidad del producto</label>
                </div>
              </div>
            </div>
          </div>
          </div>
          <div class="modal-footer">
              <button type="submit" class="btn btn-success" id="btniniciar">Ingresar</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
          </div>
        </div>
      </div>
    </div>
  </div> 
</form>

