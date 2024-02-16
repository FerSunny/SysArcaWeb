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
          
          <h2 style="color:blue;text-align:center" class="modal-title">Nuevo Medico</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>

        </div>
         <!-- Inica el body -->
        <div style="color:#000000;background:#EFFBF5" class="modal-body">
        
          <div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  
                  <label>Id medico</label>
                </div>
              </div>
            </div>
      
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">

                  Zona
                   <select name="zona" id="fi_zona" class="form-control" data-width="fit">
                    <?php
                      $sql="SELECT * FROM kg_zonas where estado = 'A'";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$row['id_zona']."' >";
                          echo $row['desc_zona'];
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
                  <input type="text" required name="fn_nombre" id="fi_nombre" maxlength="35" class="form-control">
                  <label>Nombre</label>
                </div>
              </div>
            </div>
            
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  <input type="text" required name="fn_apaterno" id="fi_apaterno" maxlength="35" class="form-control">
                  <label>A. Paterno</label>
                </div>
              </div>
            </div>

            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  <input type="text" required name="fn_amaterno" id="fi_amaterno" maxlength="35" class="form-control ">
                  <label>A. Materno</label>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                <input type="text" required name="fn_rfc" id="fi_rfc" maxlength="15" class="form-control">
                <label>RFC</label>
                </div>
              </div>
            </div>

            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  Sexo
                <select name="fn_sexo" id="fi_sexo" class="form-control">
                    <?php
                      $sql="SELECT * FROM so_sexo where activo = 'A'";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$row['id_sexo']."' >";
                          echo $row['desc_sexo'];
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
                  Especialidad
                <select name="especialidad" id="fi_especialidad" class="form-control">
                    <?php
                      $sql="SELECT * FROM km_especialidades where estado = 'A'";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$row['id_especialidad']."' >";
                          echo $row['desc_especialidad'];
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
                <select name="Estado" id="fi_estado"  class="form-control">
                    <?php
                      $sql="SELECT * FROM ku_estados where estado = 'A'";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$estado=$row['id_estado']."' >";
                          echo $row['desc_estado'];
                          echo "</option>";
                        }
                        
                        echo $estado ;
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
                <select name="Municipio" id="fi_Municipio" class="form-control">
                    
                  </select>
                </div>
              </div>
            </div>
            
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  Localidad
                <select name="Localidad" id="fi_Localidad" class="form-control">
                    
                  </select>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  <input type="text" required name="fn_colonia" id="fi_colonia" maxlength="50" class="form-control">
                  <label>Colonia</label>
                </div>
              </div>
            </div>

            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  <input type="number" required name="fn_cp" id="fi_cp" maxlength="6" class="form-control">
                  <label>CP</label>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  <input type="text" required name="fn_calle" id="fi_calle" maxlength="150" class="form-control">
                  <label>Calle</label>
                </div>
              </div>
            </div>
            
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  <input type="text" required name="fn_numero" id="fi_numero" maxlength="35" class="form-control">
                  <label>Numero</label>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  <input type="text" required name="fn_referencia" id="fi_referencia" maxlength="200" class="form-control">
                  <label>Referencia</label>
                </div>
              </div>
            </div>

            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  

                  <input type="text" required name="fn_cbanco" id="fi_cbanco" maxlength="25" class="form-control">
                <label>Cuenta Bancaria</label>
                </div>
              </div>
            </div>
            </div>
            
          <div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  <input type="text" required name="fn_tfijo" id="fi_tfijo" maxlength="15" class="form-control">
                  <label>Telefono fijo</label>
                </div>
              </div>
            </div>
            
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  <input type="text" required name="fn_movil" id="fi_movil" maxlength="15" class="form-control">
                  <label>Telefono movil</label>
                </div>
              </div>
            </div>
          </div>  

          <div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  <input type="email" name="fn_mail" id="fi_mail" maxlength="35" class="form-control">
                  <label>Mail</label>
                </div>
              </div>
            </div>  

            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">

                  Tipo Consultorio
                   <select name="tc" id="tc" class="form-control" data-width="fit">
                    <?php
                      $sql="SELECT * FROM kg_tipo_consultorio where estado = 'A'";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$row['id_tipo_consultorio']."' >";
                          echo $row['desc_tipo_consultorio'];
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
                  
                  <input type="text" readonly="readonly" name="fn_alt" id="fi_alt" maxlength="35" class="form-control">
                  <label>Altitud</label>
                </div>
              </div>
            </div>
          

          <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  <input type="text" readonly="readonly" required name="fn_lon" id="fi_lon" maxlength="35" class="form-control">
                  <label>Longitud</label>
                </div>
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">    
                     
                  <input type="text" name="fn_tipo_consul" id="fi_tipo_consul" maxlength="35" class="form-control">
                  <label>Tipo de Consultorio</label>
                </div>
              </div>
            </div>
          
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">    
                     
                  <input type="text" name="fn_observaciones" id="fi_observaciones" maxlength="100" class="form-control">
                  <label>Observaciones</label>
                </div>
              </div>
            </div>
          </div>
          
          <div class="row">
          <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  Medico
                        <select class="" name="fn_med" id="fi_med">
                          <option value="P">Perdido </option>
                          <OPTION VALUE="N">Nuevo </OPTION>
                          <OPTION VALUE="E">Existente </OPTION>
                        </select>
                  
                </div>
              </div>
            </div>

            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  Adscrito a Arca 
                        <select class="" required name="fn_ads" id="fn_ads">
                          <option value="S">SI </option>
                          <OPTION VALUE="N">NO </OPTION>
                        </select>
                </div>
              </div>
            </div>
          
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                <input type="date" required name="fn_falta" id="fi_falta" maxlength="15">
                <label>Fecha Alta</label>
                </div>
              </div>
            </div>

          

         
          </div>


          <div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">    
                Visitador Médico   
                  <select  name="fn_visitador" id="fi_visitador"  class="form-control">
                    
                    <?php
                      $sql=" SELECT id_usuario, CONCAT(nombre, ' ', a_paterno, ' ', a_materno)AS nombre FROM se_usuarios WHERE fk_id_perfil in (12,42) AND activo = 'A'";
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
                  Horario
                  <input type="text" required name="fn_horario" id="fi_horario" maxlength="35" class="form-control">
                  
                </div>
              </div>
            </div>


          </div>

          
          <div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                Adscripción a la Unidad
                <select name="fn_sucursal" id="fi_sucursal" class="form-control">
                    <?php
                      $sql="SELECT * FROM kg_sucursales where estado = 'A'";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$row['id_sucursal']."' >";
                          echo $row['desc_sucursal'];
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
                  Trabaja con otro laboratorio
                  <input type="text" required name="fn_otro_lab" id="fi_otro_lab" maxlength="35" class="form-control">
                </div>
              </div>
            </div>
            
          </div>






          <div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                
                <input type="text" name="fn_usu" id="fi_usu" maxlength="30" class="form-control">
                <label>Usuario</label>
                </div>
              </div>
            </div>
          
           <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  
                  <input type="password" name="pass" id="fi_pass" maxlength="20" class="form-control">
                  <label>Contraseña</label>
                </div>
              </div>
            </div>

            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  
                  Medico Consulta Ext. Cuenta
                  <select class="" id="fi_acti" name="fn_acti">
                       <option value="1">SI</option>
                       <option value="0">NO</option>
                    </select>
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

