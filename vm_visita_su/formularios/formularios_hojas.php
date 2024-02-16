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
          
          <h2 style="color:blue;text-align:center" class="modal-title">Nueva Hoja de visita de supervision</h2>
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

                  Visitador Medico
                   <select name="vm" id="vm" class="form-control" data-width="fit">
                    <?php
                      $sql="SELECT * FROM se_usuarios where activo = 'A' and fk_id_perfil = 12";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$row['id_usuario']."' >";
                          echo $row['nombre'].' '.$row['a_paterno'];
                          echo "</option>";
                        }
                    ?>
                  </select>
                </div>
              </div>
            </div> 
        
<!-- estado de la visita   -->
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">

                  Estado Visita
                   <select name="edovisita" id="edovisita" class="form-control" data-width="fit">
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
<!--constante  -->
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                    <td style="text-align:center;">
                        &nbsp;&nbsp;&nbsp;Visita M. Constante
                      <select class="" name="constante" id="constante">
                          <option value="S">SI </option>
                          <OPTION VALUE="N">NO </OPTION>
                      </select>
                    </td>
                </div>
              </div>
            </div>
            
<!--agradable y coorddial  -->
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                    <td style="text-align:center;">
                        &nbsp;&nbsp;&nbsp;Agradable y Coordial
                      <select class="" name="agradable" id="agradable">
                          <option value="S">SI </option>
                          <OPTION VALUE="N">NO </OPTION>
                      </select>
                    </td>
                </div>
              </div>
            </div>

<!-- informacion -->
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                    <td style="text-align:center;">
                        &nbsp;&nbsp;&nbsp;Informacion
                      <select class="" name="informacion" id="informacion">
                          <option value="S">SI </option>
                          <OPTION VALUE="N">NO </OPTION>
                      </select>
                    </td>
                </div>
              </div>
            </div>
<!-- tiempo y forma -->
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                    <td style="text-align:center;">
                        &nbsp;&nbsp;&nbsp;Tiempo y forma
                      <select class="" name="tiempo" id="tiempo">
                          <option value="S">SI </option>
                          <OPTION VALUE="N">NO </OPTION>
                      </select>
                    </td>
                </div>
              </div>
            </div>

<!-- Participaciones -->
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                    <td style="text-align:center;">
                        &nbsp;&nbsp;&nbsp;Participaciones
                      <select class="" name="participaciones" id="participaciones">
                          <option value="S">SI </option>
                          <OPTION VALUE="N">NO </OPTION>
                      </select>
                    </td>
                </div>
              </div>
            </div>

          </div>


 <!-- motivo categoria  -->  
      <div class="row">
        <!-- quejas  -->           
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  <tr>
                  <td>
									<textarea name="categoria" id="categoria" rows="3" cols="40" wrap="soft" >
									</textarea>
                  </td>
                  </tr>
                  <label>Motivo Categoria</label>
                </div>
              </div>
            </div> 


        </div>

 <!-- observaciones  -->  
      <div class="row">
        <!-- observaciones  -->           
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  <tr>
                  <td>
									<textarea name="observaciones" id="observaciones" rows="3" cols="90" wrap="soft" >
									</textarea>
                  </td>
                  </tr>
                  <label>Observaciones</label>
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
                  <input type="text" id="id_hoja" name="id_hoja" value="0" readonly>
                <input type="hidden" id="opcion" name="opcion" value="modificar">
                  <label>Id Visita</label>
                </div>
              </div>
            </div>
      
          </div>


 <!-- segunda linea -->
          <div class="row">
<!-- estado de la visita   -->
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">

                  Visitador Medico
                   <select name="vm" id="vm" class="form-control" data-width="fit">
                    <?php
                      $sql="SELECT * FROM se_usuarios where activo = 'A' and fk_id_perfil = 12";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$row['id_usuario']."' >";
                          echo $row['nombre'].' '.$row['a_paterno'];
                          echo "</option>";
                        }
                    ?>
                  </select>
                </div>
              </div>
            </div> 
            
<!-- estado de la visita   -->
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">

                  Estado Visita
                   <select name="edovisita" id="edovisita" class="form-control" data-width="fit">
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
<!--constante  -->
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                    <td style="text-align:center;">
                        &nbsp;&nbsp;&nbsp;Visita M. Constante
                      <select class="" name="constante" id="constante">
                          <option value="S">SI </option>
                          <OPTION VALUE="N">NO </OPTION>
                      </select>
                    </td>
                </div>
              </div>
            </div>
            
<!--agradable y coorddial  -->
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                    <td style="text-align:center;">
                        &nbsp;&nbsp;&nbsp;Agradable y Coordial
                      <select class="" name="agradable" id="agradable">
                          <option value="S">SI </option>
                          <OPTION VALUE="N">NO </OPTION>
                      </select>
                    </td>
                </div>
              </div>
            </div>

<!-- informacion -->
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                    <td style="text-align:center;">
                        &nbsp;&nbsp;&nbsp;Informacion
                      <select class="" name="informacion" id="informacion">
                          <option value="S">SI </option>
                          <OPTION VALUE="N">NO </OPTION>
                      </select>
                    </td>
                </div>
              </div>
            </div>
<!-- tiempo y forma -->
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                    <td style="text-align:center;">
                        &nbsp;&nbsp;&nbsp;Tiempo y forma
                      <select class="" name="tiempo" id="tiempo">
                          <option value="S">SI </option>
                          <OPTION VALUE="N">NO </OPTION>
                      </select>
                    </td>
                </div>
              </div>
            </div>

<!-- Participaciones -->
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                    <td style="text-align:center;">
                        &nbsp;&nbsp;&nbsp;Participaciones
                      <select class="" name="participaciones" id="participaciones">
                          <option value="S">SI </option>
                          <OPTION VALUE="N">NO </OPTION>
                      </select>
                    </td>
                </div>
              </div>
            </div>

          </div>


 <!-- motivo categoria  -->  
      <div class="row">
        <!-- quejas  -->           
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  <tr>
                  <td>
                  <textarea name="categoria" id="categoria" rows="3" cols="40" wrap="soft" >
                  </textarea>
                  </td>
                  </tr>
                  <label>Motivo Categoria</label>
                </div>
              </div>
            </div> 


        </div>

 <!-- observaciones  -->  
      <div class="row">
        <!-- observaciones  -->           
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  <tr>
                  <td>
                  <textarea name="observaciones" id="observaciones" rows="3" cols="90" wrap="soft" >
                  </textarea>
                  </td>
                  </tr>
                  <label>Observaciones</label>
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