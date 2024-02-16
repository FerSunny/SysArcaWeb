<?php 
  include("../controladores/conex.php");
  date_default_timezone_set('America/Mexico_City');
  $FechaHoy=date("d/m/Y : H : i : s");
?>

<form id="frm_add" action="" method="post">
<div class="modal fade" id="myModals" role="dialog">
  <div class="modal-dialog modal-lg" role="document">

      <!-- Modal content-->
   
      <div class="modal-content">
        <div class="modal-header">
          
          <h2 style="color:blue;text-align:center" class="modal-title">Nueva Hoja de visita</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>

        </div>
         <!-- Inica el body -->
        <div style="color:#000000;background:#EFFBF5" class="modal-body">
  
<!-- primer linea     --> 
          <div class="row">
<!-- Id de la visita    -->     
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  
                  <label>Id Visita</label>
                </div>
              </div>
            </div>
<!-- estado de la visita   -->
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">

                  Estado Visita
                   <select name="fn_edovisita" id="fi_edovisita" class="form-control" data-width="fit">
                    <?php
                      $sql="SELECT * FROM kg_estado_visita where estado = 'A'";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$row['id_estado_visita']."' >";
                          echo $row['desc_visita'];
                          echo "</option>";
                        }
                    ?>
                  </select>
                </div>
              </div>
            </div> 
          </div>

<!-- segunda linea -->
          <div class="row">
<!--Participaciones  -->
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                    <td style="text-align:center;">
                        &nbsp;&nbsp;&nbsp;Participaciones
                      <select class="" name="fn_participa" id="fn_participa">
                          <option value="S">SI </option>
                          <OPTION VALUE="N">NO </OPTION>
                      </select>
                    </td>
                </div>
              </div>
            </div>
            
<!--Publicidad  -->
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                    <td style="text-align:center;">
                        &nbsp;&nbsp;&nbsp;Publicidad
                      <select class="" name="fn_publicidad" id="fn_publicidad">
                          <option value="S">SI </option>
                          <OPTION VALUE="N">NO </OPTION>
                      </select>
                    </td>
                </div>
              </div>
            </div>

<!-- Ordenes  Folio inicial -->
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                    <td style="text-align:center;">
                        &nbsp;&nbsp;&nbsp;Ordenes F. Inicial
                        <!--
                        <select class="" name="fn_ordenes" id="fn_ordenes">
                          <option value="S">SI </option>
                          <OPTION VALUE="N">NO </OPTION>
                        </select>
                        -->
                        <input type="number" required name="fn_ordenes_i" id="fn_ordenes_i" maxlength="4" size='4'>
                    </td>
                </div>
              </div>
            </div>
<!-- Ordenes  Folio final -->
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                    <td style="text-align:center;">
                        &nbsp;&nbsp;&nbsp;Ordenes F. Final
                        <!--
                        <select class="" name="fn_ordenes" id="fn_ordenes">
                          <option value="S">SI </option>
                          <OPTION VALUE="N">NO </OPTION>
                        </select>
                        -->
                        <input type="number" required name="fn_ordenes_f" id="fn_ordenes_f" maxlength="4" size='4'>
                    </td>
                </div>
              </div>
            </div>


          </div>