<!--

            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  Estado del Medico 
                <select class="" id="estado_reg" name="estado_reg">
                       <option value="A">Activo</option>
                       <option value="S">Suspendido</option>
                    </select>


                </div>
              </div>
            </div>

-->

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
                  <input type="hidden" id="id_medico" name="id_medico" value="0">
                <input type="hidden" id="opcion" name="opcion" value="modificar">
                  <label>Id medico</label>
                </div>
              </div>
            </div>
      
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">

                  Zona
                   <select name="zona" id="fi_zona" class="form-control" data-width="fit">
                    <?php
                      $sql="SELECT * FROM kg_zonas where estado = 'A'";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$row['id_zona']."' >";
                          echo $row['desc_zona'];
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
                  Nombre
                  <input type="text" required name="fn_nombre" id="fi_nombre" maxlength="35" class="form-control">
                </div>
              </div>
            </div>
            
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  A. Paterno
                  <input type="text" required name="fn_apaterno" id="fi_apaterno" maxlength="35" class="form-control">
                </div>
              </div>
            </div>

            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  A. Materno
                  <input type="text" required name="fn_amaterno" id="fi_amaterno" maxlength="35" class="form-control ">
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  RFC
                <input type="text" required name="fn_rfc" id="fi_rfc" maxlength="15" class="form-control">
                </div>
              </div>
            </div>

            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  Sexo
                <select name="fn_sexo" id="fi_sexo" class="form-control">
                    <?php
                      $sql="SELECT * FROM so_sexo where activo = 'A'";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$row['id_sexo']."' >";
                          echo $row['desc_sexo'];
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
                  Especialidad
                <select name="especialidad" id="fi_especialidad" class="form-control">
                    <?php
                      $sql="SELECT * FROM km_especialidades where estado = 'A'";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$row['id_especialidad']."' >";
                          echo $row['desc_especialidad'];
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
                <select name="Estado" id="fi_estado"  class="form-control">
                    <?php
                      $sql="SELECT * FROM ku_estados where estado = 'A'";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$estado=$row['id_estado']."' >";
                          echo $row['desc_estado'];
                          echo "</option>";
                        }
                        
                        echo $estado ;
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
                <select name="Municipio" id="fi_Municipio" class="form-control">
                    
                  </select>
                </div>
              </div>
            </div>
            
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  Localidad
                <select name="fn_Localidad" id="fi_Localidad" class="form-control">
                    
                  </select>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  Colonia
                  <input type="text" required name="fn_colonia" id="fi_colonia" maxlength="50" class="form-control">
                </div>
              </div>
            </div>

            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  CP
                  <input type="number" required name="fn_cp" id="fi_cp" maxlength="6" class="form-control">
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  Calle
                  <input type="text" required name="fn_calle" id="fi_calle" maxlength="150" class="form-control">
                </div>
              </div>
            </div>
            
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  Número
                  <input type="text" required name="fn_numero" id="fi_numero" maxlength="35" class="form-control">
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  Referencia
                  <input type="text" required name="fn_referencia" id="fi_referencia" maxlength="200" class="form-control">
                </div>
              </div>
            </div>

            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  Cuenta Bancaria
                  <input type="text" required name="fn_cbanco" id="fi_cbanco" maxlength="25" class="form-control">
                </div>
              </div>
            </div>
            </div>
            
          <div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  Telefono fijo
                  <input type="text" required name="fn_tfijo" id="fi_tfijo" maxlength="15" class="form-control">
                </div>
              </div>
            </div>
            
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  Telefono movil
                  <input type="text" required name="fn_movil" id="fi_movil" maxlength="15" class="form-control">
              </div>
            </div>
          </div>  
        </div>

          <div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  Mail
                  <input type="text" name="fn_mail" id="fi_mail" maxlength="35" class="form-control">
              </div>
            </div>  
          </div>

            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  Latitud
                  <input type="text" readonly="readonly" name="fn_lat" id="fi_lat" maxlength="35" class="form-control">
                </div>
              </div>
            </div>
          </div>
          
        <div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">

                  Tipo Consultorio
                   <select name="tc" id="tc" class="form-control" data-width="fit">
                    <?php
                      $sql="SELECT * FROM kg_tipo_consultorio where estado = 'A'";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$row['id_tipo_consultorio']."' >";
                          echo $row['desc_tipo_consultorio'];
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
                  Longitud
                  <input type="text" readonly="readonly" name="fn_lon" id="fi_lon" maxlength="35" class="form-control">
                  <label></label>
                </div>
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">    
                  Tipo de Consultorio   
                  <input type="text" name="fn_tipo_consul" id="fi_tipo_consul" maxlength="35" class="form-control">
                  
                </div>
              </div>
            </div>
          
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">    
                  Observaciones   
                  <input type="text" name="fn_observaciones" id="fi_observaciones" maxlength="100" class="form-control">
                  
                </div>
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  Medico
                        <select class="" required name="fn_med" id="fi_med">
                          <option value="P">Perdido </option>
                          <OPTION VALUE="N">Nuevo </OPTION>
                          <OPTION VALUE="E">Existente </OPTION>
                        </select>
                  
                </div>
              </div>
            </div>

            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  Adscrito a Arca 
                        <select class="" required name="fn_ads" id="fn_ads">
                          <option value="S">SI </option>
                          <OPTION VALUE="N">NO </OPTION>
                        </select>
                </div>
              </div>
            </div>
          
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                <input type="date" name="fn_falta" id="fi_falta" maxlength="15">
                <label>Fecha Alta</label>
                </div>
              </div>
            </div>
          </div>


          <div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">    
                Visitador Médico   
                  <select  name="fn_visitador" id="fi_visitador" class="form-control">
                    
                    <?php
                      $sql=" SELECT id_usuario, CONCAT(nombre, ' ', a_paterno, ' ', a_materno)AS nombre FROM se_usuarios WHERE fk_id_perfil in (12,42) AND activo = 'A'";
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
                  Horario
                  <input type="text" required name="fn_horario" id="fi_horario" maxlength="35" class="form-control">
                </div>
              </div>
            </div>
          </div>

          
          <div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                Adscripción a la Unidad
                <select required name="fn_sucursal" id="fi_sucursal" class="form-control">
                    <?php
                      $sql="SELECT * FROM kg_sucursales where estado = 'A'";
                      $rec=mysqli_query($conexion,$sql);
                      while ($row=mysqli_fetch_array($rec))
                        {
                          echo "<option value='".$row['id_sucursal']."' >";
                          echo $row['desc_sucursal'];
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
                  Trabaja con otro laboratorio
                  <input type="text" required name="fn_otro_lab" id="fi_lab" maxlength="35" class="form-control">
                </div>
              </div>
            </div>
            
          </div>

           <div class="row">
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                Usuario
                <input type="text" name="fn_usu" id="fi_usu" maxlength="30" class="form-control">
                </div>
              </div>
            </div>
          
           <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                 <br>Medico Consulta Ext. Cuenta
                  <select class="" id="fi_acti" name="fn_acti">
                       <option value="1">SI</option>
                       <option value="0">NO</option>
                    </select>
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
                <input type="text" readonly="readonly" disabled   name="categoria" id="categoria" maxlength="15">
                <label>Categoria</label>
                </div>
              </div>
            </div>

<!--
            <div class="col">
              <div class="md-form mt-0">
                <div class="md-form">
                  Estado del Medico 
                <select class="" id="estado_reg" name="estado_reg" readonly="readonly">
                       <option value="A">Activo</option>
                       <option value="S">Suspendido</option>
                    </select>


                </div>
              </div>
            </div>
-->

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