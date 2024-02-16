

<?php
  include("../controladores/conex.php");
?>


<!--Editar medicos-->
<!-- SCRIPT PARA ACTUALIZAR -->
<form id="frm_add"action="" method="post">
  <div class="row">

    <div id="cuadro1" class="col-sm-12 col-md-12 col-lg-12 ocultar">
      <div class="modal fade" id="myModals" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
        <div class="modal-dialog  modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">

              <h2 style="color:blue;text-align:center" class="modal-title">
                Nueva Sucursal
            </h2>

              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <!-- INICIA EL BODY -->
            <div style="color:#000000;background:#EFFBF5" class="modal-body">

            <div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  <input type="text" required id="fi_desc"  name="fn_desc" maxlength="50" class="form-control" />
                  <label for="fn_desc">Descripción Sucursal</label>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  <input type="text" required name="fn_corta" id="fi_corta" maxlength="50"class="form-control" />
                  <label for="fn_corta">Descripción corta</label>
                </div>
              </div>
            </div>
          </div>

        <div class="row">
          <div class="col">
            <div class="md-form mt-0">
              <div class="md-form">
                Usuario
                <select  required  class="form-control" name="fn_usuario" id="fi_usuario"  data-width="fit"  >
                           <?php
                              $sql="SELECT id_usuario,CONCAT (nombre,' ' ,a_paterno,' ',a_materno) AS nombre FROM se_usuarios WHERE activo = 'A' ";
                              $rec=mysqli_query($conexion,$sql);
                              while ($row=mysqli_fetch_array($rec))
                                {
                                  echo "<option value='".$row['id_usuario']."' >";
                                  echo $row['nombre'];
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
                Grupo

                <select required class="form-control" name="fn_grupo" id="fn_grupo">
                  <?php
                              $sql="SELECT * FROM kg_grupos WHERE estado = 'A' ";
                              $rec=mysqli_query($conexion,$sql);
                              while ($row=mysqli_fetch_array($rec))
                                {
                                  echo "<option value='".$row['id_grupo']."' >";
                                  echo $row['desc_grupo'];
                                  echo "</option>";
                                }
                            ?>
                </select>

              </div>
            </div>
          </div>
        </div>




            <div class="row">
              <div class="col">
                <div class="md-form mt-0">
                  <div class="md-form">
                    <input type="number" required id="fi_telefono" required name="fn_telefono" maxlength="50" class="form-control">
                    <label for="fn_telefono">Teléfono</label>
                  </div>
                </div>
              </div>
<!-- INICIA EL BODY -->

              <div class="col">
                <div class="md-form mt-0">
                  <div class="md-form">
                    <input type="number" required id="fi_tel"  name="fn_tel" maxlength="50" class="form-control">
                    <label for="fn_tel">Teléfono 2</label>
                  </div>
                </div>
              </div>


              <div class="col">
                <div class="md-form mt-0">
                  <div class="md-form">
                  <input type="number" required name="fn_celular" id="fi_celular" maxlength="50" class="form-control">
                  <label for="fn_celular" >Celular</label>
                  </div>
                </div>
              </div>
            </div>




            <div class="row">
              <div class="col">
                <div class="md-form mt-0">
                  <div class="md-form">
                  <input type="time" required name="fn_ha" id="fi_ha" maxlength="50" class="form-control">
                  <label for="fn_ha">Horario hábil de apertura:</label>
                  </div>
                </div>
              </div>

              <div class="col">
                <div class="md-form mt-0">
                  <div class="md-form">
                  <input type="time" required name="fn_hc" id="fi_hc" maxlength="50" class="form-control">
                  <label for="fn_hc" >Horario hábil de cierre:</label>
                  </div>
              </div>
              </div>
            </div>


            <div class="row">
              <div class="col">
                <div class="md-form mt-0">
                  <div class="md-form">
                    <input type="time" required name="fn_sa" id="fi_sa" maxlength="50" class="form-control">
                    <label for="fn_ha">Horario Sábado de apertura:</label>
                  </div>
                </div>
              </div>

              <div class="col">
                <div class="md-form mt-0">
                  <div class="md-form">
                  <input type="time" required name="fn_sc" id="fi_sc" maxlength="50" class="form-control">
                  <label for="fn_hc" >Horario Sábado de cierre:</label>
                  </div>
              </div>
              </div>
            </div>


              <div class="row">
              <div class="col">
                <div class="md-form mt-0">
                  <div class="md-form">
                    <input type="time" required name="fn_da" id="fi_da" maxlength="50" class="form-control">
                    <label for="fn_ha">Horario Domingo de apertura:</label>
                  </div>
                </div>
              </div>

              <div class="col">
                <div class="md-form mt-0">
                  <div class="md-form">
                  <input type="time" required name="fn_dc" id="fi_dc" maxlength="50" class="form-control">
                  <label for="fn_hc" >Horario Domingo de cierre:</label>
                  </div>
              </div>
              </div>
            </div>




              <div class="row">
                <div class="col">
                 <div class="md-form mt-0">
                  <div class="md-form">
                  Descuento
                      <select required class="form-control form-control-sm" name ="fn_descuento" id="fi_descuento"  >
                      <?php
                              $sql="SELECT * FROM kg_descuentos ";
                              $rec=mysqli_query($conexion,$sql);
                              while ($row=mysqli_fetch_array($rec))
                                {
                                  echo "<option value='".$row['id_descuento']."' >";
                                  echo $row['desc_descuento'];
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
                      Estado
                      <select required class="form-control form-control-sm"  name="fn_estado" id="fi_estado">
                       <option value="A">Activo</option>
                       <option value="S">Suspendido</option>
                      </select>
                    </div>
                  </div>
                </div>
          </div>

              <div class="row">
                <div class="col">
                  <div class="md-form mt-0">
                    <div class="md-form">

                      Skype
                      <input type="email" required name="fn_skype" id="fi_skype" class="form-control">

                    </div>
                  </div>
                </div>

                <div class="col">
                  <div class="md-form mt-0">
                    <div class="md-form">
                    E-mail
                      <input type="email" required name="fn_mail" id="fi_mail" maxlength="50" class="form-control">

                    </div>
                  </div>
                </div>


              </div>


              <div class="row">
                <div class="col">
                  <div class="md-form mt-0">
                    <div class="md-form">
                      País
                    <select required name="fn_fk_pais" id="fi_fk_pais" class="form-control">
                      <?php
                      $sql="SELECT * FROM ku_paises ";
                              $rec=mysqli_query($conexion,$sql);
                              while ($row=mysqli_fetch_array($rec))
                                {
                                  echo "<option value='".$row['id_pais']."' >";
                                  echo $row['nombre_pais'];
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
                      Estado de la República
                      <select required class="form-control form-control-sm" name="fn_est" id="fi_est"  >
                            <?php
                              $sql="SELECT * FROM ku_estados where estado = 'A'";
                              $rec=mysqli_query($conexion,$sql);
                              while ($row=mysqli_fetch_array($rec))
                                {
                                  echo "<option value='".$row['id_estado']."' >";
                                  echo $row['desc_estado'];
                                  echo "</option>";
                                }
                            ?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>



              <div class="row">
                <div class="col">
                  <div class="md-form mt-0">
                    <div class="md-form">
                      Municipio
                    <select required name="fn_municipio" id="fi_municipio" class="form-control" >
                    </select>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="md-form mt-0">
                    <div class="md-form">
                      Localidad
                      <select required name="fn_localidad" id="fi_localidad" class=" form-control">
                      </select>
                    </div>
                  </div>
                </div>
              </div>


              <div class="row">
                <div class="col">
                  <div class="md-form mt-0">
                    <div class="md-form">
                      Código Postal
                     <input type="number" required name="fn_cp" id="fi_cp" maxlength="50" class="form-control" >
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="md-form mt-0">
                    <div class="md-form">
                      Colonia
                      <input type="text" required name="fn_colonia" id="fi_colonia" maxlength="50" class="form-control">
                    </div>
                  </div>
                </div>
              </div>



              <div class="row">
                <div class="col">
                  <div class="md-form mt-0">
                    <div class="md-form">
                      Calle
                     <input type="text" required name="fn_calle" id="fi_calle" maxlength="50"class="form-control">
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="md-form mt-0">
                    <div class="md-form">
                      Número
                     <input type="text" required name="fn_numero" id="fi_numero" maxlength="50"class="form-control">
                    </div>
                  </div>
                </div>
              </div>

                <div class="col">
                  <div class="md-form mt-0">
                    <div class="md-form">
                      Días laborales</br>

                       <tr>
                        <td style="text-align:center;">
                        Dom
                        <select class="" name="fn_do" id="fn_do">
                          <option value="S">SI </option>
                          <OPTION VALUE="N">NO </OPTION>
                          </select>
                        </td>

                        <td style="text-align:center;">
                        &nbsp;&nbsp;&nbsp;Lun
                        <select class="" name="fn_lu" id="fn_lu">
                          <option value="S">SI </option>
                          <OPTION VALUE="N">NO </OPTION>
                          </select>
                        </td>

                        <td style="text-align:center;">
                        &nbsp;&nbsp;&nbsp;Mar
                        <select class="" name="fn_ma" id="fn_ma">
                          <option value="S">SI </option>
                          <OPTION VALUE="N">NO </OPTION>
                          </select>
                        </td>

                        <td style="text-align:center;">
                        &nbsp;&nbsp;&nbsp;Mie
                        <select class="" name="fn_mi" id="fn_mi">
                          <option value="S">SI </option>
                          <OPTION VALUE="N">NO </OPTION>
                          </select>
                        </td>

                        <td style="text-align:center;">
                        &nbsp;&nbsp;&nbsp;Jue
                        <select class="" name="fn_ju" id="fn_ju">
                          <option value="S">SI </option>
                          <OPTION VALUE="N">NO </OPTION>
                          </select>
                        </td>

                        <td style="text-align:center;">
                        &nbsp;&nbsp;&nbsp;Vie
                        <select class="" name="fn_vi" id="fn_vi">
                          <option value="S">SI </option>
                          <OPTION VALUE="N">NO </OPTION>
                          </select>
                        </td>

                        <td style="text-align:center;">
                        &nbsp;&nbsp;&nbsp;Sab
                        <select class="" name="fn_sab" id="fn_sab">
                          <option value="S">SI </option>
                          <OPTION VALUE="N">NO </OPTION>
                          </select>
                        </td>
                      </tr>


                    </div>
                  </div>
                </div>



                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="btniniciar"> Ingresar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>

                  </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</form>



<form id="frm_edit"action="" method="post">
  <div class="row">
    <div id="cuadro1" class="col-sm-12 col-md-12 col-lg-12 ocultar">
      <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
        <div class="modal-dialog  modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h2 style="color:blue;text-align:center" class="modal-title">
               Editar Sucursal
              </h2>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <!-- INICIA EL BODY -->
            <div style="color:#000000;background:#EFFBF5" class="modal-body">
              <input type="hidden" id="id_sucursal" name="id_sucursal" value="0">
                <input type="hidden" id="opcion" name="opcion" value="modificar">
                <div class="row">
                  <div class="col">
                    <div class="md-form mt-0">
                      <div class="md-form">
                        <input type="text" required id="fi_desc"  name="fn_desc" maxlength="50" class="form-control" readonly/>
                         <label for="fn_desc">Descripcion Sucursal</label>
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="md-form mt-0">
                      <div class="md-form">
                        <input type="text" required name="fn_corta" id="fi_corta" maxlength="50"class="form-control" readonly/>
                        <label for="fn_corta">Descripción corta</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="md-form mt-0">
                      <div class="md-form">
                        Usuario
                        <select  required  class="form-control" name="fn_usuario" id="fi_usuario"  data-width="fit"  readonly>
                                   <?php
                                      $sql="SELECT id_usuario,CONCAT (nombre,' ' ,a_paterno,' ',a_materno) AS nombre FROM se_usuarios WHERE activo = 'A' ";
                                      $rec=mysqli_query($conexion,$sql);
                                      while ($row=mysqli_fetch_array($rec))
                                        {
                                          echo "<option value='".$row['id_usuario']."' >";
                                          echo $row['nombre'];
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
                        Grupo
                        <select required class="form-control" name="fn_grupo" id="fn_grupo">
                          <?php
                                      $sql="SELECT * FROM kg_grupos WHERE estado = 'A' ";
                                      $rec=mysqli_query($conexion,$sql);
                                      while ($row=mysqli_fetch_array($rec))
                                        {
                                          echo "<option value='".$row['id_grupo']."' >";
                                          echo $row['desc_grupo'];
                                          echo "</option>";
                                        }
                                    ?>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="md-form mt-0">
                      <div class="md-form">
                        <input type="number" required id="fi_telefono" required name="fn_telefono" maxlength="50" class="form-control" readonly>
                        <label for="fn_telefono">Telefono</label>
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="md-form mt-0">
                      <div class="md-form">
                        <input type="number" required id="fi_tel"  name="fn_tel" maxlength="50" class="form-control" readonly>
                        <label for="fn_tel">Telefono 2</label>
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="md-form mt-0">
                      <div class="md-form">
                        <input type="number" required name="fn_celular" id="fi_celular" maxlength="50" class="form-control" readonly>
                        <label for="fn_celular" >Celular</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="md-form mt-0">
                      <div class="md-form">
                      <input type="time" required name="fn_ha" id="fi_ha" maxlength="50" class="form-control" readonly>
                      <label for="fn_ha">Horario hábil de apertura:</label>
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="md-form mt-0">
                      <div class="md-form">
                        <input type="time" required name="fn_hc" id="fi_hc" maxlength="50" class="form-control" readonly>
                        <label for="fn_hc" >Horario hábil de cierre:</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="md-form mt-0">
                      <div class="md-form">
                        <input type="time" required name="fn_sa" id="fi_sa" maxlength="50" class="form-control" readonly>
                        <label for="fn_ha">Horario Sábado de apertura:</label>
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="md-form mt-0">
                      <div class="md-form">
                      <input type="time" required name="fn_sc" id="fi_sc" maxlength="50" class="form-control" readonly>
                      <label for="fn_hc" >Horario Sábado de cierre:</label>
                      </div>
                  </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="md-form mt-0">
                      <div class="md-form">
                        <input type="time" required name="fn_da" id="fi_da" maxlength="50" class="form-control" readonly>
                        <label for="fn_ha">Horario Domingo de apertura:</label>
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="md-form mt-0">
                      <div class="md-form">
                        <input type="time" required name="fn_dc" id="fi_dc" maxlength="50" class="form-control" readonly>
                        <label for="fn_hc" >Horario Domingo de cierre:</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="md-form mt-0">
                      <div class="md-form">
                        Descuento
                        <select required class="form-control form-control-sm" name ="fn_descuento" id="fi_descuento" readonly>
                          <?php
                            $sql="SELECT * FROM kg_descuentos ";
                            $rec=mysqli_query($conexion,$sql);
                            while ($row=mysqli_fetch_array($rec))
                              {
                                echo "<option value='".$row['id_descuento']."' >";
                                echo $row['desc_descuento'];
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
                        Estado
                        <select required class="form-control form-control-sm"  name="fn_estado" id="fi_estado" readonly>
                         <option value="A">Activo</option>
                         <option value="S">Suspendido</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="md-form mt-0">
                      <div class="md-form">

                        Skype
                        <input type="email" required name="fn_skype" id="fi_skype" class="form-control" readonly>

                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="md-form mt-0">
                      <div class="md-form">
                      E-mail
                        <input type="email" required name="fn_mail" id="fi_mail" maxlength="50" class="form-control" readonly>

                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="md-form mt-0">
                      <div class="md-form">
                        País
                        <select required name="fn_fk_pais" id="fi_fk_pais" class="form-control" readonly>
                          <?php
                            $sql="SELECT * FROM ku_paises ";
                            $rec=mysqli_query($conexion,$sql);
                            while ($row=mysqli_fetch_array($rec))
                              {
                                echo "<option value='".$row['id_pais']."' >";
                                echo $row['nombre_pais'];
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
                        Estado de la República
                        <select required class="form-control form-control-sm" name="fn_est" id="fi_est" readonly>
                              <?php
                                $sql="SELECT * FROM ku_estados where estado = 'A'";
                                $rec=mysqli_query($conexion,$sql);
                                while ($row=mysqli_fetch_array($rec))
                                  {
                                    echo "<option value='".$row['id_estado']."' >";
                                    echo $row['desc_estado'];
                                    echo "</option>";
                                  }
                              ?>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="md-form mt-0">
                      <div class="md-form">
                        Municipio
                      <select required name="fn_municipio" id="fi_municipio" class="form-control" readonly>
                      </select>
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="md-form mt-0">
                      <div class="md-form">
                        Localidad
                        <select required name="fn_localidad" id="fi_localidad" class=" form-control" readonly>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="md-form mt-0">
                      <div class="md-form">
                        Código Postal
                       <input type="number" required name="fn_cp" id="fi_cp" maxlength="50" class="form-control" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="md-form mt-0">
                      <div class="md-form">
                        Colonia
                        <input type="text" required name="fn_colonia" id="fi_colonia" maxlength="50" class="form-control" readonly>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="md-form mt-0">
                      <div class="md-form">
                        Calle
                       <input type="text" required name="fn_calle" id="fi_calle" maxlength="50"class="form-control" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="md-form mt-0">
                      <div class="md-form">
                        Número
                        <input type="text" required name="fn_numero" id="fi_numero" maxlength="50" class="form-control" readonly>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="md-form mt-0">
                    <div class="md-form">
                      Días laborales</br>
                      <!--<label for="fn_celular" >Celular</label><input type="number" required name="fn_labora" id="fi_labora" min="1" max="7" class="form-control">-->

                      <tr>
                        <td style="text-align:center;">
                        Dom
                        <select class="" name="fn_do" id="fn_do" readonly>
                          <option value="S">SI </option>
                          <OPTION VALUE="N">NO </OPTION>
                          </select>
                        </td>

                        <td style="text-align:center;">
                        &nbsp;&nbsp;&nbsp;Lun
                        <select class="" name="fn_lu" id="fn_lu" readonly>
                          <option value="S">SI </option>
                          <OPTION VALUE="N">NO </OPTION>
                          </select>
                        </td>

                        <td style="text-align:center;">
                        &nbsp;&nbsp;&nbsp;Mar
                        <select class="" name="fn_ma" id="fn_ma" readonly>
                          <option value="S">SI </option>
                          <OPTION VALUE="N">NO </OPTION>
                          </select>
                        </td>

                        <td style="text-align:center;">
                        &nbsp;&nbsp;&nbsp;Mie
                        <select class="" name="fn_mi" id="fn_mi" readonly>
                          <option value="S">SI </option>
                          <OPTION VALUE="N">NO </OPTION>
                          </select>
                        </td>

                        <td style="text-align:center;">
                        &nbsp;&nbsp;&nbsp;Jue
                        <select class="" name="fn_ju" id="fn_ju" readonly>
                          <option value="S">SI </option>
                          <OPTION VALUE="N">NO </OPTION>
                          </select>
                        </td>

                        <td style="text-align:center;">
                        &nbsp;&nbsp;&nbsp;Vie
                        <select class="" name="fn_vi" id="fn_vi" readonly>
                          <option value="S">SI </option>
                          <OPTION VALUE="N">NO </OPTION>
                          </select>
                        </td>

                        <td style="text-align:center;">
                        &nbsp;&nbsp;&nbsp;Sab
                        <select class="" name="fn_sab" id="fn_sab" readonly>
                          <option value="S">SI </option>
                          <OPTION VALUE="N">NO </OPTION>
                          </select>
                        </td>
                      </tr>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-success" id="btniniciar"> Ingresar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