<!-- linea tres  -->
          <div class="row">
 <!-- mail resultados  -->           
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                    <td style="text-align:center;">
                        &nbsp;&nbsp;&nbsp;Mail Resultados
                      <select class="" name="fn_mail" id="fn_mail">
                          <option value="S">SI </option>
                          <OPTION VALUE="N">NO </OPTION>
                      </select>
                    </td>
                </div>
              </div>
            </div>

 <!-- mail resultados  -->           
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                    <td style="text-align:center;">
                        &nbsp;&nbsp;&nbsp;Consulta Externa
                      <select class="" name="fn_ce" id="fn_ce">
                          <option value="S">SI </option>
                          <OPTION VALUE="N">NO </OPTION>
                      </select>
                    </td>
                </div>
              </div>
            </div>
            
          </div>

 <!-- linea cuatro  -->  
      <div class="row">
        <!-- quejas  -->           
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  <tr>
                  <td>
									<textarea name="fn_quejas" id="fi_quejas" rows="3" cols="40" wrap="soft" >
									</textarea>
                  </td>
                  </tr>
                  <label>Quejas</label>
                </div>
              </div>
            </div> 

          <!-- sugerencias  -->           
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  <tr>
                  <td>
									<textarea name="fn_sugiere" id="fi_sugiere" rows="3" cols="40" wrap="soft" >
									</textarea>
                  </td>
                  </tr>
                  <label>Sugerencias</label>
                </div>
              </div>
            </div>
        </div>

 <!-- linea cuatro.uno  -->  
      <div class="row">
        <!-- observaciones  -->           
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  <tr>
                  <td>
									<textarea name="fn_observaciones" id="fi_observaciones" rows="3" cols="90" wrap="soft" >
									</textarea>
                  </td>
                  </tr>
                  <label>Observaciones</label>
                </div>
              </div>
            </div> 
      </div>


     <!-- linea 5  --> 
          <div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                <input type="date" required name="fn_falta" id="fi_falta" maxlength="15">
                <label>Fecha Alta</label>
                </div>
              </div>
            </div>

            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  <input type="time" required name="fn_halta" id="fi_halta" maxlength="15">
                  <label>Hora Alta</label>
                </div>
              </div>
            </div>        
          </div>



          <div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                <input type="text" readonly="readonly" disabled  value="<?php echo $FechaHoy;?>" name="fn_factualiza" id="fi_factualiza" maxlength="15">
                <label>Fecha Actualización</label>
                </div>
              </div>
            </div>

            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  Estado 
                <select class="" id="estado_reg" name="estado_reg">
                       <option value="A">Activo</option>
                       <option value="S">Suspendido</option>
                    </select>


                </div>
              </div>
            </div>
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



<!--Editar medicos-->
<!-- SCRIPT PARA ACTUALIZAR -->

<form id="frmedit" action="" method="post">
      <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
        <div class="modal-dialog  modal-lg" role="document">

      <!-- Modal content-->
   
      <div class="modal-content">
        <div class="modal-header">
          
          <h2 style="color:blue;text-align:center" class="modal-title">Editar Medico</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>

        </div>
         <!-- Inica el body -->
        <div style="color:#000000;background:#EFFBF5" class="modal-body">

          
        
          <div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  <input type="hidden" id="id_hoja" name="id_hoja" value="0">
                <input type="hidden" id="opcion" name="opcion" value="modificar">
                  <label>Id medico</label>
                </div>
              </div>
            </div>
      
<!-- estado de la visita   -->
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">

                  Estado Visita
                   <select name="fn_edovisita" id="fi_edovisita" class="form-control" data-width="fit">
                    <?php
                      $sql="SELECT * FROM kg_estado_visita where estado = 'A'";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$row['id_estado_visita']."' >";
                          echo $row['desc_visita'];
                          echo "</option>";
                        }
                    ?>
                  </select>
                </div>
              </div>
            </div> 

          </div>


 <!-- segunda linea -->
          <div class="row">
<!--Participaciones  -->
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                    <td style="text-align:center;">
                        &nbsp;&nbsp;&nbsp;Participaciones
                      <select class="" name="fn_participa" id="fi_participa">
                          <option value="S">SI </option>
                          <OPTION VALUE="N">NO </OPTION>
                      </select>
                    </td>
                </div>
              </div>
            </div>
            
<!--Publicidad  -->
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                    <td style="text-align:center;">
                        &nbsp;&nbsp;&nbsp;Publicidad
                      <select class="" name="fn_publicidad" id="fi_publicidad">
                          <option value="S">SI </option>
                          <OPTION VALUE="N">NO </OPTION>
                      </select>
                    </td>
                </div>
              </div>
            </div>
<!-- Ordenes  Folio inicial -->
<div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                    <td style="text-align:center;">
                        &nbsp;&nbsp;&nbsp;Ordenes F. Inicial
                        <!--
                        <select class="" name="fn_ordenes" id="fn_ordenes">
                          <option value="S">SI </option>
                          <OPTION VALUE="N">NO </OPTION>
                        </select>
                        -->
                        <input type="number" required name="fn_ordenes_i" id="fi_ordenes_i" maxlength="4" size='4'>
                    </td>
                </div>
              </div>
            </div>
<!-- Ordenes  Folio final -->
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                    <td style="text-align:center;">
                        &nbsp;&nbsp;&nbsp;Ordenes F. Final
                        <!--
                        <select class="" name="fn_ordenes" id="fn_ordenes">
                          <option value="S">SI </option>
                          <OPTION VALUE="N">NO </OPTION>
                        </select>
                        -->
                        <input type="number" required name="fn_ordenes_f" id="fi_ordenes_f" maxlength="4" size='4'>
                    </td>
                </div>
              </div>
            </div>

<!--Publicidad 
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                    <td style="text-align:center;">
                        &nbsp;&nbsp;&nbsp;Ordenes
                      <select class="" name="fn_ordenes" id="fi_ordenes">
                          <option value="S">SI </option>
                          <OPTION VALUE="N">NO </OPTION>
                      </select>
                    </td>
                </div>
              </div>
            </div>
 -->            
          </div>
<!-- linea tres  -->
          <div class="row">
 <!-- mail resultados  -->           
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                    <td style="text-align:center;">
                        &nbsp;&nbsp;&nbsp;Mail Resultados
                      <select class="" name="fn_mail" id="fi_mail">
                          <option value="S">SI </option>
                          <OPTION VALUE="N">NO </OPTION>
                      </select>
                    </td>
                </div>
              </div>
            </div>

 <!-- mail resultados  -->           
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                    <td style="text-align:center;">
                        &nbsp;&nbsp;&nbsp;Consulta Externa
                      <select class="" name="fn_ce" id="fi_ce">
                          <option value="S">SI </option>
                          <OPTION VALUE="N">NO </OPTION>
                      </select>
                    </td>
                </div>
              </div>
            </div>
            
          </div>

 <!-- linea cuatro  -->  
          <div class="row">
   <!-- quejas  -->           
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  <tr>
                  <td>
									<textarea name="fn_quejas" id="fi_quejas" rows="3" cols="40" wrap="soft" >
									</textarea>
                  </td>
                  </tr>
                  <label>Quejas</label>
                </div>
              </div>
            </div> 

   <!-- quejas  -->           
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  <tr>
                  <td>
									<textarea name="fn_sugiere" id="fi_sugiere" rows="3" cols="40" wrap="soft" >
									</textarea>
                  </td>
                  </tr>
                  <label>Sugerencias</label>
                </div>
              </div>
            </div>
          </div>
          
     <!-- linea cuatro.uno  -->  
     <div class="row">
        <!-- observaciones  -->           
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  <tr>
                  <td>
									<textarea name="fn_observaciones" id="fi_observaciones" rows="3" cols="90" wrap="soft" >
									</textarea>
                  </td>
                  </tr>
                  <label>Observaciones</label>
                </div>
              </div>
            </div> 
      </div>

   <!-- linea 5  --> 
          <div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                <input type="date" required name="fn_falta" id="fi_falta" maxlength="15">
                <label>Fecha Alta</label>
                </div>
              </div>
            </div>

              <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                <input type="time" required name="fn_halta" id="fi_halta" maxlength="15">
                <label>Hora Alta</label>
                </div>
              </div>
            </div>        
          </div>



          <div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                <input type="text" readonly="readonly" disabled  value="<?php echo $FechaHoy;?>" name="fn_factualiza" id="fi_factualiza" maxlength="15">
                <label>Fecha Actualización</label>
                </div>
              </div>
            </div>

            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  Estado 
                <select class="" id="estado_reg" name="estado_reg">
                       <option value="A">Activo</option>
                       <option value="S">Suspendido</option>
                    </select>


                </div>
              </div>
            </div>
          </div>

<!-- aqui -->

        </div>
        
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" id="btniniciar"  >Ingresar</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        </div>
        
      </div>
    </div>
  </div>
</form>